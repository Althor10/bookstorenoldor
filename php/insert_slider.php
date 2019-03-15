<?php
session_start();
require_once "connection.php";
if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === 'admin') {
    if (isset($_POST['btnInsertSlider']))
        unset($_SESSION['error']);

    $slideText = $_POST['tbSlideText'];
    $slidePath = $_POST['tbSPath'];
    $slika = $_FILES['fSlika'];

//
$reSlideText = "/[A-Za-z\s?]+/";
//$reUrl = "/[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/";
//
    $errors = [];


    $ime_fajla = $slika['name'];
    $tip_fajla = $slika['type'];
    $velicina_fajla = $slika['size'];
    $tmp_putanja = $slika['tmp_name'];
    $dozvoljeni_formati = array("image/jpg", "image/jpeg", "image/png", "image/gif");
    if($velicina_fajla > 3000000){
        $errors[] = "File must be less than 3MB.";
    }
//
if (!preg_match($reSlideText, $slideText)) {
    $errors[] = "Wrong text entered for Slide Text.";
}
//
if ($slidePath == null || $slidePath == "") {
    $errors[] = "Wrong path type.";
}

    if (count($errors) > 0) {


        $_SESSION['error'] = $errors;
        header("Location: ../index.php?page=newslide");
    } else {


        $naziv_fajla = time().$ime_fajla;
        $nova_putanja = "../images/".$naziv_fajla;
        $putanja_fajla ="images/".$naziv_fajla;


        if(move_uploaded_file($tmp_putanja, $nova_putanja)){



            $unos_slika = 'INSERT INTO pictures_slide (alt,path) VALUES(:alt, :putanja)';

            $priprema_slika = $konekcija->prepare($unos_slika);

            $priprema_slika->bindParam(":alt", $slideText);
            $priprema_slika->bindParam(":putanja", $putanja_fajla);

            try{
                $rez_unos = $priprema_slika->execute();
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
            }

        } else {
            echo "File failed to move!";
        }


        require_once "connection.php";
        $upit_unos2 = $konekcija->prepare("INSERT INTO slider (text, picture_id, a_path) VALUES (:texta,( SELECT ps.id FROM pictures_slide ps WHERE ps.path = :putanja ), :apath)");


        $upit_unos2->bindParam(':texta', $slideText);
        $upit_unos2->bindParam(':putanja', $putanja_fajla);
        $upit_unos2->bindParam(':apath', $slidePath);
        var_dump($upit_unos2);

        try {
            $rezultat2 = $upit_unos2->execute();

            if ($rezultat2) {
                $_SESSION['success'] = "You have inserted a new slide";
                header("Location: ../index.php?page=admin");
            } else {
                $_SESSION['error'][] = "Error!!!";
                header("Location: ../index.php?page=newslide");
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }
} else {
    echo "You dont have the Authorization !!!";
}