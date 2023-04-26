<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Worker extends Authenticatable
{
    use HasFactory, Notifiable;

    const administrator_number = 1;

    /**
    * @var array
    */
    protected $fillable = [
        'worker_id',
        'password',
    ];

    /**
    * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
        'worker_name',
        'sex',
        'age',
        'address',
        'department',
        'division',
        'hire_date',
    ];

    /**
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * @var string
    */
    protected $primaryKey = 'worker_id';
}
