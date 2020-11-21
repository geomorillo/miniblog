<?php

use system\core\Assets;

// group by name only extension js, and css.
$assets = ["css" => ["css/bootstrap.min.css","css/jquery-ui.css", "css/blog-home.css"],
    "js" => [ "js/jquery.min.js", "js/bootstrap.min.js","js/jquery-ui.js","js/search.js"],
    "admincss"=>["css/bootstrap.min.css","css/font-awesome.css","css/custom.css"],
    "adminjs"=> [ "js/jquery.min.js", "js/bootstrap.min.js","js/custom.js"],
    "logincss"=>["css/bootstrap.min.css","css/jquery-ui.css","css/styles.css","css/login.css"]
   
];
Assets::group($assets);
$assets2 = [
    
    "logo1" => ["images/logo.png", "title= \"PRESTO MVC\" class=\"img-responsive imagen\" width=130 height=25"]
    //"logo2" => ["images/logo.png", "title= \"PRESTO MVC\"  width=130 height=25\""]

];

Assets::add($assets2);