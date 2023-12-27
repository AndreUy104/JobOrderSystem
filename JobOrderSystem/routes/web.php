<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\OrderController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/' , 'home')->name('home');

Route::get('/logout' , [SessionController::class , 'destroy'])->name('logout')->middleware('auth');
Route::get('/login' , [SessionController::class , 'login'])->name('login')->middleware('guest');
Route::post('/login' , [SessionController::class , 'store'])->name('login')->middleware('guest');

Route::get('/register' , [RegisterController::class , 'create'])->name('register')->middleware('guest');
Route::post('/register' , [RegisterController::class , 'store'])->name('register')->middleware('guest');

Route::get('/create-order' , [CustomerController::class , 'create'])->name('create-customer')->middleware('auth');
Route::post('/create-order' , [CustomerController::class , 'store'])->name('save-customer')->middleware('auth');
Route::get('/edit-customer/{customerId}' , [CustomerController::class , 'edit'])->name('edit-customer')->middleware('auth');
Route::put('/edit-customer/{customerId}' , [CustomerController::class , 'updateCustomer'])->name('edit-customer')->middleware('auth');


Route::get('/create-order/customer/{customer}' , [DescriptionController::class , 'create'])->name('create-description')->middleware('auth');
Route::post('/create-order/customer/{customer}' , [DescriptionController::class , 'store'])->name('save-description')->middleware('auth');
Route::delete('/create-order/{description}' , [DescriptionController::class , 'destoryDescription'])->name('delete-description')->middleware('auth');
Route::post('/edit-order/{customer}' , [DescriptionController::class , 'edit'])->name('edit-description')->middleware('auth');


//Order
Route::get('/view' , [OrderController::class , 'showAll'])->name('view')->middleware('auth');
Route::get('/print-preview/{orderNum}' , [OrderController::class , 'printPreview'])->name('print')->middleware('auth');
Route::post('/create-order/{customer}' , [OrderController::class , 'store'])->name('save-order')->middleware('auth');
Route::get('/edit-order/{customer}' , [OrderController::class , 'edit'])->name('edit-order')->middleware('auth');
Route::delete('/create-order/{description}/{customer}' , [DescriptionController::class , 'destoryEditDescription'])->name('delete-description')->middleware('auth');
Route::put('/edit-order/{customer}' , [OrderController::class , 'updateOrder'])->name('edit-order')->middleware('auth');
Route::delete('/delete-order/{orderId}' , [OrderController::class , 'destroyOrder'])->name('destroy-order')->middleware('admin');
Route::get('/orders/search', [OrderController::class, 'search'])->name('order.search');


// Admin
Route::get('/admin' , [AdminController::class , 'show'])->name('admin')->middleware('admin');
Route::put('/toggle-admin-access/{userId}', [AdminController::class, 'toggleAdminAccess'])->middleware('admin')->name('update-admin');
