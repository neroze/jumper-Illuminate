<?php

namespace Jumper\Role\Controllers;

use Illuminate\Http\Request;
use Illuminate\Response;
use Jumper\Response\Response as JResponse;
use Jumper\Core\Controllers\Controller;
use Jumper\User\User;
use Jumper\Role\Role;

class RoleController extends Controller
{
    /**
     * Instantiate a new new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['access_only_if_rool_as:root_admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JResponse::data($this->role_Summery());
    }

    /**
     * Display Role Manage table.
     */
    public function manage()
    {
        $roles = $this->role_Summery();

        return view('jumperRole::manage', compact('roles'));
    }

    /**
     * count number of user for the roles.
     *
     * @return JSON
     */
    public function role_Summery()
    {
        return Role::with('users')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Create New Role';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Role::validator($request->all());
        if ($validator->fails()) {
            return JResponse::error($validator->errors()->all());
        } else {
            $role = new Role();
            $role->name = strtolower(str_replace(' ', '_', $request->name));
            $role->display_name = ucfirst($request->display_name);
            $role->description = $request->description;
            $role->save();

            return JResponse::data([$role]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find(intval($id));
        if ($role) {
            return JResponse::data($role);
        }

        return JResponse::error('Object Not Found.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // show form to edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Role::validator($request->all());
        if ($validator->fails()) {
            return JResponse::error($validator->errors()->all());
        } else {
            $role = Role::find(intval($id));
            if ($role) {
                $role->name = strtolower(str_replace(' ', '_', $request->name));
                $role->display_name = ucfirst($request->display_name);
                $role->description = $request->description;
                $role->save();

                return JResponse::data($role);
            }

            return JResponse::error('Object Not Found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return JResponse::error('Role Can not be Deleted.');

        $role = Role::find(intval($id));
        if ($role) {
            $role->delete();

            return JResponse::data('Role Deleted.');
        }

        return JResponse::error('Object Not Found.');
    }

    // For permissions
     public function createPermission(Request $request)
     {
         $viewUsers = new Permission();
         $viewUsers->name = $request->name;
         $viewUsers->save();

         return response()->json('created');
     }

    public function assignRole(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        $role = Role::where('name', '=', $request->role)->first();
        //$user->attachRole($request->role'));
        $user->roles()->attach($role->id);

        return response()->json('created');
    }

    public function attachPermission(Request $request)
    {
        $role = Role::where('name', '=', $request->role)->first();
        $permission = Permission::where('name', '=', $request->name)->first();
        $role->attachPermission($permission);

        return response()->json('created');
    }
}
