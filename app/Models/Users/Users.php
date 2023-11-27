<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    //protected $fillable = ['title','name'];
/*
    public $rules = array(
        'email' => 'required|unique|max:255',
        'name' => 'required',
        'password' => 'required'
	);
	*/


public function messages()
{
    return [
        'email.required' => 'A title is required',
        'email.unique'  => '11',
    ];
}
}
