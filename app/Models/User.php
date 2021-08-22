<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /**
     *  !Access tokens
        Personal access client created successfully.
        Client ID: 942c0f52-78cd-41f4-8471-0f2c57cbc340
        Client secret: mmINaJZ3dLjGgZNWQm6e52VP5cauNL9aeJRXc6m8
        
        Password grant client created successfully.
        Client ID: 942c0f52-7f05-4a09-a9a6-64852709d1e6
        Client secret: ewO62a3T6eIpkMEcQfnDTTDZoaSezq4mzcX6h87C

        // !NEW
        Password grant client created successfully.
        Client ID: 942c1ffe-25df-4bd8-a438-1c99c5b9c587
        Client secret: AUlWRZB041KaUxmRUjsAJPyV58bZBKKwiF5Py1oq
     * 
    */


    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
