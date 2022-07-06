<?php

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

//notebook
Route::get('v1/notebook' , [\App\Http\Controllers\NotebookController::class , 'notebook']);
Route::get('v1/notebook/{id}' , [\App\Http\Controllers\NotebookController::class , 'notebookById']);
Route::post('v1/notebook' , [\App\Http\Controllers\NotebookController::class , 'notebookSave']);
Route::post( 'v1/notebook/{id}' , [\App\Http\Controllers\NotebookController::class  , 'notebookEdit']);
Route::delete( 'v1/notebook/{id}' , [\App\Http\Controllers\NotebookController::class  , 'notebookDelete']);
//countries
Route::get('country' , [\App\Http\Controllers\Country\CountryController::class , 'country']);
Route::get('country/{id}' , [\App\Http\Controllers\Country\CountryController::class , 'countryById']);
Route::post( 'country' , [\App\Http\Controllers\Country\CountryController::class , 'countrySave']);
Route::put( 'country/{id}' , [\App\Http\Controllers\Country\CountryController::class , 'countryEdit']);
Route::delete( 'country/{id}' , [\App\Http\Controllers\Country\CountryController::class , 'countryDelete']);



