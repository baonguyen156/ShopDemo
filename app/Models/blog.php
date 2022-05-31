<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blog';
    protected $fillable = ['title', 'image', 'description', 'content'];
    public $timestamps = false;
    public function comment()
    {
        return $this->hasMany('App\comment','idblog');
    }
}
