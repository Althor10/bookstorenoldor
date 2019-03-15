<?php

include "php/connection.php";
session_start();
$page = "";

if(isset($_GET['page'])){
      $page = $_GET['page'];
}
      include "views/head.php";
      include "views/header.php";
      include "views/nav.php";

      switch($page){

          case "shop":
                include "views/shop.php";
                break;
          case "about":
                include "views/about.php";
                break;
          case "contact":
              include "views/contact.php";
              break;
          case "login":
              include "views/login.php";
              break;
          case "checkout":
                include "views/checkout.php";
                break;
          case "register":
              include "views/register.php";
              break;
          case "single":
              include "views/single.php";
              break;
          case "admin":
              include "views/admin.php";
              break;
          case 'edit':
              include "views/edit.php";
              break;
          case 'insertbook':
              include "views/insert_new_book.php";
              break;
          case "bookedit":
              include "views/editbook.php";
              break;
          case "newslide":
              include "views/insert_new_slide.php";
              break;
          case "response":
              include "views/response.php";
              break;
          case "slideedit":
              include "views/editslide.php";
              break;
          case "cart":
              include "views/cart.php";
              break;
          case "shipping":
              include "views/shipping.php";
              break;
          case "survey":
              include "views/survey.php";
              break;
          default:
                include "views/main.php";
                break;
      }

      include "views/footer.php";
?>
