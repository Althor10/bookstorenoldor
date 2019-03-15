<?php
session_start();
if (isset($_POST['submit'])) {
unset($_SESSION['greske']);

    $email = $_POST['email'];
    $lozinka = $_POST['password'];

    $errors = [];
    $reLozinka = "/^[\S]{5,}$/";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is wrong";
    }

    if (!preg_match($reLozinka, $lozinka)) {
        $errors[] = "Password or e-mail is wrong.";
    }

    if (count($errors) > 0) {
        $_SESSION['greske'] = $errors;
        header("Location: ../index.php?page=login");
    } else {
        require_once "connection.php";
        $lozinka = md5($lozinka);

        $query = "SELECT private_mail,bookaneer_pass,u.type,bookaneer_name FROM bookaneers b INNER JOIN bookaneerroles u ON b.role_id=u.id WHERE activity=1 
                  AND b.private_mail = :email AND b.bookaneer_pass = :password";


        $stmt = $konekcija->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $lozinka);

        $stmt->execute();
        $user = $stmt->fetch(); // Dohvatanje samo jednog korisnika
        if ($user) {
            $_SESSION['korisnik'] =  $user; //Pravljenje sesije koja kao sadrzaj ima rezultat rada baze podataka
            header("Location: ../index.php?page=shop");

        } else {
            $errors[] = "Wrong e-mail or password";
            $_SESSION['greske'] = $errors;
            header("Location: ../index.php?page=login");
        }
    }
}