<?php
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){


        Config::set('auth.defines','admin');
        Route::get('login','AdminAuth@login');
        Route::post('login','AdminAuth@login_post');
        Route::get('forget/password','AdminAuth@forget_password');
        Route::post('forget/password','AdminAuth@forget_password_reset');
        Route::get('reset/password/{token}','AdminAuth@password_reset');
        Route::post('reset/password/{token}','AdminAuth@password_reset_final');
        // Route::resource('sample', 'SampleController@index');
        // Route::post('sample/export', 'SampleController@index');
        Route::group(['middleware'=>'admin:admin'],function() {

          // Admin urls
         Route::resource('admin','AdminController');
          // delete multiple admins
        Route::delete('admin/destroy/all','AdminController@multiple_delete');


        // Users urls


        Route::resource('users','UsersController');
        // delete multiple admins
       Route::delete('users/destroy/all','UsersController@multiple_delete');



       // Countries urls

       Route::resource('countries','CountriesController');

        Route::delete('countries/destroy/all','CountriesController@multiple_delete');


        // Cities urls

        Route::resource('cities','CitiesController');

         Route::delete('cities/destroy/all','CitiesController@multiple_delete');

         // States urls

         Route::resource('states','StatesController');

          Route::delete('states/destroy/all','StatesController@multiple_delete');


          // Departments urls

          Route::resource('departments','DepartmentsController');


        // trademarks urls

        Route::resource('trademarks','TradeMarkController');

         Route::delete('trademarks/destroy/all','TradeMarkController@multiple_delete');


        // manufacts urls
         Route::resource('manufacts','ManuFactsController');

          Route::delete('manufacts/destroy/all','ManuFactsController@multiple_delete');




          // shipping urls
           Route::resource('shipping','ShippingController');

            Route::delete('shipping/destroy/all','ShippingController@multiple_delete');


            // malls urls
             Route::resource('malls','MallsController');

              Route::delete('malls/destroy/all','MallsController@multiple_delete');

              // Colors urls
               Route::resource('colors','ColorsController');

                Route::delete('colors/destroy/all','ColorsController@multiple_delete');



                // Sizes urls
                 Route::resource('sizes','SizesController');

                  Route::delete('sizes/destroy/all','SizesController@multiple_delete');

                  // weightsurls
                       Route::resource('weights','WeightsController');

                        Route::delete('weights/destroy/all','WeightsController@multiple_delete');


                  // products urls
                   Route::resource('products','ProductsController');

                  Route::delete('products/destroy/all','ProductsController@multiple_delete');



            Route::get('/', function () {
                return view('admin.home');
            });





          // This Routes For Seting Of The Project

  				Route::get('settings', 'Settings@setting');
  				Route::post('settings', 'Settings@setting_save');



          Route::any('logout','AdminAuth@logout');



       // Route Of The language

     Route::get('lang/{lang}',function($lang){

            session()->has('lang')?session()->forget('lang'): '' ;
            $lang=='ar' ? session()->put('lang','ar') :  session()->put('lang','en');
            return back();
     });


       });



});
