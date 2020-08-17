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
Auth::routes();

Route::get('/', 'HomeController@home')->name('home');

Route::post('/tasks', 'ChecklistController@storeTasks')->name('tasks.store');
Route::put('/tasks/{task}', 'ChecklistController@updateTasks')->name('tasks.update');

Route::delete('/tasks/{task}', 'ChecklistController@destroyTask')->name('task.destroy');
Route::get('/tasks/{task}/edit', 'ChecklistController@editTask')->name('task.edit');
Route::put('/task/{task}', 'ChecklistController@updateTask')->name('task.update');

Route::resource('checklist', 'ChecklistController');
Route::resource('user', 'HomeController');
Route::put('/user/banned/{user}', 'HomeController@restore')->name('user.restore');
Route::get('/user/{user}/{checklist}', 'HomeController@showChecklist')->name('user.checklist.show');
