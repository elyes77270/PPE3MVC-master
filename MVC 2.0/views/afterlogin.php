<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GSB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="src/style.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/main.js"></script>
    
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


<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Profil de <?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['prenom'];?> </h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="src/img/avatar.png" class="img-circle img-responsive"> </div>
            
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Rang : </td>
                        <td><?php echo $_SESSION['Role']; ?></td>
                      </tr>
                      <tr>
                        <td>Adresse :</td>
                        <td><?php echo $_SESSION['adresse']; ?></td>
                      </tr>
                      <tr>
                        <td>Code Postal :</td>
                        <td><?php echo $_SESSION['cp']; ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Ville :</td>
                        <td><?php echo $_SESSION['ville']; ?></td>
                      </tr>
                        <tr>
                        <td>Date d'embauche :</td>
                        <td><?php echo $_SESSION['dateEmbauche']; ?></td>
                      </tr>
                      
                     
                    </tbody>
                  </table>
                  
                
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
   
  <?php/*
 } */
?>


  </body>
</html>
