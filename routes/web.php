<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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


// Common Resource Routes : 

// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// des ti kanei to ::class
// dd(ListingController::class); = "App\Http\Controllers\ListingController"

// All listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);


// Store listing data
Route::post('/listings', [ListingController::class, 'store']);

// Show edit form
Route::get('listings/{listing}/edit', [ListingController::class, 'edit']);

// Edit Submit to Update
Route::put('listings/{listing}', [ListingController::class, 'update']);

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

// Single listing
Route::get('/listings/{listing}',  [ListingController::class, 'show']);

// Show register create form
Route::get('/register', [UserController::class, 'create']);

// Create new user
Route::post('/user', [UserController::class, 'store']);

// Log user out
Route::post('/logout', [UserController::class, 'logout']);

// Show login form
Route::get("/user/login", [UserController::class, 'login']);

// Login user
Route::post("user/authenticate", [UserController::class, 'authenticate']);
