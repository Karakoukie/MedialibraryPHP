<?php

$connectionUserId = null;

if (isset($_SESSION['connectionUserId'])) {
    $connectionUserId = $_SESSION['connectionUserId'];
}

//if ($connectionUserId) {
//    $query = 'SELECT * FROM users WHERE id="' . $connectionUserId . '"';
//    
//    $statement = dataBaseConnection::execute($query);
//    
//    if ($statement) {
//        $dataComand = $statement->FetchAll();
//        
//        foreach ($dataComand as $compte) {
//            $login = $compte["login"];
//            $password = $compte["password"];
//            $admin = $compte["status"];
//            $user = new UserModel($connectionUserId, $login, $password, $admin);
//            echo $user->toModify();
//        }
//    }
//}

$panier = null;

if (isset($_SESSION["panier"])) {
    $panier = $_SESSION["panier"];
}

if ($panier) {
    include 'views/panierView.php';
}
else {
    include 'views/comandsView.php';
}