<?php

Route::apiResources(['clients' => 'API\ClientController']);
Route::apiResources(['expenses' => 'API\ExpenseController']);
Route::apiResources(['monthly_sub' => 'API\Monthly_subController']);
Route::get('monthly_sub_get_clients','API\Monthly_subController@get_clients');
Route::apiResources(['order_sub' => 'API\Order_subController']);
Route::apiResources(['restaurant' => 'API\RestaurantController']);
Route::apiResources(['delivery' => 'API\DeliveryController']);
Route::apiResources(['order' => 'API\OrderController']);
Route::get('order_get_menu/{id}','API\OrderController@get_menus');
Route::apiResources(['menu' => 'API\MenuController']);
Route::get('menu_get_restaurants','API\MenuController@get_restaurants');
Route::get('order_get_delivery','API\OrderController@get_delivery');
Route::get('order_get_foods/{id}','API\OrderController@get_foods');
Route::apiResources(['sales' => 'API\SalesController']);
Route::get('get_sales/{date}','API\SalesController@get_sales');
Route::get('delete_order/{id}','API\SalesController@destroy');
