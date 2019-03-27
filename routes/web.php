<?php

//use App\Restaurant;

Route::get('/laravel', function () {
/*
    $restaurants=Restaurant::all();
        foreach($restaurants as $restaurant){
            echo $restaurant->name.'<br>';
            echo $restaurant->category->name.'<br>';

            foreach($restaurant->dishes as $dishe){
                echo'----'.$dishe->name.'<br>';
            }
        }
        die();
*/
    return view('welcome');
});


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/restaurant/avatar/{filename}','RestaurantController@getImage')->name('restaurant.image');
Route::get('/platos/{filename}','DishController@getImage')->name('dish.image');
Route::get('/restaurant/{id}','DishController@dishes')->name('restaurant.detalle');

Route::get('/carrito',function () {
        return view('carrito.index');
    })->name('carrito.index');

Route::get('/pedidos',function () {
        return view('pedidos.index');
    })->name('pedidos.index');

Route::get('/favoritos',function () {
        return view('favoritos.index');
    })->name('favoritos.index');



