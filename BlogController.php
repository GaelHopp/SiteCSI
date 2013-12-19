<?php


include_once "Afficheur.php";


class BlogController{
	
	private $vue;
	
	function __construct()
		{
		$this->vue = new Vue();
		}
	
	

	public function afficheAccueil(){

		if(empty($_SESSION)){

			$this->vue->AffichePage("",$this->vue->afficheAccueilGuest());
			
			}
			
			else{

				$this->vue->AffichePage($this->vue->afficheSideBarNormale(),$this->vue->afficheAccueilGuest());
			}

	}


	public function afficheListeProduit($sousCat){
		$menuleft = $this->vue->afficheSideBar($sousCat);
		$centre = $this->vue->afficheListeProduit($sousCat);
		$this->vue->AffichePage($menuleft, $centre);
	}

	public function afficheProduit($id, $sousCat){
		$menuleft = $this->vue->afficheSideBar($sousCat);
		$centre = $this->vue->afficheProduit($id, $sousCat);
		$this->vue->AffichePage($menuleft, $centre);
	}

	public function afficheUpdateProduit($id){
		$menuleft = $this->vue->afficheSideBarNormale();
		$centre = $this->vue->afficheUpdateProduit($id);
		$this->vue->AffichePage($menuleft, $centre);
	}

