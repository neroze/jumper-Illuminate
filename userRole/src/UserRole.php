<?php

namespace Jumper\UserRole;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';

    protected $fillable = ['user_id', 'role_id'];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('Jumper\User\User');
    }
}
