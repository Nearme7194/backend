<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MediumController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TehasilController;
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
Route::get('products/{productId}/restore', [ProductsController::class, 'restore']);
Route::get('deleted-products-list', [ProductsController::class, 'deletedProductList']);

// routes for medium
Route::resource('mediums', MediumController::class);
Route::get('mediums/{mediumId}/restore', [MediumController::class, 'restore']);
Route::get('deleted-mediums-list', [MediumController::class, 'deletedMediumList']);

// routes for role 
Route::resource('roles', RolesController::class);
Route::get('roles/{roleId}/restore', [RolesController::class, 'restore']);
Route::get('deleted-roles-list', [RolesController::class, 'deletedRoleList']);

// routes for categories 
Route::resource('categories', CategoriesController::class);
Route::get('categories/{categoryId}/restore', [CategoriesController::class, 'restore']);
Route::get('deleted-categories-list', [CategoriesController::class, 'deletedCategoryList']);

// routes for states
Route::resource('states', StateController::class);
Route::get('states/{stateId}/restore', [StateController::class, 'restore']);
Route::get('deleted-states-list', [StateController::class, 'deletedStateList']);

// Route for locations
Route::resource('locations', LocationController::class);
Route::get('locations/{locationId}/restore', [LocationController::class, 'restore']);
Route::get('deleted-location-list', [LocationController::class, 'deletedLocationList']);

// Route for SubCategories
Route::resource('subcategories', SubCategoriesController::class);
Route::get('subcategories/{subCategoryId}/restore', [SubCategoriesController::class, 'restore']);
Route::get('deleted-subcategories-list', [SubCategoriesController::class, 'deletedSubCategoriesList']);

// Route for Districts
Route::resource('districts', DistrictController::class);
Route::get('districts/{districtId}/restore', [DistrictController::class, 'restore']);
Route::get('deleted-districts-list', [DistrictController::class, 'deletedDistrictsList']);

// Route for Tehasil
Route::resource('tehasil', TehasilController::class);
Route::get('tehasil/{tehasilId}/restore', [TehasilController::class, 'restore']);
Route::get('deleted-tehasil-list', [TehasilController::class, 'deletedTehasilList']);

// Route for addresses
Route::resource('addresses', AddressController::class);
Route::get('addresses/{addressId}/restore', [AddressController::class, 'restore']);
Route::get('deleted-addresses-list', [AddressController::class, 'deletedTehasilList']);