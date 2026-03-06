<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admins extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password'
    ];
}
