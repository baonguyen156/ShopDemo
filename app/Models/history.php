<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $table = 'history';
    protected $fillable = ['name','email','iduser','phone','price'];
    public $timestamps = true;
}
