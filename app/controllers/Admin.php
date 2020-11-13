<?php

/*
 * Todos los derechos reservados por Manuel Jhobanny Morillo Ordoñez 
 * 2015
 * Contacto: geomorillo@yahoo.com
 */

namespace app\controllers;

/**
 * Description of Main
 *
 * @author geomorillo
 */
use system\core\Controller;
use app\models\Blog;
use system\core\Assets;
use system\helpers\Auth\Auth;

class Admin extends Controller
{

    public $data;
    private $response;
    private $request;
    private $blogmodel;
    private $auth;
    private $config;

    public function __construct()
    {
        parent::__construct();

        $this->response = new \system\http\Response();
        $this->request = new \system\http\Request();
        $this->blogmodel = new Blog();
        $this->auth = new Auth();


        $this->data["navside_partial"] = $this->view->partial("templates/admin/navside_partial");

        $this->cargarOpciones();
        $this->data["copyright"] = $this->data['title'] . " " . date('Y');
        $this->data["contenido"] = '';
        //inicializar menu
        $this->actualizaPartialsMenu();
        $this->view->useTemplate('admin');
    }

    function before()
    {
        if (!$this->auth->isLogged()) {
            //$this->response->redirect("/login");
        }
    }

    public function index()
    {
        echo $this->view->useTemplate("admin")->render("blog/admin/dashboard", $this->data);
    }

    public function login()
    {
        echo "login";
    }

    public function menu($data = null)
    {

        if ($data) {
            $this->data = $data;
            $this->actualizaPartialsMenu();
        }
        echo $this->view->useTemplate("admin")->render("blog/admin/menu", $this->data);
    }

    function menuInsertar()
    {
        if ($this->request->getQuery('boton_insertar') === 'insertar') {
            $data['name'] = $this->request->getQuery('name');
            $data['url'] = $this->request->getQuery('url');
            $data['heading'] = $this->request->getQuery('heading');
            $data['secondarytext'] = $this->request->getQuery('secondarytext');
            $success = $this->blogmodel->insertarNavItem($data);
            if ($success) {
                $this->data["contenido"] = '<div class="alert alert-success">
                                                <strong>Elemento Insertado con exito!</strong> 
                                                </div>';
            } else {
                $this->data["contenido"] = '<div class="alert alert-warning">
                                                <strong>!No se pudo insertar!</strong> 
                                                </div>';
            }
        } else {

            $this->data['contenido'] = $this->view->partial('views/blog/admin/menu/insertar_partial');
        }
        $this->menu($this->data);
    }

    function menuEditar($id)
    {
        if ($this->request->getQuery('boton_editar') === 'editar') {

            $navdata['name'] = $this->request->getQuery('name');
            $navdata['url'] = $this->request->getQuery('url');
            $navdata['heading'] = $this->request->getQuery('heading');
            $navdata['secondarytext'] = $this->request->getQuery('secondarytext');

            if ($this->blogmodel->modificaNavItemporId($id, $navdata)) {
                $this->data["contenido"] = '<div class="alert alert-success">
                                                <strong>Elemento editado con exito!</strong> 
                                                </div>';
            }
        } else {

            $data["infonav"] = $this->blogmodel->navBarInfoPorId($id);
            $data['id'] = $id;
            $this->data['contenido'] = $this->view->partial('views/blog/admin/menu/editar_partial', $data);
        }
        $this->menu($this->data);
    }

    function menuBorrar($id = null, $confirmar = null)
    {

        if ($id && $confirmar === 'ok' && $id != 1) {
            //borrar y redireccionar al menu
            if ($this->blogmodel->borrarNavItemPorId($id)) {

                $this->data["contenido"] = '<div class="alert alert-success">
                                            <strong>Elemento Borrado!</strong> 
                                            </div>';
            }
        } else {
            if ($id == 1) {
                $this->data["contenido"] = '<div class="alert alert-warning">
                                            <strong>No se puede borrar Home!</strong> 
                                            </div>';
            } else {
                $data["id"] = $id;
                $this->data['contenido'] = $this->view->partial('views/blog/admin/menu/borrar_partial', $data);
            }
        }
        $this->menu($this->data);
    }

    function paginas()
    {
        echo $this->view->useTemplate("admin")->render("blog/admin/paginas", $this->data);
    }

    function categorias($data = NULL)
    {
        if ($data) {
            $this->data = $data;
        }
        $this->data['tablecategorias'] = $this->imprimeTableCategoria();
        echo $this->view->useTemplate("admin")->render("blog/admin/categorias", $this->data);
    }

