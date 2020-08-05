<?php
require_once("models/models.php");
include("connect.php");

	/**
	 *
	 */
	class Controller
	{
		public $model;

		public function __construct()
		{
			$this->models = new Model();
		}

		public function invoke()
		{
			$reslt = $this->models->getlogin();

			if($reslt == 'login')
			{
				$reslt = new Model();
				$userinfo=$reslt->userinfo();
				include 'views/afterlogin.php';
			}
			else
			{
				include 'views/login.php';
			}
		}
	/*	public function update()
		{
			$reslt = $this->models->update();

			if($reslt == 'update')
			{
				$reslt = new Model();
				$update=$reslt->update();
				include 'views/edit.php';
			}
			else
			{
				include 'views/login.php';
			}
		} */
		public function nav()
		{

			try {
			    if (!isset($_REQUEST['action'])) {
			      $controller = new Controller;
			      $controller->invoke();}
			      else {
			        $action = $_REQUEST['action'];
			        switch ($action) {
			          case 'accueil':
			            $controller = new Controller;
			            $controller->home();
			            include('views/afterlogin.php');
			            break;

			          case 'fiche':
			          /*	$controller = new Controller;
			          	$controller->home();
									$controller2 = new Controller;
									$controller2->selectAllFiche();*/
									$fiche = new Model();
									$finfo=$fiche->ficheForfaitInfo();
									$fiche = new Model();
									$fhinfo=$fiche->ficheHorsForfaitInfo();
			            include('views/fiche.php');
			            break;

			          case 'addfiche':
									if(isset($_POST['fiche']))
									{
										$controller = new Controller;
										$controller->addFiche();
									}
									elseif(isset($_POST['fichehf']))
									{
										$controller = new Controller;
										$controller->addFicheHF();
									}
			            include('views/addfiche.php');
			            break;

			          case 'editfiche':
									$reslt = new Model();
									$userinfo=$reslt->allUserInfo();
									$reslt2 = new Model();
									$Hinfo=$reslt2->allFicheUpdate();
									$reslt3 = new Model();
									$HFinfo=$reslt3->allFicheHFUpdate();
			            include('views/editfiche.php');
			            break;

								case 'logout':
									$controller = new Controller;
									$controller->logout();
										include('views/login.php');
										break;

							case 'edit':
								$controller = new Controller;
								$controller->home();
									include('views/edit.php');
									break;
						}
			      }
			}
			catch(Exception $e) {
			    echo 'Erreur : ' . $e->getMessage();
			}
		}

		public function home()
		{
			$reslt = new Model();
			$userinfo=$reslt->userinfo();
		}

		public function addFiche()
		{
			$model = new Model;
			$model->addFF();
			$model2 = new Model;
			$model2->addFicheFrais();
			$model3 = new Model;
			$model3->addLFF();
			$model4 = new Model;
			$model4->addFHF();
			$model5 = new Model;
			$model5->addLFHF();
		}

		public function addFicheHF()
		{
			$model = new Model;
			$model->addFHF();
			$model2 = new Model;
			$model2->addLFHF();
		}

		public function logout()
		{
 				session_destroy();
				header("Location: /Login_MVC/");
				die();
		}
	}


?>
