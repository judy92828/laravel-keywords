<?php

Route::get('/', 'TestController@index');//测试页面
Route::post('/store', 'TestController@store')->name('keywords.store');//测试页面数据添加