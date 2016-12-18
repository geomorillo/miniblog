<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace system\helpers;

/**
 * Description of Paginator
 *
 * @author Daniel Navarro Ramírez
 */
use system\http\Request;
use system\database\Database;

class Paginator
{

    /**
     *
     * @var type string $page store the number of page
     */
    private static $page;

    /**
     *
     * @var type string Number of links or pages to create
     */
    private static $paginas;

    /**
     *
     * @var type string Records to show
     */
    private static $perPage;

    /**
     *
     * @var type string URL request or Path
     */
    private static $uri;

    /**
     *
     * @var type string Table rows(records)
     */
    private static $rows;
    private static $db;

    /**
     * Start the essential variables
     */
    private static function init()
    {
        $request = new Request();
        $pages = $request->getQuery("page");
        $perPage = $request->getQuery("per-page");
        self::$page = !empty($pages) ? $pages : "1";
        self::$perPage = !empty($perPage) ? $perPage : 10;
        self::$uri = $request->getUrl();
        self::$db = Database::connect();
    }

    /**
     * 
     * @param type $data array Store perPage and TableName
     * PerPage is the first parameter and store the quantity of record to show per page
     * TableName is the second parameter and need to receive an string with the name of the table on your database
     * 
     * @return array queries and pagination
     * 
     * Array queries store the data from Database Model
     * Array pagination store the HTML to paginate the Database Model records
     */
    public static function paginate($perPage,$data)
    {
        // Initialize variables
        self::init();
        // Store the record from the database select
        $retorno["queries"] = self::queries($perPage,$data);

        $pagination = "";
        $p = isset($perPage) ? $perPage : self::$perPage;

        $pagination .= '<nav aria-label="Page navigation">';
        $pagination .= '<ul class="pagination">';
        if (self::$paginas <= 1) {
            $count = 1;
            $pagination .= '<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            for ($i = 1; $i <= self::$paginas; $i++) {
                $pagination .= '<li><a href="' . self::$uri . '?page=' . $i . '&per-page=' . $p . '">' . $count . '</a></li>';
                $count++;
            }
            $pagination .= '<li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        } elseif (self::$paginas > 1) {
            $count = 1;
            if (self::$page - 1 == 0) {
                $pagination .= '<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                $pagination .= '<li><a href="' . self::$uri . '?page=' . (self::$page - 1) . '&per-page=' . $p . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for ($i = 1; $i <= self::$paginas; $i++) {
                $pagination .= '<li><a href="' . self::$uri . '?page=' . $i . '&per-page=' . $p . '">' . $count . '</a></li>';
                $count++;
            }

            if (self::$page + 1 > self::$paginas) {
                $pagination .= '<li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
            } else {
                $pagination .= '<li><a href="' . self::$uri . '?page=' . (self::$page + 1) . '&per-page=' . $p . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
        $pagination .= '</ul>';
        $pagination .= '</nav>';

        $retorno["pagination"] = $pagination;

        // Retorno
        return $retorno;
    }

    /**
     * This methods establish the relation with database, besides return records and rows
     * 
     * 
     * @param $perPage gets the number of records to show on your table
     * @param $data pdo object)
     * 
     * @return type object Database records
     */
    private static function queries($perPage,$data)
    {
        $all = clone $data;  //clone the original data so we can work later with it
        $selectAll = $all->select();
        self::$rows = $all->count();
        $all = NULL;//destroy clone
        $perPage = !empty($perPage) ? $perPage : self::$perPage;

        self::$paginas = ceil(self::$rows / $perPage);
        
        return $data->limit($perPage)->offset(((self::$page - 1) * $perPage))->select();
    }

}
