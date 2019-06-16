<?php

session_start();

Auth::routes();

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/help', 'HomeController@help')->name('help');

/*Rutas para listar los platos en la sección principal*/
Route::get('/comidas', 'HomeController@getAllDishes')->name('getAllDishes')->middleware('verified');
Route::post('/comidas', 'HomeController@getDishOne')->name('platos.buscar');

/*Rutas del perfil de usuario y editar sus datos*/
Route::get('/configuracion','UserController@config')->name('config')->middleware('verified');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/restaurant/avatar/{filename}','RestaurantController@getImage')->name('restaurant.image');
Route::get('/platos/{filename}','DishController@getImage')->name('dish.image');
Route::get('/restaurante/{id}-{nombre}','DishController@dishes')->name('restaurant.detalle');


/*Rutas del carrito de compras*/
Route::get('/carrito','CarritoController@index')->name('carrito.index')->middleware('verified');
Route::post('/carrito/add','CarritoController@add')->name('carrito.add');
Route::get('/carrito/up/{indice}','CarritoController@up')->name('carrito.up');
Route::get('/carrito/down/{indice}','CarritoController@down')->name('carrito.down');
Route::get('/carrito/delete-one/{indice}','CarritoController@delete_one')->name('carrito.deleteone');
Route::get('/carrito/delete-all','CarritoController@delete_all')->name('carrito.deleteall');

Route::get('/utils/auth','UtilsController@auth')->name('utils.auth');

/*Rutas para los pedidos de los clientes*/
Route::get('/mis-pedidos','OrderController@index_c')->name('pedidos.index')->middleware('verified');
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
    Route::get('/admin-restaurante/reportes-personalizados','AdminRestaurant@reportesPersonalizados')->name('adminRestaurant.reportespersonalizados');
    Route::get('/admin-restaurante/reportes-personalizados/get/{fecini}/{fecfin}/{descargar}','PDFController@getreportespersonalizados');

    /*Rutas para mantenimiento de platos en la sección administrativa */
    Route::get('/admin-restaurante/platos/nuevo','DishController@new')->name('adminRestaurant.plato.new');
    Route::post('/admin-restaurante/platos/save','DishController@save')->name('adminRestaurant.plato.save');
    Route::get('/admin-restaurante/platos/list','DishController@list')->name('adminRestaurant.plato.list');
    Route::get('/admin-restaurante/platos/edit/{id}','DishController@edit')->name('adminRestaurant.plato.edit');
    Route::get('/admin-restaurante/platos/delete/{id}','DishController@delete')->name('adminRestaurant.plato.delete');


    /*Rutas para pedidos en la sección administrativa */
    Route::get('/admin-restaurante/pedidos-pendientes/detalle/{id}','OrderController@detail_r')->name('adminRestaurant.pedidos.detail');
    Route::get('/admin-restaurante/pedidos-completados', 'OrderController@pedidos_completados')->name('adminRestaurant.pedidos.completados');
    Route::get('/admin-restaurante/confirmation', 'OrderController@confirmation')->name('adminRestaurant.pedidos.confirmation');


    /* Ruta para el Codigo QR */
    Route::get('/admin/restaurant/escanear-qr','OrderController@qr')->name('adminRestaurant.orders.qr');

/* Ruta para Buscar restaurantes por su nombre */
Route::post('/','RestaurantController@buscar')->name('restaurant.buscar');
//Route::post('/filtro', 'RestaurantController@filtro')->name('restaurants.filtro');

