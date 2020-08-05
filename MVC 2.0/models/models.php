<?php
require_once("models/models.php");
include("connect.php");
/**
 *
 */
class Model
{
	public function getlogin()
	{
		if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
		{
			include ('connect.php');
			$login = $_REQUEST['username'];
			$password = $_REQUEST['password'];
   	        $req = $conn->prepare("SELECT * FROM visiteur, role WHERE login = ? AND password = ? AND visiteur.idRole = role.idRole");
	        $req->execute(array($login, $password));
	        $userexist = $req->rowCount();
	        $userinfo = $req->fetch();
			if ($userexist == 1) {
				$_SESSION['login'] = $userinfo['login'];
				$_SESSION['nom'] = $userinfo['nom'];
				$_SESSION['prenom'] = $userinfo['prenom'];
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['adresse'] = $userinfo['adresse'];
				$_SESSION['ville'] = $userinfo['ville'];
				$_SESSION['cp'] = $userinfo['cp'];
					$_SESSION['Role'] = $userinfo['Role'];
				$_SESSION['dateEmbauche'] = $userinfo['dateEmbauche'];
				return 'login';
			}
			else
			{
				return 'invalid user';
			}
		}
	}

	public function allUserInfo()
	{
			include ('connect.php');
			$req = $conn->prepare("SELECT * FROM visiteur");
			$req->execute();
			$userinfo = $req->fetchAll();

			return $userinfo;
	}

	public function allFicheUpdate()
	{
		include ('connect.php');
		if(isset($_POST['getmois']))
		{
			$Vid = $_POST['lstVisiteur'];
			$dateValid = $_POST['dateValid'];

			$reqF = $conn->prepare("SELECT * FROM ficheforfait NATURAL JOIN fichefrais WHERE ficheforfait.idVisiteur = ? AND MONTH(ficheforfait.date) = ? GROUP BY MONTH(ficheforfait.date)");
			$reqF->BindParam(1,$Vid);
			$reqF->BindParam(2,$dateValid);
			$reqF->execute();
			$Hinfo = $reqF->fetchAll();

			return $Hinfo;
		}
	}

	public function allFicheHFUpdate()
	{
		include ('connect.php');
		if(isset($_POST['getmois']))
		{
			$Vid = $_POST['lstVisiteur'];
			$dateValid = $_POST['dateValid'];

			$reqHF = $conn->prepare("SELECT id, date, libelle, montant FROM LigneFraisHorsForfait WHERE idVisiteur= ? AND mois= ?");
			$reqHF->BindParam(1,$Vid);
			$reqHF->BindParam(2,$dateValid);
			$reqHF->execute();
			$HFinfo = $reqHF->fetchAll();

			return $HFinfo;
		}
	}

	public function userinfo()
	{
	    include ('connect.php');
	    $getlogin = strval($_SESSION['login']);
	    $req = $conn->prepare("SELECT * FROM visiteur, role WHERE login = ? AND visiteur.idRole = role.idRole");
	    $req->execute(array($getlogin));
	    $userinfo = $req->fetchAll();
		//	$_SESSION['idRole'] = $userinfo['idRole'];

	//	return	var_dump($userinfo);
	    return $userinfo;
	}

	public function ficheForfaitInfo()
	{
		include ('connect.php');
	  if(isset($_POST['subm']))
		{
			$role = $_SESSION['Role'];
			$getmois = $_POST['mois'];
			$getid = $_SESSION['id'];

			$req2 = $conn->prepare("SELECT * FROM ficheforfait  WHERE  idVisiteur = ? AND MONTH(date) = ?");
			$req2->BindParam(1,$getid);
			$req2->BindParam(2,$getmois);
			$req2->execute();
			$finfo = $req2->fetchAll();

	/*		$req3 = $conn->prepare("SELECT * FROM ficheforfait WHERE MONTH(date) = ?");
			$req3->BindParam(1,$getmois);
			$req3->execute();
			$rfinfo = $req3->fetchAll();
*/
			return $finfo;
		}
	}


	public function ficheHorsForfaitInfo()
	{
		include ('connect.php');
		if(isset($_POST['subm']))
		{
			$role = $_SESSION['Role'];
			$getmois = $_POST['mois'];
			$getid = $_SESSION['id'];
				$req2 = $conn->prepare("SELECT * FROM fichehorsforfait  WHERE  idVisiteur = ? AND MONTH(date) = ?");
				$req2->BindParam(1,$getid);
				$req2->BindParam(2,$getmois);
				$req2->execute();
				$fhinfo = $req2->fetchAll();

	/*			$req3 = $conn->prepare("SELECT * FROM fichehorsforfait WHERE MONTH(date) = ?");
				$req3->BindParam(1,$getmois);
				$req3->execute();
				$fhinfo = $req3->fetchAll();*/

			return $fhinfo;
		}
	}

