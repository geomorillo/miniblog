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
use app\models\TestModel;

class Tests extends Controller
{

    public $mimodelo;

    public function __construct()
    {
        parent::__construct();
 
        $this->mimodelo = new TestModel();

    }

    public function index()
    {
        //print_r($this->mimodelo->categorias());
        /*
        if($this->mimodelo->insertCategorias()){
            echo "<br>categoria insertada";
        };
        
        if($this->mimodelo->updateCategorias()){
            echo "<br>categoria actualizada";
        }
        */
        /*
        if($this->mimodelo->deleteCategoria()){
            echo "categoria borrada";
            
        }
        */
        
      // print_r($this->mimodelo->queryCategoria('INSERT INTO categorias VALUES (null,1,2);',[]));
     // print_r($this->mimodelo->findCategoria(5));
     //print_r($this->mimodelo->findmultipleCategoria());
     //print_r($this->mimodelo->betweenCat());
        //print_r($this->mimodelo->like());
        //print_r($this->mimodelo->orwhere());
        //print_r($this->mimodelo->inCategorias());
        //print_r($this->mimodelo->notinCategorias());
        //print_r($this->mimodelo->firstCategoria(FALSE));
       // print_r($this->mimodelo->trescat());
        print_r($this->mimodelo->trescatdesde());
    }


    

}
