<?php

session_start();
require("controllers/controller.php");


try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'accueil') {
          //require_once("controllers/controller.php");
          $controller = new Controller;
          $controller->invoke();
            include('views/afterlogin.php');
        }

        elseif ($_GET['action'] == 'fiche') {
        //  require_once("controllers/controller.php");
          $controller = new Controller;
          $controller->invoke();
            include('views/fiche.php');
        }

    }
    else {
    //  require_once("controllers/controller.php");
      $controller = new Controller;
      $controller->invoke();
        include('views/login.php');
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}


?>
