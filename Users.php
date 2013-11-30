<?php

include "Base.php";

class Users{
	
	private $idU;
	
	private $nomU;
	
	private $prenomU;
	
	private $adresseU;
	
	private $melU;
	
	private $idL;

	private $login;

	private $mdp;

	
	
	public function __construct() {
		
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
	
	
	
	public function delete() {
		
		if (!isset($this->idU)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "delete from users
			where idU= :idU";
		$pdo = Base::getConnection();
		$nb=$pdo->prepare($delete_query);
		$nb->bindparam(':idU', $this->idU);
		$nb->execute();
		
		return $nb;
		
		
		
	}
	
	
	
	public function insert() {
		
		
		
		$c = Base::getConnection();

		$queryTest = "Select * from logs where login = '$this->login'";
		$resTest = odbc_exec($c, $queryTest);
		$userTest = odbc_fetch_object($resTest);

		if(!$userTest){
		
		$query = "INSERT INTO logs VALUES('$this->login', '$this->mdp')";
		$res = odbc_exec($c, $query);
		
		$resInt = odbc_exec($c, "Select * from logs where login = '$this->login'");
		$usr = odbc_fetch_object($resInt);
		
		$query2 = "INSERT INTO utilisateur VALUES('$this->nomU', '$this->prenomU', '$this->adresseU', '$this->melU', $usr->idL)";
		$res2 = odbc_exec($c, $query2);
	
		
		return $res2;
		}
		else{

			return(false);
		}
	}	
		
	
	public function save() {
		if (!isset($this->idU)) {
			return $this->insert();
		} else {
			return $this->update();
		}
	}
	
	
	public function update() {
		
		
		
		$queryUser = "UPDATE utilisateur SET nomU = '$this->nomU', prenomU = '$this->prenomU', adresseU = '$this->adresseU', melU = '$this->melU'
				WHERE idU = $this->idU";

		$queryLogs = "UPDATE logs SET login = '$this->login', mdp = '$this->mdp' WHERE idL = $this->idL ";
				
				
				$c = Base::getConnection();
				$res = odbc_exec($c, $queryUser);
				$res2 = odbc_exec($c, $queryLogs);
				$c = Base::getConnection();
		
		return $res;

		
	}
	
	
	
	
	public static function findAll() {
		
		$query = "select * from utilisateur order by nomU asc";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		if(!$dbres){
			throw new Exception('ODBC error : '.$query.' : '.odbc_error());
		}
		$res = array();
		while($row = odbc_fetch_object($dbres)){
			

			
			$user = new Users();
			$user->idU = $row->idU;
			$user->nomU = $row->nomU;
			$user->prenomU = $row->prenomU;
			$user->adresseU = $row->adresseU;
			$user->melU = $row->melU;
			$user->idL = $row->idL;
			array_push($res, $user);
			
		}

		
		return $res;
	}
	
	
	
	public static function findByID($idU){
		
		$query = "select * from utilisateur where idU = $idU";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
			throw new Exception('ODBC query error : '.$query.' : '.odbc_error());
		}
		
		$obj = odbc_fetch_object($dbres);
		
		if(!$obj){
		
			return(null);	
		}
		else{
			
			
			$user = new Users();
			
			$user->setAttr('idU', $obj->idU);
			$user->setAttr('nomU', $obj->nomU);
			$user->setAttr('prenomU', $obj->prenomU);
			$user->setAttr('adresseU', $obj->adresseU);
			$user->setAttr('melU', $obj->melU);
			$user->setAttr('idL', $obj->idL);
			
			
			return($user);
		}
	}


	public static function findByIDL($idL){
		
		$query = "select * from utilisateur where idL= $idL";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
			throw new Exception('ODBC query error : '.$query.' : '.odbc_error());
		}
		
		$obj = odbc_fetch_object($dbres);
		
		if(!$obj){
		
			return(null);	
		}
		else{
			
			
			$user = new Users();
			
			$user->setAttr('idU', $obj->idU);
			$user->setAttr('nomU', $obj->nomU);
			$user->setAttr('prenomU', $obj->prenomU);
			$user->setAttr('adresseU', $obj->adresseU);
			$user->setAttr('melU', $obj->melU);
			$user->setAttr('idL', $obj->idL);
			
			
			return($user);
		}
	}
	
	public static function findByPseudo($login){
		
		$query = "select * from logs where login = '$login'";
		$c = Base::getConnection();
		$dbres = odbc_exec($c, $query);
		
		if(!$dbres){
			throw new Exception('ODBC query error : '.$query.' : '.odbc_error());
		}
		
		$log = odbc_fetch_object($dbres);
		
		if(!$log){
			return(null);	
		}
		else{
			

			$user = self::findByIDL($log->idL);
			
			
			return($user);
		}
		
		
		
		
	}	
	
	
}
?>