/*Rutas para el administrador master*/
    Route::get('/admin/home', 'AdminController@index')->name('admin.index');

    Route::get('/admin/solicitudes/aceptadas', 'AdminController@listSolicitudesAceptadas')->name('admin.solicitudes.aceptadas');
    Route::get('/admin/solicitudes/historial', 'AdminController@listTodasSolicitudes')->name('admin.solicitudes.historial');
    Route::get('/admin/cash',['as'=>'cashs','uses'=>'AdminController@cash']);
     Route::get('/admin/pagarComision/{id?}', ['as'=>'pagarComision','uses'=>'AdminController@pagarComision']);

    /* Cruds restaurantes */
    Route::get('/admin/restaurantes/list', 'AdminController@showRestaurants')->name('admin.restaurants');
    Route::get('/admin/restaurants/estado/edit/{id}', 'AdminController@updateStateRestaurante')->name('admin.restaurantes.update.state');
    Route::get('/admin/restaurantes/nuevo', 'AdminController@newRestaurant')->name('admin.restaurant.new');
    Route::post('/admin/restaurantes/save', 'AdminController@saveRestaurant')->name('admin.restaurant.save');
    Route::get('/admin/restaurantes/edit/{id}', 'AdminController@editRestaurant')->name('admin.restaurant.edit');
    Route::get('/admin/restaurantes/detalles-solicitud/{id}', 'AdminController@showDatosSolicitud')->name('admin.restaurant.show-solicitud');

    /* Cruds Categorias */
    Route::get('/admin/categorias/list', 'AdminController@listCategorias')->name('admin.categorias.list');
    Route::get('/admin/categorias/edit/{id}', 'AdminController@editCategorias')->name('admin.categorias.edit');
    Route::get('/admin/categorias/create', 'AdminController@createCategorias')->name('admin.categorias.create');
    Route::post('/admin/categorias/save', 'AdminController@saveCategorias')->name('admin.categorias.save');
    Route::get('/admin/categorias/estado/edit/{id}', 'AdminController@updateStateCategoria')->name('admin.categorias.update.state');


    /* Cruds Distritos */
    Route::get('/admin/distritos/list', 'AdminController@listDistritos')->name('admin.distritos.list');
    Route::get('/admin/distritos/new', 'AdminController@newDistritos')->name('admin.distritos.new');
    Route::get('/admin/distritos/edit/{id}', 'AdminController@showDestritos')->name('admin.distritos.show');
    Route::post('/admin/distritos/save', 'AdminController@saveDistritos')->name('admin.distritos.save');
    Route::get('/admin/distritos/estado/edit/{id}', 'AdminController@updateStateDistrito')->name('admin.distritos.update.state');


    /* Reportes*/
    Route::get('/admin/reportes/', 'AdminController@reportes')->name('admin.reportes');

    /*Reportes PDF para la sección administrativa*/
    Route::get('/reportes/pdf/personalizado/{datos}/{vista}/{tipo}/{nombre}/{otrodato}/{papel}', 'PdfController@crearPDF')->name('crearPDF');

    Route::get('/admin/reportes/pdf/restaurantes/{tipo}', 'PdfController@reporteRestaurantes')->name('admin.reportes.restaurantes');
    Route::get('/admin/reportes/pdf/clientes/{tipo}', 'PdfController@reporteClientes')->name('admin.reportes.clientes');
    Route::get('/admin/reportes/pdf/restaurantes-por-distrito/{tipo}', 'PdfController@reporteRestaurantesPorDistrito')->name('admin.reportes.restaurantes-por-distrito');
    Route::get('/admin/reportes/pdf/restaurantes-por-categoria/{tipo}', 'PdfController@reporteRestaurantesPorCategoria')->name('admin.reportes.restaurantes-por-categoria');
    Route::get('/admin/reportes/pdf/clientes-por-distrito/{tipo}', 'PdfController@reporteClientesPorDistrito')->name('admin.reportes.clientes-por-distrito');

       /*Reportes PDF para la sección administrativa-restaurante*/
    Route::get('/admin-restaurante/reportes/', 'AdminRestaurant@reportes')->name('adminRestaurant.reportes');
    Route::get('/admin-restaurante/reportes/pdf/pedidos-completados/{tipo}', 'PdfController@reportePedidosCompletadosRestaurante')->name('adminRestaurant.pedidos-completados');
    Route::get('/admin-restaurante/reportes/pdf/pedidos-pendientes/{tipo}', 'PdfController@reportePedidosPendientesRestaurante')->name('adminRestaurant.pedidos-pendientes');
    Route::get('/admin-restaurante/reportes/pdf/platos/{tipo}', 'PdfController@reportePlatosdeRestaurantes')->name('adminRestaurant.platos');

    Route::get('/admin-restaurante/totalComision/', ['as'=>'totalComision','uses'=>'adminRestaurant@totalComision']);

    /*Reportes EXCEL para la sección administrativa*/
    Route::get('/admin/reportes/excel/usuarios', 'ExcelController@reporteUsers')->name('admin.excel.clientes');
    Route::get('/admin/reportes/excel/restaurantes', 'ExcelController@reporteRestaurants')->name('admin.excel.restaurantes');
    Route::get('/admin/reportes/excel/restaurantes-por-distrito', 'ExcelController@reporteRestaurantesPorDistrito')->name('admin.excel.restaurantes-distrito');
    Route::get('/admin/reportes/excel/restaurantes-por-categoria', 'ExcelController@reporteRestaurantesPorCategoria')->name('admin.excel.restaurantes-categoria');
    Route::get('/admin/reportes/excel/clientes-por-distrito', 'ExcelController@reporteClientesPorDistrito')->name('admin.excel.clientes-distrito');

    /*Reportes EXCEL para la sección administrativa del restaurante*/
    Route::get('/admin-restaurante/reportes/excel/pedidos-c', 'ExcelController@reportePedidosC')->name('admin-r.excel.pedidos-c');
    Route::get('/admin-restaurante/reportes/excel/pedidos-p', 'ExcelController@reportePedidosP')->name('admin-r.excel.pedidos-p');
    Route::get('/admin-restaurante/reportes/excel/platos', 'ExcelController@reportePlatos')->name('admin-r.excel.platos');

    Route::get('/admin/reportes-pedidos','AdminController@reportespedidos')->name('admin.reportespersonalizados');
    Route::get('/admin/reportes-clientes','AdminController@reportesclientes')->name('admin.reportesclientes');

    Route::get('/admin/reportes-clientes/get/{distrito}/{pdf}','PDFController@getreportesclientes')->name('admin.getreportesclientes');

    Route::get('/admin/reportes-pedidos/get/{fecini}/{fecfin}/{descargar}','PDFController@getreportespersonalizadosAdmin');

    Route::get('/admin-restaurante/cuenta-bancaria','AdminRestaurant@newCuentaBancaria')->name('admin-r.cuentaBancaria');
    Route::post('/admin-restaurante/cuenta-bancaria/save','AdminRestaurant@saveCuentaBancaria')->name('admin-r.cuentaBancaria.save');

