<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace system\helpers;

/**
 * Description of DbConfigSetup
 *
 * @author Usuario
 */
class DbConfigSetup {

    //put your code here
    function ConfigReader() {

        $contenido =  include_once CONFIG_PATH."database_config.php";
        return $contenido;
    }

    public function ConfigWriter($newconfig) {
        $config  = $this->ConfigReader();
        $config["mysql"] = $newconfig;
    }

}

//    'mysql' => [
//        'driver' => 'mysql',
//        'host_name' => 'localhost',
//        'db_name' => 'miniblog',
//        'db_user' => 'root',
//        'db_password' => ''
//    ],
class DbConfiguracion {

    private $driver;
    private $host_name;
    private $db_name;
    private $db_user;
    private $db_password;

    function __construct($driver, $host_name, $db_name, $db_user, $db_password) {
        $this->driver = $driver;
        $this->host_name = $host_name;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
    }

}
