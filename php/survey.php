<?php
session_start();
require_once "connection.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "Error! You are not authorised to be here!!!";
}
if (isset($_POST['btnUnos'])){
    unset($_SESSION['error']);

$contactName = $_POST['tbIme'];
$novels = $_POST['novels'];
$answer = $_POST['answer'];
$errors = [];

$reName = "/\b([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}  
    [a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[ -\']{1}[A-Z]{1}[a-z]{1,30}){2,5}/";


if (!preg_match($reName, $contactName)) {
    $errors[] = "Wrong type for name.";
}
if($novels == 0 || $novels == null){
    $errors[] = "Must choose a category";
}
if(!preg_match($reAnswer,$answer)){

}

if (count($errors) > 0) {


    $_SESSION['error'] = $errors;
    header("Location: ../index.php?page=survey");
} else {

    require_once "connection.php";

    $upit_unos = $konekcija->prepare("INSERT INTO survey (name,novelType,answer) VALUES ( :name,:novel,:answer)");

    // Zamena "placeholdera" iz upita sa vrednostima

    $upit_unos->bindParam(':name', $contactName);
    $upit_unos->bindParam(':novel', $novels);
    $upit_unos->bindParam(':answer', $answer);
    try {

        $rezultat = $upit_unos->execute();
        if ($rezultat) {
            $_SESSION['success']= "You have sent a message!";
            header("Location: ../index.php?page=main");
        } else {
            $_SESSION['error'][]= "Error while sending message";
            header("Location: ../index.php?page=survey");
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}}