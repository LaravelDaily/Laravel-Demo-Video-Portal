<?php
Route::get('/', 'HomePageController@index');
Route::get('channels/{channel}', 'HomePageController@channel')->name('channel');
Route::get('videos/{video}', 'HomePageController@video')->name('video');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Channels
    Route::delete('channels/destroy', 'ChannelsController@massDestroy')->name('channels.massDestroy');
    Route::resource('channels', 'ChannelsController');

    // Videos
    Route::delete('videos/destroy', 'VideosController@massDestroy')->name('videos.massDestroy');
    Route::resource('videos', 'VideosController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');

});