Route::get('/solicitud-unirse','HomeController@show_solicitud')->name('show.solicitud');
Route::post('/solicitud-unirse/save','HomeController@save_solicitud')->name('solicitud.save');

Route::get('/mis-pedidos/factura/{id}/{tipo}','PdfController@facturaPedidoCliente')->name('pedidos.factura.pdf');
Route::post('/mis-pedidos/cancelar','OrderController@cancelar')->name('order.cancelar');
Route::get('/mis-pedidos/vence_orden','OrderController@vence_orden')->name('order.vence');

Route::get('/admin-restaurante/cambiar-disponibilidad','AdminRestaurant@cambiarDisponibilidad');
Route::get('/admin-restaurante/serve','OrderController@notif');
// Route::post('/admin-restaurante/cambiar-disponibilidad','AdminRestaurant@cambiarDisponibilidad');




Route::get('filtroXcategoria/{categoria?}', ['as'=>'filtroXcategoria','uses'=>'RestaurantController@filtroXcategoria']);
Route::get('/admin-restaurante/platos/update_state_dish/{id?}/{state?}', ['as'=>'update_state_dish','uses'=>'DishController@update_state_dish']);



//Ruta para la valoración
Route::get('/Restaurant/califi','ValorationController@store')->name('calificar.store');
Route::get('/Restaurant/MiCalifi','ValorationController@obtnerCali')->name('calificar.obtnerCali');
Route::get('/Restaurant/MiCalifiR','ValorationController@obtnerCaliR')->name('calificar.obtnerCaliR');
Route::get('/Restaurant/ConsultarMisPe','ValorationController@consultReserva')->name('calificar.consultarPe');
// Route::get('/Restaurant/calificaion','ValorationController@update')->name('calificar.update');

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ForgotPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ForgotPasswordController@reset');

//Controladores para enviar Email

Route::get('/admin-restaurante/menus','AdminRestaurant@menus')->name('admin-r.menus');
Route::get('/admin-restaurante/getplatos','AdminRestaurant@getDishes');

Route::get('/admin-restaurante/saveplatomenu','AdminRestaurant@saveplatomenu');
Route::get('/admin-restaurante/listarplatomenu','AdminRestaurant@getMenuDia');
Route::get('/admin-restaurante/eliminarplatomenu','AdminRestaurant@eliminarMenuDia');

/*Pasarela de pagos y Ruc*/
Route::get('/respuesta_pasarela', ['as'=>'respuesta_pasarela','uses'=>'PeticionesController@respuesta_pasarela']);
Route::get('/respuestaRuc',['as'=>'respuestaRuc','uses'=>'PeticionesController@respuestaRuc']);
Route::get('/respuestaDni',['as'=>'respuestaDni','uses'=>'PeticionesController@respuestaDni']);
