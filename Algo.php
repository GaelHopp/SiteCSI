<?php


include_once "Produit.php";


class Appariement{

	public $objet1;
	public $objet2;


	function paire($obj1, $obj2){

		$this->objet1 = $obj1;
		$this->objet2 = $obj2;

	}

	public static function egal($a1, $a2){

		$appEgal = false;

		if($a1->objet1 == $a2->objet1 && $a1->objet2 == $a2->objet2){

			$appEgal = true;
		}

		return($appEgal);


	}


}






















class NoeudListeAttente{



	public $listeAppariements = array();
	public $distance = 0;


	public function ajouterAppariement($app){


		array_push($this->listeAppariements, $app);

	}


	public function enleverDernierAppariement(){
		array_pop($this->listeAppariements);
	}

	public function ajouterDistance($dist){

		$this->distance += $dist;

	}


	public function compterAppariements(){

		$nb = sizeof($this->listeAppariements);

		return($nb);
	}


	public function coupleExiste($obj1, $obj2){


		$existe = false;


		foreach ($this->listeAppariements as $value) {
			
		

			if($value->objet1 == $obj1 || $value->objet1 == $obj2 
				|| $value->objet2 == $obj1 || $value->objet2 == $obj2){

				$existe = true;
			}


		
			
		}


		return($existe);
	}




	public function affiche(){

		echo "<br/> Affichage de la liste d'appariement solution ! <br/>";

		foreach ($this->listeAppariements as $value) {
			
			echo("(".$value->objet1.", ".$value->objet2.")<br/>");
		}

		echo("<br/> Distance totale : ".$this->distance);

	}


	public static function egal($n1, $n2){					// Test si la longueur entre 2 liste d'appariements est la même

		$listeEgale = false;
		$listeEgaleFinale = true;

		if(count($n1->listeAppariements) == count($n2->listeAppariements)){

			foreach ($n1->listeAppariements as $value1) {
				
				$listeEgale = false;

				foreach ($n2->listeAppariements as $value2) {
					
				$trouve = Appariement::egal($value1, $value2);
				
				if($trouve){
					
					$listeEgale = true;
				}
			}
				if(!$listeEgale){
					$listeEgaleFinale = false;
					break;
				}

			}

		}

		return($listeEgale);

	}



}
























