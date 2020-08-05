<?php
/*
require 'include/connect.php';

session_start();


if(isset($_GET['id']))
{
    $getid = strval($_GET['id']);
    //UserInfo du modele
    if(isset($_POST['watchfrais']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: fiche.php?id=".$_GET['id']);
    }

    if(isset($_POST['modif']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: user.php?id=".$_GET['id']);
    }

    if(isset($_POST['addfiche']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: nfiche.php?id=".$_GET['id']);
    }

    if(isset($_POST['editfiche']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: editfiche.php?id=".$_GET['id']);
    }

    if(isset($_POST['logout']))
    {
      session_start();
      session_destroy();

      header('location: log.php');
    }

}
*/
?>

<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GSB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="src/style.css">
  </head>

<body>

<?php if(isset($_GET['id']))
{  ?>
  <div align="center"style="font-size: 15px;">
   <?php
   if(isset($_GET['id']) != 0) {
   ?>
   <!-- NAV -->
   <form method="post" name="home">
     <button  name="home" class="btnMenu"><img src="src/home.png" height="18" width="18"/></button> <!-- Redirige vers l'accueil -->
     <button name="watchfrais" class="btnMenu"><img src="src/view.png" height="18" width="18"/></button> <!-- Redirige vers la liste des fiches -->
     <button name="addfiche" class="btnMenu"><img src="src/add.png" height="18" width="18"/></button> <!-- Redirige pour ajouter une fiche -->
     <?php
        if ($userinfo['idRole'] != 0) { // Seul les utilisateur qui ne sont pas Visiteur peuvent voir ce boutton
     ?>
     <button name="editfiche" class="btnMenu"><img src="src/valid.png" height="18" width="18"/></button> <!-- Redirige pour consulter les fiches (etats, etc) -->
     <?php } ?>
     <button name="logout" class="btnMenu"><img src="src/off.png" height="18" width="18"/></button>
   </form>
</br>


   <!-- NAV -->
<div class="info">
  <form method="post">
   <h2>Profil de <?php echo $userinfo['nom']; ?> <?php echo $userinfo['prenom'];?> </h2>
   <br />
   <h3>Détails </h3>
   <div class="contenu">
   <b>Nom </b>= <?php echo $userinfo['nom']; ?>
   <br />
   <b>Prenom</b> = <?php echo $userinfo['prenom']; ?>
   <br />
   <b>Rang</b> = <?php echo $userinfo['Role']; ?>
   <br />
   <b>Adresse</b> = <?php echo $userinfo['adresse']; ?>
   <br />
   <b>Code Postal</b> = <?php echo $userinfo['cp']; ?>
   <br />
   <b>Ville</b> = <?php echo $userinfo['ville']; ?>
   <br />
   <b>date d'embauche</b> = <?php echo $userinfo['dateEmbauche']; ?>
   <br />
 </div>
 <br />
 <button name="modif" class="btnInfo">Modifier mes informations </button>
</form>
 </div>
   <?php
   }
 }/*
 elseif (!isset($_SESSION['id'])) {
   header("location: log.php");
 }*/
   ?>
</div>

  </body>
</html>
