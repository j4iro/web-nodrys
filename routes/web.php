<?php

session_start();

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/*Rutas para listar los platos en la sección principal*/
Route::get('/comidas', 'HomeController@getAllDishes')->name('getAllDishes');
Route::post('/comidas', 'HomeController@getDishOne')->name('platos.buscar');

/*Rutas del perfil de usuario y editar sus datos*/
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/restaurant/avatar/{filename}','RestaurantController@getImage')->name('restaurant.image');
Route::get('/platos/{filename}','DishController@getImage')->name('dish.image');
Route::get('/restaurante/{id}-{nombre}','DishController@dishes')->name('restaurant.detalle');

/*Rutas del carrito de compras*/
Route::get('/carrito','CarritoController@index')->name('carrito.index');
Route::post('/carrito/add','CarritoController@add')->name('carrito.add');
Route::get('/carrito/up/{indice}','CarritoController@up')->name('carrito.up');
Route::get('/carrito/down/{indice}','CarritoController@down')->name('carrito.down');
Route::get('/carrito/delete-one/{indice}','CarritoController@delete_one')->name('carrito.deleteone');
Route::get('/carrito/delete-all','CarritoController@delete_all')->name('carrito.deleteall');

Route::get('/utils/auth','UtilsController@auth')->name('utils.auth');

/*Rutas para los pedidos de los clientes*/
Route::get('/mis-pedidos','OrderController@index_c')->name('pedidos.index');
Route::post('/mis-pedidos/add','OrderController@add')->name('pedidos.add');
Route::get('/mis-pedidos/detalle/{id}','OrderController@detail_c')->name('pedidos.detail_c');

/*Recorrer los productos del carrito */
Route::get('/detalle-pedido/save','DetailOrderController@saveDetail')->name('detailorder.save');

/*Rutas para los favoritos*/
Route::get('/favoritos','FavoritosController@index')->name('favoritos.index');

/*Rutas para la seccion administrativa de los restaurantes*/
Route::get('/admin-restaurante/home', 'OrderController@index_r')->name('adminRestaurant.index');
Route::get('/admin-restaurante/datos', 'AdminRestaurant@datos')->name('adminRestaurant.datos');
Route::post('/admin-restaurante/update','AdminRestaurant@update')->name('adminRestaurant.update');
Route::get('/admin-restaurante/reportes-clientes','AdminRestaurant@reportesClientes')->name('adminRestaurant.reportesclientes');
Route::get('/admin-restaurante/reportes-pedidos','AdminRestaurant@reportesPedidos')->name('adminRestaurant.reportespedidos');

/*Rutas para mantenimiento de platos en la sección administrativa */
Route::get('/admin-restaurante/platos/nuevo','DishController@new')->name('adminRestaurant.plato.new');
Route::post('/admin-restaurante/platos/save','DishController@save')->name('adminRestaurant.plato.save');
Route::get('/admin-restaurante/platos/list','DishController@list')->name('adminRestaurant.plato.list');
Route::get('/admin-restaurante/platos/edit/{id}','DishController@edit')->name('adminRestaurant.plato.edit');
Route::get('/admin-restaurante/platos/delete/{id}','DishController@delete')->name('adminRestaurant.plato.delete');

/*Rutas para pedidos en la sección administrativa */


// Route::get('/admin-restaurante/pedidos-pendientes','OrderController@index_r')->name('adminRestaurant.orders.all');
Route::get('/admin-restaurante/pedidos-pendientes/detalle/{id}','OrderController@detail_r')->name('adminRestaurant.pedidos.detail');
Route::get('/admin-restaurante/pedidos-completados', 'OrderController@pedidos_completados')->name('adminRestaurant.pedidos.completados');

/* Ruta para el Codigo QR */
Route::get('/admin-restaurante/escanear-qr','OrderController@qr')->name('adminRestaurant.orders.qr');

/* Ruta para Buscar restaurantes por su nombre */
Route::post('/','RestaurantController@buscar')->name('restaurant.buscar');
Route::post('/filtro', 'RestaurantController@filtro')->name('restaurants.filtro');

/*Rutas para el administrador master*/
Route::get('/admin/home', 'AdminController@index')->name('admin.index');
Route::get('/admin/restaurantes', 'AdminController@showRestaurants')->name('admin.restaurants');
Route::get('/admin/restaurantes/nuevo', 'AdminController@newRestaurant')->name('admin.restaurant.new');
Route::post('/admin/restaurantes/save', 'AdminController@saveRestaurant')->name('admin.restaurant.save');
Route::get('/admin/restaurantes/edit/{id}', 'AdminController@editRestaurant')->name('admin.restaurant.edit');


Route::get('/admin/reportes/', 'AdminController@reportes')->name('admin.reportes');

/*Reportes PDF para la sección administrativa*/
Route::get('/admin/reportes/pdf/{tipo}', 'PdfController@reporteRestaurantes')->name('admin.resportes.restaurantes');

/*Reportes EXCEL para la sección administrativa*/
Route::get('/admin/reportes/excel/usuarios', 'ExcelController@reporteUsers');
Route::get('/admin/reportes/excel/restaurantes', 'ExcelController@reporteRestaurants');

Route::get('users/{id}', function ($id) {
    return view('nu');
});