class Algo{



public static function noeudExiste($tabNoeud, $noeud){				// Teste si un noeud existe déjà dans la liste


	$existe = false;



	foreach ($tabNoeud as $n) {


		$bool = NoeudListeAttente::egal($n, $noeud);


		if($bool){
				
				$existe = true;
			}
		

	}


	

	return($existe);
}






public static function insereTri($tableauNoeud, $noeud){		// Insère le noeud dans la liste de façon triée en fonction de son coût 




	$i = 0;



	if(!empty($tableauNoeud)){



	while($i < sizeof($tableauNoeud) && $tableauNoeud[$i]->distance <= $noeud->distance){

		

		$i++;
	}


	for($j = sizeof($tableauNoeud); $j > $i; $j--){

		$tableauNoeud[$j] = $tableauNoeud[$j-1];
		
	}

}

	$tableauNoeud[$i] = $noeud;


	

	

	return($tableauNoeud);

}







public static function successeur($noeud, $tab, $listeA){				// fonction successeur 



$min = 100;

$obj1 = null;
$obj2 = null;

$listeProduit = Produit::findAll();


for($i=0; $i < sizeof($tab); $i++){


	for($j=$i+1; $j < sizeof($tab[$i])+$i+1; $j++){





		if(!$noeud->coupleExiste($listeProduit[$i]->getAttr('idP'), $listeProduit[$j]->getAttr('idP')) && $tab[$i][$j] < $min){



			$appTemp = new Appariement();
			$appTemp->paire($listeProduit[$i], $listeProduit[$i]);

			$noeud->ajouterAppariement($appTemp);

			$test = Algo::noeudExiste($listeA, $noeud);



			if(!$test){

			$min = $tab[$i][$j];
			$obj1 = $listeProduit[$i]->getAttr('idP');
			$obj2 = $listeProduit[$j]->getAttr('idP');

		}

			$noeud->enleverDernierAppariement();


		 }

	}

}

	
	$app = new Appariement();
	$app->paire($obj1, $obj2);

	

	$noeud->ajouterAppariement($app);
	$noeud->ajouterDistance($min);


	return($noeud);





}





public static function initialisation(){				// Initialise les coefficients d'appariement en fonction des critères

	$tableauValeur = array();

	$listeProduit = Produit::findAll();

	


	for($i=0; $i < sizeof($listeProduit)-1; $i++){

		for($j=$i+1; $j < sizeof($listeProduit); $j++){

			$coeffEtat = 0;
		$coeffCategorie = 20;
		$coeffdateAchat = 10;

			$produit1 = $listeProduit[$i];
			$produit2 = $listeProduit[$j];

			

			if($produit1->getAttr('etatP') == $produit2->getAttr('etatP')){

				$coeffEtat = 29;
			}



			if($produit1->getAttr('etatP') == "Neuf"){

				if($produit2->getAttr('etatP') == "Bon etat"){

					$coeffEtat = 15;
				}
			}


			if($produit1->getAttr('etatP') == "Bon etat"){

				if($produit2->getAttr('etatP') == "Neuf" || $produit2->getAttr('etatP') == "Etat moyen"){

					$coeffEtat = 15;
				}
			}

			if($produit1->getAttr('etatP') == "Etat moyen"){

				if($produit2->getAttr('etatP') == "Bon etat" || $produit2->getAttr('etatP') == "Mauvais etat"){

					$coeffEtat = 15;
				}
			}

			if($produit1->getAttr('etatP') == "Mauvais etat"){

				if($produit2->getAttr('etatP') == "Etat moyen" || $produit2->getAttr('etatP') == "Très mauvais etat"){

					$coeffEtat = 15;
				}
			}


			if($produit1->getAttr('etatP') == "Très mauvais etat"){

				if($produit2->getAttr('etatP') == "Mauvais etat" || $produit2->getAttr('etatP') == "Pour pieces"){

					$coeffEtat = 15;
				}
			}

			if($produit1->getAttr('etatP') == "Pour pieces"){

				if($produit2->getAttr('etatP') == "Très mauvais etat"){

					$coeffEtat = 15;
				}
			}


			if($produit1->getAttr('idSC') != $produit2->getAttr('idSC')){

				$coeffCategorie = 0;

			}


			$diffDate = abs($produit1->getAttr('annee_achat') - $produit2->getAttr('annee_achat'));
			

			if($diffDate < 5){
				$coeffdateAchat = $coeffdateAchat - (2*$diffDate);
			}

			if($diffDate >= 5){
				$coeffdateAchat = 0;
			}



			$coeffTotal = 100 - $coeffEtat - $coeffCategorie - $coeffdateAchat;


			$tableauValeur[$i][$j] = $coeffTotal;

		}
	}


	return($tableauValeur);
}




public static function algorithme($tableauValeur, $nbObjets){

$trouve = false;

$solution = null;

$listeAttente = array();

$listeProduit = Produit::findAll();

for($i=0; $i < sizeof($tableauValeur)-1; $i++){									// Initialise la liste avec tous les fils de la racine



	for($j=$i+1; $j < sizeof($tableauValeur[$i])+$i+1; $j++){


		$app = new Appariement();

		$app->paire($listeProduit[$i]->getAttr('idP'), $listeProduit[$j]->getAttr('idP'));


		$noeud = new NoeudListeAttente();
		$noeud->ajouterAppariement($app);
		
		$distance = $tableauValeur[$i][$j];
		$noeud->ajouterDistance($distance);


		$listeAttente = Algo::insereTri($listeAttente, $noeud);
		
	


}


}



	

		while(!empty($listeAttente) && !$trouve){



			$noeudEtudie = $listeAttente[0];

			array_shift($listeAttente);

		


			if($noeudEtudie->compterAppariements() == floor($nbObjets/2)){ 

			$trouve = true;

			$solution = $noeudEtudie;



		}

		else{

			$successeur = Algo::successeur($noeudEtudie, $tableauValeur, $listeAttente);


			$listeAttente = Algo::insereTri($listeAttente, $successeur);

		}



	}	

	return($solution);
}

}







