<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
    protected $primaryKey='id';
    protected $fillable=
    [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function getProductData()
    {
        return $this->hasOne(Products::class,'id','product_id');
    }
}
