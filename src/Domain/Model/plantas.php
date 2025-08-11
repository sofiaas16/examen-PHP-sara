<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Plantas extends Model
{
    protected $table = 'plantas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
