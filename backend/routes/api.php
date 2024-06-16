<?php

use App\Http\Controllers\api\v1\FiltersController;
use App\Http\Controllers\api\v1\HostersController;
use App\Models\Hoster;
use App\Repositories\HosterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'v1',
    'namespace' => 'api',
    'as' => 'api.'
],function(){

    Route::group([
        'prefix' => 'hosters',
        'as' => 'hosters.'
    ],function(){
        Route::get('/',[HostersController::class,'index'])->name('index');
    });



    Route::get('/filters', [FiltersController::class, 'index']);
});
