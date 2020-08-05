<?php
include ("C:\UwAmp\www\PPE3MVC\MVC\Connexion\connect.php");
require_once ("C:\UwAmp\www\PPE3MVC\MVC\Model\User_Model.php");

class User_Controller{
    public $User;

    public function __construct()
    {
        $this->user = new User_Model();
    }

    public function log(){
   //   include_once ("View\log.php");
      require_once ("Model\User_Model.php");
      /*   if(isset($_POST['submit']))
        {
        //  $userexist = $req->rowCount();
            $obj =new User();
            $userexist=$obj->connectUser();

            if($userexist == 0)
            {
                $_SESSION['login'] = $userinfo['login'];
                $_SESSION['id'] = $userinfo['id'];
                header("location: C:\UwAmp\www\PPE3MVC\MVC\View\home.php?id=".$_SESSION['id']);
                $obj->home();
            }
            else
            {
               echo "erreur";
            }
        }*/

        $reslt = $this->user->connectUser();

        if($reslt == 'login')
        {
            //echo $reslt;
            include 'View/home.php';
           // $reslt = $this->user->home();
     //       require_once("Controller/User_Controller.php");
            $controller = new User_Controller;
            $controller->home();
        }
        else
        {
            echo $reslt;
            include 'View/log.php';
        }

    }

    public function home()
    {
        include_once ("View\home.php");
        require_once ("Model\User_Model.php");
        $reslt = $this->user->userInfo();
    }

}
