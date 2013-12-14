<?php

include_once "SousCategorie.php";
include_once "Categorie.php";
include_once "Users.php";
include_once "Produit.php";
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
						<a href=\"cart.html\">Mes demandes (2)</a> |
						<a href=\"two-column.html\">Propositions (1)</a> |
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

							 			echo "<li><a href=\"Blog.php?action=afficheListeProduit&amp;id=". $sousCategorie->getAttr('idSC') ."\">".$sousCategorie->getAttr('libelleSC')."</a></li>";

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
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>PS Vita</h5></a>  Price: &#36;50.00<br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/nexus-one-3-150x123.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>Nexus one</h5></a>  Price: &#36;50.00<br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/thumb_sam_3d.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>Samsung 3D TV</h5></a>  Price: &#36;50.00<br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/ipad_case.jpg\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>iPod Case</h5></a>  Price: &#36;50.00<br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/HMX-H104.JPG\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>HMX Camcorder</h5></a>  Price: &#36;50.00<br /><br />
            </div>
          </div>
        </li>
       
	   <li class=\"span2\">
          <div class=\"thumbnail\">
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/expic.png\" /></a>
            <div class=\"caption\">
              <a href=\"Blog.php?action=registerOuLogin\"> <h5>Kindle Fire</h5></a>  Price: &#36;50.00<br /><br />
            </div>
          </div>
        </li>

      </ul>
		</div>
        <div class=\"span2\">
		
		 <div class=\"roe\">
		<h4>Newsletter</h4><br />
		<p>Sign up for our weekly newsletter and stay up-to-date with the latest offers, and newest products.</p>
		
		    <form class=\"form-search\">
    <input type=\"text\" class=\"span2\" placeholder=\"Enter your email\" /><br /><br />
    <button type=\"submit\" class=\"btn pull-right\">Subscribe</button>
    </form>
		</div><br /><br />
            <a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" title=\"\" src=\"css/images/paypal_mc_visa_amex_disc_150x139.gif\" /></a>
			<a href=\"Blog.php?action=registerOuLogin\"><img alt=\"\" src=\"css/images/bnr_nowAccepting_150x60.gif\" /></a>

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
							<option value=\"Très mauvais etat\">très mauvais état</option>
							<option value=\"Pour pieces\">pour pièces</option>
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
							<option value=\"A une adresse précise\">A une adresse précise</option>
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
						<td style=\"width:50%;border-right:2px solid #333333;\">Nom produit : ".$produit1->libelleP."<br /></td>
						<td style=\"width:50%;border-left:2px solid #333333;\">Nom produit : .".$produit2->libelleP."</td>
					</tr>
					<tr style=\"padding:4px 4px 4px 4px;border-bottom:1px solid #333333;\">
						<td style=\"width:50%;border-right:2px solid #333333;\">Photo produit 1 <br /></td>
						<td style=\"width:50%;border-left:2px solid #333333;\">Photo produit 2</td>
					</tr>";


		}


		$html .= "	</tbody>
			</table>
	  
			</div>";

			return $html;
	}




	
	

	
}

?>
