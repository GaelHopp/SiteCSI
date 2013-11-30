<?php

include_once "SousCategorie.php";
include "Base.php";

class Categorie {
	
	
	private $idC ; 
	
	

	private $libelleC;
	

	
	
	
	
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
	
	
	/*
	public function save() {
		if (!isset($this->idC)) {
			return $this->insert();
		} else {
			return $this->update();
		}
	}
	

	public function update() {
		
		if (!isset($this->idC)) {
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
		
		if (!isset($this->idC)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "DELETE FROME Categorie
			WHERE idC= :idC";
		$pdo = Base::getConnection();
		$nb=$pdo->prepare($delete_query);
		$nb->bindparam(':idC', $this->idC);
		$nb->execute();
		
		return $nb;
		
		
		
	}
	
								
	public function insert() {
		

		
		$insert_query = "INSERT INTO Categorie VALUES('', :libelleC, :description)";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($insert_query);
		$nb->bindparam(':libelleC', $this->libelleC);
		$nb->bindparam(':description', $this->description);
		
		$nb->execute();
		$nbligne = $pdo->lastInsertidC();
		$this->setAttr('idC', $nbligne);
		
		return $nb;
		
		
		
	}*/
	

	public static function findByidC($idC) {
		$query = "SELECT * FROM categorie WHERE idC = $idC";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			return(false);
		}
		else{
			
			
				
				$categorie = new Categorie();
				
				$categorie->setAttr('idC', $obj->idC);
				$categorie->setAttr('libelleC', $obj->libelleC);
		
		
		return($categorie);
		}
	
		
	}
	

	
	public static function findAll() {
		
		$query = "SELECT * FROM categorie";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			while($row = odbc_fetch_object($dbres)){
			
				
				$categorie = new Categorie();
				$categorie->idC = $row->idC;
				$categorie->libelleC = $row->libelleC;
				array_push($res, $categorie);
			return $res;
		}
	}
		
	}
	
	public static function findBylibelleC($libelleC){
		
		$query = "SELECT * FROM categorie WHERE libelleC = '$libelleC'";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);

		if(!$dbres){
			throw new Exception('ODBC query error : '.$query.' : '.odbc_error());
		}
		
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			echo("Aucune catégorie ayant ce libelle");
			return(null);	
		}
		else{ 
		$categorie = new Categorie();
				
				$categorie->setAttr('idC', $obj->idC);
				$categorie->setAttr('libelleC', $obj->libelleC);
		
		
		return($categorie);
		}
		
	}



	public function findAllSousCat() {
		
		$query = "SELECT * FROM sous_categorie WHERE idC = $this->idC";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
			throw new Exception('ODBC query error : '.$query.' : '.odbc_error());
		}
		$res = array();
			while($row = odbc_fetch_object($dbres)){
			
				
				$Scategorie = new SousCategorie();
				$Scategorie->setAttr('idSC', $row->idSC);
				$Scategorie->setAttr('libelleSC', $row->libelleSC);
				$Scategorie->setAttr('idC', $row->idC);
				array_push($res, $Scategorie);
			
		}
		return $res;
	}
}



?>
