<?php

include_once "Souhait.php";
include_once "Base.php";

class Troc {
	
	
	private $idT; 
	
	private $dateT;
	
	private $mode_echange_final;
	
	private $effectif;

	private $idU1; 
	
	private $idU2;

	private $idP1;
	
	private $idP2;
	
	
	


	

	
	
	
	
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
	


	

	
								
	public function insert() {
		
			$query = "INSERT INTO troc VALUES('$this->dateT', '$this->mode_echange_final', '$this->effectif', $this->idU1, $this->idU2, $this->idP1, $this->idP2)";



		$c = Base::getConnection();


		$dbres = odbc_exec($c, $query);

	
		
	}


	

	public static function findByUser($idU) {
		$query = "SELECT * FROM troc WHERE idU1 = ".$idU;
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		$obj = odbc_fetch_object($dbres);

		if(!$obj){
			return(false);
		}
		else{
			
			
				
				$troc = new Troc();
				
				$troc->setAttr('idT', $obj->idT);
				$troc->setAttr('dateT', $obj->dateT);
				$troc->setAttr('mode_echange_final', $obj->mode_echange_final);
				$troc->setAttr('effectif', $obj->effectif);
				$troc->setAttr('idU1', $obj->idU1);
				$troc->setAttr('idU2', $obj->idU2);
				$troc->setAttr('idP1', $obj->idP1);
				$troc->setAttr('idP2', $obj->idP2);

				



			
		
		
		return($troc);
		}
	
		
	}

	

}



?>