    function categoriaInsertar()
    {
        if ($this->request->getQuery('boton_insertar') === 'insertar') {
            $data['name'] = $this->request->getQuery('name');
            $data['url'] = $this->request->getQuery('url');

            $success = $this->blogmodel->insertarCatItem($data);
            if ($success) {
                $this->data["contenido"] = '<div class="alert alert-success">
                                                <strong>Elemento Insertado con exito!</strong> 
                                                </div>';
            } else {
                $this->data["contenido"] = '<div class="alert alert-warning">
                                                <strong>!No se pudo insertar!</strong> 
                                                </div>';
            }
        } else {

            $this->data['contenido'] = $this->view->partial('views/blog/admin/categorias/insertar_partial');
        }
        $this->categorias($this->data);
    }

    function categoriaEditar($id)
    {
        if ($this->request->getQuery('boton_editar') === 'editar') {

            $data['name'] = $this->request->getQuery('name');
            $data['url'] = $this->request->getQuery('url');

            if ($this->blogmodel->modificaCategoriaPorId($id, $data)) {
                $this->data["contenido"] = '<div class="alert alert-success">
                                                <strong>Elemento editado con exito!</strong> 
                                                </div>';
            }
        } else {

            $data["info"] = $this->blogmodel->registroPorId("categorias", $id);
            $data['id'] = $id;
            $this->data['contenido'] = $this->view->partial('views/blog/admin/categorias/editar_partial', $data);
        }
        $this->categorias($this->data);
    }

    function categoriaBorrar($id = null, $confirmar = null)
    {
        if ($id && $confirmar === 'ok') {
            //borrar 
            if ($this->blogmodel->borrarItemPorId("categorias", $id)) {

                $this->data["contenido"] = '<div class="alert alert-success">
                                            <strong>Elemento Borrado!</strong> 
                                            </div>';
            }
        } else {
            $data["id"] = $id;
            $this->data['contenido'] = $this->view->partial('views/blog/admin/categorias/borrar_partial', $data);
        }
        $this->categorias($this->data);
    }

    function articulos($data = null)
    {
        if ($data) {
            $this->data = $data;
        }
        $this->data["tablaarticulos"] = $this->imprimeTablaArticulos();
        Assets::addToGroup("admincss", "css/jquery-te-1.4.0.css");
        Assets::addToGroup("adminjs", "js/jquery-te-1.4.0.min.js");
        Assets::addToGroup("adminjs", "js/articulos.js");
        echo $this->view->useTemplate("admin")->render("blog/admin/articulos", $this->data);
    }

    function articulosInsertar()
    {
        if ($this->request->getQuery('boton_insertar') === 'insertar') {
            $data_articulo['byuser'] = "geovanny";
            $data_articulo['text'] = $this->request->getQuery("articulo");
            $data_articulo['title'] = $this->request->getQuery("title");
            $data_articulo['id_recurso'] = $this->request->getQuery('recursosselect');
            $data_articulo['readmore'] = $this->request->getQuery("readmore");
            $data_articulo['id_categoria'] = $this->request->getQuery('categoriasselect');
            $success = $this->blogmodel->insert("posts", $data_articulo);
            if ($success) {
                $this->data["contenido"] = '<div class="alert alert-success">
                                                <strong>Artículo salvado!</strong> 
                                                </div>';
            } else {

                $this->data["contenido"] = '<div class="alert alert-warning">
                                                <strong>!No se pudo Crear el artículo!</strong> 
                                                </div>';
            }
        } else {
            $data_articulo['categorias_select'] = $this->imprimeCategoriasSelect();
            $data_articulo['checked'] = '';
            $data_articulo['imagen_select'] = $this->imprimeRecursosSelect();
            $this->data['contenido'] = $this->view->partial('views/blog/admin/articulos/insertar_partial', $data_articulo);
        }
        $this->articulos($this->data);
    }

