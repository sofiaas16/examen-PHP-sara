<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class riego extends Model
{
    protected $table = 'riego';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha_riego',
    ];
}
