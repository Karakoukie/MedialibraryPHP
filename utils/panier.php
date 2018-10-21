<?php

abstract class Panier {

    public static function addArticle($id, $quantity, $type, $price) {
        $panier = null;
        
        if (isset($_SESSION["panier"])) {
            $panier = $_SESSION["panier"];
        }

        if ($panier == null) {
            $panier = array();
        }
        
        $isTheSame = false;
        
        for($i=0; $i<sizeof($panier); $i++) {
            if ($panier[$i]["id"] == $id) {
                $isTheSame = true;
                $panier[$i]["quantity"] += $quantity;
            }
        }

        if (!$isTheSame) {
            array_push($panier, array("id" => $id, "quantity" => $quantity, "type" => $type, "price" => $price));
        }
        
        $_SESSION["panier"] = $panier;
    }

    public static function removeArticle($offset) {
        $panier = $_SESSION["panier"];
        array_splice($panier, $offset);
        $_SESSION["panier"] = $panier;
    }
    
    public static function validate() {
        $panier = $_SESSION["panier"];
        
        $idUser = null;
        if (isset($_SESSION['connectionUserId'])) {
            $idUser = $_SESSION['connectionUserId'];
        }
        
        $queryComand = "INSERT INTO comands (date_commande, id_user) ";
        $queryComand .= "VALUES (CURRENT_TIMESTAMP, '".$idUser."')";
        $statementComand = dataBaseConnection::execute($queryComand);
        
        if ($statementComand) {
            $queryLastID = "SELECT LAST_INSERT_ID()";
            $statementID = dataBaseConnection::execute($queryLastID);

            if ($statementID) {
                $data = $statementID->FetchAll();
                $comandID = $data[0]["LAST_INSERT_ID()"];
                for($i=0; $i<sizeof($panier); $i++) {
                    $queryComandLine = "INSERT INTO commande_ligne (id_commande, id_media, qtx, prix) ";
                    $queryComandLine .= "VALUES (".$comandID.", '".$panier[$i]["id"]."', '".$panier[$i]["quantity"]."', '".$panier[$i]["price"]."')";
                    dataBaseConnection::execute($queryComandLine);
                }
            }
        }
        
        echo "<section class='panel-white'><p class='info'>Commande validée, vous allez être redirigé</p></section>";
        header("refresh:3");
        
        $somme = self::getTotalPriceTTC();
        $grain = "417795";
        $ident = "41578954";
        $token = hash('sha256', $somme.$grain.$ident);
        echo "<script>window.open('http://188.165.252.100/sio/banq/index.php?somme=".$somme."&ident=".$ident."&token=".$token."&numcb=4012001037141112');</script>";
        
        self::clear();
    }

    public static function clear() {
        $_SESSION["panier"] = null;
    }

    public static function toString() {
        $string = null;
        
        $totalPriceHT = 0;
        $totalPriceTVA = 0;
        $totalPriceTTC = 0;

        $panier = $_SESSION["panier"];
        if ($panier != null) {
            $string = "<article class='panel-white'>";
            $string .= "<table>";
            
            $string .= "<thead>";
            $string .= "<th>Titre</th>";
            $string .= "<th>Type</th>";
            $string .= "<th>Quantité</th>";
            $string .= "<th>Prix HT</th>";
            $string .= "<th>Total prix HT</th>";
            $string .= "<th>Total prix TTC</th>";
            $string .= "</thead>";
            
            for ($i = 0; $i < sizeof($panier); $i++) {
                $string .= "<tr>";
                $string .= "<td><p>" . MediaModel::importTitle($panier[$i]["id"]) . "</p></td>";
                $string .= "<td><p>" . $panier[$i]["type"] . "</p></td>";
                $string .= "<td><p>" . $panier[$i]["quantity"] . "</p></td>";
                $string .= "<td><p>" . $panier[$i]["price"] . "€</p></td>";
                $string .= "<td><p>" . $panier[$i]["price"] * $panier[$i]["quantity"] . "€</p></td>";
                $string .= "<td><p>" . $panier[$i]["quantity"] * ($panier[$i]["price"] + $panier[$i]["price"] * 0.2) . "€</p></td>";
                $string .= "</tr>";
                
                $totalPriceHT += $panier[$i]["quantity"] * $panier[$i]["price"];
                $totalPriceTVA += $panier[$i]["quantity"] * ($panier[$i]["price"] * 0.2);
                $totalPriceTTC += $panier[$i]["quantity"] * ($panier[$i]["price"] + $panier[$i]["price"] * 0.2);
            }
            
            $string .= "</table><section>";
            $string .= "<p>Prix total HT: ". $totalPriceHT ."€</p>";
            $string .= "<p>Montant total de TVA (20%): ". $totalPriceTVA ."€</p>";
            $string .= "<p>Prix total TTC: ". $totalPriceTTC ."€</p>";
            $string .= "</section></article>";
        }

        return $string;
    }
    
    public static function toValidate() {
        $string = null;

        $panier = $_SESSION["panier"];
        if ($panier != null) {
            $string = "<article class='panel-white'>";
            $string .= "<form>";
            $string .= "<input name='panierValidate' type='submit' value='Valider le panier'>";
            $string .= "</form>";
            $string .= "</article>";
        }

        return $string;
    }

    public static function toClear() {
        $string = null;

        $panier = $_SESSION["panier"];
        if ($panier != null) {
            $string = "<article class='panel-white'>";
            $string .= "<form>";
            $string .= "<input name='panierClear' type='submit' value='Vider le panier'>";
            $string .= "</form>";
            $string .= "</article>";
        }

        return $string;
    }
    
    public static function getTotalPriceTTC() {
        $totalPriceTTC = 0;
        
        $panier = $_SESSION["panier"];
        
        if ($panier != null) {
            for ($i = 0; $i < sizeof($panier); $i++) {
                $totalPriceTTC += $panier[$i]["quantity"] * ($panier[$i]["price"] + $panier[$i]["price"] * 0.2);
            }
        }
        
        return $totalPriceTTC;
    }

}
