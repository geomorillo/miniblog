<?php

namespace app\controllers;

/**
 * Description of Main
 *
 * @author geomorillo
 */
use system\core\Controller;
use system\core\Assets;
use system\core\Language;
use system\helpers\Auth\Auth;
use system\helpers\Html;

class Installer extends Controller {

    private $_errors = [];

    public function index(...$args) {
        $data = Language::translateAll();

        // $attributes = array(
        //     'class' => 'boldlist',
        //     'id'    => 'requerimientos'
        // );

        $data["requerimientos"] = Html::ul($this->chequeaRequerimientos(), "");
        $data["dbPartial"] = $this->view->partial("views/installer/FormDbPartial");
        if (count($this->_errors) > 0) {

            $data["errores"] = Html::ul($this->getErrors(), "");
        }

        echo $this->view->useTemplate("installer")->render("installer/index", $data);
    }

    public function chequeaRequerimientos() {
        $requerimientos = array();

        if ($this->getPhpVersion(null)) {
            array_push($requerimientos, "Version PHP" . phpversion() . " OK ");
        }
        if ($this->checkPdo()) {

            array_push($requerimientos, "Pdo Support OK ");
        }
        if ($this->checkSessionSupport()) {

            array_push($requerimientos, "Session Support OK ");
        }
        if ($this->checkCurl()) {

            array_push($requerimientos, "Curl Support OK ");
        }

        if ($this->checkModRewrite()) {

            array_push($requerimientos, "Apache Mod Rewrite Support OK ");
        }

        return $requerimientos;
    }

    protected function setError($errorName = '', $errorMessage = '') {
        $this->_errors[] = $errorMessage;
    }

    public function getErrors() {
        return $this->_errors;
    }

    public function pass() {
        return (!count($this->getErrors()) ? true : false);
    }

    public function getPhpVersion() {
        $version = phpversion();
        $versionSoportada = "7.2.19";
        if (version_compare($version, $versionSoportada, ">="))
            return true;

        $this->setError('php_version', 'PHP vesion Must be <strong>' . $versionSoportada . '</strong> or higher, the current version is <strong>' . $version . '</strong>');
        return false;
    }

    public function getServerOS() {
        return PHP_OS . ' | ' . php_uname();
    }

    // check if PDO Extension is Supported
    public function checkPdo() {
        if (class_exists('PDO') && defined('PDO::ATTR_DRIVER_NAME'))
            return true;

        $this->setError('pdo', 'this Server not Supported PDO');
        return false;
    }

    // check if session is support
    public function checkSessionSupport() {
        if (function_exists('session_start'))
            return true;

        $this->setError('session', 'Session Support not enabeld on this Server');
        return false;
    }

    public function checkCurl() {
        if (function_exists('curl_version'))
            return true;

        $this->setError('curl', 'the CURL not enabeld in this server');
        return false;
    }

    public function checkModRewrite() {
        if (function_exists('apache_get_modules')) {
            if (in_array('mod_rewrite', \apache_get_modules()))
                return true;
        } elseif (getenv('HTTP_MOD_REWRITE') == 'On' || array_key_exists('HTTP_MOD_REWRITE', $_SERVER)) {
            return true;
        }


        $this->setError('mod_rewrite', 'the Mode Rewrite not available on this server');
        return false;
    }

    /**
     * Directories and Files
     * 	check if x path is writable or not
     */
    public function checkIfDirIsWritable($foo) {

        if (is_writable("ruta archivo config"))
            return true;

        $this->setError("is_writable", "Can't Write on " . "ruta archivo");
        return false;
    }

    public function test() {
        $cf = new \system\helpers\DbConfigSetup();

        $newconfig = [
            'driver' => 'mysql',
            'host_name' => 'localhost',
            'db_name' => 'miniblog',
            'db_user' => 'root',
            'db_password' => ''
        ];

        $cf->ConfigWriter($newconfig);
    }

}
