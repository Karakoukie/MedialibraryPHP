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
            
    $query1 = "SELECT login FROM users ";
    $query1 .= "WHERE login='" . $login . "'";
    $statement1 = dataBaseConnection::execute($query1);
    
    if ($statement1) {
        $data1 = $statement1->FetchAll();

        if (sizeof($data1) == 0) {
            
            $newUser = new UserModel(0, $login, $password, false);
            $insertStatement = $newUser->insert();
            
            if ($insertStatement) {                
                $_SESSION['connected'] = true;
                $_SESSION['connectedAsAdmin'] = false;
                
                $query3 = "SELECT id FROM users ";
                $query3 .= "WHERE login='" . $login . "'";
                $statement3 = dataBaseConnection::execute($query3);
                
                if ($statement3) {
                    $data3 = $statement3->FetchAll();
                    $_SESSION['connectionUserId'] = $data3[0]["id"];
                }

                echo '<section class="panel-white">';
                echo '<p class="info">Info: Compte créé avec succès, vous allez être redirigé(e)</p>';
                echo '</section>';

                header("Refresh: 3");
            }
            else {
                echo '<section class="panel-white">';
                echo '<p class="error">Erreur: Impossible de créer le compte</p>';
                echo '</section>';
            }
        }
        else {
            echo '<section class="panel-white">';
            echo '<p class="error">Erreur: Nom de compte déjà utilisé</p>';
            echo '</section>';
        }
    }
    else {
        echo '<section class="panel-white">';
        echo '<p class="error">Erreur1: Impossible de créer le compte</p>';
        echo '</section>';
    }
}