    function articulosEditar($id)
    {
        if ($this->request->getQuery("boton_editar") == "editar") {
            $data['title'] = $this->request->getQuery('title');
            $data['readmore'] = $this->request->getQuery('readmore');
            $data['text'] = $this->request->getQuery('articulo');
            $data['id_categoria'] = $this->request->getQuery('categoriasselect');
            $data['id_recurso'] = $this->request->getQuery('recursosselect');
            if ($this->blogmodel->modificaRegistro("posts", $id, $data)) {
                $this->data["contenido"] = '<div class="alert alert-success">
                                                <strong>Elemento editado con exito!</strong> 
                                                </div>';
            }
        } else {
            //mostrar el partial editar

            $data["info"] = $this->blogmodel->registroPorId("posts", $id);
            $data['categorias_select'] = $this->imprimeCategoriasSelect($data['info'][0]->id_categoria);
            $data['imagen_select'] = $this->imprimeRecursosSelect($data['info'][0]->id_recurso);
            $this->data["contenido"] = $this->view->partial('views/blog/admin/articulos/editar_partial', $data);
        }
        $this->articulos($this->data);
    }

    function articulosBorrar($id = null, $confirmar = null)
    {

        if ($id && $confirmar === 'ok') {
            //borrar 
            if ($this->blogmodel->borrarItemPorId("posts", $id)) {

                $this->data["contenido"] = '<div class="alert alert-success">
                                            <strong>Elemento Borrado!</strong> 
                                            </div>';
            }
        } else {
            $data["id"] = $id;
            $this->data['contenido'] = $this->view->partial('views/blog/admin/articulos/borrar_partial', $data);
        }
        $this->articulos($this->data);
    }

    function configuracion($salvar = null)
    {
        if ($this->request->getQuery('boton_salvar') === $salvar) {
            $opciones['title'] = $this->request->getQuery('titulo');
            $this->salvarOpciones($opciones);
            $this->cargarOpciones();
            $this->data["contenido"] = '<div class="alert alert-success">
                                            <strong>Configuracion Salvada!</strong> 
                                            </div>';
        }
        echo $this->view->render('blog/admin/configuracion', $this->data);
    }

    function imprimeBarraNav()
    {

        $navbar = $this->blogmodel->barraNav();
        $li = "";
        foreach ($navbar as $elemento) {
            if ($elemento->name != "HOME") {
                $li .= "<li>";
                $li .= "<a href = \"$elemento->url\">$elemento->name</a>";
                $li.= "</li>";
            }
        }

        return $li;
    }

    function imprimeTableMenu()
    {
        $navbar = $this->blogmodel->barraNav();
        $tablemenu = "";
        foreach ($navbar as $elementos) {

            $tablemenu .= "<tr>";
            foreach ($elementos as $elem) {
                $tablemenu.= "<td>$elem</td>";
            }

            $tablemenu.="<td><a href=\"/admin/menu/editar/$elementos->id\" class='btn-sm btn-warning'>Editar</a></td>";
            $tablemenu.="<td><a href=\"/admin/menu/borrar/$elementos->id\" class='btn-sm btn-danger'>Borrar</a></td>";
            $tablemenu.="</tr>";
        }
        $tablemenu.="<tr><td colspan='7'><a href=\"/admin/menu/insertar/\" class='btn-sm btn-primary'>Insertar</a></td></tr>";

        return $tablemenu;
    }

    function actualizaPartialsMenu()
    {

        $this->data["navbar"] = $this->imprimeBarraNav();
        $this->data["navbar_partial"] = $this->view->partial("templates/admin/navbar_partial", $this->data);
        $this->data["tablemenu"] = $this->imprimeTableMenu();
    }

    function imprimeTableCategoria()
    {
        $categorias = $this->blogmodel->categorias();
        $tablemenu = "";
        foreach ($categorias as $elementos) {

            $tablemenu .= "<tr>";
            foreach ($elementos as $elem) {
                $tablemenu.= "<td>$elem</td>";
            }
            $tablemenu.="<td><a href=\"/admin/categorias/editar/$elementos->id\" class='btn-sm btn-warning'>Editar</a></td>";
            $tablemenu.="<td><a href=\"/admin/categorias/borrar/$elementos->id\" class='btn-sm btn-danger'>Borrar</a></td>";
            $tablemenu.="</tr>";
        }
        $tablemenu.="<tr><td colspan='5' ><a href=\"/admin/categorias/insertar/\" class='btn-sm btn-primary'>Insertar</a></td></tr>";

        return $tablemenu;
    }

    function imprimeCategoriasSelect($id = NULL)
    {

        $categorias = $this->blogmodel->categorias();

        $select = '<select name="categoriasselect">';
        if (count($categorias)) {
            foreach ($categorias as $cat) {
                $option_selected = '';
                if ($id === $cat->id) {
                    $option_selected = 'selected';
                }

                $select.= "<option value='$cat->id' $option_selected>$cat->name</option>";
            }
        }
        $select.='</select>';
        return $select;
    }

