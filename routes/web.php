<?php

Route::get('/lang/{lang}', 'LangController@index');
Route::get('/','LangController@login');
Route::post('/','LangController@loged');
Route::get('/register','LangController@reg');
Route::post('/register','LangController@register');
Route::get('/logout','LangController@logout');

Route::get('/home','LangController@home')->middleware('admin');
Route::get('{any}', 'LangController@home')->where('any', '([A-z\d\-\/_.]+)');
