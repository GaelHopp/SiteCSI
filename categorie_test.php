<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'Categorie.php';
include_once 'SousCategorie.php';

echo "<h1>Site test ....</h1>";

echo "<b>Test 1 : parcours des categories : </b><br/>" ;


$lc = Categorie::findAll();

foreach ($lc as $cat) {
    echo "id : " . $cat->getAttr('idC') . "<br/>" ;
    echo "nom : " . $cat->getAttr('libelleC') . "<br/>" ;
  

}



echo "<b>Test 2 : trouver une catégorie par son ID : </b><br/><br/>" ;

echo "Recherche de la catégorie d'ID 2<br/><br/>";

$cat = Categorie::findByidC(2);

	if($cat){
   		echo "id : " . $cat->getAttr('idC') . "<br/>" ;
    	echo "nom : " . $cat->getAttr('libelleC') . "<br/>" ;
	}
	else{
		echo "pas de catégorie de cet ID";
	}

echo "Recherche d'une catégorie d'ID incorrect<br/><br/>";


$cat = Categorie::findByidC(1337);

	if($cat){
    	echo "id : " . $cat->getAttr('idC') . "<br/>" ;
    	echo "nom : " . $cat->getAttr('libelleC') . "<br/>" ;
	}
	else{
		echo "pas de catégorie de cet ID<br/><br/>";
	}

	echo "<b>Test 3 : trouver une catégorie par son libelle</b><br/><br/>" ;

	echo "Recherche de la catégorie de libelle Informatique <br/><br/>";


	$cat = Categorie::findBylibelleC("Informatique");

	if($cat){
    	echo "id : " . $cat->getAttr('idC') . "<br/>" ;
    	echo "nom : " . $cat->getAttr('libelleC') . "<br/>" ;
	}
	else{
		echo "pas de catégorie de ce libelle<br/>";
	}

	echo "Recherche d'une catégorie de libelle incorrect<br/><br/>";


	$cat2 = Categorie::findBylibelleC("Informatica");

	if($cat2){
    echo "id : " . $cat->getAttr('idC') . "<br/>" ;
    echo "nom : " . $cat->getAttr('libelleC') . "<br/>" ;
	}
	else{
		echo "pas de catégorie de ce libelle<br/>";
	}



	echo "<b>Test 4 : Affichage de toutes les sous catégories de la categorie Informatique : </b><br/><br/>" ;

	
	$lsouscat = $cat->findAllSousCat();

	foreach($lsouscat as $souscat){
    
    echo "id : " . $souscat->getAttr('idSC') . "<br/>" ;
    echo "nom : " . $souscat->getAttr('libelleSC') . "<br/>" ;
	}
	





