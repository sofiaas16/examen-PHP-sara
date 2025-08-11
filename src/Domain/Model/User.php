<?php

declare(strict_types=1);

namespace App\Domain\Model\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];
}
