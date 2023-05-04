<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewProductController;
use App\Http\Controllers\UserServiceController;

// use App\Http\Controllers\Product\testController;
use GuzzleHttp\Middleware;

use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\Test\ToolController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $firstname = "Bill";
    // $lastname = "Gates";
    // $age = "60";

    // $result = compact("firstname", "lastname", "age");
    return view('web.wel');
});

Route::get('name', function () {
    return view('login');
});

Route::get('view-product', 'ViewProductController');
Route::get('view-prod', [ViewProductController::class, 'testtest']);
Route::get('get-object', [ViewProductController::class, 'getObjectVars']);
Route::get('get-items', [ViewProductController::class, 'getcartitem']);

Route::get('makeCSV', [ViewProductController::class, 'makeCSV']);


// Route::get('view-prod', [ViewProductController::class, 'index']);
// Route::get('user/{id}', function ($id) {
//     return 'id' . $id;
// })
//     // -> where('id', '[0-9]+')
// ;

// Route::get('user/{id?}', function ($id = 99) {
//     return 'user' . $id;
// })
//     ->where('id', '[0-9]+');


// 寫法 1~3
Route::get('member', [MemberController::class, 'nowMember']);
// Route::get('/member','App\Http\Controllers\MemberController@nowMember');
// Route::get('/member', [MemberController::class, 'nowMember'])->name('member');

// Route::group(['middleware' => 'check.dirty'], function () {
Route::resource('products', 'ProductController');
// });
// Route::post('products', 'Product\ProductController@store');
Route::get('get-product-redis', [ProductController::class, 'index']);



Route::group(
    [
        // 'middleware' => ['checkIP'],
        'prefix' => 'admin',
        // 'namespace' => 'Web'
    ],
    function () {
        Route::get('home', [HomeController::class, 'getHome']);
        Route::post('homePage', [HomeController::class, 'homePage']);
    }
);

// Route::post('/login', [LoginController::class, 'postLogin']);
// Route::post('/login', LoginController::class);


Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);


// Route::post('test', [testController::class, 'store']);
Route::get('test', [TestController::class, 'store']);


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::resource('cart', 'CartController');
    Route::resource('cart-items', 'CartItemController');
});

// jobs
Route::post('update-product-price', [ToolController::class, 'updatePrice']);

// set redis
Route::post('set-product-redis', [ToolController::class, 'setProductRedis']);

// services
Route::post('useService', [UserServiceController::class, 'index']);