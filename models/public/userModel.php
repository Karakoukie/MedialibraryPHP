<?php

class UserModel extends Model {

    private $login;
    private $password;
    private $admin;

    public function __construct($id, $login, $password, $admin) {
        parent::__construct($id);

        $this->login = $login;
        $this->password = $password;
        $this->password = $password;
        $this->admin = $admin;
    }

    public function toString() {
        $string = "<article class='layout-center'>";

        $string .= "<p class='panel col-1'>Id: " . $this->id . "</p>";
        $string .= "<p class='panel col-4'>Login: " . $this->login . "</p>";
        $string .= "<p class='panel col-4'>Password: " . $this->password . "</p>";
        $string .= "<p class='panel col-1'>Statut: " . ($this->admin == 0 ? "Client" : "Admin") . "</p>";

        $string .= "</article>";
        return $string;
    }

    public function delete() {
        
    }

    public function insert() {
        $password = hash("sha256", $this->password);
        
        $admin = 0;
        
        if ($this->admin) {
            $admin = 1;
        }
        
        $query = "INSERT INTO users (login, password, status) VALUES ";
        $query .= "('" . $this->login . "', '" . $password . "', " . $admin .")";

        echo $query;
        
        $statement = dataBaseConnection::execute($query);
        return $statement;
    }

    public function toCreate() {
        
    }

    public function toDelete() {
        
    }
    
    public function search() {
        $query = "SELECT * FROM users";
        $query .= " WHERE login='" . $this->login ."'";
        $query .= " AND password='" . hash("sha256", $this->password) ."'";

        $statement = dataBaseConnection::execute($query);
        return $statement;
    }

    public function toModify() {
        $string = "<article class='layout panel-white'>";

        $string .= "<form>";
        $string .= "<fieldset><legend>Modifier le compte</legend>";
        $string .= "Login: <input name='compteLogin' value='" . $this->login . "'>";
        $string .= "Password: <input name='comptePassword'>";
        $string .= "</fieldset>";
        $string .= "<input type='submit' value='Accepter les modifications'>";
        $string .= "</form>";

        $string .= "</article>";
        return $string;
    }

    public function toShow() {
        $string = "<article class='layout-center'>";

        $string .= "<p class='panel col-1'>Id: " . $this->id . "</p>";
        $string .= "<p class='panel col-4'>Login: " . $this->login . "</p>";
        $string .= "<p class='panel col-4'>Password: " . $this->password . "</p>";
        $string .= "<p class='panel col-1'>Statut: " . ($this->admin == 0 ? "Client" : "Admin") . "</p>";

        $string .= "</article>";
        return $string;
    }

    public function update() {
        
    }
    
}