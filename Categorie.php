<?php


  
class Categorie {
	
	
	private $id ; 
	
	

	private $titre;
	

	private $description;
	
	
	
	
	public function __construct() {

	}
	
	
	
	public function __toString() {
		return "[". __CLASS__ . "] id : ". $this->id . ":
		titre  ". $this->titre  .":
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
		if (!isset($this->id)) {
			return $this->insert();
		} else {
			return $this->update();
		}
	}
	

	public function update() {
		
		if (!isset($this->id)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
		} 
		
		
		$save_query = "update categorie set titre= :titre, description = :description where id= :id";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($save_query);
		$nb->bindparam(':titre', $this->titre);
		$nb->bindparam(':description', $this->description);
		$nb->bindparam(':id', $this->id);
		$nb->execute();
		
		return $nb;
		
	}
	

	public function delete() {
		
		if (!isset($this->id)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "delete from Categorie
			where id= :id";
		$pdo = Base::getConnection();
		$nb=$pdo->prepare($delete_query);
		$nb->bindparam(':id', $this->id);
		$nb->execute();
		
		return $nb;
		
		
		
	}
	
								
	public function insert() {
		

		
		$insert_query = "INSERT INTO Categorie VALUES('', :titre, :description)";
		$pdo = Base::getConnection();
		
		$nb = $pdo->prepare($insert_query);
		$nb->bindparam(':titre', $this->titre);
		$nb->bindparam(':description', $this->description);
		
		$nb->execute();
		$nbligne = $pdo->lastInsertId();
		$this->setAttr('id', $nbligne);
		
		return $nb;
		
		
		
	}
	

	public static function findById($id) {
		$query = "select * from categorie where id= :id";
		$pdo = Base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->bindparam(':id', $id);
		$dbres->execute();
		
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		
		$obj = $dbres->fetch(PDO::FETCH_OBJ);
			
				
				$categorie = new Categorie();
				
				$categorie->setAttr('id', $obj->id);
				$categorie->setAttr('titre', $obj->titre);
				$categorie->setAttr('description', $obj->description);
		
		
		return($categorie);
		
	
		
	}
	

	
	public static function findAll() {
		
		$query = "select * from categorie order by titre asc";
		$c = Base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->execute();
		
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		$res = array();
			while($row = $dbres->fetch(PDO::FETCH_ASSOC)){
			
				
				$categorie = new Categorie();
				$categorie->id = $row['id'];
				$categorie->titre = $row['titre'];
				$categorie->description = $row['description'];
				array_push($res, $categorie);
			
		}
		return $res;
	}
	
	public static function findByTitre($titre){
		
		$query = "select * from categorie where titre= :titre";
		$pdo = Base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->bindparam(':titre', $titre);
		$dbres->execute();

		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		
		$obj = $dbres->fetch(PDO::FETCH_OBJ);

		if(!$obj){
			echo("Aucune catégorie ayant ce titre");
			return(null);	
		}
		else{ 
		$categorie = new Categorie();
				
				$categorie->setAttr('id', $obj->id);
				$categorie->setAttr('titre', $obj->titre);
				$categorie->setAttr('description', $obj->description);
		
		
		return($categorie);
		}
		
	}
}



?>
