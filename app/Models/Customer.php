<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'email',
        'password',
        'disable_flag',
        'delete_flag',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
