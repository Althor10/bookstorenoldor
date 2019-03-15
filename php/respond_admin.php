<?php
session_start();
require_once "connection.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "Error! You are not authorised to be here!!!";
}
if (isset($_POST['btnSubmitMess']))
    unset($_SESSION['error']);

$text = $_POST['tbText'];
$contactEmail = $_POST['adminMail'];
$textSubject = $_POST['tbSubject'];
$errors = [];

$reName = "/\b([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}  
    [a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[ -\']{1}[A-Z]{1}[a-z]{1,30}){2,5}/";


//if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
//    $errors[] = "Email is not valid";
//}

if (count($errors) > 0) {


    $_SESSION['error'] = $errors;
    header("Location: ../index.php?page=admin");
} else {

    require_once "connection.php";

    $upit_unos = $konekcija->prepare("INSERT INTO contact (email,subject,text) VALUES ( :email,:subject,:text)");

    // Zamena "placeholdera" iz upita sa vrednostima

    $upit_unos->bindParam(':email', $contactEmail);
    $upit_unos->bindParam(':subject', $textSubject);
    $upit_unos->bindParam(':text', $text);

    try {

        $rezultat = $upit_unos->execute();
        if ($rezultat) {
            $_SESSION['success']= "You have sent a message!";
            header("Location: ../index.php?page=admin");
        } else {
            $_SESSION['error'][]= "Error while sending message";
            header("Location: ../index.php?page=admin");
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}