<?php


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {
            Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {

                Route::get('/index', 'DashboardController@index')->name('index'); // home route

                //users route
                Route::resource('users', 'UserController')->except(['show']);

                //categories route
                Route::resource('categories', 'CategoryController')->except(['show']);

            }); //end of group function
});//end of dashboard routes
