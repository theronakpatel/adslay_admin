<?php

use App\Http\Middleware\HasAccessAdmin;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Admin\DeviceInfoController;

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth', 'verified', HasAccessAdmin::class],
    'as' => 'admin.',
], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('media', 'MediaController');
    Route::resource('devices', 'DeviceController');
    Route::resource('menu', 'MenuController')->except([
        'show',
    ]);
    Route::resource('menu.item', 'MenuItemController');
    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
    ], function () {
        Route::resource('type', 'CategoryTypeController')->except([
            'show',
        ]);
        Route::resource('type.item', 'CategoryController');
    });
    Route::get('edit-account-info', 'UserController@accountInfo')->name('account.info');
    Route::post('edit-account-info', 'UserController@accountInfoStore')->name('account.info.store');
    Route::post('change-password', 'UserController@changePasswordStore')->name('account.password.store');
    Route::get('devices/{device}/edit-media', 'DeviceController@editMedia')->name('devices.editMedia');
    Route::post('devices/{device}/update-media', 'DeviceController@updateMedia')->name('devices.updateMedia');
    Route::post('devices/{device}/media/update-order', 'DeviceMediaController@updateOrder')->name('devices.media.updateOrder');
    Route::get('devices/{device}/media', 'DeviceMediaController@showMedia')->name('devices.media.index');
    Route::post('devices/media/update-repeat-count', 'DeviceMediaController@updateRepeatCount')->name('devices.media.updateRepeatCount');
    Route::get('device-info', 'DeviceInfoController@index')->name('device-info.index');
});
