<?php

use App\Models\Patient;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::namespace('App\Http\Controllers')->group(function() {
 
    Route::get('/', 'HomeController@index');
    
    Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/users', 'UserController@index')->name('lists.users');
    Route::post('/users', 'UserController@create')->name('users.create');

    Route::get('/patients', 'PatientController@index')->name('lists.patients');
    Route::post('/patients', 'PatientController@store')->name('create.patient');
    Route::get('/patients/create', 'PatientController@create')->name('form.patient');
    Route::get('/patients/{id}/edit', 'PatientController@edit')->name('form.edit.patient');
    Route::post('/patients/{id}/update', 'PatientController@update')->name('update.patient');
    Route::delete('/patients/{id}/delete', 'PatientController@destroy')->name('delete.patient');

    Route::get('/covid-form', 'CovidFormController@index')->name('form.covid');
    Route::post('/covid-form', 'CovidFormController@findUser')->name('form.covid.create');
    Route::post('/covid-form/result', 'CovidFormController@result')->name('form.covid.create.result');
}); 
