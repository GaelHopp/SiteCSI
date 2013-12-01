<?php

include_once "SousCategorie.php";
include_once "Categorie.php";
include_once "Users.php";


class Vue{ 
	
	function AffichePage($menuleft, $content) {
		
		echo "<!DOCTYPE html>
<html lang=\"fr\"><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\" /> 
    <title>Site de troc</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <!-- Le styles -->
    <link href=\"bootstrap/css/bootstrap.css\" rel=\"stylesheet\">
    <link id=\"switch_style\" href=\"http://bootswatch.com//bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
    <link href=\"css/jquery.rating.css\" rel=\"stylesheet\">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src=\"//html5shim.googlecode.com/svn/trunk/html5.js\"></script>
    <![endif]-->

  </head>
  <!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src=\"js/jquery.min.js\"></script>
<script src=\"bootstrap/js/bootstrap.js\"></script>
<script src=\"js/jquery.rating.pack.js\"></script>
<script>
$(function() {
	$('#theme_switcher ul li a').bind('click',
		function(e) {
			$(\"#switch_style\").attr(\"href\", \"http://bootswatch.com/\"+$(this).attr('rel')+\"/bootstrap.min.css\");    		
			return false;
		}
	);
});

/* SCRIPT MENU */
$(document).ready(function(){    
	//on cache tout
	$('.connect_ombre').hide();
	$('.connect').hide();
	//on click et on affiche tout !!
    $('.enreg').click(function () {

        $('.connect_ombre').slideToggle('fast');
		$('.connect').slideToggle('fast');

    });

});
</script>
  <body>

 


    <div class=\"container\">
		<div class=\"row\"><!-- start header -->
			<div class=\"span4 logo\">
			<a href=\"index.html\">
				<h1>Site de troqué</h1>
			</a>
			</div>
			<div class=\"span8\">
			
				<div class=\"row\">
					<div class=\"span1\">&nbsp;</div>
					</div>
				<br />";


		
		if(empty($_SESSION)){
			

			echo "<div class=\"row\">
					<div class=\"links pull-right\">
						<a href=\"contact.html\">Contact</a> | 
						<a href=\"register.html\">S'inscrire</a> | 
						<a href=\"#\" class=\"enreg\">Se connecter</a>
					</div>

					<!-- Surplus connexion :) -->
				<div class=\"connect_ombre\">
				<div class=\"connect\">
				

				<form class=\"\">
					<fieldset>
						<div class=\"control-group\">
							<label for=\"focusedInput\" class=\"control-label\"><b>Pseudo</b></label>
							<div class=\"controls\">
							<input type=\"text\" placeholder=\"Entrez votre pseudo\" id=\"username\" class=\"input-xlarge focused\">
							</div>
						</div>
						<div class=\"control-group\">
							<label class=\"control-label\"><b>Mot de passe</b></label>
							<div class=\"controls\">
							<input type=\"password\" placeholder=\"Entrez votre mot de passe\" id=\"password\" class=\"input-xlarge\">
							</div>
						</div>

						<button class=\"btn btn-primary pull-right\" type=\"submit\">Login</button>
					</fieldset>
				</form>
				</div>
				</div>
				<!-- fin Surplus connexion :) -->";
		}
		else{
			
			echo "<div class=\"row\">
					<div class=\"links pull-right\">
						<a href=\"index.html\">Home</a> |
						<a href=\"my_account.html\">Mon compte</a> |
						<a href=\"cart.html\">Mes demandes (2)</a> |
						<a href=\"two-column.html\">A propos</a> |
						<a href=\"contact.html\">Contact</a> | 
					</div>";
				
			
		}


		echo "</div>
			</div>
		</div><!-- end header -->";





		echo "<div class=\"row\"><!-- start nav -->
			<div class=\"span12\">
			  <div class=\"navbar\">
					<div class=\"navbar-inner\">
					  <div class=\"container\" style=\"width: auto;\">
						<a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
						  <span class=\"icon-bar\"></span>

						  <span class=\"icon-bar\"></span>
						  <span class=\"icon-bar\"></span>
						</a>
						<div class=\"nav-collapse\">
						  <ul class=\"nav\">";
							 

						  	$listeCategories = Categorie::findAll();

