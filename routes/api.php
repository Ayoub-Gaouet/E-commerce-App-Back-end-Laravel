<?php

use App\Http\Controllers\api\address\AddressController;
use App\Http\Controllers\api\Auth\ForgetPassword\CheckEmailController;
use App\Http\Controllers\api\Auth\ForgetPassword\ResetPasswordController;
use App\Http\Controllers\api\Auth\ForgetPassword\VerifyCodeController;
use App\Http\Controllers\api\Auth\LoginController;
use App\Http\Controllers\api\Auth\SignUpController;
use App\Http\Controllers\api\Auth\VerifyCodeSignUpController;
use App\Http\Controllers\api\Cart\CartController;
use App\Http\Controllers\api\Categories\ViewController;
use App\Http\Controllers\api\Favorite\FavoriteController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\Items\ItemsController;
use App\Http\Controllers\api\Items\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//auth
Route::post('/auth/signup', [SignUpController::class, 'signup']);
Route::post('/auth/verifyCodeSignUp', [VerifyCodeSignUpController::class, 'verifyCodeSignUp']);
Route::post('/auth/resend', [VerifyCodeSignUpController::class, 'resend']);
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/forgetpassword/checkEmail', [CheckEmailController::class, 'checkEmail']);
Route::post('/auth/forgetpassword/verifyCode', [VerifyCodeController::class, 'verifyCode']);
Route::post('/auth/forgetpassword/resetPassword', [ResetPasswordController::class, 'resetPassword']);
//categories
Route::get('/categories/getAllData', [ViewController::class, 'getAllData']);
//home
Route::get('/home',[HomeController::class,'getAllData']);
//items
Route::get('/items/getDataByCategory/{id}/{userId}', [ItemsController::class, 'getDataByCategory']);
Route::get('/items/search/{name}', [SearchController::class, 'search']);
//favorite
Route::post('/favorite/addFavorite/{usersId}/{itemsId}', [FavoriteController::class, 'addFavorite']);
Route::delete('/favorite/deleteFavorite/{usersId}/{itemsId}', [FavoriteController::class, 'deleteFavorite']);
Route::get('/favorite/getFavorite/{usersId}', [FavoriteController::class, 'getFavorite']);
Route::delete('/favorite/deletefromfavroite/{favoriteId}', [FavoriteController::class, 'deletefromfavroite']);
//cart
Route::post('/cart/addCart/{usersId}/{itemsId}', [CartController::class, 'addCart']);
Route::delete('/cart/removeCart/{usersId}/{itemsId}', [CartController::class, 'removeCart']);
Route::get('/cart/getCount/{usersId}/{itemsId}', [CartController::class, 'getCount']);
Route::get('/cart/getAllData/{usersId}', [CartController::class, 'getAllData']);
//address
Route::get('/address/view/{user_id}', [AddressController::class, 'view']);
Route::post('/address/add', [AddressController::class, 'add']);
Route::put('/address/edit/{user_id}/{address_id}', [AddressController::class, 'edit']);
Route::delete('/address/delete/{user_id}/{address_id}', [AddressController::class, 'delete']);

