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
    if(isset($_POST['profil']))
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  </head>

  <style>
  table { border-collapse: separate; background-color: #FFFFFF; border-spacing: 0; width: 50%; color: #666666; text-shadow: 0 1px 0 #FFFFFF; border: 2px solid #CCCCCC; box-shadow: 0; margin: 0 auto; }
  table thead tr th { background: none repeat scroll 0 0 #EEEEEE; color: #222222; padding: 10px 14px; text-align: left; border-top: 0 none; font-size: 14px; }
  table tbody tr td{
      background-color: #FFFFFF;
  	font-size: 14px;
      text-align: left;
  	padding: 10px 14px;
  	border-top: 1px solid #DDDDDD;
  }
  </style>

<body style="background-color:#31445B;">

 

 

  <div class="container" >
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Sasie Forfaitaire</h3>
            </div>
            <div class="panel-body">
              <form role="form" method="post" name="submitbutton">
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="date" name="date" id="date" class="form-control input-sm" placeholder="Date">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="repas" id="repas" class="form-control input-sm" placeholder="Repas">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="nuit" id="nuit" class="form-control input-sm" placeholder="Nuit">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="etape" id="etape" class="form-control input-sm" placeholder="Etape">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="km" id="km" class="form-control input-sm" placeholder="Km">
                    </div>
                  </div>
                </div>

            
                  
                	<input type="submit" name="submitbutton" value="Valider">
                
              
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
      <?php

   	if(isset($_POST['submitbutton'])){
   		echo "merci";
   		

   		

   		$date=$_POST['date'];
   		$repas=$_POST['repas'];
   		$nuit=$_POST['nuit'];
   		$etape=$_POST['etape'];
   		$km=$_POST['km'];

   		if(!empty($date) && !empty($repas) && !empty($nuit) && !empty($etape) && !empty($km)){
   			try
					{
						$pdo = new PDO ('mysql:host=localhost;dbname=ppe;charset=utf8', 'root','root');
						
					}
					catch(Exception $e){

						die('Connexion échouée ! : ' .$e->getMessage());
					}
					if($pdo == true){
						
   					$sql = 'INSERT INTO  ficheforfait VALUES ("", \'' . $_POST['date'] . '\', \'' . $_POST['repas']. '\', \'' . $_POST['nuit']  . '\', \'' . $_POST['etape']  . '\', \'' . $_POST['km'] . '\') ';
							$reponse= $pdo -> prepare($sql);
							$reponse->execute();
      }else {
						
					}

 }else {
 	echo "Renseignez tous les infos";
}
}
   ?>

    <div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Hors Forfait</h3>
            </div>
            <div class="panel-body">
              <form role="form" method="post" name="submit2">
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="date" name="date" id="date" class="form-control input-sm" placeholder="Date">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="libelle" id="Libelle" class="form-control input-sm" placeholder="Libelle">
                    </div>
                  </div>
                </div>
                <div class="panel-body">
              <form role="form">
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="montant" id="montant" class="form-control input-sm" placeholder="Montant">
                    </div>
                  </div>
                  
                <input type="submit" name="submit2" value="Valider" >
              
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   <br />
   <br />
    <br />
     <br />
     <?php 
     if(isset($_POST['submit2'])){
   		echo "merci";
   		
   		$date=$_POST['date'];
   		$libelle=$_POST['libelle'];
   		$montant=$_POST['montant'];
   		

   		if(!empty($date) && !empty($libelle) && !empty($montant)){
   			try
					{
						$pdo = new PDO ('mysql:host=localhost;dbname=ppe;charset=utf8', 'root','root');
						
					}
					catch(Exception $e){

						die('Connexion échouée ! : ' .$e->getMessage());
					}
					if($pdo == true){
						
   					$sql = 'INSERT INTO  fichehorsforfait VALUES ("", \'' . $_POST['date'] . '\', \'' . $_POST['libelle']. '\', \'' . $_POST['montant']  . '\') ';
							$reponse= $pdo -> prepare($sql);
							$reponse->execute();
      }else {
						echo"Connexion base de donnée echouée";
					}

 }else {
 	echo "Renseignez tous les infos";
}
}




      ?>

     <form method="post" name="profil">
     <input type="submit" name="profil" value="Profil">
   </form>
   <form method="post" name="watchfrais">
     <input type="submit" name="watchfrais" value="Consulter Fiche">
   </form>
   <form method="post" name="logout">
     <input type="submit" name="logout" value="Log Out">
   </form>
 

   
</div>

  </body>
</html>
