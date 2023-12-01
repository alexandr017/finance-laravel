<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'status', 'confirmation_code', 'confirmed'];

    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        return in_array($this->email, config('admins'));
    }
}
