<?php


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {
            Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {

                // home route
                Route::get('/', 'WelcomeController@index')->name('welcome');

                //categories route
                Route::resource('categories', 'CategoryController')->except(['show']);


                //products route
                Route::resource('products', 'ProductController')->except(['show']);


                //clients route
                Route::resource('clients', 'ClientController')->except(['show']);
                Route::resource('clients.orders', 'client\OrderController')->except(['show']);

                //orders route
                Route::resource('orders', 'OrderController')->except(['show']);
                Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');

                //users route
                Route::resource('users', 'UserController')->except(['show']);

            }); //end of group function
});//end of dashboard routes
