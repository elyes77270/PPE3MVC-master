<?php

require 'include/connect.php';

session_start();


if(isset($_GET['id']))
{
    $getid = strval($_GET['id']);
    $req = $conn->prepare("SELECT * FROM visiteur, role WHERE id = ? AND visiteur.idRole = role.idRole");
    $req->execute(array($getid));
    $userinfo = $req->fetch();

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

    if(isset($_POST['home']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: home.php?id=".$_GET['id']);
    }

    if(isset($_POST['logout']))
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
</br>
</br>
</br>
<div class="infoNfiche2">
<form name="formValidFrais" method="post">
   <h1> Validation des frais par visiteur </h1>
<?php
$reqV = $conn->prepare("SELECT * FROM visiteur WHERE id = ?");
$reqV->BindParam(1,$getid);
$reqV->execute();
for($i=0; $Hinfo = $reqV->fetch(); $i++)
{
?>
 <p class="titre" />
 <h3>Frais au forfait </h3>
 <table style="color:white;" border="1">
        <form method="post" name="edit">
        </br>
   <tr align="center">
     <td width="80" >Nom</td><th><input type="text" size="10" name="nom" value="<?php echo $Hinfo['nom']; ?>" /> </th>
     </tr>
   <tr align="center">
     <td width="80" >Prénom</td><th><input type="text" size="10" name="prenom" value="<?php echo $Hinfo['prenom']; ?>" /> </th>
     </tr>
     <tr align="center">
       <td width="80" >Adresse</td><th><input type="text" size="10" name="adresse" value="<?php echo $Hinfo['adresse']; ?>" /> </th>
       </tr>
       <tr align="center">
         <td width="80" >Ville</td><th><input type="text" size="10" name="ville" value="<?php echo $Hinfo['ville']; ?>" /> </th>
         </tr>
         <tr align="center">
           <td width="80" >Code Postal</td><th><input type="text" size="10" name="cp" value="<?php echo $Hinfo['cp']; ?>" /> </th>
           </tr>
 </table>
</br>
<button  name="edit" class="btnValid"><img src="src/done.png" height="16" width="15"/></button>
</form>
</br>
   <?php
 }
   }
   if(isset($_POST['edit'])) {

     $nom = $_POST['nom'];
     $prenom = $_POST['prenom'];
     $adresse = $_POST['adresse'];
     $ville = $_POST['ville'];
     $cp = $_POST['cp'];

     $reqc = $conn->prepare("UPDATE visiteur SET nom = ?, prenom = ?, adresse = ?, ville = ?, cp = ? WHERE id = ?");
     $reqc->BindParam(1,$nom);
     $reqc->BindParam(2,$prenom);
     $reqc->BindParam(3,$adresse);
     $reqc->BindParam(4,$ville);
     $reqc->BindParam(5,$cp);
     $reqc->BindParam(6,$getid);
     $reqc->execute();
   }
 }
 elseif (!isset($_SESSION['id'])) {
   header("location: log.php");
 }
   ?>
</div>

  </body>
</html>
