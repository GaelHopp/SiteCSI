<?php


  
class Categorie {
	
	
	private $idC ; 
	
	

	private $lebelleC;
	

	
	
	
	
	public function __construct() {

	}
	
	
	
	public function __toString() {
		return "[". __CLASS__ . "] idC : ". $this->idC . ":
		lebelleC  ". $this->lebelleC  .":
		description ". $this->description  ;
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
		
		
		$save_query = "update categorie set lebelleC= :lebelleC, description = :description where idC= :idC";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($save_query);
		$nb->bindparam(':lebelleC', $this->lebelleC);
		$nb->bindparam(':description', $this->description);
		$nb->bindparam(':idC', $this->idC);
		$nb->execute();
		
		return $nb;
		
	}
	

	public function delete() {
		
		if (!isset($this->idC)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "delete from Categorie
			where idC= :idC";
		$pdo = Base::getConnection();
		$nb=$pdo->prepare($delete_query);
		$nb->bindparam(':idC', $this->idC);
		$nb->execute();
		
		return $nb;
		
		
		
	}
	
								
	public function insert() {
		

		
		$insert_query = "INSERT INTO Categorie VALUES('', :lebelleC, :description)";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($insert_query);
		$nb->bindparam(':lebelleC', $this->lebelleC);
		$nb->bindparam(':description', $this->description);
		
		$nb->execute();
		$nbligne = $pdo->lastInsertidC();
		$this->setAttr('idC', $nbligne);
		
		return $nb;
		
		
		
	}
	

	public static function findByidC($idC) {
		$query = "select * from categorie where idC= :idC";
		$pdo = Base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->bindparam(':idC', $idC);
		$dbres->execute();
		
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		
		$obj = $dbres->fetch(PDO::FETCH_OBJ);
			
				
				$categorie = new Categorie();
				
				$categorie->setAttr('idC', $obj->idC);
				$categorie->setAttr('lebelleC', $obj->lebelleC);
				$categorie->setAttr('description', $obj->description);
		
		
		return($categorie);
		
	
		
	}
	

	
	public static function findAll() {
		
		$query = "select * from categorie order by lebelleC asc";
		$c = Base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->execute();
		
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		$res = array();
			while($row = $dbres->fetch(PDO::FETCH_ASSOC)){
			
				
				$categorie = new Categorie();
				$categorie->idC = $row['idC'];
				$categorie->lebelleC = $row['lebelleC'];
				$categorie->description = $row['description'];
				array_push($res, $categorie);
			
		}
		return $res;
	}
	
	public static function findBylebelleC($lebelleC){
		
		$query = "select * from categorie where lebelleC= :lebelleC";
		$pdo = Base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->bindparam(':lebelleC', $lebelleC);
		$dbres->execute();

		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		
		$obj = $dbres->fetch(PDO::FETCH_OBJ);

		if(!$obj){
			echo("Aucune catégorie ayant ce lebelleC");
			return(null);	
		}
		else{ 
		$categorie = new Categorie();
				
				$categorie->setAttr('idC', $obj->idC);
				$categorie->setAttr('lebelleC', $obj->lebelleC);
				$categorie->setAttr('description', $obj->description);
		
		
		return($categorie);
		}
		
	}
}



?>
