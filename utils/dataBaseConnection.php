<?php

class dataBaseConnection {

    private static $pdo = null;
    private static $host = "mysql:host=localhost";
    private static $dataBaseName = "dbname=medialibraryphp";
    private static $user = "root";
    private static $password = "";

    public static function setHost($host) {
        self::$host = $host;
    }

    public static function setDataBaseName($dataBaseName) {
        self::$dataBaseName = $dataBaseName;
    }
    
    static function setUser($user) {
        self::$user = $user;
    }

    static function setPassword($password) {
        self::$password = $password;
    }
    
    public static function getPdo() {
        $pdo = null;
        
        if (!self::$pdo) {
            $host = self::$host;
            $dataBase = self::$dataBaseName;
            $user = self::$user;
            $password = self::$password;

            try {
                self::$pdo = new PDO($host . ';' . $dataBase, $user, $password, null);
                self::$pdo->query("SET CHARACTER SET utf8");
            }
            catch (Exception $ex) {
                print_r("Error: " . $ex->getMessage());
            }
        }
        
        $pdo = self::$pdo;
        return $pdo;
    }
    
    public static function getLastId() {
        $lastId = "";
        
        try {
            $pdo = self::getPdo();
            
            if ($pdo) {
                $lastId = $pdo->lastInsertId();
            }
        }
        catch (Exception $ex) {
            print_r("Error: " . $ex->getMessage());
        }
        
        return $lastId;
    }
    
    public static function execute($query) {
        $statement = null;

        try {
            $pdo = self::getPdo();
            
            if ($pdo) {
                $statement = $pdo->query($query);
            }
        }
        catch (Exception $ex) {
            print_r("Error: " . $ex->getMessage());
        }
        
        return $statement;
    }

}