<?php

require 'include/connect.php';

session_start();


if(isset($_GET['id']))
{
    $getid = strval($_GET['id']);
    $req = $conn->prepare("SELECT * FROM visiteur WHERE id = ?");
    $req->execute(array($getid));
    $userinfo = $req->fetch();
    $role = $userinfo['idRole'];

    if(isset($_POST['home']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: home.php?id=".$_GET['id']);
    }

    if(isset($_POST['watchfrais']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: fiche.php?id=".$_GET['id']);
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

    elseif(isset($_POST['logout']))
    {
      session_start();
      session_destroy();

      header('location: log.php');
    }

}

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

  <style>
  table { border-collapse: separate; background-color: #FFFFFF; border-spacing: 0; width: 50%; color: #666666; text-shadow: 0 1px 0 #FFFFFF; border: 2px solid #CCCCCC; box-shadow: 0; margin: 0 auto; }
  table thead tr th { background: none repeat scroll 0 0 #EEEEEE; color: #222222; padding: 10px 14px; text-align: left; border-top: 0 none; font-size: 14px; }
  table tbody tr td{
      background-color: #FFFFFF;
  	font-size: 14px;
      text-align: left;

  	border-top: 1px solid #DDDDDD;
  }

  </style>

<body>

<center>

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
</br>
   <!-- NAV -->
<div class="infoNfiche2">
  <h1>Consulter les fiches</h1>
   <form method="post" name="getmois">
   </br>
      <input list="mois" name="mois" placeholder="choisir un mois">
      <datalist id="mois">
        <option value="01">
        <option value="02">
        <option value="03">
        <option value="04">
        <option value="05">
        <option value="06">
        <option value="07">
        <option value="08">
        <option value="09">
        <option value="10">
        <option value="11">
        <option value="12">
      </datalist>
      <input type="submit" name="subm" value="Choisir un mois" class="btnInfo">
    </form>
</br>
   <!-- FICHE FORFAIT -->
  <h3>Fiche Forfait</h3>
</br>
  <div align="center">
    <table cellspacing="0" cellpadding="2" id="sample">
    <thead >
     <tr>
       <th> repas </th>
       <th> nuit </th>
        <th> etape </th>
        <th> km </th>
        <?php
        if($role != 0)
         {
          echo "<th> id comptable</th>";
        }
        ?>
    </thead>
   <?php
   if(isset($_POST['subm']))
   {
     $getmois = $_POST['mois'];
    if(isset($_GET['id']) != 0)
   {
     $req2 = $conn->prepare("SELECT * FROM ficheforfait  WHERE  idVisiteur = ? AND MONTH(date) = ?");

     $req2->BindParam(1,$getid);
     $req2->BindParam(2,$getmois);
     $req2->execute();

     $req3 = $conn->prepare("SELECT * FROM ficheforfait WHERE MONTH(date) = ?");
     $req3->BindParam(1,$getmois);
     $req3->execute();
     ?>

     <tbody>
     <?php
     if($role == 0)
     {

       for($i=0; $finfo = $req2->fetch(); $i++ ){

       ?>
     <tr>
      <td><?php echo $finfo['repas']; ?></td>
      <td><?php echo $finfo['nuit']; ?></td>
       <td><?php echo $finfo['etape']; ?></td>
       <td><?php echo $finfo['km']; ?></td>
    </tr>

         <?php

           }
     }
     else {
       for($i=0; $root = $req3->fetch(); $i++){
         ?>
       </br>
         <tr>
      <td><?php echo $root['repas']; ?></td>
      <td><?php echo $root['nuit']; ?></td>
       <td><?php echo $root['etape']; ?></td>
       <td><?php echo $root['km']; ?></td>
       <td><?php echo $root['idVisiteur']; ?></td>
        </tr>

     <?php
       }
     }
   }
     ?>
   </tbody>
   </table>
   <?php
   }
   ?>
   <!-- FICHE FORFAIT -->
</br>
   <!-- FICHE HORS FORFAIT -->
   <h3>Fiche Hors Forfait</h3>
        </br>
     <table cellspacing="0" cellpadding="5" id="sample">
     <thead >
      <tr>
         <th> Date </th>
        <th> libelle </th>
        <th> montant </th>
        <?php
        if($role != 0)
         {
          echo "<th> id comptable</th>";
        }
        ?>
     </thead>

     <tbody>
    <?php
   if(isset($_POST['subm']))
   {
     $getmois = $_POST['mois'];
    if(isset($_GET['id']) != 0)
   {
     $req2 = $conn->prepare("SELECT * FROM fichehorsforfait  WHERE  idVisiteur = ? AND MONTH(date) = ?");

     $req2->BindParam(1,$getid);
     $req2->BindParam(2,$getmois);
     $req2->execute();

     $req3 = $conn->prepare("SELECT * FROM fichehorsforfait WHERE MONTH(date) = ?");
     $req3->BindParam(1,$getmois);
     $req3->execute();
     ?>

     <?php
     if($role == 0)
     {

       for($i=0; $finfo = $req2->fetch(); $i++ ){

       ?>
     <tr>
      <td><?php echo $finfo['date']; ?></td>
      <td><?php echo $finfo['libelle']; ?></td>
      <td><?php echo $finfo['montant']; ?></td>
    </tr>

         <?php

           }
     }
     else {
       for($i=0; $root = $req3->fetch(); $i++){
         ?>
         <tr>
      <td><?php echo $root['date']; ?></td>
      <td><?php echo $root['libelle']; ?></td>
      <td><?php echo $root['montant']; ?></td>
      <td><?php echo $root['idVisiteur']; ?></td>
        </tr>
     <?php
       }
     }
   }
     ?>
   </tbody>
   </table>
   </br>
      <!-- FICHE HORS FORFAIT -->
    </div>
   <?php
   }
 }
  elseif (!isset($_SESSION['id'])) {
     header("location: log.php");
 }
   ?>
</div>
</center>
  </body>
</html>
