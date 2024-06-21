<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\V1'], function() {
    /**
     * Market
     */
    Route::group(['prefix' => 'market'], function() {
        Route::get('/main', 'MarketController@main')->name('api.market.main');
    });

    /**
     * Users
     */
    Route::group(['prefix' => 'user'], function() {
        Route::get('/info', 'UsersController@info')->name('api.users.info');
        Route::get('/inventory', 'UsersController@inventory')->name('api.users.inventory');
        Route::get('/favorites', 'UsersController@favorites')->name('api.users.favorites');
    });

    /**
     * Group
     */
    Route::get('/members/{id}/{rank}', 'GroupController@groupMembers')->name('api.users.members');
});
