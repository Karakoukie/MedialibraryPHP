<?php

$queryComand = "SELECT * FROM comands WHERE id_user=" . $_SESSION['connectionUserId'] . " ORDER BY date_commande DESC";
$statementComand = dataBaseConnection::execute($queryComand);

if ($statementComand) {
    $dataComand = $statementComand->FetchAll();
    
    for($i=0; $i<sizeof($dataComand); $i++) {
        $date = $dataComand[$i]["date_commande"];
        
        $queryComandLine = "SELECT * FROM commande_ligne WHERE id_commande=".$dataComand[$i]["id_commande"];
        $statementComandLine = dataBaseConnection::execute($queryComandLine);
        
        $comandLines = array();
        
        if ($statementComandLine) {
            $dataComandLine = $statementComandLine->FetchAll();
            
            for($y=0; $y<sizeof($dataComandLine); $y++) {
                $comandLineId = $dataComandLine[$y]["id_commande"];
                $comandLineMedia = $dataComandLine[$y]["id_media"];
                $comandLineQuantity = $dataComandLine[$y]["qtx"];
                $comandLinePrice = $dataComandLine[$y]["prix"];
                $comandLine = new ComandLine($comandLineId, $comandLineMedia, $comandLineQuantity, $comandLinePrice);
                
                array_push($comandLines, $comandLine);
            }
        }
        
        $comand = new Comand($dataComand[$i]["id_commande"], $date, $comandLines);
        echo $comand->toShow();
    }
}