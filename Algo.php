<?php


class Appariement{

	public $objet1;
	public $objet2;


	function paire($obj1, $obj2){

		$this->objet1 = $obj1;
		$this->objet2 = $obj2;

	}


}





class NoeudListeAttente{



	public $listeAppariements = array();
	public $distance = 0;


	public function ajouterAppariement($app){


		array_push($this->listeAppariements, $app);

	}

	public function ajouterDistance($dist){

		$this->distance += $dist;

	}



}



class Algo{





public static function algorithme($tableauValeur){

$trouve = false;

$listeAttente = array();

for($i=1; $i < sizeof($tableauValeur)+1; $i++){



	for($j=$i+1; $j < sizeof($tableauValeur[$i])+$i+1; $j++){


		$app = new Appariement();

		$app->paire($i, $j);


		$noeud = new NoeudListeAttente();
		$noeud->ajouterAppariement($app);
		
		$distance = $tableauValeur[$i][$j];
		$noeud->ajouterDistance($distance);

		$listeAttente[$distance] = $noeud;




}


}
	ksort($listeAttente);


		while(!empty($listeAttente) && !$trouve){

			list($key, $val) = each($listeAttente);

			echo("BBBB : ".$key."<br/>");	// J'arrive pas à récup le premier ID du tableau

			$id = $array[0];

			echo($array[0]);

			$noeudEtudie = $listeAttente[$id];

			unset($listeAttente[$id]);


			foreach ($listeAttente as $key => $value) {
				echo($key."<br/>");
			}

		}




}

}







$tableauValeur = array();


$tableauValeur[1][2] = 54;
$tableauValeur[1][3] = 27;
$tableauValeur[1][4] = 32;
$tableauValeur[1][5] = 88;
$tableauValeur[1][6] = 12;
$tableauValeur[2][3] = 62;
$tableauValeur[2][4] = 44;
$tableauValeur[2][5] = 87;
$tableauValeur[2][6] = 98;
$tableauValeur[3][4] = 17;
$tableauValeur[3][5] = 20;
$tableauValeur[3][6] = 30;
$tableauValeur[4][5] = 64;
$tableauValeur[4][6] = 77;
$tableauValeur[5][6] = 29;




Algo::algorithme($tableauValeur);






?>
