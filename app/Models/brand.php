<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table = 'brand';
    protected $fillable = ['brand'];
    public $timestamps = true;
}
