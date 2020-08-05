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
   <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <style>
  table { border-collapse: separate; background-color: #FFFFFF; border-spacing: 0; width: 50%; color: #666666; text-shadow: 0 1px 0 #FFFFFF; border: 2px solid #CCCCCC; box-shadow: 0; margin: 0 auto; }
  table thead tr th { background: none repeat scroll 0 0 #EEEEEE; color: #222222; padding: 10px 14px; text-align: left; border-top: 0 none; font-size: 12px; }
  table tbody tr td{
      background-color: #FFFFFF;
    font-size: 10px;
      text-align: center;

    border-top: 1px solid #DDDDDD;
  }
</style>

<body style="background-color:#87CEEB;">

<center>

<?php
   if(isset($_GET['id']) != 0) {
   ?>
   <!-- NAV -->

   <form method="post" name="home">
     <button  name="home">Accueil</button> <!-- Redirige vers l'accueil -->
     <button name="watchfrais">Voir Fiche</button> <!-- Redirige vers la liste des fiches -->
     <button name="addfiche">Ajouter Fiche</button> <!-- Redirige pour ajouter une fiche -->
     <?php
        if ($userinfo['idRole'] != 0) { // Seul les utilisateur qui ne sont pas Visiteur peuvent voir ce boutton
     ?>
     <button name="editfiche">Validation Fiche</button> <!-- Redirige pour consulter les fiches (etats, etc) -->
     <?php } ?>
     <button name="logout">Déconection</button>
   </form>

   <!-- NAV -->
<br>
   <form method="post" name="getmois">
      <input type="text" name="visiteur" placeholder="choisir un visiteur">
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
      <input type="submit" name="getmois">
    </form>

<br>
   <!-- Test -->

   <table cellspacing="0" cellpadding="2" id="sample" >
   <thead>
    <tr>
      <th> Fiche n° </th>
      <th> Dte </th>
      <th> repas </th>
      <th> nuit </th>
       <th> etape </th>
       <th> km </th>
       <th> Etat </th>
       <th> Visiteur n° </th>
       <th> Action </th>
    </tr>
   </thead>
   <tbody>

    <?php
//SELECT idFicheForfait, fichefrais.mois, repas, nuit, etape, km, idEtat, idVisiteur FROM ficheforfait NATURAL JOIN fichefrais WHERE ficheforfait.idVisiteur = ? AND MONTH(ficheforfait.date) = ? GROUP BY idFicheForfait

    if(isset($_POST['getmois']))
{
      $visiteur = $_POST['visiteur'];
      $mois = $_POST['mois'];
      $reqa = $conn->prepare("SELECT idFicheForfait, date, repas, nuit, etape, km, fichefrais.idEtat, idVisiteur FROM ficheforfait NATURAL JOIN fichefrais WHERE ficheforfait.idVisiteur = ? AND MONTH(ficheforfait.date) = ? GROUP BY idFicheForfait");
      $reqa->BindParam(1,$visiteur);
      $reqa->BindParam(2,$mois);
      $reqa->execute();
      var_dump($reqa);
      for($i=0; $row = $reqa->fetch(); $i++){
    ?>
    <form method="POST" name="valid" action="submit.php">
    <tr class="record">
      <td><?php echo $row['idFicheForfait']; ?></td>
      <td><?php echo $row['date']; ?></td>
     <td><?php echo $row['repas']; ?></td>
     <td><?php echo $row['nuit']; ?></td>
      <td><?php echo $row['etape']; ?></td>
      <td><?php echo $row['km']; ?></td>
      <td><?php echo $row['idEtat']; ?></td>
      <td><?php echo $row['idVisiteur']; ?></td>
      <td><input type="submit" name="valid" value="validation"></td>
      <td><input type="submit" name="delete" value="Supprimer"></td>
    </tr>
    </form>
    <?php

    var_dump(isset($_GET['valid']));
    if(isset($_POST['delete']))
    {
      $visiteur = $_GET['idVisiteur'];
      $mois = $_GET['mois'];
      $reqc = $conn->prepare("UPDATE fichefrais SET idEtat ='CR' WHERE idVisiteur = ? AND mois = ?");
      $reqc->BindParam(1,$visiteur);
      $reqc->BindParam(2,$mois);
      $reqc->execute();
      }
    }
   }
    ?>
   </tbody>
   </table>

<br>
    <table cellspacing="0" cellpadding="2" id="sample" >
   <thead>
    <tr>
      <th> Fiche n° </th>
      <th> Date </th>
      <th> libelle </th>
      <th> montant </th>
      <th> Visiteur n° </th>
    </tr>
   </thead>
   <tbody>

    <?php
//SELECT idFicheForfait, fichefrais.mois, repas, nuit, etape, km, idEtat, idVisiteur FROM ficheforfait NATURAL JOIN fichefrais WHERE ficheforfait.idVisiteur = ? AND MONTH(ficheforfait.date) = ? GROUP BY idFicheForfait

    if(isset($_POST['getmois']))
{
      $visiteur = $_POST['visiteur'];
      $mois = $_POST['mois'];
      $reqa = $conn->prepare("SELECT * FROM fichehorsforfait NATURAL JOIN fichefrais WHERE fichehorsforfait.idVisiteur = ? AND MONTH(fichehorsforfait.date) = ? GROUP BY idFicheHorsForfait");
      $reqa->BindParam(1,$visiteur);
      $reqa->BindParam(2,$mois);
      $reqa->execute();
      for($i=0; $row = $reqa->fetch(); $i++){
    ?>
    <tr class="record">
      <td><?php echo $row['idFicheHorsForfait']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['libelle']; ?></td>
      <td><?php echo $row['montant']; ?></td>
      <td><?php echo $row['idVisiteur']; ?></td>
    </tr>
    <?php

      }
      }
    ?>
   </tbody>
   </table>
   <!-- Test -->

   <?php
 }
  elseif (!isset($_SESSION['id'])) {
     header("location: log.php");
 }
   ?>
</div>
</center>
  </body>
</html>