    function imprimeTablaArticulos()
    {
        $articulos = $this->blogmodel->select("posts", ['id', 'title', 'byuser', 'postedon', 'id_recurso', 'readmore', 'id_categoria']);
        $tablemenu = "";
        foreach ($articulos as $articulo) {
            $tablemenu .= "<tr>";
            foreach ($articulo as $elem) {
                $tablemenu.= "<td>$elem</td>";
            }
            $tablemenu.="<td><a href=\"/admin/articulos/editar/$articulo->id\" class='btn-sm btn-warning'>Editar</a></td>";
            $tablemenu.="<td><a href=\"/admin/articulos/borrar/$articulo->id\" class='btn-sm btn-danger'>Borrar</a></td>";
            $tablemenu.="</tr>";
        }
        $tablemenu.="<tr><td colspan='9' ><a href=\"/admin/articulos/insertar/#articulo\" class='btn-sm btn-primary'>Crear Nuevo</a></td></tr>";

        return $tablemenu;
    }

    function obtenerOpciones()
    {
        return unserialize(file_get_contents(CONFIG_PATH . 'blog.php'));
    }

    function salvarOpciones($opciones)
    {
        file_put_contents(CONFIG_PATH . 'blog.php', serialize($opciones));
    }

    function cargarOpciones()
    {
        $this->config = $this->obtenerOpciones();
        $this->data["title"] = $this->config['title'];
    }

    public function search()
    {
        $q = $this->request->getQuery("term");
        $datos = $this->blogmodel->getPostsTitle($q);

        foreach ($datos as $key) {
            $registro["id"] = $key->id;
            $registro["value"] = $key->title;
            $registro["label"] = $key->title;

            $data[] = $registro;
        }

        echo json_encode($data);
    }

    function recursos($mensaje = null)
    {
        $this->data['galeria'] = $this->imprimeGaleria();
        $this->data['mensaje'] = $mensaje;
        echo $this->view->useTemplate("admin")->render("blog/admin/recursos/subirform", $this->data);
    }

    function recursosDescarga($nombre)
    {
        $nombrereal = split('/', $nombre);
        header("Content-disposition: attachment; filename='$nombrereal[1]'");
        readfile(ASSET_PATH . "images" . DS . $nombre);
        exit();
    }

    /**
     * It wont delete the file on server
     * @param type $id
     */
    function recursosBorrar($id)
    {
        $exito = $this->blogmodel->borrarItemPorId('recursos', $id);
        if ($exito) {
            $this->recursos($this->mensajeExito("Imagen Borrada Exitosamente!"));
        }
    }

    function subir()
    {
        $nombre_img = $_FILES['file']['name'];
        $dir_subida = ASSET_PATH . 'images' . DS . 'galeria' . DS;
        $fichero_subido = $dir_subida . $nombre_img;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $fichero_subido)) {
            $data['url'] = "galeria/$nombre_img";
            $this->blogmodel->insert('recursos', $data);
            $this->recursos($this->mensajeExito("Imagen subida con exito"));
        }
    }

    function imprimeGaleria()
    {
        $imgrows = $this->blogmodel->select('recursos', ['*']);
        $gal = '';
        foreach ($imgrows as $img) {
            $gal.= "<div class='col-xs-8 col-md-3'>
                <div class='panel panel-default'>
                    <div class='panel-image'>
                        <img src='/assets/images/$img->url' class='img-responsive' />
                    </div>
                    <div class='panel-footer text-center'>
                        <a href='/admin/recursos/descarga/$img->url'><span class='glyphicon glyphicon-download'>Descargar</span></a>
                        <a href='/admin/recursos/borrar/$img->id'><span class='glyphicon glyphicon-remove'>Borrar</span></a>
                    </div>
                </div>
            </div>";
        }
        return $gal;
    }

    function imprimeRecursosSelect($id = NULL)
    {

        $recursos = $this->blogmodel->select('recursos', ['*']);

        $select = '<select name="recursosselect">';
        if (count($recursos)) {
            $select.= "<option value=''>SIN IMAGEN</option>";

            foreach ($recursos as $rec) {
                $optionSelected = '';
                if ($id === $rec->id) {
                    $optionSelected = 'selected';
                }

                $select.= "<option value='$rec->id' $optionSelected>$rec->url</option>";
            }
        }
        $select.='</select>';
        return $select;
    }

    function mensajeExito($mensaje)
    {
        return '<div class="alert alert-success">
                <strong>' . $mensaje . '</strong>
                </div>';
    }

}
