<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticationController::class)->group(function () 
{
 Route::get('/register','register')->name('register');
 Route::post('/register','userStore')->name('register');

 Route::get('/login','login')->name('login');
 Route::post('/login','Authenticate')->name('Authenticate');
 Route::get('/logout','logout')->name('logout');

 Route::get('/forget_password','forgetPassword')->name('forgetPassword');
 Route::post('/forget_password','sendForgetPasswordEmail')->name('sendForgetPasswordEmail');

 Route::get('reset-password/{token}','resetPassword')->name('resetPassword');
 Route::post('reset-password','resetPasswordData')->name('resetPasswordData');

});

Route::controller(UserController::class)->group(function()
{
   Route::get('/profile','profileUser')->name('profileUser');
   Route::put('/profile','profileUserUpdate')->name('profileUserUpdate');
   Route::post('/profile','imageUserUpdate')->name('imageUserUpdate');
});


// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard',[AdminController::class,'dashboard'])->name('ad_dash');
// });

Route::group(['prefix'=>'admin','middleware'=>'RoleMiddleware'],function(){

    // Admin routes is here
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('admin_dash');
      //admin profile route  
        Route::get('/admin-profile','profileAdmin')->name('admin_profile');
        Route::put('/admin-profile','profileAdminUpdate')->name('admin_profileUpdate');
        Route::post('/admin-profile','imageAdminUpdate')->name('admin_imageUpdate');
      //admin profile end
        Route::get('/user-list','userList')->name('admin_userlist');
        Route::get('/edit-users/{id}','editUsers')->name('admin_showUsers');
        Route::put('/edit-users/{id}','updateUsers')->name('admin_updateUsers');
        Route::post('/edit-user/{id}','updateUserProfile')->name('admin_updateUsersProfile');
        Route::get('/add-user','addUser')->name('admin_addUser');
        Route::post('/add-user','storeUser');
        Route::get('/user-action/{id}/{status?}','userAction')->name('admin_user_action');
    });

    //brand controller with admin prefix
    Route::resource('/brand',BrandsController::class);
    Route::controller(BrandsController::class)->group(function(){
        Route::post('/change-brand-image/{id}','changeBrandImage')->name('admin_changeBrandImage');
        Route::get('/brand-action/{id}/{status?}','changeBrandStatus')->name('admin_changeBrandStatus');
    });
    //product controller with admin prefix
    Route::resource('/product',ProductsController::class);
    
    Route::controller(ProductsController::class)->group(function(){
        Route::post('/change-product-image/{id}','changeProductImage')->name('admin_changeProductImage');
        Route::get('/product-action/{id}/{status?}','changeProductStatus')->name('admin_changeProductStatus');
    });

    //order controller and lineitems
    Route::controller(orderController::class)->group(function (){
        Route::get('/order-list','ordreList')->name('admin_order_list');
        Route::get('/change-order-status/{id}','changeOrderStatus')->name('admin_changeOrderStatus');
        Route::get('/line-items/{id}','LineItems')->name('admin_lineItems');
    });
   
});


//Home Controller group

Route::controller(HomeController::class)->group(function(){
    Route::get('/','indexPage')->name('index');
    Route::get('/product-info/{id}','productInfo')->name('product_info');
    Route::get('/view-products','viewProducts')->name('view_products');
    
});

//Cart functionality
Route::resource('/cart',CartController::class);
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('add_to_cart');
Route::get('/store-order',[CartController::class,'storeOrder'])->name('store_order');