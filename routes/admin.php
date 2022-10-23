<?php

Route::group([
    'namespace'  => 'Bitfumes\Multiauth\Http\Controllers',
    'middleware' => 'web',
], function () {

    Route::GET('/dashboard', 'AdminController@index')->name('dashboard');

    Route::group([
        'prefix'     => config('multiauth.prefix', 'admin'),
    ], function () {
        
        // Login and Logout
        Route::GET('/', 'LoginController@showLoginForm')->name('admin.login');
        Route::POST('/', 'LoginController@login');
        Route::POST('/logout', 'LoginController@logout')->name('admin.logout');

        // Password Resets
        Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::POST('/password/reset', 'ResetPasswordController@reset');
        Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');

        // Register Admins
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
        Route::post('/register', 'RegisterController@register');
        Route::get('/{admin}/edit', 'RegisterController@edit')->name('admin.edit');
        Route::delete('/{admin}', 'RegisterController@destroy')->name('admin.delete');
        Route::patch('/{admin}', 'RegisterController@update')->name('admin.update');

        // Admin Lists
        Route::get('/show', 'AdminController@show')->name('admin.show');

        // Admin Roles
        Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
        Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');

        // Roles
        Route::get('/roles', 'RoleController@index')->name('admin.roles');
        Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
        Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
        Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
        Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
        Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');

        //App Setting
        Route::get('/app', 'AppController@index')->name('admin.app.home');
        Route::patch('/app/{app}', 'AppController@update')->name('admin.app.update');

        //Profile Setting
        Route::get('/profile', 'AdminProfileController@index')->name('admin.profile');
        Route::patch('/profile/{app}', 'AdminProfileController@update')->name('admin.profile.update');

    });
    //mailbox
    Route::group([
        'prefix'     => 'mailbox',
    ], function(){
        Route::get('/inbox', 'MailController@index')->name('admin.inbox');
        Route::get('/message/{id}', 'MailController@show')->name('admin.message');
        Route::get('/sent', 'MailController@sent')->name('admin.sent');
        Route::get('/draft', 'MailController@draft')->name('admin.draft');
        Route::get('/trash', 'MailController@trash')->name('admin.trash');
        Route::post('/search_message', 'MailController@search')->name('admin.search_message');
        Route::get('/search_message', 'MailController@search')->name('admin.search_message');
        Route::get('/compose', 'MailController@compose')->name('admin.compose');
        Route::get('/reply/{id}', 'MailController@reply')->name('admin.reply');
        Route::get('/forward/{id}', 'MailController@forward')->name('admin.forward');
        Route::post('/composemail', 'MailController@store')->name('admin.composemail');
        Route::post('/deletemessage', 'MailController@action')->name('admin.deletemessage');
        Route::delete('/deletemsg/{id}', 'MailController@movetotrash')->name('admin.deletemsg');
    });

    //mailbox
    Route::group([
        'prefix'     => 'todo',
    ], function(){ 
        Route::get('/list', 'ToDoController@index')->name('todo.list');
        Route::post('/add', 'ToDoController@store')->name('todo.add');
        Route::post('/update', 'ToDoController@update')->name('todo.update');
        Route::patch('/status/{id}', 'ToDoController@status')->name('todo.status');
        Route::delete('/delete/{id}', 'ToDoController@destroy')->name('todo.delete');
    });
        

    //error route
    Route::get('/{any}', function () {
        return abort(404);
    });
});


