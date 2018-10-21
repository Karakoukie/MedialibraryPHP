<?php

$updateArticleId = null;
$updateArticleTitle = null;
$updateArticleYear = null;
$updateArticlePrice = null;
$updateArticleStock = null;
$updateArticleImage = null;
$updateArticleDuration = null;
$updateArticleFormat = null;
$updateArticleEditor = null;
$updateArticleSupport = null;

if (isset($_REQUEST["crudArticleId"])) {
    $updateArticleId = $_REQUEST["crudArticleId"];
}
if (isset($_REQUEST["crudArticleTitle"])) {
    $updateArticleTitle = $_REQUEST["crudArticleTitle"];
}
if (isset($_REQUEST["crudArticleYear"])) {
    $updateArticleYear = $_REQUEST["crudArticleYear"];
}
if (isset($_REQUEST["crudArticlePrice"])) {
    $updateArticlePrice = $_REQUEST["crudArticlePrice"];
}
if (isset($_REQUEST["crudArticleStock"])) {
    $updateArticleStock = $_REQUEST["crudArticleStock"];
}
if (isset($_REQUEST["crudArticleImage"])) {
    $updateArticleImage = $_REQUEST["crudArticleImage"];
}
if (isset($_REQUEST["crudArticleDuration"])) {
    $updateArticleDuration = $_REQUEST["crudArticleDuration"];
}
if (isset($_REQUEST["crudArticleFormat"])) {
    $updateArticleFormat = $_REQUEST["crudArticleFormat"];
}
if (isset($_REQUEST["crudArticleRealisateur"])) {
    $updateArticleEditor = $_REQUEST["crudArticleRealisateur"];
}
if (isset($_REQUEST["crudArticleSupport"])) {
    $updateArticleSupport = $_REQUEST["crudArticleSupport"];
}

if ($updateArticleId != null && $updateArticleTitle != null 
        && $updateArticleYear != null && $updateArticlePrice != null 
        && $updateArticleStock != null && $updateArticleImage != null 
        && $updateArticleDuration != null && $updateArticleFormat != null 
        && $updateArticleEditor != null && $updateArticleSupport != null) {
    
    $article = new MovieArticleModel($updateArticleId, $updateArticleStock, 
            $updateArticlePrice, $updateArticleTitle, $updateArticleYear, null, 
            $updateArticleImage, $updateArticleDuration, $updateArticleSupport, 
            $updateArticleFormat, $updateArticleEditor, null);

    $statement = $article->update();

    if ($statement) {
        echo '<section class="panel-white">';
        echo '<p class="info">Modifications réussies avec succès.</p>';
        echo '</section>';
    } else {
        echo '<section class="panel-white">';
        echo '<p class="error">Modification impossible</p>';
        echo '</section>';
    }
}
else {
    $articles = MovieArticleModel::search(null, null, null, null);
    
    foreach ($articles as $article) {
        echo $article->toModify();
    }
}