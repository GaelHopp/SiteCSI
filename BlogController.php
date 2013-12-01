<?php


include_once "Afficheur.php";


class BlogController{
	
	private $vue;
	
	function __construct()
		{
		$this->vue = new Vue();
		}
	
	public function listCAction(){
		$lc = Categorie::findAll();
		$centre = $this->vue->afficheListeCat($lc);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
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
	
	public function firstRegisterAction(){
		
		if(!empty($_POST)){
		
		$u = Users::findById(1);
		$u->setAttr('password', md5($_POST['password']));
		
		$u->save();
		
		$lb = Billets::findAll();
		$centre = $this->vue->afficheListeBillet($lb);
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
		}
		else{
		
		$centre = $this->vue->firstRegister();
		$this->vue->AffichePage($centre, $this->vue->menuGauche(), $this->vue->menuDroit(), "");
		}
	}
	
	public function analyse(){
		
		if(!empty($_GET)){ 
			switch($_GET['action']) {
			
				case 'list':
					
					$this->listAction();
					break;
					
				case 'listC':
					
					$this->listCAction();
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
			
			$this->vue->AffichePage("","");
		}
	}
}


?>
