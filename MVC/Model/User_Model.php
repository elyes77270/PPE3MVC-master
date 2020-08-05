<?php
include ('C:\UwAmp\www\PPE3MVC\MVC\Connexion\connect.php');
/**
 *
 */
class User_Model
{


  public function connectUser()
  {
    if(isset($_REQUEST['login']) && isset($_REQUEST['password']))
    {
      include ('C:\UwAmp\www\PPE3MVC\MVC\Connexion\connect.php');
      $login = $_POST['login'];
      $password = $_POST['password'];
      $req = $conn->prepare("SELECT * FROM visiteur WHERE login = ? AND password = ?");
      $req->execute(array($login, $password));
      $userinfo = $req->fetch();
      $userexist = $req->rowCount();
      if ($userexist == 1) {
        $_SESSION['login'] = $userinfo['login'];
        $_SESSION['id'] = $userinfo['id'];
				return 'login';
			}
			else
			{
				return 'invalid user';
			}
    }
  }

  public function userInfo()
  {
    $getid = strval($_SESSION['id']);
    include ('C:\UwAmp\www\PPE3MVC\MVC\Connexion\connect.php');
    $req = $conn->prepare("SELECT * FROM visiteur, role WHERE id = ? AND visiteur.idRole = role.idRole");
    $req->execute(array($getid));
    $userinfo = $req->fetch();
    return 'info';
  }

  public function userInfo2()
  {
    include ('C:\UwAmp\www\PPE3MVC\MVC\Connexion\connect.php');
    $req = $conn->prepare("SELECT * FROM visiteur WHERE id = ?");
    $req->execute(array($getid));
    $userinfo = $req->fetch();
  }

  public function userInfo3()
  {
    include ('C:\UwAmp\www\PPE3MVC\MVC\Connexion\connect.php');
    $reqV = $conn->prepare("SELECT * FROM visiteur");
    $reqV->execute();
  }
}


 ?>
