<?php

namespace Jumper\Role;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Validator;

class Role extends EntrustRole
{
    /**
     * Get a validator for an incoming save request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected static function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'display_name' => 'required',
        ]);
    }
}
