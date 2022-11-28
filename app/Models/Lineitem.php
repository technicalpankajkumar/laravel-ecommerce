<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineitem extends Model
{
    use HasFactory;

    protected $table='lineitems';
    protected $primaryKey='id';
    protected $fillable=
    [
        'user_id',
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price'
    ];

    public function getUserData()
    {
        return $this->hasOne(User::class,'id','user_id')->select('id','first_name','last_name'); 
    }

    public function getProductData()
    {
        return $this->hasOne(Products::class,'id','product_id'); 
    }

    public function getOrderData()
    {
        return $this->hasOne(Order::class,'id','order_id')->select('id','status','total_amount');
    }

}
