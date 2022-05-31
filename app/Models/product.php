<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'price',
        'idcategory',
        'idbrand',
        'status',
        'sale',
        'company',
        'image',
        'detail'];
    public $timestamps = true;
}
