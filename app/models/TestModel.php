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

class TestModel extends Model
{

    public function categorias()
    {
        return $this->db->table('categorias')->select();
    }

    public function insertCategorias()
    {
        return $this->db->table('categorias')->insert(['name' => 'geo', 'url' => 'xxx']);
    }

    public function updateCategorias()
    {
        return $this->db->table('categorias')->where('id', 3)->update(['name' => 'yyyy']);
    }

    public function deleteCategoria()
    {
        return $this->db->table('categorias')->where('id', 3)->delete();
    }

    public function queryCategoria($sql, $params)
    {
        return $this->db->query($sql, $params)->results();
    }

    public function findCategoria($id)
    {
        return $this->db->table('categorias')->find($id);
    }

    function findmultipleCategoria()
    {
        return $this->db->table('categorias')
                        ->where('name', 'geo')
                        ->where('url', 2)
                        ->select();
    }

    function betweenCat()
    {
        return $this->db->table('categorias')
                        ->whereBetween('id', [5, 15])
                        ->select();
    }

    function like()
    {
        return $this->db->table('categorias')
                        ->likeWhere('name', 'geo')
                        ->select();
    }

    function orwhere()
    {
        return $this->db->table('categorias')
                        ->where('id', 5)
                        ->orWhere('id', 15)
                        ->select();
    }

    function inCategorias()
    {
        return $this->db->table('categorias')
                        ->in('id', [5, 15])
                        ->select();
    }

    function notinCategorias()
    {
        return $this->db->table('categorias')
                        ->notIn('id', [5, 15])
                        ->select();
    }

    function firstCategoria()
    {
        return $this->db->table('categorias')
                        ->notIn('id', [5, 15])
                        ->first();
    }

    public function trescat()
    {
        return $this->db->table('categorias')
                        ->limit(3)
                        ->select();
    }

    public function trescatdesde()
    {
        return $this->db->table('categorias')
                        ->limit(3)
                        ->offset(3)
                        ->select();
    }

}
