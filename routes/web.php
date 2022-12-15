<?php

use App\Traits\StorageImageTrait;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingAdminController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminRolesController;

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

Route::get('/admin', [AdminController::class, "loginAdmin"]);

Route::post('/admin', [AdminController::class, "postLoginAdmin"]);

Route::get('/home', function () {
    return view('home');
});
//Route Admin 
Route::prefix('admin')->group(function () {
    
    //Category Route

    Route::prefix('categories')->group(function () {
        
        Route::get('/create', [CategoryController::class, "create"])->name("categories.create");

        Route::get('/', [CategoryController::class, "index"])->name("categories.index");

        Route::post('/store', [CategoryController::class, "store"])->name("categories.store");

        Route::get('/edit/{id}', [CategoryController::class, "edit"])->name("categories.edit");

        Route::get('/delete/{id}', [CategoryController::class, "delete"])->name("categories.delete");

        Route::post('/update/{id}', [CategoryController::class, "update"])->name("categories.update");
    });

    //Menus Route

    Route::prefix('menus')->group(function () {

        Route::get('/', [MenuController::class, "index"])->name("menus.index");

        Route::get('/create', [MenuController::class, "create"])->name("menus.create");

        Route::post('/store', [MenuController::class, "store"])->name("menus.store");

        Route::get('/edit/{id}', [MenuController::class, "edit"])->name("menus.edit");

        Route::post('/update/{id}', [MenuController::class, "update"])->name("menus.update");

        Route::get('/delete/{id}', [MenuController::class, "delete"])->name("menus.delete");
    });

    // Route Sản Phẩm

    Route::prefix('product')->group(function () {

        Route::get('/', [AdminProductController::class, "index"])->name("product.index");

        Route::get('/create', [AdminProductController::class, "create"])->name("product.create");

        Route::post('/store', [AdminProductController::class, "store"])->name("product.store");

        Route::get('/edit{id}', [AdminProductController::class, "edit"])->name("product.edit");

        Route::post('/update{id}', [AdminProductController::class, "update"])->name("product.update");

        Route::get('/delete{id}', [AdminProductController::class, "delete"])->name("product.delete");
    });

    //Route slider

    Route::prefix('slider')->group(function () {

        Route::get('/', [SliderController::class, "index"])->name("slider.index");

        Route::get('/create', [SliderController::class, "create"])->name("slider.create");

        Route::post('/store', [SliderController::class, "store"])->name("slider.store");

        Route::get('/edit{id}', [SliderController::class, "edit"])->name("slider.edit");

        Route::post('/update{id}', [SliderController::class, "update"])->name("slider.update");

        Route::get('/delete{id}', [SliderController::class, "delete"])->name("slider.delete");
    });

    //Route Setting

    Route::prefix('settings')->group(function () {

        Route::get('/', [SettingAdminController::class, "index"])->name("settings.index");

        Route::get('/create', [SettingAdminController::class, "create"])->name("settings.create");

        Route::post('/store', [SettingAdminController::class, "store"])->name("settings.store");

        Route::get('/edit{id}', [SettingAdminController::class, "edit"])->name("settings.edit");

        Route::post('/update{id}', [SettingAdminController::class, "update"])->name("settings.update");

        Route::get('/delete{id}', [SettingAdminController::class, "delete"])->name("settings.delete");

    });

    // Route User

    Route::prefix('users')->group(function(){
        Route::get('/', [AdminUserController::class, "index"])->name("users.index");

        Route::get('/create', [AdminUserController::class, "create"])->name("users.create");

        Route::post('/store', [AdminUserController::class, "store"])->name("users.store");

        Route::get('/edit/{id}', [AdminUserController::class, "edit"])->name("users.edit");

        Route::post('/update/{id}', [AdminUserController::class, "update"])->name("users.update");

        Route::get('/delete/{id}', [AdminUserController::class, "delete"])->name("users.delete");
    });

    // Route Roles

    Route::prefix('roles')->group(function(){
        Route::get('/', [AdminRolesController::class, "index"])->name("roles.index");

        Route::get('/create', [AdminRolesController::class, "create"])->name("roles.create");

        Route::post('/store', [AdminRolesController::class, "store"])->name("roles.store");

        Route::get('/edit/{id}', [AdminRolesController::class, "edit"])->name("roles.edit");

        Route::post('/update/{id}', [AdminRolesController::class, "update"])->name("roles.update");

        Route::get('/delete/{id}', [AdminRolesController::class, "delete"])->name("roles.delete");
    });

    // Route Permissions

    Route::prefix('permissons')->group(function(){

        Route::get('/permissons', [AdminRolesController::class, "createPermission"])->name("permissons.create");

    });



});


