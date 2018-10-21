<?php

$loginSearch = null;

if (isset($_REQUEST["loginSearch"])) {
    $loginSearch = $_REQUEST["loginSearch"];
}

$query = "SELECT * FROM users";

if ($loginSearch) {
    $query .= " WHERE login LIKE '%" . $loginSearch . "%'";
}

$statement = dataBaseConnection::execute($query);
$dataComand = $statement->FetchAll();

for ($i=0; $i<sizeof($dataComand); $i++) {
    $id = $dataComand[$i]["id"];
    $login = $dataComand[$i]["login"];
    $password = $dataComand[$i]["password"];
    $admin = $dataComand[$i]["status"];
    $user = new UserModel($id, $login, $password, $admin);
    echo $user->toString();
}