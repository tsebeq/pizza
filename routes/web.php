<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PizzaController@index');

Route::get('pizza', 'PizzaController@index');
Route::post('pizza', 'PizzaController@store');
Route::get('pizza/remove/{id}', 'PizzaController@remove');
Route::get('pizza/{name}', 'PizzaController@edit');

Route::get('ingredient', 'IngredientController@index');
Route::post('ingredient', 'IngredientController@store');
Route::get('ingredient/remove/{id}', 'IngredientController@remove');
Route::get('ingredient/{name}', 'IngredientController@edit');