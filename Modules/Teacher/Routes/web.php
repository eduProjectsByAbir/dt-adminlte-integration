<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'isAdmin'])->prefix('teacher')->group(function() {
    Route::get('/', 'TeacherController@index')->name('teachers.index');
    Route::get('/add', 'TeacherController@create')->name('teachers.create');
    Route::post('/store', 'TeacherController@store')->name('teachers.store');
    Route::get('/{id}/edit', 'TeacherController@edit')->name('teachers.edit');
});
