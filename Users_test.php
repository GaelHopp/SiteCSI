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


$user = Users::findByID(1337);

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



	echo "<b>Test 4 : insertion d'un user : </b><br/><br/>" ;

	echo "Insertion d'un utilisateur non existant<br/><br/>";


	$user = new Users();

	$user->setAttr('login', "AnneSo");
	$user->setAttr('mdp', "AnneSo");
	$user->setAttr('nomU', "Duhaut");
	$user->setAttr('prenomU', "Anne-Sophie");
	$user->setAttr('adresseU', "Par la");
	$user->setAttr('melU', "AnneSo@yopmail.com");

	//$user->insert();


echo "<b>Test 5 : update d'un user : </b><br/><br/>" ;

	echo "Update d'un utilisateur existant<br/><br/>";

	$user2 = Users::findByPseudo("AnneSo");
	$user2->setAttr('nomU', "Raleuse");
	$user2->setAttr('prenomU', "Fu-Girl");

	$user2->update();




