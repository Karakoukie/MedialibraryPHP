<?php

$page = "home";

if (isset($_REQUEST['page'])) {
    $_SESSION['page'] = $_REQUEST['page'];
}
if (isset($_SESSION['page'])) {
    $page = $_SESSION['page'];
}

switch ($page) {
    default : include 'views/errorView.php';
        break;
    
    case "home" : include 'views/homeView.php';
        break;
    
    case "connection" : include 'views/connectionView.php';
        break;
    
    case "articles" : include 'views/articlesView.php';
        break;
}