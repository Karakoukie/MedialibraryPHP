<?php

$login = null;
$password = null;

if (isset($_REQUEST['login'])) {
    $login = $_REQUEST['login'];
}
if (isset($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
}

if ($login && $password) {
    
    $user = new UserModel(0, $login, $password, false);
    $statement = $user->search();
    $dataComand = $statement->FetchAll();
    
    if (sizeof($dataComand) == 1) {
        $_SESSION['connected'] = true;
        $_SESSION['connectionUserId'] = $dataComand[0]["id"];
        
        if ($dataComand[0]["status"] == 1) {
            $_SESSION['connectedAsAdmin'] = true;
        }
        else {
            $_SESSION['connectedAsAdmin'] = false;
        }
        
        echo '<section class="panel-white">';
        echo '<p class="info">Connexion réussie avec succès, vous allez être rediriger.</p>';
        echo '</section>';
        header("Refresh: 3");
    }
    else {
        echo '<section class="panel-white">';
        echo '<p class="error">Connexion impossible</p>';
        echo '</section>';
    }
}