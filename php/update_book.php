<?php
session_start();

if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin") {

    if (isset($_POST['btnUnos3']))
        unset($_SESSION['error']);

    $bookId = $_POST['bookid'];
    $title = $_POST['tbTitle'];
    $summary = trim($_POST['tbSummary']);
    $ssummary = trim($_POST['tbSSummary']);
    $price =  $_POST['tbPrice'];
    $authorF = trim($_POST['tbAuthorF']);
    $authorL = $_POST['tbAuthorL'];
    $bio = $_POST['tbBio'];
    $path = $_POST['tbPath'];
    $cat = $_POST['tbCategory'];



    $reImePrezime = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
    $reLozinka = "/^[\S]{5,}$/";
    $rePrice = "/^[0-9]{2,}(\.[0-9]{,2})?$/";


    $errors = [];

    if (!preg_match($reImePrezime, $authorF)) {
        $errors[] = "Author First name is not valid.";
    }

    if (!preg_match($reImePrezime, $authorL)) {
        $errors[] = "Author Last name cant't be written like that";
    }

    if (!preg_match($rePrice, $price)) {
        $errors[] = "Price is not valid.";
    }


    if (count($errors) > 0) {


        $_SESSION['error'] = $errors;
        header("Location: ../index.php?page=bookedit&id=$bookId");
    } else {


        require_once "connection.php";
        $upit_unos = $konekcija->prepare("UPDATE pictures SET path = :path, alt = :booktitle WHERE id = (SELECT picture_id FROM book WHERE id = :bookid) ");

        $upit_unos->bindParam(':path', $path);
        $upit_unos->bindParam(':booktitle', $title);
        $upit_unos->bindParam(':bookid', $bookId);


        try {

            $rezultat = $upit_unos->execute();

            if ($rezultat) {
                $upit_unos2 = $konekcija->prepare("UPDATE author SET author_firstname = :firstnam, author_lastname = :lastname, bio = :bio  WHERE id = (SELECT author_id FROM book WHERE id = :bookid) ");

                $upit_unos2->bindParam(':firstnam', $authorF);
                $upit_unos2->bindParam(':lastname', $authorL);
                $upit_unos2->bindParam(':bio',$bio);
                $upit_unos2->bindParam(':bookid', $bookId);

                try {
                    $rez2 = $upit_unos2->execute();

                    if($rez2){
                        $upit_unos3 = $konekcija->prepare("UPDATE book SET  title = :title, author_id = (SELECT id FROM author WHERE author_firstname = :firstname AND author_lastname = :lastname), picture_id = (SELECT id FROM pictures WHERE path = :path), summary = :summary, price = :price, sale = 1,new = 0,cat_id = (SELECT id FROM category WHERE name = :cat),about = :ssummary WHERE id =:bookid ");

                        $upit_unos3->bindParam(':title', $title);
                        $upit_unos3->bindParam(':firstname', $authorF);
                        $upit_unos3->bindParam(':lastname', $authorL);
                        $upit_unos3->bindParam(':path', $path);
                        $upit_unos3->bindParam(':summary', $summary);
                        $upit_unos3->bindParam(':price', $price);
                        $upit_unos3->bindParam(':firstname', $authorF);
                        $upit_unos3->bindParam(':cat', $cat);
                        $upit_unos3->bindParam(':ssummary', $ssummary);
                        $upit_unos3->bindParam(':firstname', $authorF);
                        $upit_unos3->bindParam(':bookid', $bookId);


                        try{
                            $rez3 = $upit_unos3->execute();
                            if ($rez3) {
                                $_SESSION['success'] = "Update was made!";
                                header("Location: ../index.php?page=admin");
                            } else {
                                $_SESSION['error'][] = "Update error!";
                                header("Location: ../index.php?page=edit&id=$korId");
                            }
                        }
                        catch (PDOException $e){
                            echo $e->getMessage();

                        }
                    }
                    else {
                        $_SESSION['error'][] = "Update error!";
                        header("Location: ../index.php?page=edit&id=$bookId");
                    }

                }
                catch (PDOException $e){
                    echo $e->getMessage();
                }
            } else {
                $_SESSION['error'][] = "Update error!";
                header("Location: ../index.php?page=edit&id=$bookId");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}