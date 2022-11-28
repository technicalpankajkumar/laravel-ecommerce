<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $primaryKey="id";
    
    protected $fillable=[
        'user_id',
        'total_price',
        'shipping_charge',
        'including_tax',
        'tax_rate',
        'total_amount',
        'comment',
        'status'
    ];

    public function userData(){
        return $this->hasOne(User::class,'id','user_id')->select('id','first_name','last_name');
    }
    public function getLineItems(){
        return $this->hasMany(Lineitem::class,'order_id','id');
    }
}