// $tableauValeur = array();


// $tableauValeur[1][2] = 27;
// $tableauValeur[1][3] = 34;
// $tableauValeur[1][4] = 67;
// $tableauValeur[1][5] = 8;
// $tableauValeur[1][6] = 89;
// $tableauValeur[1][7] = 90;
// $tableauValeur[1][8] = 12;
// $tableauValeur[1][9] = 49;
// $tableauValeur[1][10] = 22;
// $tableauValeur[1][11] = 45;
// $tableauValeur[2][3] = 71;
// $tableauValeur[2][4] = 53;
// $tableauValeur[2][5] = 33;
// $tableauValeur[2][6] = 67;
// $tableauValeur[2][7] = 95;
// $tableauValeur[2][8] = 47;
// $tableauValeur[2][9] = 39;
// $tableauValeur[2][10] = 12;
// $tableauValeur[2][11] = 25;
// $tableauValeur[3][4] = 83;
// $tableauValeur[3][5] = 17;
// $tableauValeur[3][6] = 32;
// $tableauValeur[3][7] = 69;
// $tableauValeur[3][8] = 21;
// $tableauValeur[3][9] = 18;
// $tableauValeur[3][10] = 1;
// $tableauValeur[3][11] = 78;
// $tableauValeur[4][5] = 91;
// $tableauValeur[4][6] = 61;
// $tableauValeur[4][7] = 58;
// $tableauValeur[4][8] = 31;
// $tableauValeur[4][9] = 72;
// $tableauValeur[4][10] = 4;
// $tableauValeur[4][11] = 53;
// $tableauValeur[5][6] = 34;
// $tableauValeur[5][7] = 7;
// $tableauValeur[5][8] = 64;
// $tableauValeur[5][9] = 82;
// $tableauValeur[5][10] = 20;
// $tableauValeur[5][11] = 44;
// $tableauValeur[6][7] = 60;
// $tableauValeur[6][8] = 31;
// $tableauValeur[6][9] = 27;
// $tableauValeur[6][10] = 36;
// $tableauValeur[6][11] = 95;
// $tableauValeur[7][8] = 2;
// $tableauValeur[7][9] = 1;
// $tableauValeur[7][10] = 47;
// $tableauValeur[7][11] = 48;
// $tableauValeur[8][9] = 74;
// $tableauValeur[8][10] = 89;
// $tableauValeur[8][11] = 88;
// $tableauValeur[9][10] = 61;
// $tableauValeur[9][11] = 66;
// $tableauValeur[10][11] = 14;





// $soluce = Algo::algorithme($tableauValeur, 11);

// $soluce->affiche();


// $tableauValeur[1][2] = 34;
// $tableauValeur[1][3] = 7;
// $tableauValeur[1][4] = 64;
// $tableauValeur[1][5] = 82;
// $tableauValeur[1][6] = 20;
// $tableauValeur[2][3] = 60;
// $tableauValeur[2][4] = 31;
// $tableauValeur[2][5] = 27;
// $tableauValeur[2][6] = 36;
// $tableauValeur[3][4] = 2;
// $tableauValeur[3][5] = 1;
// $tableauValeur[3][6] = 47;
// $tableauValeur[4][5] = 74;
// $tableauValeur[4][6] = 89;
// $tableauValeur[5][6] = 61;

// $soluce = Algo::algorithme($tableauValeur, 6);

// $soluce->affiche();











?>
