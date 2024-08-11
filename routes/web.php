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

    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('{id}', 'update')->name('update');

    Route::get('details/{id}','show')->name('details');
    Route::delete('del/{id}', 'softdel')->name('delete');
    Route::get('trashed', 'showDeleted')->name('trashed');
    Route::patch('{id}', 'restore')->name('restore');
    Route::delete('{id}', 'destroy')->name('destroy');
    
                        
});


#<!------upload-------¡> 
//Route::get('uploadFile', [ExampleController::class,'uploadFile']);
//Route::post('assets', [ExampleController::class,'uploadimg'])->name('uploadimg');