<?php
    require_once "config.php";

    try{
        $konekcija = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DBNAME.";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

        $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }

    function executeQuery($upit){
        global $konekcija;

            $rezultat = $konekcija->query($upit)->fetchAll();

            return $rezultat;
    }