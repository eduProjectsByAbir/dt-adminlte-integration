<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    // password meutator
    public function setPasswordAttribute($password){

        // checking empty password
        if (trim($password) == '') {
            return;
        }
        // encrypting using bcrypt
        $this->attributes['password'] = bcrypt($password);
    }
}