	public function listeProduitUser($id){
		$menuleft = $this->vue->afficheSideBarNormale();
		$centre = $this->vue->listeProduitUser($id);
		$this->vue->AffichePage($menuleft,$centre);
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


	public function logoutAction(){
		
		
		session_unset();
		session_destroy();

		$this->afficheAccueil();

	}



	
	public function afficheRegister(){
		
		$centre = $this->vue->afficheRegister();
		$this->vue->AffichePage("", $centre);
	}


	public function afficheRegisterOuLogin(){
		if (empty($_SESSION)) {
			$centre = $this->vue->afficheRegisterOuLogin();
			$this->vue->AffichePage("", $centre);
		}
		else {
			$this->afficheAccueil();
		}
	}

	public function afficheAjoutProduit(){
		$centre = $this->vue->afficheAjoutProduit();
		$this->vue->AffichePage($this->vue->afficheSideBarNormale(), $centre);

	}

	public function ajoutProduit(){



		if((!empty($_POST['nomProduit'])) && (!empty($_POST['categorie'])) 
			&& (!empty($_POST['sousCategorie'])) && (!empty($_POST['etatProduit']))
			 && (!empty($_POST['descriptionProduit'])) && (!empty($_POST['anneeProduit']))
			  && (!empty($_POST['modeEchangeProduit'])) ){

			
			
			$produit = new Produit();

			$produit->setAttr('typeP', "Actif");
			
			$sc = SousCategorie::findByidSC($_POST['sousCategorie']);

			$dateDeb = date("Y-m-d H:i:s");

			$produit->setAttr('idSC', $sc->getAttr('idSC'));
			$produit->setAttr('visible', "Vrai");
			$produit->setAttr('idU', $_SESSION['idU']);
			$produit->setAttr('etatP', $_POST['etatProduit']);
			$produit->setAttr('dateDeb', $dateDeb);
			$produit->setAttr('dateFin', NULL);
			$produit->setAttr('modeEchange', $_POST['modeEchangeProduit']);
			$produit->setAttr('libelleP', $_POST['nomProduit']);
			$produit->setAttr('descriptionP', $_POST['descriptionProduit']);
			$produit->setAttr('annee_achat', $_POST['anneeProduit']);

			$produit->insert();

			$produit->uploadImage();
		


			$this->afficheAccueil();


	}else{

		$this->vue->afficheAjoutProduit();
			

		}

	
}


	

public function afficheSousCat($id){

	return $this->vue->afficheSousCat($id);
}




public function afficheAlgo(){
		$centre = $this->vue->afficheAlgo();
		$this->vue->AffichePage($this->vue->afficheSideBarNormale(), $centre);

	}





public function updateProduit($id){


		if((!empty($_POST['libelleP'])) && (!empty($_POST['etatP'])) 
			&& (!empty($_POST['descriptionP'])) && (!empty($_POST['annee_achat']))
			 && (!empty($_POST['modeEchange']))){

			$produit = Produit::findByidP($id);

			$produit->setAttr('libelleP', $_POST['libelleP']);
			$produit->setAttr('descriptionP', $_POST['descriptionP']);
			$produit->setAttr('annee_achat', $_POST['annee_achat']);
			$produit->setAttr('modeEchange', $_POST['modeEchange']);
			$produit->setAttr('etatP', $_POST['etatP']);
			$ex = $produit->getAttr('typeP');
			$produit->setAttr('typeP', $_POST['typeP']);

			$produit->update($ex);

			
			$produit->uploadImage();


		}

		$centre = $this->vue->listeProduitUser($_SESSION['idU']);
		$this->vue->AffichePage($this->vue->afficheSideBarNormale(), $centre);


}


public function faireSouhait($idP){

	$souhait = new Souhait();

	$souhait->setAttr('idP', $idP);
	$souhait->setAttr('idU', $_SESSION['idU']);

	if($_POST['options'] == "option1"){

		$souhait->setAttr('idP2', 0);
		

	}
	else{

		$idP2 = $_POST['produit'];
		$souhait->setAttr('idP2', $idP2);
		
	}

	$date_souhait = date("Y-m-d H:i:s");

	$souhait->setAttr('date_souhait', $date_souhait);

	$souhait->insert();


	$centre = $this->vue->afficheSouhait($_SESSION['idU']);
	$this->vue->AffichePage($this->vue->afficheSideBarNormale(), $centre);


}


public function afficheSouhait($idU){

	$centre = $this->vue->afficheSouhait($idU);
	$this->vue->AffichePage($this->vue->afficheSideBarNormale(), $centre);

}



public function ajoutTroc($idP1, $idU2){

	$souhait = Souhait::findyByPK($idP1, $idU2);

	$produit = Produit::findByidP($idP1);

	$dateT = date("Y-m-d H:i:s");

	$troc = new Troc();

	$troc->setAttr('dateT', $dateT);
	$troc->setAttr('mode_echange_final', $produit->getAttr('modeEchange'));
	$troc->setAttr('effectif', "Faux");
	$troc->setAttr('idU1', $produit->getAttr('idU'));
	$troc->setAttr('idU2', $idU2);
	$troc->setAttr('idP1', $idP1);
	$troc->setAttr('idP2', $souhait->getAttr('idP2'));

	$troc->insert();

	$listeSouhait1 = Souhait::findByidP($idP1);
	$listeSouhait2 = Souhait::findByidP($troc->getAttr('idP1'));

	foreach ($listeSouhait1 as $souhait) {
		$souhait->delete();
	}

	foreach ($listeSouhait1 as $souhait) {
		$souhait->delete();
	}




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

				case 'logout':

					$this->logoutAction();
					break;

				case 'afficheAjoutProduit':

					$this->afficheAjoutProduit();
					
					break;

				case 'ajoutProduit':
					
					$this->ajoutProduit();
					break;

				case 'afficheSousCat':
					echo $this->afficheSousCat($_GET['idCat']);
					break;

				case 'afficheAlgo':
					$this->afficheAlgo();
					break;

				case 'afficheProduit':
					$sousCat = SousCategorie::findByIdSC($_GET['id']);
					$this->afficheProduit($_GET['id'], $sousCat);
					break;

				case 'listeProduitUser':
					$this->listeProduitUser($_SESSION['idU']);
					break;

				case 'afficheUpdateProduit':
					$this->afficheUpdateProduit($_GET['id']);
					break;

				case 'updateProduit':
					$this->updateProduit($_GET['id']);
					break;

				case 'faireSouhait':
				$this->faireSouhait($_GET['id']);
				break;

				case 'afficheSouhait':
				$this->afficheSouhait($_SESSION['idU']);
				break;

				case 'ajoutTroc':
				$this->ajoutTroc($idP1, $idU2);
				break;


				
			}
		}
		else{
			

			$this->afficheAccueil();
		}
	}
}


?>
