<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model

{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['id','name', 'email', 'password'];

    protected $hidden = ['password'];

    public $timestamps = false;
}
