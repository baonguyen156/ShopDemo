<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    protected $table ='rate';
    protected $fillable = ['point','blog_id'];
    public $timestamps = false;
}
