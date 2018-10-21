<?php

$connected = false;

if (isset($_SESSION['connected'])) {
    $connected = $_SESSION['connected'];
}

if ($connected) {
    include 'views/connectedView.php';
}
else {
    include 'views/notConnectedView.php';
}