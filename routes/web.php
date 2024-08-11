<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdController;


Route::get('/', function () {   #homepage
    return view('welcome');
});


#<!------Fashion-------¡> 
Route::group([
    'prefix' => 'fashion',  #for the uri
    'controller' => ProdController::class,  #then we'll del the [] from the pages that open in browser
    'as' => 'prod-'  #for the name
], function () {

    Route::get('home', 'LatestProds')->name('index');
    Route::get('add', 'create')->name('add');
    Route::post('', 'store')->name('store');
});


#<!------upload-------¡> 
//Route::get('uploadFile', [ExampleController::class,'uploadFile']);
//Route::post('assets', [ExampleController::class,'uploadimg'])->name('uploadimg');