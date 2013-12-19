<?php

include_once "SousCategorie.php";
include_once "Categorie.php";
include_once "Users.php";
include_once "Produit.php";
include_once "Souhait.php";
include_once "Algo.php";


class Vue{ 
	
	function AffichePage($menuleft, $content) {
		
		


		echo "<!DOCTYPE html>
<html lang=\"fr\"><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> 
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
			<a href=\"Blog.php\">
				<h1>Site de troc</h1>
			</a>
			</div>
			<div class=\"span8\">
			
				<div class=\"row\">
					<div class=\"span1\">&nbsp;</div>
					</div>
				<br />";

		
		
		if(!isset($_SESSION['login'])){
			
			

			echo "<div class=\"row\">
					<div class=\"links pull-right\">
						<a href=\"\">Contact</a> | 
						<a href=\"Blog.php?action=afficheRegister\">S'inscrire</a> | 
						<a href=\"#\" class=\"enreg\">Se connecter</a>
					</div>

					<!-- Surplus connexion :) -->
				<div class=\"connect_ombre\">
				<div class=\"connect\">
				

				<form class=\"\" action=\"Blog.php?action=login\" method= \"post\">
					<fieldset>
						<div class=\"control-group\">
							<label for=\"focusedInput\" class=\"control-label\"><b>Pseudo</b></label>
							<div class=\"controls\">
							<input type=\"text\" name = \"login\" placeholder=\"Entrez votre pseudo\" id=\"username\" class=\"input-xlarge focused\">
							</div>
						</div>
						<div class=\"control-group\">
							<label class=\"control-label\"><b>Mot de passe</b></label>
							<div class=\"controls\">
							<input type=\"password\" name = \"mdp\" placeholder=\"Entrez votre mot de passe\" id=\"password\" class=\"input-xlarge\">
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
						<a href=\"Blog.php?action=afficheAlgo\">Algo</a> |
						<a href=\"Blog.php?action=afficheSouhait\">Souhaits/Demandes</a> |
						<a href=\"Blog.php?action=listeProduitUser\">Mes produits</a> | 
						<a href=\"Blog.php?action=afficheAjoutProduit\">Ajouter un produit</a> | 
						<a href=\"Blog.php?action=logout\">Déconnexion</a> |
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
							  	<a href= \"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">". $categorie->getAttr('libelleC') . "<b class=\"caret\"></b></a>
							  	<ul class=\"dropdown-menu\">";

							 $listeSousCategories = $categorie->findAllSousCat();

							 		foreach($listeSousCategories as $sousCategorie){
							 			if(!empty($_SESSION)){ 
							 			echo "<li><a href=\"Blog.php?action=afficheListeProduit&amp;id=". $sousCategorie->getAttr('idSC') ."\">".$sousCategorie->getAttr('libelleSC')."</a></li>";
							 			}else{
							 			echo "<li><a href=\"Blog.php?action=registerOuLogin\">".$sousCategorie->getAttr('libelleSC')."</a></li>";

							 			}
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
		</div><!-- end nav -->

		<div class=\"row\">";


		echo($menuleft);

		echo($content);
		
		
		
				


		echo "</div>

		<footer>
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
	
	
	
	
	function afficheSideBar($sousCat){
		
		$html = "<div class=\"span3\">
			<!-- start sidebar -->
<ul class=\"breadcrumb\">
    <li>Categories</span></li>
</ul>
<div class=\"span3 product_list\">
	<ul class=\"nav\">";

	$listeCategories = Categorie::findAll();
	$cat = Categorie::findByIdC($sousCat->getAttr('idC'));

	foreach ($listeCategories as $categorie) {
		
		$html .= "<li>";

		$firstSousCat = $categorie->findFirstIdSC();


		if($cat->getAttr('idC') == $categorie->getAttr('idC')){

			
			$html .= "<a class=\"active\" href=\"Blog.php?action=afficheListeProduit&amp;id=". $firstSousCat->getAttr('idSC') ."\"> ". $categorie->getAttr('libelleC') ."</a>";
		}
		else{

			$html .= "<a href=\"Blog.php?action=afficheListeProduit&amp;id=". $firstSousCat->getAttr('idSC'). "\"> ". $categorie->getAttr('libelleC') ."</a>";


		}

		$html .= "<ul>";

		$listeSousCategorie = $categorie->findAllSousCat();

		foreach ($listeSousCategorie as $sousCategorie) {
				
				$html .= "<li>";


				if($sousCat->getAttr('idSC') == $sousCategorie->getAttr('idSC')){

			$html .= "<a class=\"active\" href=\"Blog.php?action=afficheListeProduit&amp;id=". $sousCategorie->getAttr('idSC') ."\"> -&nbsp;&nbsp;". $sousCategorie->getAttr('libelleSC') ."</a>";
		}
		else{

			$html .= "<a href=\"Blog.php?action=afficheListeProduit&amp;id=". $sousCategorie->getAttr('idSC') ."\"> -&nbsp;&nbsp;". $sousCategorie->getAttr('libelleSC') ."</a>";


		}


			$html .= "</li>";

			}
		$html .= "</ul></li>";


	}
		
	$html .= "</ul> </div><!-- end sidebar -->		</div>";
		
		return($html);
	}



function afficheSideBarNormale(){
		
		$html = "<div class=\"span3\">
			<!-- start sidebar -->
<ul class=\"breadcrumb\">
    <li>Categories</span></li>
</ul>
<div class=\"span3 product_list\">
	<ul class=\"nav\">";

	$listeCategories = Categorie::findAll();
	

	foreach ($listeCategories as $categorie) {
		
		$html .= "<li>";

		
		$firstSousCat = $categorie->findFirstIdSC();

			$html .= "<a href=\"Blog.php?action=afficheListeProduit&amp;id=". $firstSousCat->getAttr('idSC'). "\"> ". $categorie->getAttr('libelleC') ."</a>";


		

		$html .= "<ul>";

		$listeSousCategorie = $categorie->findAllSousCat();

		foreach ($listeSousCategorie as $sousCategorie) {
				
				$html .= "<li>";


				

			$html .= "<a href=\"Blog.php?action=afficheListeProduit&amp;id=". $sousCategorie->getAttr('idSC') ."\"> -&nbsp;&nbsp;". $sousCategorie->getAttr('libelleSC') ."</a>";


		


			$html .= "</li>";

			}
		$html .= "</ul></li>";


	}
		
	$html .= "</ul> </div><!-- end sidebar -->		</div>";
		
		return($html);
	}





	function afficheAccueilGuest(){

		$html = "

		<div class=\"span9\">

			<div id=\"myCarousel\" class=\"carousel slide\">
            <div class=\"carousel-inner\">
              <div class=\"item active\">
		<img src=\"css/images/carousel_1.jpg\" alt=\"\">
                <div class=\"carousel-caption\">
                  <h4>First Thumbnail label</h4>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </div>

              </div>
              <div class=\"item\">
                <img src=\"css/images/carousel_2.jpg\" alt=\"\">
                <div class=\"carousel-caption\">
                  <h4>Second Thumbnail label</h4>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </div>
              </div>

              <div class=\"item\">
		<img src=\"css/images/carousel_3.jpg\" alt=\"\">
                <div class=\"carousel-caption\">
                  <h4>Third Thumbnail label</h4>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </div>
              </div>
            </div>

            <a class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">&lsaquo;</a>
            <a class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">&rsaquo;</a>
          </div>
          </div>
		  
		  
		  
		<div class=\"span7 popular_products\">
		 <h4>Popular products</h4><br />
		<ul class=\"thumbnails\">
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/ps-vita-150cx123.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>PS Vita</h5></a><br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/nexus-one-3-150x123.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>Nexus one</h5></a><br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/thumb_sam_3d.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>Samsung 3D TV</h5></a><br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/ipad_case.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>iPod Case</h5></a><br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/HMX-H104.JPG\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>HMX Camcorder</h5></a><br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/expic.png\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>Kindle Fire</h5></a><br /><br />
            </div>
          </div>
        </li>

      </ul>
		</div>";

		return($html);



	}



	function afficheRegister(){

		$nomU ="";
		$prenomU ="";
		$melU ="";
		$adresseU ="";
		$login ="";
		$mdp = "";

		if(isset($_POST['nomU'])){
			$nomU = $_POST['nomU'];
		}
		if(isset($_POST['prenomU'])){
			$prenomU = $_POST['prenomU'];
		}
		if(isset($_POST['melU'])){
			$melU = $_POST['melU'];
		}
		if(isset($_POST['adresseU'])){
			$adresseU = $_POST['adresseU'];
		}
		if(isset($_POST['login'])){
			$login = $_POST['login'];
		}
		if(isset($_POST['mdp'])){
			$mdp = $_POST['mdp'];
		}


		$html = "<div class=\"span12\">
		<ul class=\"breadcrumb\">
			<li><a href=\"#\">Home</a> <span class=\"divider\">/</span></li>
			<li><a href=\"#\">Mon compte</a> <span class=\"divider\">/</span></li>
			<li class=\"active\"><a href=\"#\">Inscription</a></li>
		</ul>
		</div>

			<div class=\"span12\">
				<h1>Créer un compte</h1>
				
				<br />				
				<form class=\"form-horizontal\" action=\"Blog.php?action=register\" method = \"post\">
					<fieldset>
					<div class=\"span6 no_margin_left\">
						<legend>Vos informations personnelles</legend>
					  <div class=\"control-group\">
						<label class=\"control-label\">Nom</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"text\" name=\"nomU\" value=\"$nomU\" class=\"span4\">
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label\">Prénom</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"text\" name=\"prenomU\" value=\"$prenomU\" class=\"span4\">
						</div>
					  </div>					  
					  <div class=\"control-group\">
						<label class=\"control-label\">Adresse Mail</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"text\" name=\"melU\" value=\"$melU\" class=\"span4\">
						</div>
					  </div>					 

					  
					  </div>
					  <div class=\"span6\">
					<legend>Votre adresse</legend>
					  <div class=\"control-group\">
						<label class=\"control-label\">Adresse</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"text\" name=\"adresseU\" value=\"$adresseU\" class=\"span4\">
						</div>
					  </div>
					 
					  
					 
					  </div>
					  
					<div class=\"span12 no_margin_left\">
					<legend>Vos identifiants</legend>
					<div class=\"span6 no_margin_left\">
					  <div class=\"control-group\">
						<label class=\"control-label\">Login</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"text\" name=\"login\" value=\"$login\" class=\"span4\">
						</div>
					  </div>					 
					  </div>					 
					<div class=\"span6\">
					  <div class=\"control-group\">
						<label class=\"control-label\">Mot de passe</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"password\" name=\"mdp\" value=\"\" class=\"span4\">
						</div>
					  </div>					  <div class=\"control-group\">
						<label class=\"control-label\">Confirmez le mot de passe</label>
						<div class=\"controls docs-input-sizes\">
						  <input type=\"password\" name=\"mdpConfirm\" placeholder=\"\" class=\"span4\">
						</div>
					  </div>
					</div>

					  
					  

					  
					  </div>

					
				<div class=\" span12 no_margin_left\">
					<hr>
					<div class=\"span8\">
						<p>&nbsp;</p>
					 </div>
					 <div class=\"span3\"><button class=\"btn btn-primary btn-large pull-right\" type=\"submit\">S'enregistrer</button></div>
					 <hr>
          </div></fieldset>
				  </form>
	  
			</div>
		
		<hr />";

		return($html);
	}


	function afficheRegisterOuLogin(){


	$html = "<div class=\"span12\">
		<ul class=\"breadcrumb\">
			<li><a href=\"#\">Home</a> <span class=\"divider\">/</span></li>
			<li><a href=\"#\">Mon compte</a> <span class=\"divider\">/</span></li>
			<li class=\"active\"><a href=\"#\">Login</a></li>
		</ul>

		<div class=\"row\">
			<div class=\"span9\">
				<h1>Se connecter à un compte</h1>
			</div>
		</div>
		
		<hr />

		<div class=\"row\">

			<div class=\"span5 well\">
				<h2>Nouveaux utilisateurs</h2>
				<p>En créant un nouveau compte vous pourrez consulter les produits</p><br />
				<a href=\"Blog.php?action=afficheRegister\" class=\"btn btn-primary pull-right\">Créer un compte</a>
			</div>	 		
			
			<div class=\"span5 well pull-right\">
				<h2>Utilisateurs enregistrés</h2>
				<p>Si vous avez déjà un compte, connectez vous !</p>

				<form class=\"\" action=\"Blog.php?action=login\" method=\"post\">
					<fieldset>
						<div class=\"control-group\">
							<label for=\"focusedInput\" class=\"control-label\">Login</label>
							<div class=\"controls\">
							<input type=\"text\" name=\"login\" placeholder=\"Entrez votre login\" id=\"login\" class=\"input-xlarge focused\">
							</div>
						</div>
						<div class=\"control-group\">
							<label class=\"control-label\">Mot de passe</label>
							<div class=\"controls\">
							<input type=\"password\" name=\"mdp\"placeholder=\"Entrez votre mot de passe\" id=\"mdp\" class=\"input-xlarge\">
							</div>
						</div>

						<button class=\"btn btn-primary pull-right\" type=\"submit\">Login</button>
					</fieldset>
				</form>
				
			</div>

		</div>
	</div>";



		return($html);

	}







	function afficheAjoutProduit(){


		$html = "<div class=\"span9\">
		<ul class=\"breadcrumb\">
			<li><a href=\"#\">Home</a> <span class=\"divider\">/</span></li>
			<li><a href=\"#\">Produit</a> <span class=\"divider\">/</span></li>
			<li class=\"active\"><a href=\"#\">Ajout Produit</a></li>
		</ul>
		</div>
			<div class=\"span9\">
				<h1>Ajouter un produit</h1>
				
				<br />				
				<form class=\"form-horizontal\" method=\"post\" action=\"Blog.php?action=ajoutProduit\" enctype='multipart/form-data'>
					<fieldset>
					<div class=\"span6 no_margin_left\">
					  <div class=\"control-group\">
						<label class=\"control-label2\">Nom du produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <input type=\"text\" placeholder=\"\" class=\"span4\" name=\"nomProduit\">
						</div>
					  </div>
					  <div id=\"after\" class=\"control-group\">
						<label class=\"control-label2\">Catégorie du produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <select id=\"categorie\" placeholder=\"\" class=\"span4\" name=\"categorie\">
						  <option value=\"\"></option>";
							
						  $listeCategories = Categorie::findAll();

						  foreach($listeCategories as $categorie){

						  	$html .= "<option value=\"".$categorie->getAttr('idC')."\">".$categorie->getAttr('libelleC')."</option>";
						  }
						
						$html .="
						</select>
						</div>
					  </div>

						<script src=\"http://code.jquery.com/jquery-1.10.2.min.js\"></script>
						<script>
							

							$(document).ready(function(){
			
						 		

						 		$(\"#categorie\").change(function (event){ 
						
								$( \"#remove\" ).remove();
						 		$.ajax({
							 		type: \"GET\",
							 		url: \"Blog.php\",
							 		data: \"action=afficheSousCat&idCat=\"+$(\"#categorie\").val(),
							 		success: function(msg){ 
							 			$(\"#after\").after(msg);
							 		} 
						 		}); 
								return false; 
							}); });
						 </script>";
						 
	

						


					 
					  
					 $html .= "<div class=\"control-group\">
						<label class=\"control-label2\">Etat de votre produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"etatProduit\">
							<option value=\"Neuf\">Neuf</option>
							<option value=\"Bon etat\">Bon état</option>
							<option value=\"Etat moyen\">Etat moyen</option>
							<option value=\"Mauvais etat\">Mauvais état</option>
							<option value=\"Tres mauvais etat\">Tres mauvais état</option>
							<option value=\"Pour pieces\">Pour pièces</option>
						  </select>
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label2\">Description du produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <textarea rows=\"4\" cols=\"50\" placeholder=\"\" class=\"span4\" name=\"descriptionProduit\"></textarea>
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label2\">Année d'achat du produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"anneeProduit\">
							<option value=\"2013\">2013</option>
							<option value=\"2012\">2012</option>
							<option value=\"2011\">2011</option>
							<option value=\"2010\">2010</option>
							<option value=\"2009\">2009</option>
							<option value=\"2008\">2008</option>
							<option value=\"2007\">2007</option>
							<option value=\"2006\">2006</option>
							<option value=\"2005\">2005</option>
							<option value=\"2004\">2004</option>
							<option value=\"2003\">2003</option>
							<option value=\"2002\">2002</option>
							<option value=\"2001\">2001</option>
							<option value=\"2000\">2000</option>
							<option value=\"1\">Avant</option>
						  </select>
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label2\">Choisissez un mode d'échange</label>
						<div class=\"controls2 docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"modeEchangeProduit\">
							<option value=\"A mon domicile\">A mon domicile</option>
							<option value=\"A son domicile\">A son domicile</option>
							<option value=\"A une adresse postale\">A une adresse postale</option>
						  </select>
						</div>	
					  </div>	

					  <div class=\"control-group\">
						<label class=\"control-label2\">Photo du produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <input type='hidden' name='MAX_FILE_SIZE' value='10000000'>
	     				
						  <input type=\"file\" placeholder=\"\" class=\"span4\" name=\"photoProduit\">
						</div>
					  </div>				 
					</div>	
					
					 
					 <div class=\"span5\"><button class=\"btn btn-primary btn-large pull-right\" type=\"submit\">Ajouter le produit</button>
					 </div>

					
				</fieldset>
				  </form>
	  
			</div>";


			return($html);

	}


	function afficheSousCat($id){

		$html = "";

		if(!empty($id)){ 

		$categorie = new Categorie();

		$categorie->setAttr('idC', $id);
		

		$html = "<div id=\"remove\" class=\"control-group\">
						<label class=\"control-label2\">Sous-catégorie du produit</label>
						<div class=\"controls2 docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"sousCategorie\">";

						  
							
						  $listeSCategories = $categorie->findAllSousCat();



						  foreach($listeSCategories as $scategorie){

						  	$html .= "<option value=\"".$scategorie->getAttr('idSC')."\">".$scategorie->getAttr('libelleSC')."</option>";
						  }

							
						 
						 $html .= "</select>
						</div>
					  </div>";

					 
					}


					return($html);
	}



function afficheAlgo(){

		

		$noeud = Algo::algorithme(Algo::initialisation(), Produit::nombreObjet());

		$html = "<div class=\"span9\">
		<ul class=\"breadcrumb\">
			<li><a href=\"#\">Home</a> <span class=\"divider\">/</span></li>
			<li><a href=\"#\">Produit</a> <span class=\"divider\">/</span></li>
			<li class=\"active\"><a href=\"#\">Paire de produit</a></li>
		</ul>
		</div>
			<div class=\"span9\">
				<h1>Appariement des produits</h1>
				
				<br />				
			<table style=\"width:100%\">
				<thead>
					<tr>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px; width:50%;height:30px;border-right:2px solid #333333;\">Ce produit ...</th>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px;width:50%;width:50%;height:30px;border-left:2px solid #333333;\">est de paire avec ...</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style=\"width:50%\"></td>
						<td style=\"width:50%\"></td>
					</tr>";


					
					

			
		foreach ($noeud->listeAppariements as $value) {
			
			$produit1 = Produit::findByidP($value->objet1);
			$produit2 = Produit::findByidP($value->objet2);

			$html .= "<tr style=\"padding:4px 4px 4px 4px;border-top:1px solid #333333;\">
						<td style=\"width:50%;border-right:2px solid #333333;\">Nom produit : ".$produit1->getAttr('libelleP')."<br /></td>
						<td style=\"width:50%;border-left:2px solid #333333;\">Nom produit : .".$produit2->getAttr('libelleP')."</td>
					</tr>
					<tr style=\"padding:4px 4px 4px 4px;border-bottom:1px solid #333333;\">
						<td style=\"width:50%;border-right:2px solid #333333;\">
							<div class=\"span1\"> 	
						 		<img alt=\"\"  id=\"tmp\" src=images/". $produit1->getAttr('idP')."/".Produit::recupImage( $produit1->getAttr('idP'))."> <br />
							</div>
						</td>
						<td style=\"width:50%;border-left:2px solid #333333;\"> 
							<div class=\"span1\">
								<img alt=\"\"  id=\"tmp\" src=images/". $produit2->getAttr('idP')."/".Produit::recupImage( $produit2->getAttr('idP'))."></td>
							</div>
					</tr>";


		}


		$html .= "	</tbody>
			</table>
	  
			</div>";

			return $html;
	}



 function afficheListeProduit($sousCat){

		$html = "";

		if(!empty($sousCat) && $sousCat->getAttr('idSC') != 0){ 

		$listeProduit = Produit::listeProduitSousCat($sousCat->getAttr('idSC'));

		$sousCategorie = SousCategorie::findByidSC($sousCat->getAttr('idSC'));

		$categorie = Categorie::findByIdC($sousCategorie->getAttr('idC'));
		

		$html .= "<div class=\"span9\">
		    		 <ul class=\"breadcrumb\">
   						 <li>
   							 <a href=\"#\">Home</a> <span class=\"divider\">/</span>
    					</li>
    					<li>
   							 <a href=\"listings.html\">".$categorie->getAttr('libelleC')."</a> <span class=\"divider\">/</span>
   						 </li>
   						 <li class=\"active\">
    						<a href=\"category.html\">".$sousCategorie->getAttr('libelleSC')."</a>
    </li>
    </ul>

     ";


		foreach ($listeProduit as $value) {
			

			$html .= "<div class=\"row\">
	 <div class=\"span1\">
	  <a href=\"product.html\"><img alt=\"\"  id=\"tmp\" src=images/". $value->getAttr('idP')."/".Produit::recupImage( $value->getAttr('idP'))."></a>
	  </div>	 
	  
	  <div class=\"span6\">
	   <a href=\"Blog.php?action=afficheProduit&amp;id=".$value->getAttr('idP')."&amp;idsc=".$value->getAttr('idSC')."\"><h5>".$value->getAttr('libelleP')."</h5></a>
              <p>".$value->getAttr('descriptionP')."</p>
	  </div>	
 
  <script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>
						<script>
							

							jQuery(function($){
						   		   
	//Lorsque vous cliquez sur un lien de la classe poplight
	$('a.poplight').on('click', function() {
		var popID = $(this).data('rel'); //Trouver la pop-up correspondante
		var popWidth = $(this).data('width'); //Trouver la largeur

		//Faire apparaitre la pop-up et ajouter le bouton de fermeture
		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href=\"#\" class=\"close\"><img src=\"close_pop.png\" class=\"btn_close\" title=\"Close Window\" alt=\"Close\" /></a>');
		
		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
		$('body').append('<div id=\"fade\"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	}); //...ils disparaissent ensemble
		
		return false;
	});

	
});


function libere() {
			document.getElementById('listeproduit').disabled = true;
			if(document.getElementById(\"liberer\").checked){
				document.getElementById('listeproduit').disabled = false;
			}else{
				document.getElementById('listeproduit').disabled = true;
			}
			return true;
		}


						 </script>	
	  
	  <div class=\"span2\">
	   <p><a class=\"btn btn-primary poplight\" href=\"#\" data-width=\"500\" data-rel=\"popup1".$value->getAttr('idP')."\">Je troque</a></p>




	   <p><a class=\"\" href=\"Blog.php?action=afficheProduit&amp;id=".$value->getAttr('idP')."\">Voir la fiche produit</a></p>
	  </div>
  </div>
  <hr/>	  
	  
	     <div id=\"popup1".$value->getAttr('idP')."\" class=\"popup_block\">



	     <div id=\"choixTroc\">
			<div class=\"choixTroc\">

			<form action=\"Blog.php?action=faireSouhait&amp;id=".$value->getAttr('idP')."\" method= \"post\">
				<input type=\"hidden\" id=\"refProduct\" class=\"input-xlarge focused\">
				Je souhaite échanger ce produit par : <br /><br/>
				
				<input type= \"radio\" name=\"options\" value=\"option1\" onclick=\"libere()\" checked> Je laisse l'utilisateur choisir un de mes produits <br />
				<input type= \"radio\" name=\"options\" id=\"liberer\" value=\"option2\" onclick=\"libere()\"> Je propose un de mes produits <br />
				<div class=\"control-group\">
						<label class=\"control-label\">Merci de choisir votre produit à échanger :</label>
						<div class=\"controls docs-input-sizes\">
						  <select placeholder=\"\" name=\"produit\" class=\"span4\" id=\"listeproduit\" >";

						  $listeProduit = Produit::listeProduitUser($_SESSION['idU']);

						  foreach ($listeProduit as $value) {
						  	$html .="<option value=".$value->getAttr('idP').">".$value->getAttr('libelleP')."</option>";
						  }

		
						 
						 $html .=" </select>
						</div>
					  </div>
				<div class=\"span6\">
					<div class=\"span3 no_margin_left\">
						<button class=\"btn btn-primary\" type=\"submit\">Valider</button>
						</form>
					</div>	
				</div>
			</div>
		</div>
		
		</div> 

		<body onload = \"javascript:document.getElementById('listeproduit').disabled = true;\">
    ";

		}


		$html .= "<div class=\"pagination\">
    <ul>
    <li><a href=\"#\">Prev</a></li>
    <li class=\"active\">
    <a href=\"#\">1</a>
    </li>
    <li><a href=\"#\">2</a></li>
    <li><a href=\"#\">3</a></li>
    <li><a href=\"#\">4</a></li>
    <li><a href=\"#\">Next</a></li>
    </ul>
    </div>
    				</div>";
	}

		


					return($html);
	}






	function afficheProduit($idP, $sousCat){

		$html = "";

		if(!empty($idP) && $idP != 0){ 

		$produit = Produit::findByidP($idP);

		$sousCategorie = SousCategorie::findByidSC($sousCat->getAttr('idSC'));

		$categorie = Categorie::findByIdC($sousCategorie->getAttr('idC'));

			 $html.="<div class=\"span9\">
		     <ul class=\"breadcrumb\">
    <li>
    <a href=\"#\">Home</a> <span class=\"divider\">/</span>
    </li>
    <li>
    <a href=\"#\">".$categorie->getAttr('libelleC')."</a> <span class=\"divider\">/</span>
    </li>
    <li class=\"active\">
    <a href=\"#\">".$sousCategorie->getAttr('libelleSC')."</a>
    </li>
    </ul>
	
	
	 <div class=\"row\">
		 <div class=\"span9\">
			<h1>".$produit->getAttr('libelleP')."</h1>
		 </div>
	</div>
	 <hr>
	
	 <div class=\"row\">
		 <div class=\"span3\">
			<img alt=\"\" src=images/". $produit->getAttr('idP')."/".Produit::recupImage( $produit->getAttr('idP'))." />
			

		</div>	 

		  <script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>
						<script>
							

							jQuery(function($){
						   		   
	//Lorsque vous cliquez sur un lien de la classe poplight
	$('a.poplight').on('click', function() {
		var popID = $(this).data('rel'); //Trouver la pop-up correspondante
		var popWidth = $(this).data('width'); //Trouver la largeur

		//Faire apparaitre la pop-up et ajouter le bouton de fermeture
		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href=\"#\" class=\"close\"><img src=\"close_pop.png\" class=\"btn_close\" title=\"Close Window\" alt=\"Close\" /></a>');
		
		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
		$('body').append('<div id=\"fade\"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	}); //...ils disparaissent ensemble
		
		return false;
	});

	
});


function libere() {
			document.getElementById('listeproduit').disabled = true;
			if(document.getElementById(\"liberer\").checked){
				document.getElementById('listeproduit').disabled = false;
			}else{
				document.getElementById('listeproduit').disabled = true;
			}
			return true;
		}


						 </script>
	  
	  <div class=\"span6\">
	  
		<div class=\"span6\">
			<address>
				<strong>Nom du produit : </strong> <span>".$produit->getAttr('libelleP')."</span><br />
				<strong>Année du produit:</strong> <span>".$produit->getAttr('annee_achat')."</span><br />
				<strong>Etat du produit:</strong> <span>".$produit->getAttr('etatP')."</span><br />
			</address>
		</div>	
			
		
		<div class=\"span6\">
				<div class=\"span3 no_margin_left\">
					<a class=\"btn btn-primary poplight\" href=\"Blog.php?action=faireSouhait&amp;id=".$produit->getAttr('idP')."\" data-width=\"500\" data-rel=\"popup1".$produit->getAttr('idP')."\">Je troque</button></a>

				</div>	
		</div>	

		
		<div class=\"span6\">
		<br/>	<br/>	
			<p>
			<input name=\"star1\" type=\"radio\" class=\"star\"/>
<input name=\"star1\" type=\"radio\" class=\"star\"/>
<input name=\"star1\" type=\"radio\" class=\"star\"/>
<input name=\"star1\" type=\"radio\" class=\"star\"/>
<input name=\"star1\" type=\"radio\" class=\"star\"/>&nbsp;&nbsp;
			
			<a href=\"#\">Noter le produit</a></p>
		</div>	
		
		
	  </div>	


  </div>
   <hr>
		<div class=\"row\">
	  <div class=\"span9\">
    <div class=\"tabbable\">
    <ul class=\"nav nav-tabs\">
    <li class=\"active\"><a href=\"#1\" data-toggle=\"tab\">Description</a></li>
    <li><a href=\"#2\" data-toggle=\"tab\">Historique</a></li>
    </ul>
    <div class=\"tab-content\">
    <div class=\"tab-pane active\" id=\"1\">
    <p>".$produit->getAttr('descriptionP')."</p>
    </div>
    <div class=\"tab-pane\" id=\"2\">
		<p>utilisateur1 say \"Oh my god\"</p><hr>
		<p>utilisateur2 say \"Oh my god\"</p>
    </div>    

    </div>
    </div>

		</div>
		</div>
	 
	 
	 
		</div>


		 <div id=\"popup1".$produit->getAttr('idP')."\" class=\"popup_block\">



	     <div id=\"choixTroc\">
			<div class=\"choixTroc\">

			<form action=\"Blog.php?action=faireSouhait&amp;id=".$idP."\" method= \"post\">
				<input type=\"hidden\" id=\"refProduct\" class=\"input-xlarge focused\">
				Je souhaite échanger ce produit par : <br /><br/>
				
				<input type= \"radio\" name=\"options\" value=\"option1\" onclick=\"libere()\" checked> Je laisse l'utilisateur choisir un de mes produits <br />
				<input type= \"radio\" name=\"options\" id=\"liberer\" value=\"option2\" onclick=\"libere()\"> Je propose un de mes produits <br />
				<div class=\"control-group\">
						<label class=\"control-label\">Merci de choisir votre produit à échanger :</label>
						<div class=\"controls docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"produit\" id=\"listeproduit\" >";

						  $listeProduit = Produit::listeProduitUser($_SESSION['idU']);

						  foreach ($listeProduit as $value) {
						  	$html .="<option value=".$value->getAttr('idP').">".$value->getAttr('libelleP')."</option>";
						  }

		
						 
						 $html .=" </select>
						</div>
					  </div>
				<div class=\"span6\">
					<div class=\"span3 no_margin_left\">
						<button class=\"btn btn-primary\" type=\"submit\">Valider</button>
						</form>
					</div>	
				</div>
			</div>
		</div>
		
		</div> 

		<body onload = \"javascript:document.getElementById('listeproduit').disabled = true;\">


";

	}

	return($html);
}

	
		function listeProduitUser($idU){

		$html = "";

		if(!empty($idU) && $idU != 0){ 

		$produitUser = Produit::listeProduitUser($idU);

		$html .=" <div class=\"span9\">
		     <ul class=\"breadcrumb\">
    <li>
    <a href=\"#\">Home</a> <span class=\"divider\">/</span>
    </li>
    <li>
    <a href=\"listings.html\">Produit</a> <span class=\"divider\">/</span>
    </li>
    <li class=\"active\">
    <a href=\"category.html\">Mes produits</a>
    </li>
    </ul>";

		foreach ($produitUser as $value) {
			
			$html.="<div class=\"row\">
						<div class=\"span1\">
							<img alt=\"\"  id=\"tmp\" src=images/". $value->getAttr('idP')."/".Produit::recupImage( $value->getAttr('idP')).">
						</div>	 
		  
						<div class=\"span6\">
							<h5>".$value->getAttr('libelleP')."</h5>
						</div>	 

						<div class=\"span2\">
							<p><a class=\"btn btn-primary\" href=\"Blog.php?action=afficheUpdateProduit&amp;id=".$value->getAttr('idP')."\">Modifier produit</a></p>
						</div>
					</div>
		 <hr />";
  		}
	  
	      $html .="<div class=\"pagination\">
    				<ul>
    					<li><a href=\"#\">Prev</a></li>
    					<li class=\"active\">
   							 <a href=\"#\">1</a>
   						</li>
    					<li><a href=\"#\">2</a></li>
   						<li><a href=\"#\">3</a></li>
    					<li><a href=\"#\">4</a></li>
    					<li><a href=\"#\">Next</a></li>
    				</ul>
    			</div>
    			</div>";
			}

			return($html);
	}


	function afficheUpdateProduit($id){

		$html ="<div class=\"span9\">
				<h1>Modifier le produit</h1>
				
				<br />				
				<form class=\"form-horizontal\" action=Blog.php?action=updateProduit&amp;id=$id method=\"post\" enctype='multipart/form-data'>
					  <div class=\"control-group\">
					  <div class=\"control-label\">
							<fieldset>
								&nbsp; Actif &nbsp;  <input type=\"radio\" value=\"Actif\" name=\"typeP\" checked > 
								&nbsp;&nbsp; Inactif &nbsp;<input type=\"radio\" value=\"Passif\" name=\"typeP\"> <br/>
					  		</fieldset>
					  		</div>
					  		</div>
						
					  <div class=\"control-group\">
						<label class=\"control-label\">Nom du produit</label>
						<div class=\"controls docs-input-sizes\">
							 <input type=\"text\" placeholder=\"\" class=\"span4\" name=\"libelleP\">
						</div>	
					  </div>				  
					  <div class=\"control-group\">
						<label class=\"control-label\">Photo du produit</label>
						<div class=\"controls docs-input-sizes\">
						  <input type='hidden' name='MAX_FILE_SIZE' value='10000000'>
	     				
						  <input type=\"file\" placeholder=\"\" class=\"span4\" name=\"photoProduit\">
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label\">Etat de votre produit</label>
						<div class=\"controls docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"etatP\">
							<option value=\"Neuf\">Neuf</option>
							<option value=\"Bon etat\">Bon état</option>
							<option value=\"Etat moyen\">Etat moyen</option>
							<option value=\"Mauvais etat\">Mauvais état</option>
							<option value=\"Tres mauvais etat\">Très mauvais état</option>
							<option value=\"Pour pieces\">Pour pièces</option>
						  </select>
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label\">Description du produit</label>
						<div class=\"controls docs-input-sizes\">
						  <textarea rows=\"4\" cols=\"50\" placeholder=\"\" class=\"span4\" name=\"descriptionP\"> Ici la description de votre produit</textarea>
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label\">Année d'achat du produit</label>
						<div class=\"controls docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"annee_achat\">
							<option value=\"2013\">2013</option>
							<option value=\"2012\">2012</option>
							<option value=\"2011\">2011</option>
							<option value=\"2010\">2010</option>
							<option value=\"2009\">2009</option>
							<option value=\"2008\">2008</option>
							<option value=\"2007\">2007</option>
							<option value=\"2006\">2006</option>
							<option value=\"2005\">2005</option>
							<option value=\"2004\">2004</option>
							<option value=\"2003\">2003</option>
							<option value=\"2002\">2002</option>
							<option value=\"2001\">2001</option>
							<option value=\"2000\">2000</option>
							<option value=\"1\">Avant</option>
						  </select>
						</div>
					  </div>
					  <div class=\"control-group\">
						<label class=\"control-label\">Choisissez un mode d'échange</label>
						<div class=\"controls docs-input-sizes\">
						  <select placeholder=\"\" class=\"span4\" name=\"modeEchange\">
							<option value=\"A mon domicile\">A mon domicile</option>
							<option value=\"A son domicile\">A son domicile</option>
							<option value=\"A une adresse postale\">A une adresse postale</option>
						  </select>
						</div>	
					  </div>					 
					</div>	
					 <div class=\"span6\"><button class=\"btn btn-primary btn-large pull-right\" type=\"submit\">Modifier le produit</button></div>

				</fieldset>
				  </form>

	  
			";

		

			return($html);
	}


	function afficheSouhait($idU){

		$html = "<div class=\"span9\">
		<ul class=\"breadcrumb\">
			<li><a href=\"#\">Home</a> <span class=\"divider\">/</span></li>
			<li><a href=\"#\">Produit</a> <span class=\"divider\">/</span></li>
			<li class=\"active\">Souhaits</li>
		</ul>
		</div>
			<div class=\"span9\">
				<h1>Mes souhaits</h1>
				
				<br />		
<!-- boucle -->		
		<div class=\"row\">
	  <div class=\"span9\">
    <div class=\"tabbable\">
    <ul class=\"nav nav-tabs\">
    <li class=\"active\"><a href=\"#1\" data-toggle=\"tab\">Souhaits émis</a></li>
    <li><a href=\"#2\" data-toggle=\"tab\">Souhaits reçus</a></li>
    </ul>
    <div class=\"tab-content\">
    <div class=\"tab-pane active\" id=\"1\">
		<p><!-- Mes souhaits -->";
		
		$listeSouhaitAcheteur = Souhait::findByUserAcheteur($_SESSION['idU']);

		print_r($listeSouhaitAcheteur);

		$listeSouhaitVendeur = Souhait::findByUserVendeur($_SESSION['idU']);

		print_r($listeSouhaitVendeur);

		foreach ($listeSouhaitAcheteur as $souhait) {
			
			$produit1 = Produit::findByidP($souhait->getAttr('idP'));
			$produit2 = Produit::findByidP($souhait->getAttr('idP2'));

			if(is_null($produit2)){
				$valeurP2 = "Au choix";
			}else{
				$valeurP2 = $produit2->getAttr('idP');
			}
			


			$html .= "<table style=\"width:100%\">
				<thead>
					<tr>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px;width:10%;height:30px;border-right:2px solid #333333;\">Voir le détail</th>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px; width:45%;height:30px;border-right:2px solid #333333;\">Troc de ce produit</th>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px;width:45%;height:30px;border-left:2px solid #333333;\">contre</th>
					</tr>
				</thead>
				<tbody>
					<tr style=\"padding:4px 4px 4px 4px;border-top:1px solid #333333;\">
						<td style=\"width:10%;border-right:2px solid #333333;\"><center>Voir le détail</center></td>
						<td style=\"width:45%;border-right:2px solid #333333;\">".
	
						$produit1->getAttr('libelleP')."<br />
						
						</td>
						<td style=\"width:45%;border-left:2px solid #333333;\">".$valeurP2."<br /></td>
					</tr>

				</tbody>
			</table>
			<br />";
		}

		$html .= "</p>
		</div>
    <div class=\"tab-pane\" id=\"2\">
		<p><!-- Mes échanges -->";

		foreach ($listeSouhaitVendeur as $souhait) {
				
				$produit1 = Produit::findByidP($souhait->getAttr('idP'));
			$produit2 = Produit::findByidP($souhait->getAttr('idP2'));

			if(is_null($produit2)){
				$valeurP2 = "Au choix";
			}else{
				$valeurP2 = $produit2->getAttr('idP');
			}


				$html .= "
    
		
		<!-- BOUCLE -->
		<table style=\"width:100%\">
				<thead>
					<tr>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px;width:10%;height:30px;border-right:2px solid #333333;\">Voir le détail</th>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px; width:45%;height:30px;border-right:2px solid #333333;\">Je peux échanger ce produit</th>
						<th style=\"color:#ffffff;background:#0088cc;padding:4px 4px 4px 4px;width:45%;height:30px;border-left:2px solid #333333;\">contre</th>
					</tr>
				</thead>
				<tbody>
					<tr style=\"padding:4px 4px 4px 4px;border-top:1px solid #333333;\">
						<td style=\"width:10%;border-right:2px solid #333333;\"><center>En attente</center></td>
						<td style=\"width:45%;border-right:2px solid #333333;\">"
					
						.$produit1->getAttr('idP')."<br />
						
						</td>
						<td style=\"width:45%;border-left:2px solid #333333;\"><center></center>
						".$valeurP2."<br /></td>
					</tr>

				</tbody>
			</table> <br/>";
		}




		
		
		
		$html .= "</p>
    </div>    
    </div>
    </div>

		</div>
		</div>	  
			</div>";

		return($html);
	}


	
}

?>
