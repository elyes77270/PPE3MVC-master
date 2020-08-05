
<head>
  <meta charset="utf-8">
  <title>GSB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="src/style.css">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">GSB</a>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?action=accueil">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=fiche">Mes fiches</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=addfiche">Ajouter une fiche</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=editfiche">Valider une fiche</a>
      </li>
    </ul>
    <ul class="navbar-nav my-2 my-lg-0">
      <li class="navbar-item">
        <a class="nav-link" href="?action=logout">Log out</a>
      </li>
  </div>
</nav>

<form name="formValidFrais" method="post">
   <h1> Validation des frais par visiteur </h1>

 <label class="titre">Choisir le visiteur :</label>
   <select name="lstVisiteur" class="zone">
   <option value="a17">Choisir un visiteur</option>
<?php

  foreach($userinfo as $userinfo)
  {
?>
     <option value="<?php echo $userinfo['id'];   ?>"><?php echo $userinfo['nom'];?> &nbsp;<?php echo $userinfo['prenom']; ?></option>
<?php
  }
?>
</select>
 <label class="titre">Mois :</label> <input class="zone" type="text" name="dateValid" size="12" />
 <button  name="getmois" class="btnValid">Choisir</button>
 <h3>Frais au forfait </h3></br>
 <table style="color:black;" border="1">
   <tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
     <?php
     if(is_array($Hinfo))
     {
         foreach ($Hinfo as $Hinfo)
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
  if(is_array($HFinfo))
  {
      foreach($HFinfo as $HFinfo)
      {
?>
<form method="POST" name="subsub">
  <tr align="center">
    <td width="100" ><input type="text" size="12" name="hfDate1" value="<?php echo $HFinfo['date'];  ?>" /></td>
    <td width="220"><input type="text" size="30" name="hfLib1" value="<?php echo $HFinfo['libelle'];  ?>" /></td>
    <td width="90"> <input type="text" size="10" name="hfMont1" value="<?php echo $HFinfo['montant'];  ?>" /></td>
    </tr>
  </form>
    <?php
    }
  }
    ?>
</table>
  </form>
<p class="titre"></p> Nb Justificatifs :
<input type="text" class="zone" size="4" name="hcMontant"/>
<p class="titre" /><label class="titre">&nbsp;</label></br>
<button  name="editfi" class="btnValid">Validé la fiche</button>
</div>
</div>
