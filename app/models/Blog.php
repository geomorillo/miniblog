<?php

/*
 * Todos los derechos reservados por Manuel Jhobanny Morillo Ordoñez 
 * 2016
 * Contacto: geomorillo@yahoo.com
 */

/**
 * Description of Blog
 *
 * @author geomorillo
 */

namespace app\models;

use system\core\Model;

class Blog extends Model
{

    function barraNav()
    {
        return $this->db->table("navbar")->select();
    }

    function paginas()
    {
        return $this->db->table("paginas")->select();
    }

    function allposts()
    {
        return $this->db->table("posts p")
                        ->join('recursos r', ['r.id', '=', 'p.id_recurso'], 'LEFT')
                        ->orderBy('postedon', 'DESC')
                        ->orderBy('byuser', 'ASC');
                     //   ->select(["p.id as pid", "p.title", "p.byuser", "p.postedon", "p.readmore", "p.text", "r.url as url"]);
    }

    function select($tabla, $data)
    {
        return $this->db->table($tabla)->select($data);
    }

    function categorias()
    {
        return $this->db->table("categorias")->select();
    }

    function insertarCatItem($categoria)
    {
        return $this->db->table("categorias")->insert($categoria);
    }

    function modificaCategoriaPorId($id, $data)
    {
        return $this->db->table("categorias")->where('id', $id)->update($data);
    }

    function registroPorId($tabla, $id)
    {
        return $this->db->table($tabla)->where("id", $id)->select();
    }

    function selectWhere($tabla, $campo, $valor)
    {
        return $this->db->table($tabla)->where($campo, $valor)->select();
    }

    function borrarItemPorId($tabla, $id)
    {
        return $this->db->table($tabla)->where("id", $id)->delete();
    }

    function post($id)
    {
        return $this->db->table("posts")->where("id", $id)->select();
    }

    function postInfo($id)
    {
        return $this->db->table('posts p')
                        ->join('recursos r', ['r.id', '=', 'p.id_recurso'], 'LEFT')
                        ->join('categorias c', ['c.id', '=', 'p.id_categoria'], 'LEFT')
                        ->where("p.id", $id)
                        ->select(["p.id as pid", "p.title", "p.byuser", "p.postedon", "p.readmore", "p.text", "r.url as url","c.name"]);
    }
    function postInfoCategoria($idCaterogia)
    {
        return $this->db->table('posts p')
                        ->join('recursos r', ['r.id', '=', 'p.id_recurso'], 'LEFT')
                        ->join('categorias c', ['c.id', '=', 'p.id_categoria'], 'LEFT')
                        ->where("c.id", $idCaterogia)
                        ->select(["p.id as pid", "p.title", "p.byuser", "p.postedon", "p.readmore", "p.text", "r.url as url","c.name"]);
    }
    function modificaRegistro($tabla, $id, $data)
    {
        return $this->db->table($tabla)->where('id', $id)->update($data);
    }

    function comentarios($id_post)
    {
        return $this->db->table("comentarios")->where("id_post", $id_post)->select();
    }

    function insertarComentario($comentario)
    {
        return $this->db->table("comentarios")->insert($comentario);
    }

    function navBarInfoPorName($nombre)
    {
        return $this->db->table("navbar")->where('name', $nombre)->select();
    }

    function navBarInfoPorId($id)
    {
        return $this->db->table("navbar")->where('id', $id)->select();
    }

    function insertarNavItem($data)
    {
        return $this->db->table('navbar')->insert($data);
    }

    function modificaNavItemporId($id, $data)
    {
        return $this->db->table("navbar")->where('id', $id)->update($data);
    }

    function borrarNavItemPorId($id)
    {
        return $this->db->table("navbar")->where("id", $id)->delete();
    }

    function insert($tabla, $data)
    {
        return $this->db->table($tabla)->insert($data);
    }


    function buscarPosts($termino)
    {
        return $this->db->table('posts p')
                        ->join('recursos r', ['r.id', '=', 'p.id_recurso'], 'LEFT')
                        ->join('categorias c', ['c.id', '=', 'p.id_categoria'], 'LEFT')
                        ->likeWhere("title", $termino)
                        ->orderBy('postedon', 'DESC')
                        ->select(["p.id as pid", "p.title", "p.byuser", "p.postedon", "p.readmore", "p.text", "r.url as url","c.name"]);
    }

    public function getPostsTitle($data)
    {
        $posts = $this->db->table("posts")->where("title", "LIKE", '%' . $data . '%')->select();
        return $posts;
    }

    public function test1()
    {
        return $this->db->table('posts')
                        ->where('text', 'xxxxxx')
                        ->where('byuser', 'geovanny')
                        ->select();
    }

}
