<?php


include_once "Afficheur.php";


class BlogController{
	
	private $vue;
	
	function __construct()
		{
		$this->vue = new Vue();
		}
	
	

	public function afficheAccueil(){

		if(isset($_SESSION)){

			$this->vue->AffichePage("",$this->vue->afficheAccueilGuest());
			
			}
			
			else{

				$this->vue->AffichePage($this->vue->afficheSideBarNormale(),$this->vue->afficheAccueilGuest());
			}

	}


	public function afficheListeProduit($sousCat){
		$menuleft = $this->vue->afficheSideBar($sousCat);
		$this->vue->AffichePage($menuleft, "");
	}
	
	public function loginAction(){

		if((!empty($_POST['login'])) && (!empty($_POST['mdp']))){
			
			$u = Users::findByPseudo($_POST['login']);

			
			if((!is_null($u)) && ($u->getAttr('mdp') == $_POST['mdp'])){
			
				
				
				
				$_SESSION['idU'] = $u->getAttr('idU');
				$_SESSION['login'] = $u->getAttr('login');
				$_SESSION['mdp'] = $u->getAttr('mdp');
				$_SESSION['mail'] = $u->getAttr('melU');
				$_SESSION['nomU'] = $u->getAttr('nomU');
				$_SESSION['prenomU'] = $u->getAttr('prenomU');
				$_SESSION['adresseU'] = $u->getAttr('adresseU');
				$_SESSION['idL'] = $u->getAttr('idL');

				$this->vue->AffichePage($this->vue->afficheSideBarNormale(),$this->vue->afficheAccueilGuest());


		}
		else{

						$this->vue->AffichePage("",$this->vue->afficheAccueilGuest());

		}
	}else{

					$this->vue->AffichePage("",$this->vue->afficheAccueilGuest());

	}

	
}



public function registerAction(){

		

		if((!empty($_POST['nomU'])) && (!empty($_POST['prenomU'])) && (!empty($_POST['melU'])) 
			&& (!empty($_POST['adresseU'])) && (!empty($_POST['login'])) && (!empty($_POST['mdp'])) 
			&& (!empty($_POST['mdpConfirm']))){
			
			
			
			if($_POST['mdp'] == $_POST['mdpConfirm']){

				
				
				$u = new Users();

				$u->setAttr('nomU', $_POST['nomU']);
				$u->setAttr('prenomU', $_POST['prenomU']);
				$u->setAttr('melU', $_POST['melU']);
				$u->setAttr('adresseU', $_POST['adresseU']);
				$u->setAttr('login', $_POST['login']);
				$u->setAttr('mdp', $_POST['mdp']);

				$u->insert();

				
				$_SESSION['idU'] = $u->getAttr('idU');
				$_SESSION['login'] = $u->getAttr('login');
				$_SESSION['mdp'] = $u->getAttr('mdp');
				$_SESSION['mail'] = $u->getAttr('melU');
				$_SESSION['nomU'] = $u->getAttr('nomU');
				$_SESSION['prenomU'] = $u->getAttr('prenomU');
				$_SESSION['adresseU'] = $u->getAttr('adresseU');
				$_SESSION['idL'] = $u->getAttr('idL');


				$this->vue->AffichePage($this->vue->afficheSideBarNormale(), "");

		}

		$this->vue->AffichePage("", $this->vue->afficheRegister());

	}

	$this->vue->AffichePage("", $this->$ue->afficheRegister());

	
}



	
	public function afficheRegister(){
		
		$centre = $this->vue->afficheRegister();
		$this->vue->AffichePage("", $centre);
	}


	public function afficheRegisterOuLogin(){

		$centre = $this->vue->afficheRegisterOuLogin();
		$this->vue->AffichePage("", $centre);
	}
	
	public function analyse(){
		
		if(!empty($_GET)){ 
			switch($_GET['action']) {
			
				case 'afficheListeProduit':
					$sousCat = SousCategorie::findByIdSC($_GET['id']);
					$this->afficheListeProduit($sousCat);
					break;
					
				case 'afficheRegister':
					
					$this->afficheRegister();
					break;

				case 'registerOuLogin':

					$this->afficheRegisterOuLogin();
					break;
					
				case 'login':
					
					$this->loginAction();
					break;

				case 'register':
					
					$this->registerAction();
					break;

				
				
			}
		}
		else{
			

			$this->afficheAccueil();
		}
	}
}


?>
