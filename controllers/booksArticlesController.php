<?php

$title = null;
$price = null;
$year = null;
$amount = 5;

if (isset($_REQUEST['title'])) {
    $title = $_REQUEST['title'];
}
if (isset($_REQUEST['price'])) {
    $price = $_REQUEST['price'];
}
if (isset($_REQUEST['year'])) {
    $year = $_REQUEST['year'];
}
if (isset($_REQUEST['articleAmount'])) {
    $amount = $_REQUEST['articleAmount'];
}

$articles = BookArticleModel::import($amount, $title, $price, $year);

$connected = null;
$admin = false;

if (isset($_SESSION['connected'])) {
    $connected = $_SESSION['connected'];
}
if (isset($_SESSION['connectedAsAdmin'])) {
    $admin = $_SESSION['connectedAsAdmin'];
}

if (!$connected) {
    echo "<article class='panel'><p class='info'>Vous devez vous connecter pour affectuer un achat</p></article>";
}

foreach ($articles as $article) {
    echo $article->toShow();
    if ($connected && !$admin) {
        echo $article->toBuy("book");
    }
}