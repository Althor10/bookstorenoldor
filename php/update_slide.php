<?php
session_start();
if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin") {

    if (isset($_POST['btnUnos2']))
        unset($_SESSION['error']);

    $slideId = $_POST['sid'];
    $slideText = $_POST['tbText'];
    $slideATag = $_POST['tbAHref'];
    $imgTag = $_POST['tbImg'];



    $errors = [];

    if (count($errors) > 0) {


        $_SESSION['error'] = $errors;
        header("Location: ../index.php?page=edit&id=$korId");
    } else {

        require_once "connection.php";
        $upit_unos = $konekcija->prepare("UPDATE slider SET  text= :text, picture_id = (SELECT id FROM pictures_slide WHERE path = :img),a_path = :apath WHERE id=:sid ");

        $upit_unos->bindParam(':text', $slideText);
        $upit_unos->bindParam(':img', $imgTag);
        $upit_unos->bindParam(':apath', $slideATag);
        $upit_unos->bindParam(':sid', $slideId);



        try {

            $rezultat = $upit_unos->execute();

            if ($rezultat) {
                $_SESSION['success'] = "Update was made!";
                header("Location: ../index.php?page=admin");
            } else {
                $_SESSION['error'][] = "Update error!";
                header("Location: ../index.php?page=edit&id=$korId");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}