	public function addFF()
	{
		include ('connect.php');
		if(isset($_POST['fiche']))
		{
			$getid = $_SESSION['id'];

		  $mois = $_POST['FRA_MOIS'];
		  $date = $_POST['FRA_AUT_DAT1'];
		  $repas = $_POST['FRA_REPAS'];
		  $nuit = $_POST['FRA_NUIT'];
		  $etape = $_POST['FRA_ETAP'];
		  $km = $_POST['FRA_KM'];

		  $libelle = $_POST['FRA_AUT_LIB1'];
		  $montant = $_POST['FRA_AUT_MONT1'];

			// Ajout Fiche Forfait
		  $req = $conn->prepare("INSERT INTO ficheforfait (idFicheForfait, date, repas, nuit, etape, km, idVisiteur) VALUES (0, ?, ?, ?, ?, ?, ?)");
		  $req->BindParam(1,$date);
		  $req->BindParam(2,$repas);
		  $req->BindParam(3,$nuit);
		  $req->BindParam(4,$etape);
		  $req->BindParam(5,$km);
		  $req->BindParam(6,$getid);
		  $req->execute();
			// Ajout Fiche Forfait
		}
	}

		public function addFicheFrais()
		{
			include ('connect.php');
			if(isset($_POST['fiche']))
			{
				$getid = $_SESSION['id'];

				$mois = $_POST['FRA_MOIS'];
				$date = $_POST['FRA_AUT_DAT1'];

			// Ajout Fiche Frais
		  $req = $conn->prepare("INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES (?, ?, 0, null, ?, 'CR')");
		  $req->BindParam(1,$getid);
		  $req->BindParam(2,$mois);
		  $req->BindParam(3,$date);
		  $req->execute();
			// Ajout Fiche Frais
		}
		}

		public function addLFF()
		{
			include ('connect.php');
			if(isset($_POST['fiche']))
			{
				$getid = $_SESSION['id'];

				$mois = $_POST['FRA_MOIS'];
				$date = $_POST['FRA_AUT_DAT1'];
				$repas = $_POST['FRA_REPAS'];
				$nuit = $_POST['FRA_NUIT'];
				$etape = $_POST['FRA_ETAP'];
				$km = $_POST['FRA_KM'];

				$libelle = $_POST['FRA_AUT_LIB1'];
				$montant = $_POST['FRA_AUT_MONT1'];

			// Ajout LigneFraisForfait
		  $req = $conn->prepare("SELECT id from FraisForfait");
		  $req->execute();
		  $ligne = $req->fetch(PDO::FETCH_ASSOC);
		  if(is_array($ligne) ) {
		    $getfid = $ligne["id"];
		    $req = $conn->prepare("INSERT INTO LigneFraisForfait (idVisiteur, mois, idFraisForfait, quantite) VALUES (?, ?, ?, 0)");
		    $req->BindParam(1,$getid);
		    $req->BindParam(2,$mois);
		    $req->BindParam(3,$getfid);
		    $req->execute();
		  }
			// Ajout LigneFraisForfait
			}
		}

		public function addFHF()
		{
			include ('connect.php');
			if(isset($_POST['fiche']) || isset($_POST['fichehf']))
			{
				$getid = $_SESSION['id'];

				$mois = $_POST['FRA_MOIS'];
				$date = $_POST['FRA_AUT_DAT1'];

				$libelle = $_POST['FRA_AUT_LIB1'];
				$montant = $_POST['FRA_AUT_MONT1'];

			// Ajout Fiche Hors Forfait
		  $req = $conn->prepare("INSERT INTO fichehorsforfait (idFicheHorsForfait, date, libelle, montant, idVisiteur) VALUES (0, ?, ?, ?, ?)");
		  $req->BindParam(1,$date);
		  $req->BindParam(2,$libelle);
		  $req->BindParam(3,$montant);
		  $req->BindParam(4,$getid);
		  $req->execute();
			// Ajout Fiche Hors Forfait
		}
		}

		public function addLFHF()
		{
			include ('connect.php');
			if(isset($_POST['fiche']) || isset($_POST['fichehf']))
			{
				$getid = $_SESSION['id'];

				$mois = $_POST['FRA_MOIS'];
				$date = $_POST['FRA_AUT_DAT1'];

				$libelle = $_POST['FRA_AUT_LIB1'];
				$montant = $_POST['FRA_AUT_MONT1'];

			// Ajout Ligne Frais Hors Forfait
		  $req = $conn->prepare("INSERT INTO lignefraishorsforfait (id, idVisiteur, mois, libelle, date, montant) VALUES (0, ?, ?, ?, ?, ?)");
		  $req->BindParam(1,$getid);
		  $req->BindParam(2,$mois);
		  $req->BindParam(3,$libelle);
		  $req->BindParam(4,$date);
		  $req->BindParam(5,$montant);
		  $req->execute();
			// Ajout Ligne Frais Hors Forfait
		}
		}

	public function update()
	{
			include ('connect.php');
			$getlogin = strval($_SESSION['login']);
			$req = $conn->prepare("UPDATE table SET colonne_1 = 'valeur 1', colonne_2 = 'valeur 2', colonne_3 = 'valeur 3' WHERE condition");
			$req->execute(array($getlogin));
			header("Refresh:0");
	}

}

?>
