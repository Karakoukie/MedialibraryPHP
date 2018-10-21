<?php

$type = "movies";

if (isset($_REQUEST["type"])) {
    $type =$_REQUEST["type"];
}

switch ($type) {
    default: include 'views/errorView.php';
        break;
        
    case "movies" : include 'controllers/moviesArticleModuleController.php';
        break;
    
    case "musics" : include 'controllers/musicsArticleModuleController.php';
        break;
    
    case "books" : include 'controllers/booksArticleModuleController.php';
        break;
}