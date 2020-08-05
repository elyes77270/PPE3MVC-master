<?php

session_start();

require 'include/connect.php';


if(isset($_POST['submit']))
{
  $login = $_POST['login'];
  $password = $_POST['password'];

  $req = $conn->prepare("SELECT * FROM visiteur WHERE login = ? AND password = ?");
  $req->execute(array($login, $password));
  $userexist = $req->rowCount();

  if($userexist == 1)
  {
    $userinfo = $req->fetch();
    $_SESSION['login'] = $userinfo['login'];
    $_SESSION['id'] = $userinfo['id'];
    header("location: home.php?id=".$_SESSION['id']);
  }
  else
  {
    echo "erreur";
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
    <link rel="stylesheet" href="src/style.css">
  </head>

  <body>
    <center>
      <div class="log">
      <br>
      <div class="fadeIn first">
        <img src="src/img/logo.png" id="icon" alt="User Icon" class="logo" height="140" width="220"/>
      </div>
      <br><br>
      <form method="POST">
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="Nom d'utilisateur"><br><br>
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Mot de passe">
        <br><br>
        <input type="submit" class="btnInfo" name="submit" value="Connexion">
      </form>
    </br>
      <div id="formFooter">
        <h6>Tout droits reservé - 2019 - 2020</h2>
      </div>
  </div>
</center>
</body>
</html>
