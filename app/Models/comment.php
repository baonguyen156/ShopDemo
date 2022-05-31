<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['idblog','iduser','cmt','avatar','name','level'];
    public $timestamps = true;
    public function replies()
    {
        return $this->hasMany('App\Models\comment','level');
    }
}
