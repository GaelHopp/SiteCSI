<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'Categorie.php';
include_once 'SousCategorie.php';

echo "<h1>Site test ....</h1>";

echo "<b>Test 1 : parcours des sous categories : </b><br/>" ;


$lsc = SousCategorie::findAll();

foreach ($lsc as $scat) {
    echo "idSC : " . $scat->getAttr('idSC') . "<br/>" ;
    echo "nom : " . $scat->getAttr('libelleSC') . "<br/>" ;
    echo "idC : " . $scat->getAttr('idC') . "<br/>" ;

  

}



echo "<b>Test 2 : trouver une sous categorie par son ID : </b><br/><br/>" ;

echo "Recherche de la sous categorie d'ID 2<br/><br/>";

$scat = SousCategorie::findByidSC(2);

	if($scat){
   		echo "idSC : " . $scat->getAttr('idSC') . "<br/>" ;
    echo "nom : " . $scat->getAttr('libelleSC') . "<br/>" ;
    echo "idC : " . $scat->getAttr('idC') . "<br/>" ;
	}
	else{
		echo "pas de sous categorie de cet ID";
	}

echo "Recherche d'une catégorie d'ID incorrect<br/><br/>";


$scat = SousCategorie::findByidSC(1337);

	if($scat){
    	echo "idSC : " . $scat->getAttr('idSC') . "<br/>" ;
    echo "nom : " . $scat->getAttr('libelleSC') . "<br/>" ;
    echo "idC : " . $scat->getAttr('idC') . "<br/>" ;
	}
	else{
		echo "pas de sous categorie de cet ID<br/><br/>";
	}

	echo "<b>Test 3 : trouver une sous categorie par son libelle</b><br/><br/>" ;

	echo "Recherche de la sous categorie de libelle Ordinateurs portables <br/><br/>";


	$scat = SousCategorie::findBylibelleSC("Ordinateurs portable");

	if($scat){
    	echo "idSC : " . $scat->getAttr('idSC') . "<br/>" ;
    echo "nom : " . $scat->getAttr('libelleSC') . "<br/>" ;
    echo "idC : " . $scat->getAttr('idC') . "<br/>" ;
	}
	else{
		echo "pas de catégorie de ce libelle<br/>";
	}

	echo "Recherche d'une catégorie de libelle incorrect<br/><br/>";


	$scat2 = SousCategorie::findBylibelleSC("Informatica");

	if($scat2){
    echo "idSC : " . $scat->getAttr('idSC') . "<br/>" ;
    echo "nom : " . $scat->getAttr('libelleSC') . "<br/>" ;
    echo "idC : " . $scat->getAttr('idC') . "<br/>" ;
	}
	else{
		echo "pas de catégorie de ce libelle<br/>";
	}



	echo "<b>Test 4 : Affichage de toutes la categorie correspondant a une sous categorie</b><br/><br/>" ;

	
	$cat = Categorie::findByidC($scat->getAttr('idC'));

    
    echo "id : " . $cat->getAttr('idC') . "<br/>" ;
    echo "nom : " . $cat->getAttr('libelleC') . "<br/>" ;
	
	





