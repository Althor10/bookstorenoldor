<?php
session_start();
if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === "admin") {

    if (isset($_POST['btnUnos2']))
        unset($_SESSION['error']);

    $korId = $_POST['korid'];
    $ime = trim($_POST['tbIme2']);
    $prezime = trim($_POST['tbPrezime2']);
    $email = trim($_POST['tbMail2']);
    $lozinka = trim($_POST['tbLozinka2']);
    $adresa = $_POST['tbAdresa2'];


    $reImePrezime = "/^[A-Z][a-z]{2,50}$/";
    $reLozinka = "/^[\S]{5,}$/";
    $reAdresa = "/^[\S]{5,}$";

    $errors = [];

    if (!preg_match($reImePrezime, $ime)) {
        $errors[] = "Name is not valid.";
    }

    if (!preg_match($reImePrezime, $prezime)) {
        $errors[] = "Last name cant't be written like that";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email format is wrong.";
    }

    if (!preg_match($reLozinka, $lozinka)) {
        $errors[] = "Password must be at least 5 letters long.";
    }
    if (!preg_match($reImePrezime, $adresa)) {
        $errors[] = "Address is not valid.";
    }

    if (count($errors) > 0) {


        $_SESSION['error'] = $errors;
        header("Location: ../index.php?page=edit&id=$korId");
    } else {


        $podaciEmail = explode("@", $email);

        $korisnicko_ime = $podaciEmail[0];

        $lozinka = md5($lozinka);

        require_once "connection.php";
        $upit_unos = $konekcija->prepare("UPDATE bookaneers SET first_name = :ime, last_name = :prezime, bookaneer_name = :kor_ime, private_mail = :email, bookaneer_pass = :lozinka, adress = :adresa WHERE id=:korid ");

        $upit_unos->bindParam(':korid', $korId);
        $upit_unos->bindParam(':ime', $ime);
        $upit_unos->bindParam(':prezime', $prezime);
        $upit_unos->bindParam(':kor_ime', $korisnicko_ime);
        $upit_unos->bindParam(':email', $email);

        $upit_unos->bindParam(':lozinka', $lozinka);
        $upit_unos->bindParam(':adresa', $adresa);


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