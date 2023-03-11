<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MediumController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    return "test";
});

// routes for products
Route::resource('products', ProductsController::class);
Route::get('/products/{productId}/restore', [ProductsController::class, 'restore']);
Route::get('deleted-products-list', [ProductsController::class, 'deletedProductList']);

// routes for medium
Route::resource('mediums', MediumController::class);
Route::get('/mediums/{mediumId}/restore', [MediumController::class, 'restore']);
Route::get('deleted-mediums-list', [MediumController::class, 'deletedMediumList']);

// routes for role 
Route::resource('roles', RolesController::class);
Route::get('/roles/{roleId}/restore', [RolesController::class, 'restore']);
Route::get('deleted-roles-list', [RolesController::class, 'deletedRoleList']);

// routes for categories 
Route::resource('categories', CategoriesController::class);
Route::get('/categories/{categoryId}/restore', [CategoriesController::class, 'restore']);
Route::get('deleted-categories-list', [CategoriesController::class, 'deletedCategoryList']);

// routes for states
Route::resource('states', StateController::class);
Route::get('/states/{stateId}/restore', [StateController::class, 'restore']);
Route::get('deleted-states-list', [StateController::class, 'deletedStateList']);

// Route for locations
Route::resource('locations', LocationController::class);
Route::get('/locations/{locationId}/restore', [LocationController::class, 'restore']);
Route::get('deleted-location-list', [LocationController::class, 'deletedLocationList']);

//authentication route
Route::post('login',[AuthController::class,'login']);
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {
    
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});