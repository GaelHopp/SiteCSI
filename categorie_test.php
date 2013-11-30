<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'Users.php';

echo "<h1>Site test ....</h1>";

echo "<b>Test 1 : parcours des users : </b><br/>" ;


$lu = Users::findAll();

foreach ($lc as $user) {
    echo "id : " . $user->getAttr('idU') . "<br/>" ;
    echo "nom : " . $user->getAttr('nomU') . "<br/>" ;
    echo "prenom : " . $user->getAttr('prenomU') . "<br/><br/>" ;
     echo "adresse : " . $user->getAttr('adresseU') . "<br/><br/>" ;
      echo "mail : " . $user->getAttr('melU') . "<br/><br/>" ;
       echo "idL : " . $user->getAttr('idL') . "<br/><br/>" ;

}

