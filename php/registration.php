<?php
session_start();
if (isset($_POST['btnUnos']))
    unset($_SESSION['error']);


    $ime = trim($_POST['tbIme']);
    $prezime = trim($_POST['tbPrezime']);
    $email = trim($_POST['tbEmail']);
    $lozinka = trim($_POST['tbLozinka']);
    $adresa = $_POST['tbAdresa'];

# Validacija podataka

    $reImePrezime = "/^[A-Z][a-z]{2,50}$/";
    $reLozinka = "/^[\S]{5,}$/";

    $errors = [];

    if (!preg_match($reImePrezime, $ime)) {
        $errors[] = "Wrong type for name.";
    }

    if (!preg_match($reImePrezime, $prezime)) {
        $errors[] = "Last name wont go.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    }

    if (!preg_match($reLozinka, $lozinka)) {
        $errors[] = "Password must be at least 5 letters long.";
    }
    if (!preg_match($reImePrezime, $adresa)) {
        $errors[] = "Adress is not valid.";
    }

    if (count($errors) > 0) {


            $_SESSION['error']= $errors;
        header("Location: ../index.php?page=register");
    } else {

        # Generisanje korisnickog imena od email adrese korisnika

        $podaciEmail = explode("@", $email);

        $korisnicko_ime = $podaciEmail[0];

        $lozinka = md5($lozinka);

    require_once "connection.php";

        $upit_unos = $konekcija->prepare("INSERT INTO bookaneers VALUES ('', :ime, :prezime,:kor_ime, :email,  :lozinka, :datum,'', '', :adresa)");

        // Zamena "placeholdera" iz upita sa vrednostima

        $upit_unos->bindParam(':ime', $ime);
        $upit_unos->bindParam(':prezime', $prezime);
        $upit_unos->bindParam(':email', $email);
        $upit_unos->bindParam(':kor_ime', $korisnicko_ime);
        $upit_unos->bindParam(':lozinka', $lozinka);
        $upit_unos->bindParam(':adresa', $adresa);

        $datum = date("Y-m-d H:i:s");

        $upit_unos->bindParam(':datum', $datum);

        try {
            // izvrsavanje upita

            $rezultat = $upit_unos->execute();

            if ($rezultat) {
                $_SESSION['success']= "You have Registered succsessfuly!";
                header("Location: ../index.php?page=login");
            } else {
                $_SESSION['error'][]= "Error!!";
                header("Location: ../index.php?page=register");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

}