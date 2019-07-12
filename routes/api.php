<?php

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResources(['users' => 'API\UserController']);
    Route::get('search', 'API\UserController@searchUser');
    Route::put('profile/update', 'API\UserController@updateProfile');
});