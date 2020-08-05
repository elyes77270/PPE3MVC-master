<?php

/**
 *
 */
class Fiche
{

  public function ficheForfait1()
  {
    include ("../Connexion/connect.php");
    $req2 = $conn->prepare("SELECT * FROM ficheforfait  WHERE  idVisiteur = ? AND MONTH(date) = ?");
    $req2->BindParam(1,$getid);
    $req2->BindParam(2,$getmois);
    $req2->execute();
  }

  public function ficheForfait2()
  {
    include ("../Connexion/connect.php");
    $req3 = $conn->prepare("SELECT * FROM ficheforfait WHERE MONTH(date) = ?");
    $req3->BindParam(1,$getmois);
    $req3->execute();
  }

  public function ficheHorsForfait1()
  {
    include ("../Connexion/connect.php");
    $req2 = $conn->prepare("SELECT * FROM fichehorsforfait  WHERE  idVisiteur = ? AND MONTH(date) = ?");
    $req2->BindParam(1,$getid);
    $req2->BindParam(2,$getmois);
    $req2->execute();
  }

  public function ficheHorsForfait2()
  {
    include ("../Connexion/connect.php");
    $req3 = $conn->prepare("SELECT * FROM fichehorsforfait WHERE MONTH(date) = ?");
    $req3->BindParam(1,$getmois);
    $req3->execute();
  }

  public function ff1()
  {
    include ("../Connexion/connect.php");
    $reqF = $conn->prepare("SELECT * FROM ficheforfait NATURAL JOIN fichefrais WHERE ficheforfait.idVisiteur = ? AND MONTH(ficheforfait.date) = ? GROUP BY MONTH(ficheforfait.date)");
    $reqF->BindParam(1,$Vid);
    $reqF->BindParam(2,$dateValid);
    $reqF->execute();
  }

  public function fhf1()
  {
    //include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $reqHF = $conn->prepare("SELECT id, date, libelle, montant FROM LigneFraisHorsForfait WHERE idVisiteur= ? AND mois= ?");
    $reqHF->BindParam(1,$Vid);
    $reqHF->BindParam(2,$dateValid);
    $reqHF->execute();
  }

  public function updateFhf()
  {
  //  include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $reqHF2 = $conn->prepare("UPDATE FicheHorsForfait SET date = ?, libelle = ?, Montant = ? WHERE idVisiteur = ? AND MONTH(date)= ?");
    $reqHF2->BindParam(1,$hfDate1);
    $reqHF2->BindParam(2,$hfLib1);
    $reqHF2->BindParam(3,$hfMont1);
    $reqHF2->BindParam(4,$Vid);
    $reqHF2->BindParam(5,$dateValid);
    $reqHF2->execute();
  }

  public function updateLFHF()
  {
    //include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $reqHF3 = $conn->prepare("UPDATE LigneFraisHorsForfait SET date = ?, libelle = ?, Montant = ? WHERE idVisiteur = ? AND MONTH(date) = ?");
  //  $reqHF3->BindParam(1,$hfDate1);
  //  $reqHF3->BindParam(2,$hfLib1);
  //  $reqHF3->BindParam(3,$hfMont1);
    //$reqHF3->BindParam(4,$Vid);
  //  $reqHF3->BindParam(5,$dateValid);
    $reqHF3->execute([$hfDate1, $hfLib1, $hfMont1, $Vid, $dateValid]);
  }

  public function addFicheForfait()
  {
    //include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $req2 = $conn->prepare("INSERT INTO ficheforfait (idFicheForfait, date, repas, nuit, etape, km, idVisiteur) VALUES ('', ?, ?, ?, ?, ?, ?)");
    $req2->BindParam(1,$date);
    $req2->BindParam(2,$repas);
    $req2->BindParam(3,$nuit);
    $req2->BindParam(4,$etape);
    $req2->BindParam(5,$km);
    $req2->BindParam(6,$getid);
    $req2->execute();
  }

  public function addFicheFrais()
  {
    include ("../Connexion/connect.php");
    $reqb = $conn->prepare("INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES (?, ?, 0, null, ?, 'CR')");
    $reqb->BindParam(1,$getid);
    $reqb->BindParam(2,$mois);
    $reqb->BindParam(3,$date);
    $reqb->execute();
  }

  public function addLFF()
  {
   // include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $req2c = $conn->prepare("SELECT id from FraisForfait");
    $req2c->execute();
    $ligne = $req2c->fetch(PDO::FETCH_ASSOC);
    if(is_array($ligne) )
    {
      $getfid = $ligne["id"];
      $reqc = $conn->prepare("INSERT INTO LigneFraisForfait (idVisiteur, mois, idFraisForfait, quantite) VALUES (?, ?, ?, 0)");
      $reqc->BindParam(1,$getid);
      $reqc->BindParam(2,$mois);
      $reqc->BindParam(3,$getfid);
      $reqc->execute();
    }
  }

  public function addFHF()
  {
   // include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $req0 = $conn->prepare("INSERT INTO fichehorsforfait (idFicheHorsForfait, date, libelle, montant, idVisiteur) VALUES ('', ?, ?, ?, ?)");
    $req0->BindParam(1,$date);
    $req0->BindParam(2,$libelle);
    $req0->BindParam(3,$montant);
    $req0->BindParam(4,$getid);
    $req0->execute();
  }

  public function addLFHF()
  {
   // include ("/Applications/MAMP/htdocs/PPE3MVC/MVC/Connexion/connect.php");
    $req0b = $conn->prepare("INSERT INTO lignefraishorsforfait (id, idVisiteur, mois, libelle, date, montant) VALUES ('', ?, ?, ?, ?, ?)");
    $req0b->BindParam(1,$getid);
    $req0b->BindParam(2,$mois);
    $req0b->BindParam(3,$libelle);
    $req0b->BindParam(4,$date);
    $req0b->BindParam(5,$montant);
    $req0b->execute();
  }
}


 ?>
