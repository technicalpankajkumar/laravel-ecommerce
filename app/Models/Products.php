<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    
    protected $table="products";
    protected $primaryKey="id";
    protected $fillable=[
        'name',
        'brand_id',
        'price',
        'sale_price',
        'color',
        'product_code',
        'gender',
        'function',
        'stock',
        'description',
        'image',
        'action'
    ];

    public function getBrandsData(){
        return $this->belongsTo(Brands::class,'brand_id','id');
    }
}
