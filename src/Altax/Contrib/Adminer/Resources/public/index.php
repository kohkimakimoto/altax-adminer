<?php

if (preg_match("/^\/adminer\.css/", $_SERVER["REQUEST_URI"])) {
    // request css file
    $adminerCss = isset($_ENV["ADMINER_CSS"]) ? $_ENV["ADMINER_CSS"] : "default";
    $adminerCss .= ".css";

    $cssPath = __DIR__."/../adminer/css/".$adminerCss;

    $contents = file_get_contents($cssPath);

    header("Content-type: text/css"); 
    echo $contents;
    exit;
}

require __DIR__."/../adminer/adminer.php";

