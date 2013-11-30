<?php

include_once "Categorie.php";


  
class Souscategorie {
	
	
	private $idSC ; 
	
	

	private $libelleSC;
	
	private $idC ; 
	
	
	
	
	public function __construct() {

	}
	
	
	
	public function __toString() {
		return "[". __CLASS__ . "] idSC : ". $this->idSC . ":
		libelleSC  ". $this->libelleSC;
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
	
	
	/*
	public function save() {
		if (!isset($this->idSC)) {
			return $this->insert();
		} else {
			return $this->update();
		}
	}
	

	public function update() {
		
		if (!isset($this->idSC)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
		} 
		
		
		$save_query = "UPDATE Scategorie SET libelleSC= :libelleSC WHERE idSC= :idSC";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($save_query);
		$nb->bindparam(':libelleSC', $this->libelleSC);
		$nb->bindparam(':description', $this->description);
		$nb->bindparam(':idSC', $this->idSC);
		$nb->execute();
		
		return $nb;
		
	}
	

	public function delete() {
		
		if (!isset($this->idSC)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "DELETE FROME Scategorie
			WHERE idSC= :idSC";
		$pdo = Base::getConnection();
		$nb=$pdo->prepare($delete_query);
		$nb->bindparam(':idSC', $this->idSC);
		$nb->execute();
		
		return $nb;
		
		
		
	}
	
								
	public function insert() {
		

		
		$insert_query = "INSERT INTO Scategorie VALUES('', :libelleSC, :description)";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($insert_query);
		$nb->bindparam(':libelleSC', $this->libelleSC);
		$nb->bindparam(':description', $this->description);
		
		$nb->execute();
		$nbligne = $pdo->lastInsertidSC();
		$this->setAttr('idSC', $nbligne);
		
		return $nb;
		
		
		
	}*/
	

	public static function findByidSC($idSC) {
		$query = "SELECT * FROM sous_categorie WHERE idSC = $idSC";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);
		
		if(!$obj){
			return(false);
		}
		
		
			
				
				$Scategorie = new SousCategorie();
				
				$Scategorie->setAttr('idSC', $obj->idSC);
				$Scategorie->setAttr('libelleSC', $obj->libelleSC);
				$Scategorie->setAttr('idC', $obj->idC);
		
		
		return($Scategorie);
		
	
		
	}
	

	
	public static function findAll() {
		
		$query = "SELECT * FROM sous_categorie";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
			throw new Exception('ODBC query error : '.$query.' : '.odbc_error());
		}
		$res = array();
			while($row = odbc_fetch_object($dbres)){
			
				
				$Scategorie = new SousCategorie();
				$Scategorie->idSC = $row->idSC;
				$Scategorie->libelleSC = $row->libelleSC;
				$Scategorie->idC = $row->idC;
				array_push($res, $Scategorie);
			
		}
		return $res;
	}
	
	public static function findBylibelleSC($libelleSC){
		
		$query = "SELECT * FROM sous_categorie WHERE libelleSC = '$libelleSC'";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			return(false);
		}
		
		

		if(!$obj){
			echo("Aucune catégorie ayant ce libelle");
			return(null);	
		}
		else{ 
		$Scategorie = new SousCategorie();
				
				$Scategorie->setAttr('idSC', $obj->idSC);
				$Scategorie->setAttr('libelleSC', $obj->libelleSC);
				$Scategorie->setAttr('idC', $obj->idC);

		
		return($Scategorie);
		}
		
	}



	
}



?>
