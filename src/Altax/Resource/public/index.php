<?php

if (preg_match("/^\/adminer\.css/", $_SERVER["REQUEST_URI"])) {
    // request css file
    
}

require __DIR__."/../adminer/adminer.php";

