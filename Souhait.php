<?php

include_once "Produit.php";
include_once "Base.php";

class Souhait {
	
	
	private $idP; 
	
	private $idU;
	
	private $idP2;
	
	private $date_souhait;
	


	

	
	
	
	
	public function __construct() {

	}
	
	
	
	public function __toString() {
		return "[". __CLASS__ . "] idP : ". $this->idP . ":
		libelleP  ". $this->libelleP;
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
	}*/
	


	

	public function delete() {
		
		if (!isset($this->idP)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "DELETE FROM souhait_echange
			WHERE idP= $this->idP and idU = $this->idU";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, delete_query);
		
		return $dbres;
		
		
		
	}
	
								
	public function insert() {
		

		$query = "INSERT INTO souhait_echange VALUES($this->idP, $this->idU, $this->idP2, '$this->date_souhait')";
		
		$c = Base::getConnection();
		
		$dbres = odbc_exec($c, $query);

		return $dbres;

	
		
	}


	

	public static function findByidP($idP) {
		$query = "SELECT * FROM souhait_echange WHERE idP = ".$idP;
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			return(false);
		}
		else{
			
			
				
				$souhait = new Souhait();
				
				$souhait->setAttr('idP', $obj->idP);
				$souhait->setAttr('idU', $obj->idU);
				$souhait->setAttr('idP2', $obj->idP2);
				$souhait->setAttr('date_souhait', $obj->date_souhait);
				



			
		
		
		return($souhait);
		}
	
		
	}
	

	
	public static function findAll() {
		
		$query = "SELECT * FROM souhait_echange";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			
			while($obj = odbc_fetch_object($dbres)){
			
				
			$souhait = new Souhait();
				
				$souhait->setAttr('idP', $obj->idP);
				$souhait->setAttr('idU', $obj->idU);
				$souhait->setAttr('idP2', $obj->idP2);
				$souhait->setAttr('date_souhait', $obj->date_souhait);
				

				array_push($res, $souhait);
			
		}
	}
	return $res;
		
	}


	
	public static function findByUserVendeur($idU){
		
		$query = "SELECT souhait_echange.* FROM souhait_echange, possession WHERE possession.idU = $idU AND possession.idP = souhait_echange.idP";
		


		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

	if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			
			while($obj = odbc_fetch_object($dbres)){
			
			
				
				$souhait = new Souhait();
				
				$souhait->setAttr('idP', $obj->idP);
				$souhait->setAttr('idU', $obj->idU);
				$souhait->setAttr('idP2', $obj->idP2);
				$souhait->setAttr('date_souhait', $obj->date_souhait);


				
			}
		
		
		return($souhait);
		}
		
		
	}


	public static function findByUserAcheteur($idU){
		
		$query = "SELECT * FROM souhait_echange WHERE idU = $idU";
		


		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

	if(!$dbres){
				return(false);		
			}
			else{
			$res = array();
			
			while($obj = odbc_fetch_object($dbres)){
			
			
				
				$souhait = new Souhait();
				
				$souhait->setAttr('idP', $obj->idP);
				$souhait->setAttr('idU', $obj->idU);
				$souhait->setAttr('idP2', $obj->idP2);
				$souhait->setAttr('date_souhait', $obj->date_souhait);


				
			}
		
		
		return($souhait);
		}
		
		
	}



}



?>
