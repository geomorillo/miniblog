<?php

namespace system\http;

/**
 * Simple cookie class
 * @author Jhobanny Morillo <geomorillo@yahoo.com>
 * @date June 10, 2015
 */
class Cookie {

    public static function exists($key) {
        if (isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public static function set($key, $value, $expiry = 126144000, $path = "/", $domain = false) {
        $retval = false;
        if (!headers_sent()) {
            if ($domain === false)
                $domain = $_SERVER['HTTP_HOST'];

            if ($expiry === -1)
                $expiry = 1893456000; // Lifetime = 2030-01-01 00:00:00
            elseif (is_numeric($expiry))
                $expiry += time();
            else
                $expiry = strtotime($expiry);

            $retval = @setcookie($key, $value, $expiry, $path, $domain);
            if ($retval)
                $_COOKIE[$key] = $value;
        }
        return $retval;
    }

    public static function get($key, $default = '') {
        return (isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default);
    }

    public static function display() {
        return $_COOKIE;
    }

    public static function destroy($key, $value = '', $path = "/",$domain=".test.geo") {
        if (isset($_COOKIE[$key])) {
            $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
            unset($_COOKIE[$key]);
            setcookie($key, $value, time() - 3600, $path,$domain);
        }
    }

}
