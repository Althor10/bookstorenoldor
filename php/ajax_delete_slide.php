<?php

$statusCode = 404;


if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "Error! You are not authorised to be here!!!";
}

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    include "connection.php";

    $upit = $konekcija->prepare("DELETE FROM pictures_slide WHERE id = (SELECT picture_id FROM slider s WHERE s.id = :id)");
    $upit->bindParam(':id', $id);

    try {
        $rezultat = $upit->execute();

        if ($rezultat) {
            $upit2 = $konekcija->prepare("DELETE FROM slider WHERE id = :id");
            $upit2->bindParam(':id', $id);

            try {
                $rezultat2 = $upit->execute();
                if($rezultat2){
                    $statusCode = 200;
                }
                else{
                    $statusCode = 500;
                }
            }
           catch (PDOException $e) {
                $statusCode = 500;
            }
        }
        else {
            $statusCode = 500;
        }
    } catch (PDOException $e) {
        $statusCode = 500;
    }
}

// Vracanje statusnog koda ka klijentu (JS)
http_response_code($statusCode);

