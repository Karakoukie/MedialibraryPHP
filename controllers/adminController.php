<?php

$module = "articles";

if (isset($_REQUEST["module"])) {
    $module = $_REQUEST["module"];
}

switch ($module) {
    default : include 'views/errorView.php';
        break;
    case "users" : include 'views/usersModuleView.php';
        break;
    case "commands" : include 'views/commandsModuleView.php';
        break;
    case "articles" : include 'views/articlesModuleView.php';
        break;
}