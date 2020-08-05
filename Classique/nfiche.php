<?php

require 'include/connect.php';

session_start();


if(isset($_GET['id']))
{
    $getid = strval($_GET['id']);
    $req = $conn->prepare("SELECT * FROM visiteur WHERE id = ?");
    $req->execute(array($getid));
    $userinfo = $req->fetch();

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

    if(isset($_POST['home']))
    {
      $userinfo = $req->fetch();
      $_GET['login'] = $userinfo['login'];
      $_SESSION['id'] = $userinfo['id'];
      header("location: home.php?id=".$_GET['id']);
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

<?php if(isset($_GET['id']))
{  ?>
  <div align="center">
   <?php
   if(isset($_GET['id']) != 0) { // On affiche la page seulement si on récupère un id différent de 0 (aucun utilisateur)
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
   <!-- NAV -->
</br>
<div class="infoNfiche">
    <form name="formSaisieFrais" method="post" class="form1">
  		<h1> Saisie Fiche Frais</h1>
  			<label>Mois (2 chiffres) : </label>
        <input type="text" size="4" name="FRA_MOIS" class="zone" />
  		<p class="titre" /><div style="clear:left;"><h3>Frais au forfait</h3></div></br>
  		<label class="titre">Repas midi :</label>
      <input type="text" size="2" name="FRA_REPAS" class="zone" />
  		<label class="titre">Nuitées :</label>
      <input type="text" size="2" name="FRA_NUIT" class="zone" />
  		<label class="titre">Etape :</label>
      <input type="text" size="5" name="FRA_ETAP" class="zone" />
  		<label class="titre">Km :</label>
      <input type="text" size="5" name="FRA_KM" class="zone" />
  		<p class="titre" /><div style="clear:left;"><h3>Hors Forfait</h3></div></br>
  		<div style="clear:left;" id="lignes">
        <label class="titre">&nbsp;Date :</label>
  			<input type="text" size="12" name="FRA_AUT_DAT1" class="zone"/>
        <label class="titre">&nbsp;Libellé :</label>
  			<input type="text" size="30" name="FRA_AUT_LIB1" class="zone"/>
        <label class="titre">&nbsp;Montant :</label>
  			<input class="zone" size="3" name="FRA_AUT_MONT1" type="text" />
  		</div>
    </br>
  		<p class="titre" /><label class="titre">&nbsp;</label>
      <button  name="reset" class="btnReset"><img src="src/off.png" height="16" width="15"/></button>
      <button  name="fiche" class="btnValid"><img src="src/done.png" height="16" width="15"/></button>
  	</form>
</div>
<div class="infoNfiche2">
    <form name="formSaisieFrais" method="post" class="form2">
  		<h1> Saisie Hors Frais</h1>
  			<label>Mois (2 chiffres) : </label>
        <input type="text" size="4" name="FRA_MOIS" class="zone" />
  		<p class="titre" /><div style="clear:left;"><h3>Hors Forfait</h3></div></br>
  		<div style="clear:left;" id="lignes">
        <label class="titre">&nbsp;Date :</label>
  			<input type="text" size="12" name="FRA_AUT_DAT1" class="zone"/>
        <label class="titre">&nbsp;Libellé :</label>
  			<input type="text" size="30" name="FRA_AUT_LIB1" class="zone"/>
        <label class="titre">&nbsp;Montant :</label>
  			<input class="zone" size="3" name="FRA_AUT_MONT1" type="text" />
  		</div>
    </br>
  		<p class="titre" /><label class="titre">&nbsp;</label>
      <button  name="reset" class="btnReset"><img src="src/off.png" height="16" width="15"/></button>
      <button  name="fichehf" class="btnValid"><img src="src/done.png" height="16" width="15"/></button>
  	</form>
  </div>
</br>
</div>
  </body>
</html>


<?php
if(isset($_POST['fiche']))
{

  $mois = $_POST['FRA_MOIS'];
  $date = $_POST['FRA_AUT_DAT1'];
  $repas = $_POST['FRA_REPAS'];
  $nuit = $_POST['FRA_NUIT'];
  $etape = $_POST['FRA_ETAP'];
  $km = $_POST['FRA_KM'];

  $libelle = $_POST['FRA_AUT_LIB1'];
  $montant = $_POST['FRA_AUT_MONT1'];

// Ajout Fiche Forfait
  $req2 = $conn->prepare("INSERT INTO ficheforfait (idFicheForfait, date, repas, nuit, etape, km, idVisiteur) VALUES ('', ?, ?, ?, ?, ?, ?)");
  $req2->BindParam(1,$date);
  $req2->BindParam(2,$repas);
  $req2->BindParam(3,$nuit);
  $req2->BindParam(4,$etape);
  $req2->BindParam(5,$km);
  $req2->BindParam(6,$getid);
  $req2->execute();
// Ajout Fiche Forfait

// Ajout Fiche Frais
  $reqb = $conn->prepare("INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES (?, ?, 0, null, ?, 'CR')");
  $reqb->BindParam(1,$getid);
  $reqb->BindParam(2,$mois);
  $reqb->BindParam(3,$date);
  $reqb->execute();
// Ajout Fiche Frais

// Ajout LigneFraisForfait
  $req2c = $conn->prepare("SELECT id from FraisForfait");
  $req2c->execute();
  $ligne = $req2c->fetch(PDO::FETCH_ASSOC);
  if(is_array($ligne) ) {
    $getfid = $ligne["id"];
    $reqc = $conn->prepare("INSERT INTO LigneFraisForfait (idVisiteur, mois, idFraisForfait, quantite) VALUES (?, ?, ?, 0)");
    $reqc->BindParam(1,$getid);
    $reqc->BindParam(2,$mois);
    $reqc->BindParam(3,$getfid);
    $reqc->execute();
  }
// Ajout LigneFraisForfait

// Ajout Fiche Hors Forfait
  $req0 = $conn->prepare("INSERT INTO fichehorsforfait (idFicheHorsForfait, date, libelle, montant, idVisiteur) VALUES ('', ?, ?, ?, ?)");
  $req0->BindParam(1,$date);
  $req0->BindParam(2,$libelle);
  $req0->BindParam(3,$montant);
  $req0->BindParam(4,$getid);
  $req0->execute();
// Ajout Fiche Hors Forfait

// Ajout Ligne Frais Hors Forfait
  $req0b = $conn->prepare("INSERT INTO lignefraishorsforfait (id, idVisiteur, mois, libelle, date, montant) VALUES ('', ?, ?, ?, ?, ?)");
  $req0b->BindParam(1,$getid);
  $req0b->BindParam(2,$mois);
  $req0b->BindParam(3,$libelle);
  $req0b->BindParam(4,$date);
  $req0b->BindParam(5,$montant);
  $req0b->execute();
// Ajout Ligne Frais Hors Forfait


}

if (isset($_POST['fichehf'])) {

  $mois = $_POST['FRA_MOIS'];
  $date = $_POST['FRA_AUT_DAT1'];
  $libelle = $_POST['FRA_AUT_LIB1'];
  $montant = $_POST['FRA_AUT_MONT1'];

  // Ajout Fiche Hors Forfait
    $req0 = $conn->prepare("INSERT INTO fichehorsforfait (idFicheHorsForfait, date, libelle, montant, idVisiteur) VALUES ('', ?, ?, ?, ?)");
    $req0->BindParam(1,$date);
    $req0->BindParam(2,$libelle);
    $req0->BindParam(3,$montant);
    $req0->BindParam(4,$getid);
    $req0->execute();
  // Ajout Fiche Hors Forfait

  // Ajout Ligne Frais Hors Forfait
    $req0b = $conn->prepare("INSERT INTO lignefraishorsforfait (id, idVisiteur, mois, libelle, date, montant) VALUES ('', ?, ?, ?, ?, ?)");
    $req0b->BindParam(1,$getid);
    $req0b->BindParam(2,$mois);
    $req0b->BindParam(3,$libelle);
    $req0b->BindParam(4,$date);
    $req0b->BindParam(5,$montant);
    $req0b->execute();
  // Ajout Ligne Frais Hors Forfait.
}

}
  }
  elseif (!isset($_SESSION['id']))
  {
  header("location: log.php");
}

?>
