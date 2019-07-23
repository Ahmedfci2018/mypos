<?php


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {
            Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {

                Route::get('/index', 'DashboardController@index')->name('index'); // home route

                //categories route
                Route::resource('categories', 'CategoryController')->except(['show']);


                //products route
                Route::resource('products', 'ProductController')->except(['show']);

                //users route
                Route::resource('users', 'UserController')->except(['show']);

            }); //end of group function
});//end of dashboard routes
