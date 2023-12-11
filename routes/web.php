<?php

use App\Http\Controllers\LocalizationController;
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
Route::get('locale/{locale}',[LocalizationController::class,'index'])->name('locale');

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::group([
    'prefix'=>'upload'
],function (){
    Route::get('',[\App\Http\Controllers\UploadController::class,'index']);
    Route::post('',[\App\Http\Controllers\UploadController::class,'upload'])->name('upload');
});

Route::group([
    'prefix'=>'admin',
    'as'=>'admin.'
],function (){
    Route::post('template/list',[\App\Http\Controllers\Admin\TemplateController::class,'list'])->name('template.list');
    Route::post('template/{template}/sync-properties',[\App\Http\Controllers\Admin\TemplateController::class,'syncProperties'])->name('template.properties.sync');
    Route::resource('template',\App\Http\Controllers\Admin\TemplateController::class);
    Route::resource('category',\App\Http\Controllers\Admin\CategoryController::class);
});
