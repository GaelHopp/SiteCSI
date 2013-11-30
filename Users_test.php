<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'Users.php';

echo "<h1>Site test ....</h1>";

echo "<b>Test 1 : parcours des users : </b><br/>" ;


$lu = Users::findAll();

foreach ($lu as $user) {
    echo "id : " . $user->getAttr('idU') . "<br/>" ;
    echo "nom : " . $user->getAttr('nomU') . "<br/>" ;
    echo "prenom : " . $user->getAttr('prenomU') . "<br/>" ;
     echo "adresse : " . $user->getAttr('adresseU') . "<br/>" ;
      echo "mail : " . $user->getAttr('melU') . "<br/>" ;
       echo "idL : " . $user->getAttr('idL') . "<br/></br>" ;

}



echo "<b>Test 2 : trouver un user par son ID : </b><br/><br/>" ;

echo "Recherche de l'utilisateur d'ID 1<br/><br/>";

$user = Users::findByID(1);

	if($user){
    echo "nom : " . $user->getAttr('nomU') . "<br/>" ;
    echo "prenom : " . $user->getAttr('prenomU') . "<br/>" ;
     echo "adresse : " . $user->getAttr('adresseU') . "<br/>" ;
      echo "mail : " . $user->getAttr('melU') . "<br/>" ;
       echo "idL : " . $user->getAttr('idL') . "<br/></br>" ;
	}
	else{
		echo "pas d'utilisateur de cet ID";
	}

echo "Recherche de l'utilisateur d'ID incorrect<br/><br/>";


$user = Users::findByID(3);

	if($user){
    echo "nom : " . $user->getAttr('nomU') . "<br/>" ;
    echo "prenom : " . $user->getAttr('prenomU') . "<br/>" ;
     echo "adresse : " . $user->getAttr('adresseU') . "<br/>" ;
      echo "mail : " . $user->getAttr('melU') . "<br/>" ;
       echo "idL : " . $user->getAttr('idL') . "<br/></br>" ;
	}
	else{
		echo "pas d'utilisateur de cet ID<br/><br/>";
	}

	echo "<b>Test 3 : trouver un user par son pseudo : </b><br/><br/>" ;

	echo "Recherche de l'utilisateur de pseudo Hopp<br/><br/>";


	$user = Users::findByPseudo("Hopp");

	if($user){
    echo "nom : " . $user->getAttr('nomU') . "<br/>" ;
    echo "prenom : " . $user->getAttr('prenomU') . "<br/>" ;
     echo "adresse : " . $user->getAttr('adresseU') . "<br/>" ;
      echo "mail : " . $user->getAttr('melU') . "<br/>" ;
       echo "idL : " . $user->getAttr('idL') . "<br/></br>" ;
	}
	else{
		echo "pas d'utilisateur de ce pseudo<br/>";
	}

	echo "Recherche de l'utilisateur de pseudo incorrect<br/><br/>";


	$user = Users::findByPseudo("Ho");

	if($user){
    echo "nom : " . $user->getAttr('nomU') . "<br/>" ;
    echo "prenom : " . $user->getAttr('prenomU') . "<br/>" ;
     echo "adresse : " . $user->getAttr('adresseU') . "<br/>" ;
      echo "mail : " . $user->getAttr('melU') . "<br/>" ;
       echo "idL : " . $user->getAttr('idL') . "<br/></br>" ;
	}
	else{
		echo "pas d'utilisateur de ce pseudo<br/>";
	}



