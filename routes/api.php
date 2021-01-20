<?php

Route::apiResources(['clients' => 'API\ClientController']);
Route::apiResources(['expenses' => 'API\ExpenseController']);
Route::apiResources(['monthly_sub' => 'API\Monthly_subController']);
Route::get('monthly_sub_get_clients','API\Monthly_subController@get_clients');
Route::apiResources(['order_sub' => 'API\Order_subController']);
Route::apiResources(['restaurant' => 'API\RestaurantController']);
Route::apiResources(['delivery' => 'API\DeliveryController']);
Route::apiResources(['order' => 'API\OrderController']);
Route::apiResources(['menu' => 'API\MenuController']);
Route::apiResources(['sales' => 'API\SalesController']);
