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
use system\helpers\Paginator;
use system\http\Request;
use system\http\Response;

class Main extends Controller
{

    public $blogmodel;
    public $data;
    private $response;
    private $request;
    private $config;

    public function __construct()
    {
        parent::__construct();
        $this->response = new Response();
        $this->request = new Request();
        $this->blogmodel = new Blog();
        $this->config = $this->obtenerOpciones();
        $this->recargaIndex();
    }

    public function index($data = null)
    {
        //encabezado y textosecundario
        $navbarInfo = $this->blogmodel->navBarInfoPorName("HOME");
        $this->data["heading"] = $navbarInfo[0]->heading;
        $this->data["secondarytext"] = $navbarInfo[0]->secondarytext;
        if ($data) {
            $this->data = $data;
            $this->data["paginador"] = "";
            $this->recargaIndex();
        } else {
            $query = $this->blogmodel->allposts();

            $paginador = Paginator::paginate(3, $query);
            if (count($paginador["queries"])) {
                $this->data["paginador"] = $paginador["pagination"];
                $this->data["posts"] = $this->imprimePosts($paginador["queries"]);
            } else {
                $this->data["posts"] = "";
                $this->data["paginador"] = "";
            }
        }
        \system\core\Event::trigger('test.event',[1,2]);
        echo $this->view->useTemplate("blog")->render("blog/index", $this->data);
    }

    function post($id_post)
    {
        $post = (array) $this->blogmodel->postInfo($id_post);
        $this->data["post"] = $this->imprimePosts($post, FALSE);
        $this->data["id_post"] = $id_post;
        $this->data["comentarios"] = $this->imprimeComentarios($id_post);
        echo $this->view->useTemplate("blog")->render("blog/post", $this->data);
    }

    function pagina($id_post)
    {
        $post = $this->blogmodel->post($id_post);
        $this->data['post'] = $this->imprimePagina($post);
        $this->data["id_post"] = $id_post;
        echo $this->view->useTemplate("blog")->render('blog/pagina', $this->data);
    }

    function imprimePagina($postsData)
    {
        $postHtml = "";
        foreach ($postsData as $post) {
            $postHtml .= "<h2>
                <a href=\"post/$post->id\">$post->title</a>
            </h2>
            <p class=\"lead\">
                by <a href=\"\">$post->byuser</a>
            </p>
            <p><span class=\"glyphicon glyphicon-time\"></span> Posted on $post->postedon</p>
            <hr>";

            $postHtml.= "<p>$post->text</p>";
        }
        return $postHtml;
    }

    function imprimePosts($postsData, $readmore = TRUE)
    {

        $postHtml = "";
        foreach ($postsData as $post) {
            $post = (array) $post;
            $postId = $post['id'][0]; //the id i want is the first
            if (count($post['url']) > 1) {
                $url = $post['url'][0];
            } else {
                $url = $post['url'];
            }

            $postHtml .= "<h2>
                <a href=\"post/$postId\">$post[title]</a>
            </h2>
            <p class=\"lead\">
                by <a href=\"\">$post[byuser]</a>
            </p>
            <p><span class=\"glyphicon glyphicon-time\"></span> Posted on $post[postedon]</p>
            <hr>
            <img class=\"img-responsive\" width=\"304\" height=\"236\" src=\"/assets/images/$url\" alt=\"\">
            <hr>";
            if ($post['readmore'] === 'on' && $readmore) {
                $postHtml.="<p>" . substr($post['text'], 0, 200) . "........</p>";
                $postHtml.= "<a class=\"btn btn-primary\" href=\"/post/$postId\">Read More <span class=\"glyphicon glyphicon-chevron-right\"></span></a>";
            } else {
                $postHtml.= "<p>$post[text]</p>";
            }

            $postHtml.="<hr>";
        }
        return $postHtml;
    }

    function imprimeBarraNav()
    {

        $navbar = $this->blogmodel->barraNav();
        $li = "";
        foreach ($navbar as $elemento) {
            if ($elemento->name != "HOME") {
                $li .= "<li>";
                $li .= "<a href = \"/pagina/$elemento->url\">$elemento->name</a>";
                $li.= "</li>";
            }
        }

        return $li;
    }

    function imprimeCategorias()
    {
        $categorias = $this->blogmodel->categorias();
        $cathtml = "";
        foreach ($categorias as $cat) {
            $cathtml.= "<li><a href = \"/categorias/search/$cat->id\">$cat->name</a></li>";
        }
        return $cathtml;
    }

    function imprimeComentarios($id_post)
    {
        $comentarios = $this->blogmodel->comentarios($id_post);
        $html = "";
        foreach ($comentarios as $coment) {
            $html .= "<div class=\"media\">
        <a class=\"pull-left\" href=\"#\">
            <img class=\"media-object\" src='\assets\images\container2.jpg' alt=\"\">
        </a>
        <div class=\"media-body\">
            <h4 class=\"media-heading\">$coment->byuser
                <small>$coment->fecha</small>
            </h4>
           $coment->contenido
        </div>
        </div>";
        }
        return $html;
    }

    function insertarComentario($id_post)
    {
        $request = new \system\http\Request();
        $comentario["byuser"] = "Anonimo";
        $comentario["contenido"] = $request->getQuery("contenido");
        $comentario["id_post"] = $id_post;
        $this->blogmodel->insertarComentario($comentario);


        $this->response->redirect("/post/$id_post");
    }

    function alert($msg)
    {
        echo "<script>alert('" . $msg . "')</script>";
    }

    function obtenerOpciones()
    {
        return unserialize(file_get_contents(CONFIG_PATH . 'blog.php'));
    }

    function categoriaSearch($id)
    {
        $posts = $this->blogmodel->postInfo($id);
        $data["posts"] = $this->imprimePosts($posts, TRUE);
        $data["heading"] = 'Categoria:';
        if (isset($posts[0])) {
            $data["secondarytext"] = $posts[0]->name;
        } else {
            $data["secondarytext"] = 'No esta definida';
        }
        $this->index($data);
    }

    function recargaIndex()
    {
        $this->data['title'] = $this->config['title'];
        $this->data["navbar"] = $this->imprimeBarraNav();
        $this->data["categorias"] = $this->imprimeCategorias();
        $this->data["copyright"] = $this->data['title'] . " " . date('Y');
    }

    function search()
    {

        $string_busqueda = $this->request->getQuery('buscar');
        if ($string_busqueda) {
            $posts = $this->blogmodel->buscarPosts($string_busqueda);
            $data["posts"] = $this->imprimePosts($posts);
            $data["heading"] = 'Busqueda:';
            if (isset($posts[0])) {
                $data["secondarytext"] = $posts[0]->title;
            } else {
                $data["secondarytext"] = 'No se encontró!';
            }
            $this->index($data);
        } else {
            $this->index();
        }
    }

}
