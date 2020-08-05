<head>
  <meta charset="utf-8">
  <title>GSB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="src/style.css">
</head>
<?php $role = $_SESSION['Role']; ?>

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
     ?>
     <tbody>
     <?php

    foreach ($finfo as $info ) {
       ?>
     <tr>
      <td><?php echo $info['repas']; ?></td>
      <td><?php echo $info['nuit']; ?></td>
       <td><?php echo $info['etape']; ?></td>
       <td><?php echo $info['km']; ?></td>
    </tr>

         <?php

     }
  /*   elseif {
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
     }*/
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
<?php
if(is_array($fhinfo))
{
 foreach ($fhinfo as $hinfo )
 { ?>
     <tbody>
     <tr>
      <td><?php echo $hinfo['date']; ?></td>
      <td><?php echo $hinfo['libelle']; ?></td>
      <td><?php echo $hinfo['montant']; ?></td>
    </tr>

<?php
    /* }
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
   }*/
 }
 }?>
   </tbody>
   </table>
   </br>
      <!-- FICHE HORS FORFAIT -->
    </div>
