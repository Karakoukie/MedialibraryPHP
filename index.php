<!DOCTYPE html>
<html>
    <head>
        <title>Mediathèque</title>
        <meta charset="UTF-8">
        <link href="styles/Rooster.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php
        session_start();
        require 'importer.php';
        
        include 'views/headerView.php';
        include 'views/mainView.php';
        include 'views/footerView.php';
        ?>
    </body>
</html>
