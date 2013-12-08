	<?php
	/* 
	 * To change this template, choose Tools | Templates
	 * and open the template in the editor.
	 */


	include_once 'Produit.php';


	echo "<h1>Site test ....</h1>";

	echo "<b>Test 1 : parcours des produit : </b><br/>" ;


	$lp = Produit::findAll();

	foreach ($lp as $p) {
	    echo "idp : " . $p->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $p->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $p->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $p->getAttr('descriptionP') . "<br/>" ;
	    echo "libelleP : " . $p->getAttr('libelleP') . "<br/>" ;

	}



	echo "<br/><b>Test 2 : trouver un produit par son libellé : </b><br/><br/>" ;

	echo "Recherche de produit avec le libelle Macbook air <br/><br/>";

	$lp = Produit::findBylibelle("Macbook air");

	if($lp){
		 echo "idp : " . $lp->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $lp->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $lp->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $lp->getAttr('descriptionP') . "<br/>" ;
	}else{
		echo "Pas de produit correspond au libelle demandé" . "<br/><br/>";
	}

	echo "<br/>Recherche de produit avec un faux libelle <br/><br/>";

	$lp = Produit::findBylibelle("Fake lib");

	if($lp){
		 echo "idp : " . $lp->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $lp->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $lp->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $lp->getAttr('descriptionP') . "<br/>" ;
	}else{
		echo "Pas de produit correspond au libelle demandé" . "<br/><br/>";
	}


	echo "<br/><b>Test 3 : trouver un produit par son ID produit : </b><br/><br/>" ;

	echo "Recherche de produit avec l'id 8 <br/><br/>";

	$lp = Produit::findByidP(8);

	if($lp){
		echo "idp : " . $lp->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $lp->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $lp->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $lp->getAttr('descriptionP') . "<br/>" ;
	    print("<img src=images/". $lp->getAttr('idP')."/".Produit::recupImage( $lp->getAttr('idP')).">" );
	}else{
		echo "Pas de produit correspond au libelle demandé" . "<br/><br/>";
	}

	echo "<br/>Recherche de produit avec un id non existant <br/><br/>";

	$lp = Produit::findByidP(32);

	if($lp){
		 echo "idp : " . $lp->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $lp->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $lp->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $lp->getAttr('descriptionP') . "<br/>" ;
	}else{
		echo "Pas de produit correspond à l'id demandé" . "<br/><br/>";
	}

	echo "<br/><b>Test 4 : trouver les produits actifs: </b><br/><br/>" ;

	$lp = Produit::findActif();

	foreach ($lp as $p) {
	    echo "idp : " . $p->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $p->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $p->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $p->getAttr('descriptionP') . "<br/>" ;
	    echo "libelleP : " . $p->getAttr('libelleP') . "<br/>" ;

	}

	echo "<br/><b>Test 5 : trouver les produits passifs: </b><br/><br/>" ;

	$lp = Produit::findPassif();

	foreach ($lp as $p) {
	    echo "idp : " . $p->getAttr('idP') . "<br/>" ;
	    echo "typeP : " . $p->getAttr('typeP') . "<br/>" ;
	    echo "idsC : " . $p->getAttr('idSC') . "<br/>" ;
	    echo "descriptionP : " . $p->getAttr('descriptionP') . "<br/>" ;
	    echo "libelleP : " . $p->getAttr('libelleP') . "<br/>" ;

	}

	/*echo "<b>Test 6 : insertion d'un produit : </b><br/><br/>" ;

	echo "Insertion d'un produit non existant<br/><br/>";*/


	$prod = new Produit();

	$prod->setAttr('typeP', "Actif");
	$prod->setAttr('idSC', 3);
	$prod->setAttr('visible', "Vrai");
	$prod->setAttr('idU', 1);
	$prod->setAttr('dateDeb', '2013-11-26 00:00:00');
	$prod->setAttr('dateFin', NULL);
	$prod->setAttr('etatP', "Neuf");
	$prod->setAttr('modeEchange', "A son domicile");
	$prod->setAttr('libelleP', "Ipad Air");
	$prod->setAttr('descriptionP', "Ipad Air de 2013 32go");
	

/*	$prod->insert();
*/
/*	$idproduit = $prod->getAttr('idP');           A réactiver pour l'insertion d'image

/*	echo"<form method='POST' action = 'upload.php' enctype='multipart/form-data' >              A réactiver pour l'insertion d'image
	     <input type='hidden' name='MAX_FILE_SIZE' value='10000000'>
	     <input type='hidden' name='idProd' value= $idproduit >
	     Fichier : <input type='file' name='avatar'>
	     <input type='submit' name='envoyer' value='Valider le formulaire'>
	</form>";*/

