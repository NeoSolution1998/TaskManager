<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
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
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Auth::routes();


Route::get('task_statuses', 'App\Http\Controllers\TaskStatusController@index')->name('task_statuses.index');
Route::get('task_statuses/create', 'App\Http\Controllers\TaskStatusController@create')->name('task_statuses.create');
Route::post('task_statuses', 'App\Http\Controllers\TaskStatusController@store')->name('task_statuses.store');
Route::get('task_statuses/{id}/edit', 'App\Http\Controllers\TaskStatusController@edit')->name('task_statuses.edit');
Route::patch('task_statuses/{id}', 'App\Http\Controllers\TaskStatusController@update')->name('task_statuses.update');
Route::delete('task_statuses/{id}', 'App\Http\Controllers\TaskStatusController@destroy')->name('task_statuses.destroy');

Route::get('tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
Route::get('tasks/create', 'App\Http\Controllers\TaskController@create')->name('tasks.create');
Route::post('tasks', 'App\Http\Controllers\TaskController@store')->name('tasks.store');
Route::get('tasks/{id}/edit', 'App\Http\Controllers\TaskController@edit')->name('tasks.edit');
Route::patch('tasks/{id}', 'App\Http\Controllers\TaskController@update')->name('tasks.update');
Route::delete('tasks/{id}', 'App\Http\Controllers\TaskController@destroy')->name('tasks.destroy');
Route::get('tasks/{id}', 'App\Http\Controllers\TaskController@show')->name('tasks.show');

Route::get('labels', 'App\Http\Controllers\LabelController@index')->name('labels.index');
Route::get('labels/create', 'App\Http\Controllers\LabelController@create')->name('labels.create');
Route::post('labels', 'App\Http\Controllers\LabelController@store')->name('labels.store');
Route::get('labels/{id}/edit', 'App\Http\Controllers\LabelController@edit')->name('labels.edit');
Route::patch('labels/{id}', 'App\Http\Controllers\LabelController@update')->name('labels.update');
Route::delete('labels/{id}', 'App\Http\Controllers\LabelController@destroy')->name('labels.destroy');
Route::get('labels/{id}', 'App\Http\Controllers\LabelController@show')->name('labels.show');


