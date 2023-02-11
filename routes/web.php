<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('routes', function() {
    \Artisan::call('route:list');
    return '<pre>' . \Artisan::output() . '</pre>';
});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'IndexController@index')->name('index');

    Route::get('/kontakt', 'ContactController@index')->name('contact.index');
    Route::post('/kontakt', 'ContactController@form')->name('contact.form');

    Route::get('/lista-kursow', 'CourseController@index')->name('course.index');
    Route::get('/nazwa-kursu/formularz', 'CourseController@form')->name('course.form');

    Route::get('/o-nas', 'AboutController@index')->name('about');
});