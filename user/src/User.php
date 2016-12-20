<?php

namespace Jumper\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Hash;
use Jumper\UserRole\UserRole as Role_user;
use Jumper\Role\Role as Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'trial_ends_at',
    ];

    public function field_visits($value = '')
    {
        return $this->hasMany('App\FieldVisit', 'coordinator_id');
    }

    public function time_sheets($value = '')
    {
        return $this->hasMany('App\Educator_time_sheet', 'user_id');
    }

    /*public function subscriptions()
    {
        return $this->hasMany('App\Subscription','user_id');
    }*/

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            // 'email' => 'required',
            'contact' => 'required',
        ]);
    }

    protected static function create_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|unique:users',
            'name' => 'required',
            'contact' => 'required',
        ]);
    }

    public function change_password($id = '', $password)
    {
        $user = self::find($id);
        if ($user) {
            $user->password = Hash::make($password);
        }
    }

    public function assign_role($value = '')
    {
    }

    public static function update_validation($user, $data)
    {
        $rules = [
                        'email' => 'required|unique:users',
                        'name' => 'required',
                        'contact' => 'required',
                    ];

        if ($user->email == $data->email) {
            $rules['email'] = 'required';
        }

        $validation = Validator::make($data->all(), $rules);
        if ($validation->fails()) {
            return ['stat' => false, 'msg' => $user_validation->errors()->all()];
        }

        return ['stat' => true];
    }

    public static function save_user($data, $id = null)
    {
        if ($id = intval($id)) {
            $user = self::find($id);
            $resp = self::update_validation($user, $data);

            if (!$resp['stat']) {
                return $resp;
            }
            $user->email = $data->email;

            if (!empty($data->password) && $data->password != 'null') {
                $user->password = Hash::make($data->password);
            }

            // protecting Root admin
            if ($id == 1 && !Auth::user()->hasRole('root_admin')) {
                abort(403, 'Unauthorized action.');
                die();
            }

            Log::info('User ('.$user->email.') Details updated by :'.Auth::user()->email);
        } else {
            $user_validation = self::create_validator($data->all());
            if ($user_validation->fails()) {
                return ['stat' => false, 'msg' => $user_validation->errors()->all()];
            }
        }

        if (!$id) {
            $user = new self();
            $user->password = Hash::make($data->password);
            $user->email = $data->email;
           // $user->user_id = Auth::user()->id;
            //$user->status = 1;
        }

        $user->name = $data->name;
        //$user->contact = $data->contact;

        $user->save();

        if (!empty($data->roles) && $data->roles !=  'null') {
            self::assignRole($user, $data->roles);
        }

        return ['stat' => true, 'data' => $user];
    }

    public static function assignRole($user, $roles)
    {
        if (!empty($roles)) {

                // protecting Root Admin's right
                if ($user->hasRole('root_admin')) {
                    if (!Auth::user()->hasRole('root_admin')) {
                        return false;
                    }
                }

            $oldRole = Role_user::where('user_id', '=', $user->id);
            $oldRole->delete();

                // assigning new roles
                $roles = explode(',', $roles);
            foreach ($roles as $key => $role) {
                // allowing only root admin to assign anyone as root admin
                    $role = intval($role);
                $user->roles()->attach(intval($role));
            }
        }

        return true;
    }

    public static function check_permission($user_id = '')
    {

        // $user = self::find($user_id);
        // if()
    }

    /**
     * Get All Users details Based on Users Role.
     *
     * @param User $user
     *
     * @return array
     *
     * @author 
     **/
    public static function getUsers($user)
    {
        if ($user) {
            if ($user->hasRole('root_admin')) {
                return self::with('roles')->orderBy('id', 'desc')->get();
            } elseif ($user->hasRole('admin')) {
                return self::with('roles')->orderBy('id', 'desc')->where('id', '!=', 1)->get();
            } elseif ($user->hasRole('company')) {
                return self::with('roles')->orderBy('id', 'desc')->where('user_id', '=', $user->id)->get();
            } elseif ($user->hasRole('company_admin')) {
                return self::with('roles')
                            ->where('user_id', '=', $user->user_id)
                            ->where('id', '!=', $user->user_id)
                            ->where('id', '!=', $user->id)
                            ->orderBy('id', 'desc')
                            ->get();
            }
        }
    }

    /**
     * Get All Role details Based on Users Role.
     *
     * @param User $user
     *
     * @return array
     *
     * @author 
     **/
    public static function roleMeta($user = '')
    {
        if (!Auth::user()->hasRole('root_admin')) {
            $role_meta = Role::where('name', '!=', 'root_admin')->get();
        } else {
            $role_meta = Role::all();
        }

        if ($user) {
            if ($user->hasRole('root_admin')) {
                return Role::all();
            } elseif ($user->hasRole('admin')) {
                return Role::where('name', '!=', 'root_admin')->get();
            } elseif ($user->hasRole('company') || $user->hasRole('company_admin')) {
                return Role::where('name', '!=', 'root_admin')->where('name', '!=', 'admin')->where('name', '!=', 'company')->get();
            }
        }
    }

    /**
     * Check if educator belongs to educator or not.
     *
     * @param User $user
     * @param User $company
     *
     * @return Boolen
     *
     * @author 
     **/
    public static function doesBelongsToCompany($user = '')
    {
        $session_user = Auth::user();
        if ($session_user->id == $user) {
            return true;
        } elseif ($session_user->hasRole('root_admin') || $session_user->hasRole('admin')) {
            return true;
        } elseif ($session_user->hasRole('company')) {
            $company_id = $session_user->id;
            $educator = self::find($user);

            if ($educator->user_id == $company_id) {
                return true;
            }

            return false;
        } elseif ($session_user->hasRole('company_admin') || $session_user->hasRole('coordinator')) {
            $company_id = $session_user->user_id;
            $educator = self::find($user);

            if ($educator->user_id == $company_id) {
                return true;
            }

            return false;
        }

        return;
    }

    /**
     * get owner ID.
     *
     * @param User $user
     *
     * @return int Uuser_id
     *
     * @author 
     **/
    public static function owner($user = '')
    {
        if ($user->hasRole('root_admin') || $user->hasRole('admin')) {
            return 1;
        } elseif ($user->hasRole('company')) {
            return $user->id;
        } elseif ($user->hasRole('company_admin') || $user->hasRole('coordinator')) {
            return $user->user_id;
        } elseif ($user->hasRole('educator')) {
            return $user->user_id;
        } else {
            return $user->user_id;
        }
    }

    /**
     * sets the Imersonate flag to session.
     *
     * @param int $id user_id App\User->id
     *
     * @author 
     **/
    public function setImpersonating($id)
    {
        Session::put('impersonate', $id);
    }

    /**
     * Destory the Imersonate session.
     * 
     * @author 
     **/
    public function stopImpersonating()
    {
        Session::forget('impersonate');
    }

    /**
     * returns true if is being impersonated or else return false.
     * 
     * @return Boolen
     *
     * @author 
     **/
    public function isImpersonating()
    {
        return Session::has('impersonate');
    }
    /**
     * Deletes file uploaded
     *
     * @return void
     * @author 
     **/
    
    public static function deleteFiles($file='', $path=null)
    {
        if($path){
            $file = $path.'/'.$file;
        }else{
            $file = 'uploads/'.$file;
        }
        if(File::exists($file)){
            File::delete($file);
            return true;
        }else{
            return false;
        }
    }

    /**
     * Saves profile picture
     *
     * @return $user->profile_pic
     * @author 
     **/
    
    public static function saveProfilePic($file='',$educator_id)
    {
       $user = User::find($educator_id);
       $user->profile_pic = $file;
       $user->save();
       return $user->profile_pic;
    }
}
