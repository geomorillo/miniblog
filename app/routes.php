<?php

namespace app;

use system\http\Response;

/*
 * Adding new routes.
 * 
 * $router->get($route, $action)
 * 
 * string @route get the uri
 * strin @action get namespace and controller split by '@' then method from class controller
 */


//$router->get('/','app\controllers\Tests@index');
$router->get('/', 'app\controllers\Main@index');

//busqueda 

$router->post('search','app\controllers\Main@search');

// POST
$router->get('post/[:num]', 'app\controllers\Main@post'); //post especifico
$router->post('comentario/insertar/[:num]', 'app\controllers\Main@insertarComentario'); //insertar comentario
//filtrar por categorias
$router->get('categorias/search/[:num]','app\controllers\Main@categoriaSearch');


//PAGINA
$router->get('pagina/[:num]','app\controllers\Main@pagina');

//admin area
$router->get('admin', 'app\controllers\Admin@index', 'before');
$router->get('login', 'app\controllers\Main@login');
$router->post('authenticate', 'app\controllers\Main@authenticate');
$router->get('crearAdmin', 'app\controllers\Main@crearAdmin');
$router->get('admin/logout',"Admin@logout");
//MENU

$router->get('admin/menu', 'app\controllers\Admin@menu');
$router->any('admin/menu/insertar', 'app\controllers\Admin@menuInsertar');
$router->any('admin/menu/editar/[:num]', 'app\controllers\Admin@menuEditar'); //click boton editar
$router->any('admin/menu/borrar/[:num]', 'app\controllers\Admin@menuBorrar');
$router->get('admin/menu/borrar/[:num]/[:any]', 'app\controllers\Admin@menuBorrar'); //click en el boton borrar
$router->get('admin/menu/borrar/cancel', 'app\controllers\Admin@menuBorrar'); //click en el boton cancelar

 
//CATEGORIAS

$router->get('admin/categorias', 'app\controllers\Admin@categorias');
$router->any('admin/categorias/insertar', 'app\controllers\Admin@categoriaInsertar');
$router->any('admin/categorias/editar/[:num]', 'app\controllers\Admin@categoriaEditar'); //click boton editar y accion editar
$router->any('admin/categorias/borrar/[:num]', 'app\controllers\Admin@categoriaBorrar');
$router->get('admin/categorias/borrar/[:num]/[:any]', 'app\controllers\Admin@categoriaBorrar'); //click boton ok
$router->get('admin/categorias/borrar/cancel', 'app\controllers\Admin@categoriaBorrar'); //click en el boton cancelar

//ARTICULOS
//$router->get('admin/paginas', 'app\controllers\Admin@paginas');

$router->get('admin/articulos', 'app\controllers\Admin@articulos');
$router->any('admin/articulos/insertar', 'app\controllers\Admin@articulosInsertar');
$router->any('admin/articulos/insertar/ok', 'app\controllers\Admin@articulosInsertar');
$router->any('admin/articulos/editar/[:num]', 'app\controllers\Admin@articulosEditar');
$router->any('admin/articulos/borrar/[:num]', 'app\controllers\Admin@articulosBorrar');
$router->get('admin/articulos/borrar/[:num]/[:any]', 'app\controllers\Admin@articulosBorrar'); //click boton ok

//RECURSOS
$router->get('admin/recursos','app\controllers\Admin@recursos');
$router->get('admin/recursos/descarga/[:any]','app\controllers\Admin@recursosDescarga');
$router->get('admin/recursos/borrar/[:num]','app\controllers\Admin@recursosBorrar');
$router->post('admin/recursos/subir','app\controllers\Admin@subir');

//CONFIG

$router->get('admin/config','app\controllers\Admin@configuracion');
$router->post('admin/config/[:any]','app\controllers\Admin@configuracion');



