<?php

include_once "SousCategorie.php";
include_once "Base.php";

class Produit {
	
	
	private $idP; 
	
	private $typeP;
	
	private $idSC;
	
	private $visible;
	
	private $idU;
	
	private $dateDeb;
	
	private $dateFin;
	
	private $etatP;
	
	private $modeEchange;
	
	private $libelleP;
	
	private $descriptionP;

	private $annee_achat;

	

	
	
	
	
	public function __construct() {

	}
	
	
	
	public function __toString() {
		return "[". __CLASS__ . "] idC : ". $this->idC . ":
		libelleC  ". $this->libelleC;
	}

	
	
	public function getAttr($attr_name) {
		if (property_exists( __CLASS__, $attr_name)) { 
			return $this->$attr_name;
		} 
		$emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
		throw new Exception($emess, 45);
	}
	

	public function setAttr($attr_name, $attr_val) {
		if (property_exists( __CLASS__, $attr_name)) {
			$this->$attr_name=strip_tags($attr_val); 
			return $this->$attr_name;
		} 
		$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
		throw new Exception($emess, 45);
		
	}
	
	
	
	/*public function save() {
		if (!isset($this->idC)) {
			return $this->insert();
		} else {
			return $this->update();
		}
	}
	

	public function update() {
		
		if (!isset($this->idP)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
		} 
		
		
		$save_query = "UPDATE categorie SET libelleC= :libelleC WHERE idC= :idC";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($save_query);
		$nb->bindparam(':libelleC', $this->libelleC);
		$nb->bindparam(':description', $this->description);
		$nb->bindparam(':idC', $this->idC);
		$nb->execute();
		
		return $nb;
		
	}
	

	public function delete() {
		
		if (!isset($this->idP)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "DELETE FROM Produit
			WHERE idP= $this->idP";
		$pdo = Base::getConnection();
		$nb=$pdo->prepare($delete_query);
		$nb->bindparam(':idC', $this->idC);
		$nb->execute();
		
		return $nb;
		
		
		
	}*/
	
								
	public function insert() {
		

		
		$query = "INSERT INTO produit VALUES('$this->typeP', $this->idSC, '$this->visible')";
		
		$c = Base::getConnection();
		
		$dbres = odbc_exec($c, $query);

		$res = odbc_exec($c, "SELECT @@IDENTITY as nb");
		$idP = odbc_fetch_object($res);

		$this->idP = $idP->nb; 

		$query2 = "INSERT INTO actif VALUES($this->idP)";

		$dbres2 = odbc_exec($c, $query2);

/*		$image = $this->photo;

		$data = bin2hex(fread(fopen($image,"r"), filesize($image))); */

		$query3 = "INSERT INTO possession VALUES($this->idP, $this->idU, now(), '$this->dateFin', '$this->etatP', '$this->modeEchange', '$this->libelleP', '$this->descriptionP', $this->annee_achat)";
		
		$dbres3 = odbc_exec($c, $query3);

		return $dbres3;
		
	}

	public static function recupImage($idProd){        /* permet de récup le nom de l'image*/
		$dos = opendir('images/'.$idProd);
		while($nom = readdir($dos)){
			if ($nom != "." && $nom != "..") {
        		return ($nom);
    		}
    	}
		closedir($dos);
	}
	

