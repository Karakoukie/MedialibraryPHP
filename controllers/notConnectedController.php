<?php

$connection = "login";

if (isset($_REQUEST['connection'])) {
    $_SESSION['connection'] = $_REQUEST['connection'];
}
if (isset($_SESSION['connection'])) {
    $connection = $_SESSION['connection'];
}

switch ($connection) {
    default : include 'views/errorView.php';
        break;
    
    case "login" : include 'views/loginView.php';
        break;
    
    case "register" : include 'views/registerView.php';
        break;
    
    case "deconnection" : include 'views/loginView.php';
        break;
}