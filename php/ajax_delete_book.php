<?php

$statusCode = 404;


if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "Error! You aren't authorised to be here!";
}

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    include "connection.php";

    $authorId  = $konekcija->query("SELECT author_id FROM book b WHERE b.id = $id ")->fetch();
    $upitDeleteAuthor = $konekcija->prepare("DELETE FROM author WHERE id = :id");
    $upitDeleteAuthor->bindParam(":id",$authorId->author_id);

    try {
        $rezultat1 = $upitDeleteAuthor->execute();

        if ($rezultat1) {

            $pictureId = $konekcija->query("SELECT picture_id FROM book WHERE id = $id")->fetch();
            $upitDeletePicture = $konekcija->prepare("DELETE FROM pictures WHERE id = :id");
            $upitDeletePicture->bindParam(":id",$pictureId->picture_id);
            try {
                $rezultat2 = $upitDeletePicture->execute();

                if ($rezultat2) {

                    $upitDeleteBook = $konekcija->prepare("DELETE FROM book WHERE id = :id");
                    $upitDeleteBook->bindParam(":id",$id);
                    try {
                        $rezultat = $upitDeleteBook->execute();

                        if ($rezultat) {
                            $statusCode = 204;
                        } else {
                            $statusCode = 500;
                        }
                    } catch (PDOException $e) {
                        $statusCode = 500;
                    }


                } else {
                    $statusCode = 500;
                }
            } catch (PDOException $e) {
                $statusCode = 500;
            }
        } else {
            $statusCode = 500;
        }
    } catch (PDOException $e) {
        $statusCode = 500;
    }



}

// Vracanje statusnog koda ka klijentu (JS)
http_response_code($statusCode);

