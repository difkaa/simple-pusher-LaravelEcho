<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('lesson/create', 'LessonController@newLesson');
Route::post('/notification/lesson/notification','LessonController@notification');

Route::post('/markAsRead', 'LessonController@markAsRead')->name('markAsRead');
Route::get('readLesson/{lesson_id}', 'LessonController@readLesson')->name('readLesson');

Route::post('/allMarkAsread', 'LessonController@allMarkAsread')->name('allMarkAsread');
Route::get('/readAllLesson','LessonController@readAllLesson')->name('readAllLesson');
