<?php

$type = "movies";

if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
}

$buyId = null;
$buyQuantity = null;
$buyType = null;
$buyPrice = null;
$buyTitle = null;

if (isset($_REQUEST['buyId'])) {
    $buyId = $_REQUEST['buyId'];
}
if (isset($_REQUEST['buyQuantity'])) {
    $buyQuantity = $_REQUEST['buyQuantity'];
}
if (isset($_REQUEST['buyType'])) {
    $buyType = $_REQUEST['buyType'];
}
if (isset($_REQUEST['buyPrice'])) {
    $buyPrice = $_REQUEST['buyPrice'];
}

if ($buyId != null && $buyQuantity != null) {
    Panier::addArticle($buyId, $buyQuantity, $buyType, $buyPrice);
    echo '<section class="panel-white"><p class="info">Article ajouté au panier avec succès</p></section>';
    header("Location: index.php");
}

switch ($type) {
    default : include 'views/errorView.php';
        break;
    
    case "movies" : include 'controllers/moviesArticlesController.php';
        break;
        
    case "musics" : include 'controllers/musicsArticlesController.php';
        break;
    
    case "books" : include 'controllers/booksArticlesController.php';
        break;
}