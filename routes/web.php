<?php
session_start();

Route::get('/laravel', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/*Rutas del perfil de usuario y editar sus datos*/
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/restaurant/avatar/{filename}','RestaurantController@getImage')->name('restaurant.image');
Route::get('/platos/{filename}','DishController@getImage')->name('dish.image');
Route::get('/restaurant/{id}','DishController@dishes')->name('restaurant.detalle');

/*Rutas del carrito de compras*/
Route::get('/carrito','CarritoController@index')->name('carrito.index');
Route::post('/carrito/add','CarritoController@add')->name('carrito.add');
Route::get('/carrito/up/{indice}','CarritoController@up')->name('carrito.up');
Route::get('/carrito/down/{indice}','CarritoController@down')->name('carrito.down');
Route::get('/carrito/delete-one/{indice}','CarritoController@delete_one')->name('carrito.deleteone');
Route::get('/carrito/delete-all','CarritoController@delete_all')->name('carrito.deleteall');

/*Rutas para los pedidos*/
Route::get('/pedidos','PedidosController@index')->name('pedidos.index');

/*Rutas para los favoritos*/
Route::get('/favoritos','FavoritosController@index')->name('favoritos.index');

/*Rutas para la seccion administrativa de los restaurantes*/
Route::get('/admin/restaurant', 'AdminRestaurant@index')->name('adminRestaurant.index');

/*Rutas para mantenimiento de platos en la sección administrativa */
Route::get('/admin/restaurant/platos/new','DishController@new')->name('adminRestaurant.plato.new');
Route::post('/admin/restaurant/platos/save','DishController@save')->name('adminRestaurant.plato.save');
Route::get('/admin/restaurant/platos/list','DishController@list')->name('adminRestaurant.plato.list');
Route::get('/admin/restaurant/platos/edit/{id}','DishController@edit')->name('adminRestaurant.plato.edit');
Route::get('/admin/restaurant/platos/delete/{id}','DishController@delete')->name('adminRestaurant.plato.delete');

/*Rutas para pedidos en la sección administrativa */

Route::get('/admin/restaurant/pedidos-pendientes','OrderController@index_r')->name('adminRestaurant.orders.all');