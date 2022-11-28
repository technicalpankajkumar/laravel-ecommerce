<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function indexPage(){
        $brands=Brands::all();
        // $startDate=Carbon::now()->firstOfMonth(); 
        // $lastDate=Carbon::now()->lastOfMonth();
        // $products=Products::whereBetween('Created_at',[$startDate,$lastDate])->inRandomOrder()->limit(8)->get();
        $products=Products::inRandomOrder()->limit(12)->get();
        // echo"<pre>";
        // print_r($lastDate);
        // die;
        return view('index_user',compact('brands','products'));
    }

    public function productInfo(Request $request,$id)
    {
        $productInfo=Products::find($id);
        $products=Products::where('gender',$productInfo->gender)->inRandomOrder()->limit(4)->get();
        // echo"<pre>";
        // print_r($products);
        // die;
        return view('product_info',compact('productInfo','products'));
    }
    public function viewProducts(Request $request)
    {
        $requestData=$request->all();   
        $brands=Brands::all();
        $functions=Config::get('add_function_admin');
        $products=Products::query();
        // fillter condition
        if(isset($requestData['gender']) && !empty($requestData['gender'])){
            $products=$products->where('gender',$requestData['gender']);
        }
        if(isset($requestData['color']) && !empty($requestData['color'])){
            $products=$products->where('color',$requestData['color']);
        }
        if(isset($requestData['function']) && !empty($requestData['function'])){
            $products=$products->where('function',$requestData['function']);
        }
        if(isset($requestData['brand']) && !empty($requestData['brand'])){
            $products=$products->where('brand_id',$requestData['brand']);
        }
        if(isset($requestData['price']) && !empty($requestData['price'])){
            if($requestData['price']=='less_than_1500')
            {
                $products=$products->where('price','<=',1500);
            }
            else if($requestData['price']=='between_1500_5k')
            {
                $products=$products->whereBetween('price',[1500,5000]);
            }
            else if($requestData['price']=='between_5k_10k')
            {
                $products=$products->whereBetween('price',[5000,10000]);
            }
            else if($requestData['price']=='between_10k_30k')
            {
                $products=$products->whereBetween('price',[10000,30000]);
            }
            else if($requestData['price']=='greater_than_30k')
            {
                $products=$products->where('price','>=',30000);
            }      
        }

        if(isset($requestData['sort_by']) && !empty($requestData['sort_by'])){
            if($requestData['sort_by']=='lower_to_higher')
            {
                $products=$products->orderBy('price','ASC');
            }
            else if($requestData['sort_by']=='higher_to_lower')
            {
                $products=$products->orderBy('price','DESC');
            }
            else if($requestData['sort_by']=='model_a_z')
            {
                $products=$products->orderBy('name','ASC');
            }
            else if($requestData['sort_by']=='model_z_a')
            {
                $products=$products->orderBy('name','DESC');
            }  
        }

        $products=$products->paginate(12);
        return view('all_product_view',compact('products','brands','functions'));
    }

    
}
