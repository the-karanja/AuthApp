<?php

use App\Http\Controllers\Authenticator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth');

Route::get('/login',[Authenticator::class, 'LoginIndex'])->name('login');
Route::get('/register',[Authenticator::class, 'RegisterIndex']);

Route::get('/', [Authenticator::class,'Home']);
Route::post('/logout', [Authenticator::class, 'logout'])->name('logout');