						  	foreach($listeCategories as $categorie){

						  		echo "<li class=\"dropdown\">
							  	<a href=\"category.html\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">". $categorie->getAttr('libelleC') . "<b class=\"caret\"></b></a>
							  	<ul class=\"dropdown-menu\">";

							 $listeSousCategories = $categorie->findAllSousCat();

							 		foreach($listeSousCategories as $sousCategorie){

							 			echo "<li><a href=\"listings.html\">".$sousCategorie->getAttr('libelleSC')."</a></li>";

							 		}

							 	echo "</ul>
									</li>";
						  	}


							  

						echo  "<ul class=\"nav pull-right\">
						   <li class=\"divider-vertical\"></li>
							<form class=\"navbar-search\" action=\"\">
								<input type=\"text\" class=\"search-query span2\" placeholder=\"Search\">
								<button class=\"btn btn-primary btn-small search_btn\" type=\"submit\">Go</button>
							</form>
							
						  </ul>
						</div><!-- /.nav-collapse -->
					  </div>
					</div><!-- /navbar-inner -->
				</div><!-- /navbar -->
			</div>
		</div><!-- end nav -->";




		echo($menuleft);

		echo($content);
		
		
		
				


		echo "<footer>
	<hr />
	<div class=\"row well no_margin_left\">

