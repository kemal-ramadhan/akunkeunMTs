<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orangtuawali extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public static $rules = [
        'username' => 'required|unique:orangtuawalis,username',
        'password' => 'required',
    ];

    protected $messages = [
        'username.unique' => 'Username sudah ada. Silakan pilih username lain.',
    ];
}
