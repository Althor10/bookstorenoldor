<?php

require_once "connection.php";
session_start();
if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === 'admin'){
if(isset($_POST['btnInsert'])){
    unset($_SESSION['errors']);

    $authorFirstname = trim($_POST['tbAuthorF']);
    $authorLastname = trim($_POST['tbAuthorL']);
    $authorBio = htmlspecialchars($_POST['tbBio']);
    $bookTitle = $_POST['tbTitle'];
    $bookSummary = htmlspecialchars($_POST['tbSummary']);
    $bookSSummary = htmlspecialchars($_POST['tbSSummary']);
    $slika = $_FILES['movePic'];
    $bookCategory = trim($_POST['tbCat']);
    $bookPrice =  $_POST['tbPrice'];


    $reImePrezime = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
    $reBio = "/^[\S]{5,}$/";
    $rePath = "/^[\S]{5,}$/";
    $rePrice = "/^[0-9]{2,}(\.[0-9]{,2})?$/";
    $reTitle = "/^[\w\s]{1,255}$/";

    $errors = [];

    if (!preg_match($reImePrezime, $authorFirstname)) {
        $errors[] = "Wrong type for name.";
    }
    if (!preg_match($reTitle, $bookTitle)) {
        $errors[] = "Title is wrong.";
    }

    if (!preg_match($reImePrezime, $authorLastname)) {
        $errors[] = "Last name wont go.";
    }

    $ime_fajla = $slika['name'];
    $tip_fajla = $slika['type'];
    $velicina_fajla = $slika['size'];
    $tmp_putanja = $slika['tmp_name'];

    $dozvoljeni_formati = array("image/jpg", "image/jpeg", "image/png", "image/gif");

//    if(!in_array($tip_fajla, $dozvoljeni_formati)){
//        $errors[] = "Wrong Type of file.";
//    }

    if($velicina_fajla > 3000000){
        $errors[] = "File must be less than 3MB.";
    }


    if (count($errors) > 0) {


        $_SESSION['error']= $errors;
        header("Location: ../index.php?page=insertbook");
    }

    else {

    $insertQueryAuthor = $konekcija->prepare("INSERT INTO author (author_firstname,author_lastname,bio) VALUES (:authorname, :authorlasntame,:bio)");

    $insertQueryAuthor->bindParam(':authorname',$authorFirstname );
    $insertQueryAuthor->bindParam(':authorlasntame',$authorLastname);
    $insertQueryAuthor->bindParam(':bio',$authorBio );



    try {

        $rez = $insertQueryAuthor->execute();


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }



            $naziv_fajla = time().$ime_fajla;
            $nova_putanja = "../images/books/".$naziv_fajla;
            $putanja_fajla ="images/books/".$naziv_fajla;


            if(move_uploaded_file($tmp_putanja, $nova_putanja)){



                $unos_slika = 'INSERT INTO pictures (alt,thumbnail,path) VALUES(:alt, :mala, :putanja)';

                $priprema_slika = $konekcija->prepare($unos_slika);

                $priprema_slika->bindParam(":alt", $bookTitle);
                $priprema_slika->bindParam(":mala", $putanja_fajla);
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

    $insertQueryBooks = $konekcija->prepare("INSERT INTO book (title,author_id,picture_id,summary,price,sale,new,cat_id,about) VALUES (:title,(SELECT id FROM author WHERE author_firstname = :authorfirst AND author_lastname = :authorlast),(SELECT id FROM pictures WHERE path = :putanja),:summary,:price,0,1,(SELECT id FROM category WHERE name = :cat),:ssummary)");
    $insertQueryBooks->bindParam(':title',$bookTitle);
    $insertQueryBooks->bindParam(':authorfirst',$authorFirstname);
    $insertQueryBooks->bindParam(':authorlast',$authorLastname);
    $insertQueryBooks->bindParam(':putanja',$putanja_fajla);
    $insertQueryBooks->bindParam(':summary',$bookSummary);
    $insertQueryBooks->bindParam(':price',$bookPrice);
    $insertQueryBooks->bindParam(':cat',$bookCategory);
    $insertQueryBooks->bindParam(':ssummary',$bookSSummary);


    try {

        $rez3 = $insertQueryBooks->execute();
        if ($rez3) {
            $_SESSION['success']= "Uspesno ste ubacili novu knjigu!!";
            header("Location: ../index.php?page=admin");
        } else {
            $_SESSION['error'][]= "Greska pri regisrtraciji";
            header("Location: ../index.php?page=insertbook");
        }

    }
    catch(PDOException $exs){
        echo $exs->getMessage();
    }
}
}
}else {
    echo "YOU ARE NOT AUTHORISED TO ENTER THIS PAGE";
}

