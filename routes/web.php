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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/login',[Authenticator::class, 'LoginIndex'])->name('login');
Route::get('/register',[Authenticator::class, 'RegisterIndex']);

Route::get('/get-credential-id', [Authenticator::class,'GetCredentialId']);

Route::get('/readme', function () {
    $readmePath = base_path('README.md');
    $content = File::exists($readmePath) ? File::get($readmePath) : 'README.md not found';
    return view('readme', ['content' => $content]);
});
