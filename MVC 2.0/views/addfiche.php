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
  			<input type="date" size="12" name="FRA_AUT_DAT1" class="zone"/>
        <label class="titre">&nbsp;Libellé :</label>
  			<input type="text" size="30" name="FRA_AUT_LIB1" class="zone"/>
        <label class="titre">&nbsp;Montant :</label>
  			<input class="zone" size="3" name="FRA_AUT_MONT1" type="text" />
  		</div>
    </br>
  		<p class="titre" /><label class="titre">&nbsp;</label>
    <!--  <button  name="reset" class="btnReset"><img src="src/off.png" height="16" width="15"/></button> -->
      <button  name="fiche" class="btnValid">Ajouter fiche</button>
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
  			<input type="date" size="12" name="FRA_AUT_DAT1" class="zone"/>
        <label class="titre">&nbsp;Libellé :</label>
  			<input type="text" size="30" name="FRA_AUT_LIB1" class="zone"/>
        <label class="titre">&nbsp;Montant :</label>
  			<input class="zone" size="3" name="FRA_AUT_MONT1" type="text" />
  		</div>
    </br>
  		<p class="titre" /><label class="titre">&nbsp;</label>
      <button  name="fichehf" class="btnValid">Ajouter Fiche Hors Frais</button>
  	</form>
  </div>
</br>
</div>
