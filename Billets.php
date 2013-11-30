<?php


class Billets{
	
	private $id;
	
	private $titre;
	
	private $body;
	
	private $cat_id;
	
	private $date;
	
	private $iduser;
	
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
			$this->$attr_name= strip_tags($attr_val); 
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
		
		
		$save_query = "update billets set titre= :titre, body= :body, cat_id= :cat_id, date=NOW(), iduser= :iduser 
				where id= :id";
		$pdo = Base::getConnection();
	
		$nb = $pdo->prepare($save_query);
		$nb->bindparam(':titre', $this->titre);
		$nb->bindparam(':body', $this->body);
		$nb->bindparam(':cat_id', $this->cat_id);
		$nb->bindparam(':iduser', $this->iduser);
		$nb->bindparam(':id', $this->id);
		$nb->execute();
		
		return $nb;
		
	}
	
	
	
	
	public function delete() {
		
		if (!isset($this->id)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
		} 
		
		
		$delete_query = "delete from billets
			where id= :id";
		$pdo = Base::getConnection();
		$nb = $pdo->prepare($delete_query);
		$nb->bindparam(':id', $this->id);
		$nb->execute();
		
		return $nb;
		
		
		
	}
	
	
	
	public function insert() {
		

		
		$insert_query = "INSERT INTO billets VALUES('',:titre, :body, :cat_id, NOW(), :iduser)";
		$pdo = Base::getConnection();
		$nb = $pdo->prepare($insert_query);
		$nb->bindparam(':titre', $this->titre);
		$nb->bindparam(':body', $this->body);
		$nb->bindparam(':cat_id', $this->cat_id);
		$nb->bindparam(':iduser', $this->iduser);
		$nb->execute();
		$nbligne = $pdo->lastInsertId();
		$this->setAttr('id', $nbligne);
		
		return $nb;
		
		
		
	}
	
	
	
	
	public static function findById($id) {
		$query = "select * from billets where id= :id";
		$pdo = Base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->bindparam(':id', $id);
		$dbres->execute();
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		
		$obj = $dbres->fetch(PDO::FETCH_OBJ);
			
				
				$billet = new Billets();
				
				$billet->setAttr('id', $obj->id);
				$billet->setAttr('titre', $obj->titre);
				$billet->setAttr('body', $obj->body);
				$billet->setAttr('cat_id', $obj->cat_id);
				$billet->setAttr('date', $obj->date);
				$billet->setAttr('iduser', $obj->iduser);
		
		
		return($billet);
		
	
		
	}
	
	
	
	public static function findAll() {
		
		$query = "select * from billets order by titre asc";
		$c = Base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->execute();
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		$res = array();
			while($row = $dbres->fetch(PDO::FETCH_ASSOC)){
			
				
				$billet = new Billets();
				$billet->id = $row['id'];
				$billet->titre = $row['titre'];
				$billet->body = $row['body'];
				$billet->cat_id = $row['cat_id'];
				$billet->date = $row['date'];
				$billet->iduser = $row['iduser'];
				array_push($res, $billet);
			
		}
		return $res;
	}
	
	
	
	public static function findByTitre($titre){
		
		$query = "select * from billets where titre= :titre";
		$pdo = Base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->bindparam(':titre', $titre);
		$dbres->execute();

		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		
		$obj = $dbres->fetch(PDO::FETCH_OBJ);

		if(!$obj){
			echo("Aucun billet ayant ce titre");
			return(null);	
		}
		else{
			
				
				$billet = new Billets();
				
				$billet->setAttr('id', $obj->id);
				$billet->setAttr('titre', $obj->titre);
				$billet->setAttr('body', $obj->body);
				$billet->setAttr('cat_id', $obj->cat_id);
				$billet->setAttr('date', $obj->date);
				$billet->setAttr('iduser', $obj->iduser);
		
		
		return($billet);
		}
		
	}
	
	
	public static function findByCat($cat) {
		
		$query = "select * from billets where cat_id = :cat_id order by titre asc";
		$c = Base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->bindparam(':cat_id', $cat);
		$dbres->execute();
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		$res = array();
			while($row = $dbres->fetch(PDO::FETCH_ASSOC)){
			
				
				$billet = new Billets();
				
				$billet->id = $row['id'];
				$billet->titre = $row['titre'];
				$billet->body = $row['body'];
				$billet->cat_id = $row['cat_id'];
				$billet->date = $row['date'];
				$billet->iduser = $row['iduser'];
				array_push($res, $billet);
			
		}
		return $res;
	}
	
	
	public static function findByUser($id) {
		
		$query = "select * from billets where iduser = :iduser order by titre asc";
		$c = Base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->bindparam(':iduser', $id);
		$dbres->execute();
		if(!$dbres){
			throw new Exception('Mysql query error : '.$query.' : '.mysql_error());
		}
		$res = array();
			while($row = $dbres->fetch(PDO::FETCH_ASSOC)){
			
				
				$billet = new Billets();
				
				$billet->id = $row['id'];
				$billet->titre = $row['titre'];
				$billet->body = $row['body'];
				$billet->cat_id = $row['cat_id'];
				$billet->date = $row['date'];
				$billet->iduser = $row['iduser'];
				array_push($res, $billet);
			
		}
		return $res;
	}
	
}

?>
