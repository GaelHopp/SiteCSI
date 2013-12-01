<?php


include_once "Afficheur.php";


class BlogController{
	
	private $vue;
	
	function __construct()
		{
		$this->vue = new Vue();
		}
	
	public function afficheListeProduit($sousCat){
		$menuleft = $this->vue->afficheSideBar($sousCat);
		$this->vue->AffichePage($menuleft, "");
	}
	
	public function listAction(){
		$lb = Billets::findAll();
		$centre = $this->vue->afficheListeBillet($lb);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
	}
	
	public function listUAction(){
		$users = Users::findAll();
		$centre = $this->vue->afficheListeUsers($users);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
	}
	
	public function detailAction($id){
		$b = Billets::findById($id);
		$centre = $this->vue->afficheBillet($b);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
		
	}
	
	public function catAction($id){ 
		$lb = Billets::findByCat($id);
		$centre = $this->vue->afficheListeBillet($lb);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
	}
	
	public function profilAction($user){
		$centre = $this->vue->profil($user);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "Profil de l'utilisateur ".$user->getAttr('pseudo'));
		
	}
	
	public function registerAction(){
		
		$centre = $this->vue->afficheRegister();
		$this->vue->AffichePage("", $centre);
	}
	
	public function analyse(){
		
		if(!empty($_GET)){ 
			switch($_GET['action']) {
			
				case 'afficheListeProduit':
					$sousCat = SousCategorie::findByIdSC($_GET['id']);
					$this->afficheListeProduit($sousCat);
					break;
					
				case 'register':
					
					$this->registerAction();
					break;
					
				case 'detail':
					
					$this->detailAction($_GET['id']);
					break;
					
				case 'cat':
					
					$this->catAction($_GET['id']);
					break;	
					
				case 'profil' :
					$u = Users::findById($_GET['id']);
					$this->profilAction($u);
					break;
					
				case 'listU' :
					$this->listUAction();
					break;
				
				case 'firstR' :
					$this->firstRegisterAction();
					break;
				
				
			}
		}
		else{
			
			$this->vue->AffichePage("",$this->vue->afficheAccueilGuest());
		}
	}
}


?>
