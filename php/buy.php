<?php

require_once "connection.php";
session_start();
if (isset($_SESSION['korisnik'])) {
    if (isset($_POST['btnBuy'])) {
        $id="";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }

        $quantity = $_POST['tbOption'];


        $korName = $_SESSION['korisnik']->bookaneer_name;
        $insertBookCart = $konekcija->prepare("INSERT INTO cart (book_id,bookaneers_id,day_of_buyout,quantity) VALUES ((SELECT id FROM book WHERE id = :id),(SELECT id FROM bookaneers WHERE bookaneer_name= '$korName' ),:datum,:quan)");

        $datum = date("Y-m-d H:i:s");
        $insertBookCart->bindParam(':id',$id);
        $insertBookCart->bindParam(':quan',$quantity);
        $insertBookCart->bindParam(':datum', $datum);


        try {

            $rez = $insertBookCart->execute();

            if(rez){
                header("Location: ../index.php?page=cart");
            }
            else{
                $_SESSION['error'][]= "Error!!";
                header("Location: ../index.php?page=single&id=$id");
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
//

    }
} else {
    header("Location: ../index.php?page=cart");
}

