<?php

$statusCode = 404;

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "Error! You are not authorised to be here!!!";
}

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    include "connection.php";

    $upit = $konekcija->prepare("DELETE FROM bookaneers WHERE id = :id");
    $upit->bindParam(':id', $id);

    try {
        $rezultat = $upit->execute();

        if ($rezultat) {
            $statusCode = 204;
        } else {
            $statusCode = 500;
        }
    } catch (PDOException $e) {
        $statusCode = 500;
    }
}

// Vracanje statusnog koda ka klijentu (JS)
http_response_code($statusCode);

