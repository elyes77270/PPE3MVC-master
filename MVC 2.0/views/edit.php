<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GSB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="src/style.css">
  </head>

<body>
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

<?php
 /* foreach ($userinfo as $row) { */ ?>

 <div align="center"style="font-size: 15px;">
</br>
<?php // var_dump($_SESSION) ?>
<div class="info">

  <form post action="Login_MVC/action_page.php" method="post">
    <fieldset>
      <legend>Personal information:</legend>
      First name:<br>
      <input type="text" name="firstname" value="<?= $_SESSION['nom']; ?>" ><br>
      Last name:<br>
      <input type="text" name="lastname" value="<?= $_SESSION['prenom']; ?>"><br>
      <input type="text" name="lastname" value="<?= $_SESSION['adresse']; ?>"><br>
      <input type="text" name="lastname" value="<?= $_SESSION['cp']; ?>"><br>
      <input type="text" name="lastname" value="<?= $_SESSION['ville']; ?>"><br>

      <input type="submit" value="Submit">
    </fieldset>
  </form>
 </div>
</div>

  <?php/*
} */
?>


  </body>
</html>
