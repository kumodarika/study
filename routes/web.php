<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/','App\Http\Controllers\TaskController@index')->name('home');
Route::get('/create-task','App\Http\Controllers\TaskController@createTask');
Route::post('/create','App\Http\Controllers\TaskController@create');
Route::get('/edit/{id}','App\Http\Controllers\TaskController@editTask');
Route::post('/update','App\Http\Controllers\TaskController@update');
Route::delete('/delete/{id}','App\Http\Controllers\TaskController@delete')->name('tasks.delete');
