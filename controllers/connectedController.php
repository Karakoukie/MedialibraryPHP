<?php

$connection = null;
$admin = false;

if (isset($_REQUEST['connection'])) {
    $connection = $_REQUEST['connection'];
}

if ($connection == "deconnection") {
    $_SESSION['connected'] = false;
    Panier::clear();
    header("Refresh: 0");
}

if (isset($_SESSION['connectedAsAdmin'])) {
    $admin = $_SESSION['connectedAsAdmin'];
}

if ($admin == true) {
    include 'views/adminView.php';
}
else {
    include 'views/clientView.php';
}