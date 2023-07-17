<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,'index']);


Route::get('Blogs',[BlogController::class,'index']);
Route::get('ShowBlog/{id}',[BlogController::class,'show']);



Route::get('project',[ProjectController::class,'index']);
Route::get('ShowProject/{id}',[ProjectController::class,'show']);
Route::get('ShowProjectMember/{id}',[ProjectController::class,'create']);



Route::get('Team',[TeamController::class,'index']);

Route::middleware(['auth'])->group(function () {


    Route::get('Dashbord', [HomeController::class, 'Dash']);
    Route::get('DashShowBlog', [BlogController::class, 'create']);
    Route::post('DashShowBlog', [BlogController::class, 'store']);
    Route::patch('DashShowBlog/{id}', [BlogController::class, 'update']);
    Route::delete('DashShowBlog/{id}', [BlogController::class, 'destroy']);
    Route::put('DashShowBlog/{id}', [BlogController::class, 'publish']);


    Route::get('DashShowProject', [ProjectController::class, 'Dashcreate']);
    Route::post('DashShowProject', [ProjectController::class, 'store']);
    Route::patch('DashShowProject/{id}', [ProjectController::class, 'update']);
    Route::delete('DashShowProject/{id}', [ProjectController::class, 'destroy']);


    Route::get('DashTeam', [TeamController::class, 'create']);
    Route::post('DashTeam', [TeamController::class, 'store']);
    Route::patch('DashTeam/{id}', [TeamController::class, 'update']);
    Route::delete('DashTeam/{id}', [TeamController::class, 'destroy']);

});






/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');