	public static function findByidP($idP) {
		$query = "SELECT * FROM possession WHERE idP = ".$idP;
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			return(false);
		}
		else{
			
			
				
				$produit = new Produit();
				
				$produit->setAttr('idP', $obj->idP);
				$produit->setAttr('idU', $obj->idU);
				$produit->setAttr('dateDeb', $obj->date_debut);
				$produit->setAttr('dateFin', $obj->date_finP);
				$produit->setAttr('etatP', $obj->etatP);
				$produit->setAttr('modeEchange', $obj->mode_echangeP);
				$produit->setAttr('libelleP', $obj->libelleP);
				$produit->setAttr('descriptionP', $obj->descriptionP);



				$query2 = "SELECT * FROM produit WHERE idP = $produit->idP";
				$dbres2 = odbc_exec($c, $query2);
				
				$obj2 = odbc_fetch_object($dbres2);

				$produit->setAttr('typeP', $obj2->typeP);
				$produit->setAttr('idSC', $obj2->idSC);
				$produit->setAttr('visible', $obj2->visible);
		
		
		return($produit);
		}
	
		
	}
	

	
	public static function findAll() {
		
		$query = "SELECT possession.* FROM possession, produit where possession.idP = produit.idP and produit.visible = 'Vrai'";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			
			while($obj = odbc_fetch_object($dbres)){
			
				
			$produit = new Produit();
				
				$produit->setAttr('idP', $obj->idP);
				$produit->setAttr('idU', $obj->idU);
				$produit->setAttr('dateDeb', $obj->date_debut);
				$produit->setAttr('dateFin', $obj->date_finP);
				$produit->setAttr('etatP', $obj->etatP);
				$produit->setAttr('modeEchange', $obj->mode_echangeP);
				$produit->setAttr('libelleP', $obj->libelleP);
				$produit->setAttr('descriptionP', $obj->descriptionP);
				

			$query2 = "SELECT * FROM produit WHERE idP = $obj->idP";
						
					$c2 = Base::getConnection();
					$dbres2 = odbc_exec($c2, $query2);
					

				if(!$dbres2){
					throw new Exception('ODBC error : '.$query.' : '.odbc_error());

				}
				
				$obj2 = odbc_fetch_object($dbres2);


				$produit->setAttr('typeP', $obj2->typeP);
				$produit->setAttr('idSC', $obj2->idSC);
				$produit->setAttr('visible', $obj2->visible);

				

				array_push($res, $produit);
			
		}
	}
	return $res;
		
	}
	
	public static function findBylibelle($libelle){
		
		$query = "SELECT possession.* FROM possession, produit WHERE libelleP = '$libelle' and possession.idP = produit.idP and produit.visible = 'Vrai'";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			return(false);
		}
		else{
			
			
				
				$produit = new Produit();
				
				$produit->setAttr('idP', $obj->idP);
				$produit->setAttr('idU', $obj->idU);
				$produit->setAttr('dateDeb', $obj->date_debut);
				$produit->setAttr('dateFin', $obj->date_finP);
				$produit->setAttr('etatP', $obj->etatP);
				$produit->setAttr('modeEchange', $obj->mode_echangeP);
				$produit->setAttr('libelleP', $obj->libelleP);
				$produit->setAttr('descriptionP', $obj->descriptionP);


				$query2 = "SELECT * FROM produit WHERE idP = $produit->idP";
				$dbres2 = odbc_exec($c, $query2);
				
				$obj2 = odbc_fetch_object($dbres2);

				$produit->setAttr('typeP', $obj2->typeP);
				$produit->setAttr('idSC', $obj2->idSC);
				$produit->setAttr('visible', $obj2->visible);
		
		
		return($produit);
		}
		
		
	}



	public static function findActif(){

	$query = "SELECT possession.* 
	FROM possession, actif WHERE actif.idActif = possession.idP";

		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			


			while($obj = odbc_fetch_object($dbres)){
			
				
			$produit = new Produit();
				
				$produit->setAttr('idP', $obj->idP);
				$produit->setAttr('idU', $obj->idU);
				$produit->setAttr('dateDeb', $obj->date_debut);
				$produit->setAttr('dateFin', $obj->date_finP);
				$produit->setAttr('etatP', $obj->etatP);
				$produit->setAttr('modeEchange', $obj->mode_echangeP);
				$produit->setAttr('libelleP', $obj->libelleP);
				$produit->setAttr('descriptionP', $obj->descriptionP);

				$query2 = "SELECT * FROM produit WHERE idP = $produit->idP";
				$dbres2 = odbc_exec($c, $query2);
				
				$obj2 = odbc_fetch_object($dbres2);

				$produit->setAttr('typeP', $obj2->typeP);
				$produit->setAttr('idSC', $obj2->idSC);
				$produit->setAttr('visible', $obj2->visible);
				

				array_push($res, $produit);
			
		}
	}
	return $res;


	}


	public static function findPassif(){

	$query = "SELECT possession.* 
	FROM possession, passif WHERE passif.idPassif = possession.idP";
	
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			


			while($obj = odbc_fetch_object($dbres)){
			
				
			$produit = new Produit();
				
				$produit->setAttr('idP', $obj->idP);
				$produit->setAttr('idU', $obj->idU);
				$produit->setAttr('dateDeb', $obj->date_debut);
				$produit->setAttr('dateFin', $obj->date_finP);
				$produit->setAttr('etatP', $obj->etatP);
				$produit->setAttr('modeEchange', $obj->mode_echangeP);
				$produit->setAttr('libelleP', $obj->libelleP);
				$produit->setAttr('descriptionP', $obj->descriptionP);

				$query2 = "SELECT * FROM produit WHERE idP = $produit->idP";
				$dbres2 = odbc_exec($c, $query2);
				
				$obj2 = odbc_fetch_object($dbres2);

				$produit->setAttr('typeP', $obj2->typeP);
				$produit->setAttr('idSC', $obj2->idSC);
				$produit->setAttr('visible', $obj2->visible);
				

				array_push($res, $produit);
			
		}
	}
	return $res;


	}

	public static function nombreObjet(){



	$query = "SELECT COUNT(*) AS nb FROM produit";
	
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			
			$nb = odbc_fetch_object($dbres);

			 $nbFinal = $nb->nb;	

			 return($nbFinal);
		}


			

	}


	public function popularite(){

		$popu = null;

		$query = "SELECT COUNT(*) AS nb WHERE (".$this->idP." = idP1 OR ".$this->idP." = idP2)";

		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			
			$nb = odbc_fetch_object($dbres);

			$popu = $nb->nb;

			
	}

	return($popu);

}



}



?>