	<div class=\"span3\">
		<h4>Information</h4>
		<ul>
			<li><a href=\"two-column.html\">About Us</a></li>
			<li><a href=\"typography.html\">Delivery Information</a></li>
			<li><a href=\"typography.html\">Privacy Policy</a></li>
			<li><a href=\"typography.html\">Terms &amp; Conditions</a></li>
		</ul>
	</div>
	<div class=\"span3\">
		<h4>Customer Service</h4>
		<ul>
			<li><a href=\"contact.html\">Contact Us</a></li>
			<li><a href=\"typography.html\">Returns</a></li>
			<li><a href=\"typography.html\">Site Map</a></li>
		</ul>
	</div>
	<div class=\"span3\">
		<h4>Extras</h4>
		<ul>
			<li><a href=\"typography.html\">Brands</a></li>
			<li><a href=\"typography.html\">Gift Vouchers</a></li>
			<li><a href=\"typography.html\">Affiliates</a></li>
			<li><a href=\"typography.html\">Specials</a></li>
		</ul>
	</div>
	<div class=\"span2\">
		<h4>My Account</h4>
		<ul>
			<li><a href=\"my_account.html\">My Account</a></li>
			<li><a href=\"typography.html\">Order History</a></li>
			<li><a href=\"typography.html\">Wish List</a></li>
			<li><a href=\"typography.html\">Newsletter</a></li>
		</ul>
	</div>

</footer>

</div> <!-- /container -->


<!--<div id=\"theme_switcher\">
	<div class=\"btn-group\">
		<a class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Switch theme <span class=\"caret\"></span></a>
		<ul class=\"dropdown-menu\">
            <li><a href=\"#\" rel=\"united\">United</a></li>
            <li><a href=\"#\" rel=\"spacelab\">Spacelab</a></li>
			<li><a href=\"#\" rel=\"journal\">Journal</a></li>
			<li><a href=\"#\" rel=\"simplex\">Simplex</a></li>
            <li><a href=\"#\" rel=\"cerulean\">Cerulean</a></li>
			<li><a href=\"#\" rel=\"cyborg\">Cyborg</a></li>
            <li><a href=\"#\" rel=\"slate\">Slate</a></li>
            <li><a href=\"#\" rel=\"spruce\">Spruce</a></li>
			<li><a href=\"#\" rel=\"\">Bootstrap</a></li>
		</ul>
	</div>
</div> -->

</body>
</html>";
		
	}
	
	
	
	
	function afficheBillet($billet){
		
		$html = "<span class = \"underline\">Billet n°".$billet->getAttr('id')."</span><div class=\"centrer\"><h3><b><span class = \"underline\">".$billet->getAttr('titre')."</span></b></h3></div><br/>";
		$titreC = Categorie::findById($billet->getAttr('cat_id'));
		$html .= "<p class = \"right\"><span class = \"underline\">Catégorie :</span> ".$titreC->getAttr('titre')."    </p><br/><br/>";
		$html .= $billet->getAttr('body')."<br/><br/>";
		$u = Users::findById($billet->getAttr('iduser'));
		$html .= "<p class = \"right\">Posté par : <a href=\"Blog.php?action=profil&amp;id=".$u->getAttr('id')."\">".$u->getAttr('pseudo')."</a><i> le ".$billet->getAttr('date')."</i></p><br/><hr/>";
		if((!empty($_SESSION)) && (($_SESSION['id'] == $billet->getAttr('iduser')) || ($_SESSION['statut'] == "admin"))){ 
		
		$html .= "<p style=\"float: left;\"><a href=\"Admin.php?action=editB&amp;id=".$billet->getAttr('id')."\">Editer ce billet</a></p>
			<p style=\"float: right;\"><a href=\"Admin.php?action=deleteB&amp;id=".$billet->getAttr('id')."\">Supprimer ce billet</a></p>";
		}
		
		return($html);
	}
	
	
	function afficheBilletL($billet){
		
		$html = "<span class = \"underline\">Billet n°".$billet->getAttr('id')."</span><div class=\"centrer\"><h3><b><span class = \"underline\">".$billet->getAttr('titre')."</span></b></h3></div><br/>";
		$titreC = Categorie::findById($billet->getAttr('cat_id'));
		$html .= "<p class = \"right\"><span class = \"underline\">Catégorie :</span> ".$titreC->getAttr('titre')."    </p><br/><br/>";
		$chaine = $billet->getAttr('body');
		$fin = substr($chaine, 40);
		$final = str_replace($fin, "...  <a href = Blog.php?action=detail&amp;id=".$billet->getAttr('id').">[Lire la suite]</a>", $chaine);
		$html .= $final."<br/><br/>";
		$u = Users::findById($billet->getAttr('iduser'));
		$html .= "<p class = \"right\">Posté par : <a href=\"Blog.php?action=profil&amp;id=".$u->getAttr('id')."\">".$u->getAttr('pseudo')."</a><i> le ".$billet->getAttr('date')."</i></p><br/><hr/>";
		if((!empty($_SESSION)) && (($_SESSION['id'] == $billet->getAttr('iduser')) || (($_SESSION['statut'] == "admin") ||($_SESSION['statut'] == "superAdmin")))){ 
		
		$html .= "<p style=\"float: left;\"><a href=\"Admin.php?action=editB&amp;id=".$billet->getAttr('id')."\">Editer ce billet</a></p>
			<p style=\"float: right;\"><a href=\"Admin.php?action=deleteB&amp;id=".$billet->getAttr('id')."\">Supprimer ce billet</a></p>";
		}
		
		return($html);
	}
	
	
	
	function afficheCat($categorie){
		
		$html = "<span class = \"underline\">Catégorie n°".$categorie->getAttr('id')."</span><div class=\"centrer\"><h3><b><span class = \"underline\">".$categorie->getAttr('titre')."</span></b></h3></div><br/>";
		$html .= $categorie->getAttr('description')."<br/><br/><hr/>";
		if($categorie->getAttr('id') != 1){
			if((!empty($_SESSION)) && (($_SESSION['statut'] == "admin") || ($_SESSION['statut'] == "superAdmin"))){
				$html .= "<p style=\"float: left;\"><a href=\"Admin.php?action=editC&amp;id=".$categorie->getAttr('id')."\">Editer cette catégorie</a></p>
					<p style=\"float: right;\"><a href=\"Admin.php?action=deleteC&amp;id=".$categorie->getAttr('id')."\">Supprimer cette catégorie</a></p>";
				
			}
		}
		return($html);
	}
	
	function afficheListeBillet($billets){
		
		$html = "<div><table class = \"tableau\" cellspacing=\"20\" border=\"5\"><caption><span class = \"titre\"><b> Liste des billets</b></span></caption> ";
		
		foreach($billets as $billet){
			$html .= "<tr><td class = \"tableauB\">".$this->afficheBilletL($billet)."</td></tr>";
		}
		$html .= "</table></div>";
		
		return($html);
	}
	
	function afficheListeCat($categories){
		
		$html = "<div><table class = \"tableau\" cellspacing=\"20\" border=\"5\"><caption> <span class = \"titre\"><b>Liste des catégories</b></span></caption>";
		
		foreach($categories as $categorie){
			$html .= "<tr><td class = \"tableauC\">".$this->afficheCat($categorie)."</td></tr>";
		}
		$html .= "</table></div>";
		
		return($html);
	}
	
	function menuDroit(){
		
		$billets = Billets::findAll();
		
		$html ="<div class=\"centrer\"><a href=\"Blog.php?action=list\">Tous les billets</a></div><br/> ";
		foreach($billets as $billet){
			$html .= "<div class=\"centrer\"><a href=\"Blog.php?action=detail&amp;id=".$billet->getAttr('id')."\">".$billet->getAttr('titre')."</a></div>";
		}
		if(!empty($_SESSION)){
		$html .= "<br/><div class=\"centrer\"><a href=\"Admin.php?action=addM\">Ajouter un billet</a></div>";
		}
		return($html);
	}
	
	function menuGauche(){
		
		$categories = Categorie::findAll();
		$html = "<div class=\"centrer\"><a href=\"Blog.php?action=listC\">Toutes les catégories</a></div><br/> ";
		foreach($categories as $categorie){
			$html .= "<div class=\"centrer\"><a href=\"Blog.php?action=cat&amp;id=".$categorie->getAttr('id')."\">".$categorie->getAttr('titre')."</a></div>";
		}
		if((!empty($_SESSION)) && (($_SESSION['statut'] == "admin") || ($_SESSION['statut'] == "superAdmin"))){
		$html .= "<br/><div class=\"centrer\"><a href=\"Admin.php?action=addC\">Ajouter une catégorie</a></div>";
		}
		return($html);
	}
	
	function ajoutCategorie(){
		$html = "<form action=\"Admin.php?action=addC\" method=\"post\">
			<p class = \"centrer\">
			<input type=\"text\" name=\"titre\" value=\"titre de votre catégorie\" /><br/><br/>
			<textarea name=\"description\" rows=\"15\" cols=\"60\">
			Votre description ici </textarea><br/><br/>
			<input type=\"submit\" name=\"valider\" value=\"Valider\" />
			</p>
			</form>";
		
		return($html);
	}
	
	function ajoutBillet(){
		$html = "<form action=\"Admin.php?action=addM\" method=\"post\">
			<p class = \"centrer\"> <input type=\"text\" name=\"titre\" value= \"titre de votre billet\"/><br/><br/>
			<textarea name=\"body\" rows=\"15\" cols=\"60\">
			Votre message ici
			</textarea><br/><br/>
			<select name=\"categorie\">";
		
		$lc = Categorie::findAll();
		foreach($lc as $cat){
			
			$html .= "<option value=\"".$cat->getAttr('id')."\">".$cat->getAttr('titre')."</option>";
		}
		
		$html .= "</select><br/><br/>
			<input type=\"submit\" value=\"Valider\" />
			</p>
			</form>";
		
		return($html);
	}
	
	
	function editBillet($billet){ 
		
		$idB = $billet->getAttr('id');
		$titreB = $billet->getAttr('titre');
		$bodyB = $billet->getAttr('body');
		
		$html = "<form action=\"Admin.php?action=editB&amp;id=$idB\" method=\"post\">
			<p class=\"centrer\"> <input type=\"text\" name=\"titre\" value= \"$titreB\"/><br/><br/>
			<textarea name=\"body\" rows=\"15\" cols=\"60\">
			$bodyB
			</textarea><br/><br/>
			
			<select name=\"categorie\">";
		
		$lc = Categorie::findAll();
		foreach($lc as $cat){
			if($cat->getAttr('id') == $billet->getAttr('cat_id')){
				$html .= "<option value=\"".$cat->getAttr('id')."\" selected = \"selected\">".$cat->getAttr('titre')."</option>";
			}
			else{
				$html .= "<option value=\"".$cat->getAttr('id')."\">".$cat->getAttr('titre')."</option>";
			}
		}
		
		$html .= "</select><br/><br/>
			<input type=\"submit\" value=\"Valider\" />
			</p>
			</form>";
		
		return($html);
	}
	
	
	function editCat($categorie){ 
		
		$idC = $categorie->getAttr('id');
		$titreC = $categorie->getAttr('titre');
		$descriptionC = $categorie->getAttr('description');
		
		$html = "<form action=\"Admin.php?action=editC&amp;id=$idC\" method=\"post\">
			<p class=\"centrer\"> <input type=\"text\" name=\"titre\" value= \"$titreC\"/><br/><br/>
			<textarea name=\"description\" rows=\"15\" cols=\"60\">
			$descriptionC
			</textarea><br/><br/>
			
			
			<input type=\"submit\" value=\"Valider\" />
			</p>
			</form>";
		
		return($html);
	}
	
	function deleteBillet($billet){
		$idB = $billet->getAttr('id');
		
		$html = "<div class=\"centrer\"><h2>Êtes vous sûr de vouloir supprimer ce billet ?</h2><br/>
			<form action=\"Admin.php?action=deleteB&amp;id=$idB\" method=\"post\">
			<p>
			<input type=\"submit\" name= \"Oui\" value=\"Oui\" />
			<input type=\"submit\" name= \"Non\" value=\"Non\" /></p></form></div>";
		
		return($html);
	}
	
	function deleteCat($categorie){
		$idC = $categorie->getAttr('id');
		
		$html = "<div class=\"centrer\"><h2>Êtes vous sûr de vouloir supprimer cette catégorie ?</h2><br/>
			<form action=\"Admin.php?action=deleteC&amp;id=$idC\" method=\"post\">
			<p>
			<input type=\"submit\" name= \"Oui\" value=\"Oui\" />
			<input type=\"submit\" name= \"Non\" value=\"Non\" /></p></form></div>";
		
		return($html);
	}
	
	
	function inscription(){
		$html = "<form action=\"Admin.php?action=register\" method=\"post\">
			<p>
			<span class = \"formulaire\">Pseudo : </span><input type=\"text\" name=\"pseudo\" value=\"Votre pseudo\" /><br/>
			<span class = \"formulaire\">Mot de passe : </span><input type=\"password\" name=\"password\" value=\"mdp\" /><br/>
			<span class = \"formulaire\">E-Mail : </span><input type=\"text\" name=\"mail\" value=\"Votre mail\" /><br/>
			<span class = \"formulaire\">Sexe : </span><select name=\"sexe\">
   			<option value=\"Homme\">Homme</option>
    		<option value=\"Homme\">Femme</option>
			</select><br/>
			<span class = \"formulaire\">Pays : </span><input type=\"text\" name=\"pays\" value=\"Votre pays\" /><br/>	
			<span class = \"formulaire\">Ville : </span><input type=\"text\" name=\"ville\" value=\"Votre ville\" /><br/>
			<span class = \"description\">&nbsp;</span><textarea name=\"description\" rows=\"15\" cols=\"60\">
			Votre description
			</textarea><br/>				
			<span class = \"formulaire\">&nbsp; </span><input type=\"submit\" value=\"Valider\"  />
			</p>
			</form>";
		
		return($html);
	}
	
	function connexion(){
		
		$html = "<form action=\"Admin.php?action=login\" method=\"post\">
			<p class=\"centrer\">
			Pseudo : <input type=\"text\" name=\"pseudo\" value=\"Votre pseudo\" /><br/>
			Mot de passe :<input type=\"password\" name=\"password\" value=\"mdp\" /><br/>
			<input type=\"submit\" value=\"Valider\"  />
			</p>
			</form>";
		
		
		return($html);
		
	}
	
	function profil($user){
		$html = "<div class=\"centrer\"><span class = \"underline\">".$user->getAttr('pseudo')."</span>
				<br/><br/>".$user->getAttr('mail')."
				<br/><br/>".$user->getAttr('sexe')."
				<br/><br/>".$user->getAttr('pays')."
				<br/><br/>".$user->getAttr('ville')."
				<br/><br/>".$user->getAttr('description')."</div>";
				if($_SESSION['id'] == $user->getAttr('id')){
				$html .= "<p class = \"right\"><a href=\"Admin.php?action=editP&amp;id=".$user->getAttr('id')."\">Editer le profil</a></p>"; 		
				}
				return($html);
	}
	
	function deleteUser($user){
		$idU = $user->getAttr('id');
		
		$html = "<div class=\"centrer\"><h2>Êtes vous sûr de vouloir supprimer cet utilisateur ?</h2><br/>
			<form action=\"Admin.php?action=deleteU&amp;id=$idU\" method=\"post\"><p>
			<input type=\"submit\" name= \"Oui\" value=\"Oui\" />
			<input type=\"submit\" name= \"Non\" value=\"Non\" /></p></form></div>";
		
		return($html);
	}
	
	
	function addAdmin($user){
		$idU = $user->getAttr('id');
		
		$html = "<div class=\"centrer\"><h2>Êtes vous sûr de vouloir donner les droits d'administrateur à cet utilisateur ?</h2><br/>
			<form action=\"Admin.php?action=addAdmin&amp;id=$idU\" method=\"post\"><p>
			<input type=\"submit\" name= \"Oui\" value=\"Oui\" />
			<input type=\"submit\" name= \"Non\" value=\"Non\" /></p></form></div>";
		
		return($html);
	}
	
	function deleteAdmin($user){
		$idU = $user->getAttr('id');
		
		$html = "<div class=\"centrer\"><h2>Êtes vous sûr de vouloir ôter les droits d'administrateur à cet utilisateur ?</h2><br/>
			<form action=\"Admin.php?action=deleteAdmin&amp;id=$idU\" method=\"post\"><p>
			<input type=\"submit\" name= \"Oui\" value=\"Oui\" />
			<input type=\"submit\" name= \"Non\" value=\"Non\" /></p></form></div>";
		
		return($html);
	}
	
	function afficheListeUsers($users){
		
		$html = "<div><table class = \"tableau\" border=\"5\" cellspacing=\"10\" cellpadding=\"30\"><caption><span class = \"titre\"><b> Liste des utilisateurs</b></span> </caption>";
		
		foreach($users as $user){
			$idU = $user->getAttr('id');
			$html .= "<tr><td >".$user->getAttr('statut')."</td>";
			$html .= "<td ><a href=\"Blog.php?action=profil&amp;id=$idU\">".$user->getAttr('pseudo')."</a></td>";
			$html .= "<td >".$user->getAttr('mail')."</td>";
			if(($_SESSION['statut'] == "superAdmin") && ($idU != 1) && ($_SESSION['id'] != $idU)){
				$html .= "<td><a href=\"Admin.php?action=deleteU&amp;id=$idU\">Supprimer cet utilisateur</a></td>";
				if($user->getAttr('statut') != "admin"){
					$html .= "<td><a href=\"Admin.php?action=addAdmin&amp;id=$idU\">Ajouter un administrateur</a></td></tr>";
				}
				else{
					if($_SESSION['statut'] == "superAdmin"){
						$html .= "<td><a href=\"Admin.php?action=deleteAdmin&amp;id=$idU\">Supprimer un administrateur</a></td></tr>";
					}
				}
			}
			else{
				$html .= "</tr>";
			}
			
		}
		$html .= "</table></div>";
		
		return($html);
	}
	
	function editProfil($user){
		
		$html = "<form action=\"Admin.php?action=editP&amp;id=".$user->getAttr('id')."\" method=\"post\">
			<p class=\"centrer\">
			Pseudo : <input type=\"text\" name=\"pseudo\" value=\"".$user->getAttr('pseudo')."\" /><br/>
			Mot de passe : <input type=\"password\" name=\"password\" value=\"".$user->getAttr('password')."\" /><br/>
			E-Mail : <input type=\"text\" name=\"mail\" value=\"".$user->getAttr('mail')."\" /><br/>
			Sexe : <select name=\"sexe\">
   			<option value=\"Homme\">Homme</option>
    		<option value=\"Homme\">Femme</option>
			</select><br/>
			Pays : <input type=\"text\" name=\"pays\" value=\"".$user->getAttr('pays')."\" /><br/>
			Ville : <input type=\"text\" name=\"ville\" value=\"".$user->getAttr('ville')."\" /><br/>		
			<textarea name=\"description\" rows=\"15\" cols=\"60\">
			".$user->getAttr('description')."
			</textarea><div class=\"centrer\"><br/>				
			<input type=\"submit\" value=\"Valider\"  />
			</p>
			</form>";
		
		return($html);
		
		
	}
	
	
	function firstRegister(){
		$html = "<div class = \"centrer\">Veuillez entrez le mot de passe administrateur ! </div>
				<div class = \"centrer\">Login = admin</div>
				<form action=\"Blog.php?action=firstR\" method=\"post\">
			<p class = \"centrer\">
			Mot de passe : <input type=\"password\" name=\"password\" value=\"mdp\" /><br/>				
			<input type=\"submit\" value=\"Valider\"  />
			</p>
			</form>";
		
		return($html);
	}
	
}

?>
