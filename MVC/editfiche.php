<?php

require 'include/connect.php';

session_start();


if(isset($_GET['id']))
{
    $getid = strval($_GET['id']);
    // userInfo2 model
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
   <div class="infoNfiche2">
   <form name="formValidFrais" method="post">
      <h1> Validation des frais par visiteur </h1>

    <label class="titre">Choisir le visiteur :</label>
      <select name="lstVisiteur" class="zone">
      <option >Choisir un visiteur</option>
<?php

  // userInfo3 model
  for($i=0; $Vinfo = $reqV->fetch(); $i++)
  {

?>

        <option value="<?php echo $Vinfo['id'];   ?>"><?php echo $Vinfo['nom'];?> &nbsp;<?php echo $Vinfo['prenom']; ?></option>

  <?php
}
  ?>
  </select>
    <label class="titre">Mois :</label> <input class="zone" type="text" name="dateValid" size="12" />
    <button  name="getmois" class="btnValid"><img src="src/done.png" height="16" width="15"/></button>
    <h3>Frais au forfait </h3></br>
    <table style="color:black;" border="1">
      <tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
        <?php
          if(isset($_POST['getmois']))
          {
            $Vid = $_POST['lstVisiteur'];
            $dateValid = $_POST['dateValid'];

            // ff1 model
            for($i=0; $Hinfo = $reqF->fetch(); $i++)
          {
        ?>
        <form method="post" name="gett">
      <tr align="center">
        <td width="80" ><input type="text" size="3" name="repas" value="<?php echo $Hinfo['repas']; ?>" /></td>
        <td width="80"><input type="text" size="3" name="nuitee" value="<?php echo $Hinfo['nuit']; ?>" /></td>
        <td width="80"> <input type="text" size="3" name="etape" value="<?php echo $Hinfo['etape']; ?>" /></td>
        <td width="80"> <input type="text" size="3" name="km" value="<?php echo $Hinfo['km']; ?>"/></td>
        <td width="80">
          <select size="3" name="situ">
            <option value="E" selected="selected">Enregistré</option>
            <option value="V">Validé</option>
            <option value="R">Remboursé</option>
          </select></td>
        </tr>
      </form>
      <?php
      }
      }
      ?>
    </table>
</br>
    <h3>Hors Forfait</h3></br>

    <table style="color:white;" border="1">
      <tr><th>Date</th><th>Libellé </th><th>Montant</th></tr>
      <?php
        if(isset($_POST['getmois']))
        {
          $Vid = $_POST['lstVisiteur'];
          $dateValid = $_POST['dateValid'];
?>

  <?php

          // fhf1 model
          for($i=0; $Vinfo = $reqHF->fetch(); $i++)
          {
?>
<form method="POST" name="subsub">
      <tr align="center">
        <td width="100" ><input type="text" size="12" name="hfDate1" value="<?php echo $Vinfo['date'];  ?>" /></td>
        <td width="220"><input type="text" size="30" name="hfLib1" value="<?php echo $Vinfo['libelle'];  ?>" /></td>
        <td width="90"> <input type="text" size="10" name="hfMont1" value="<?php echo $Vinfo['montant'];  ?>" /></td>
        </tr>
      </form>
        <?php
        if(isset($_GET['subsub']))
        {
          $Vid = $_GET['lstVisiteur'];
          $dateValid = $_GET['dateValid'];
          $hfDate1 = $_POST['hfDate1'];
          $hfLib1 = $_POST['hfLib1'];
          $hfMont1 = $_POST['hfMont1'];

          // updateFhf model

          // updateLFHF model

            }
      }
        }
        ?>
    </table>
      </form>
    <p class="titre"></p> Nb Justificatifs :
    <input type="text" class="zone" size="4" name="hcMontant"/>
    <p class="titre" /><label class="titre">&nbsp;</label></br>
    <button  name="reset" class="btnReset"><img src="src/off.png" height="16" width="15"/></button>
    <button  name="editfi" class="btnValid"><img src="src/done.png" height="16" width="15"/></button>
  </div>
</div>
</br>
</div>
   <?php
 }
  elseif (!isset($_SESSION['id'])) {
     header("location: log.php");
 }
   ?>
</center>
  </body>
</html>
