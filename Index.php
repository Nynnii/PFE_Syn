<?php 

	// On démarre la session utilisateur.
	// test 
	session_start();
	require_once('config/connexion_bdd.php');
	require_once('fonctions/dates.php');

	setlocale(LC_TIME, "fr");
	date_default_timezone_set('Europe/Paris');

	$_SESSION['time'] = strftime("%d %B %Y");

	// On vérifie si l'utilisateur est bien connecté

	if(!isset($_SESSION['user'])) {
		header('location:web/loginPage.php');
	} 

	$user = $bdd->query('SELECT * FROM ldapusers WHERE name = "'.$_SESSION['user'].'";');

	while ($repUser = $user->fetch()) {
		$isAdmin = $repUser['isAdmin'];

		$_SESSION['isAdmin'] = $isAdmin;
	}


	// On prépare les requêtes SQL pour l'affichage de la base de données

	$results = $bdd->query("SELECT * FROM applications ORDER BY state, workInProgress, name;");
	$queryCarousel = $bdd->query("SELECT * FROM actus;");
	$queryflash = $bdd->query("SELECT * FROM flashinfo;");
	$res = $bdd->query("SELECT * FROM news ORDER BY date DESC;");
	
?>


<!DOCTYPE html>
<html lang="fr">

	<header>

		<!-- On identifie si on utilise un navigateur IE8 -->
		
		<!--[if lte IE 8]>

			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<link rel="stylesheet" href="css/style_ie.css" />

		<![endif]-->
		

		<meta charset="utf-8">

		<title>Accueil | Site BSU-N</title>

		<!-- On met les liens des css qu'on veut utiliser -->

		<link rel="stylesheet" type="text/css" href="frameworks/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="frameworks/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="frameworks/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" type="text/css" href="frameworks/li-scroller/li-scroller.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<link rel="icon" href="img/favicon.ico">


		<!-- On ajoute les scripts qui vont se lancer dès le chargement de la page -->

		<script type="text/javascript" src="frameworks/jquery-1.11.2/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="frameworks/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script type="text/javascript" src="frameworks/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script type="text/javascript" src="frameworks/owlcarousel/owl.carousel.min.js"></script>
		<script type="text/javascript" src="frameworks/li-scroller/li-scroller.1.0.js"></script>
		<script type="text/javascript" src="frameworks/bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript">

		// Fonction pour le pannel des applications

			$(document).ready(function() {
				$('[data-toggle="popover"]').popover();

				$('body').on('click', function (e) {
					$('[data-toggle="popover"]').each(function (){
						if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
							$(this).popover('hide');
						}
					});
				});
			});

			// Fonction pour le slider

			$(function(){
				$("ul#ticker01").liScroll({
					travelocity: 0.1
				});
			});


			$(function(){
				$("ul#ticker02").liScroll({
					travelocity: 0.2
				});
			});
		</script>

	</header>


	<!-- Class ie8 afin d'englober la totalité du code et faciliter la compatibilité pour ce navigateur -->

	<body class="ie8">

		<!-- Class container qui va contenir toute la page d'acceuil-->

		<div class="container">

			<div class="logo">

				<!-- Class row qui contient l'en tête de la page : le logo, le titre et le nom de l'utilisateur connecté  -->

				<div class="row">
					<div class="col-md-4">
						<a href="index.php"><img class="imgLogo" src="img/logo_CE.png"></a>
					</div>
					<div class="col-md-4">
						<div class="title">
							<h1>Direction Système d'Information<br>Support Informatique</h1>
						</div>
					</div>
					<div class="col-md-4">
						<div class="user">
								<strong><?php echo $_SESSION['user']; ?></strong><br>
								<a href="fonctions/logout.php">Se Déconnecter</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Système de navigation contenant les onglets et liens vers les autres pages -->

	    	<div class="location">
				<ol class="breadcrumb">
	  				<li class="active">Accueil</li>
	  				<li><a href="web/annuaire.php">Annuaire</a></li>
	  				<li><a href="#heuresDomTom" data-toggle="modal">Heures DOM-TOM</a></li>
	  				<li><a href="web/contact.php">Organisation du Support</a></li>
	  				<li><a href="#">Tutoriels</a></li>
	  				<li><a href="#">FAQ</a></li>
	  				<div class="feedRSS"><li><a type="application/rss+xml" href="rss/flux.xml"><img src="img/rss.gif" alt="RSS"></a></li></div>
	  			</ol>
  			</div>


  			<!-- Boucle PHP qui permet d'afficher les différents fuseaux horaires -->

  			<div class="modal fade" id="heuresDomTom">

  				<!-- Modal Bootstrap qui permet l'affciahge des horaires-->

				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-header">
			          		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			          		<h3 class="modal-title">Heures des DOM-TOM</h3>
			        	</div>
						  
						<div class="modal-body">

							<h4>
								Paris :&nbsp;
								<strong>

<?php 								setlocale(LC_TIME, "fr");
									date_default_timezone_set('Europe/Paris');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>

							<br><h4>
								Tahiti :&nbsp;
								<strong>

<?php								date_default_timezone_set('Pacific/Honolulu');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>	

							<br><h4>
								Martinique/Guadeloupe :&nbsp;
								<strong>
<?php
									date_default_timezone_set('America/Guadeloupe');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>

							<br>

							<h4>
								Guyanne :&nbsp;
								<strong>
<?php
									date_default_timezone_set('America/Guyana');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>

							<br>

							<h4>
								Réunion :&nbsp;
								<strong>
<?php
									date_default_timezone_set('Indian/Reunion');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>

							<br>

							<h4>
								Mayotte :&nbsp;
								<strong>
<?php
									date_default_timezone_set('Indian/Mayotte');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>

							<br>

							<h4>
								Nouvelle-Calédonie :&nbsp;
								<strong>
<?php
									date_default_timezone_set('Pacific/Noumea');
									echo strftime("%A %d %B %H:%M");

?>								</strong>
							</h4>

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
						</div>
					</div>			
				</div>
			</div>

			<!-- Informations de la page d'accueil -->


  			<div class="col-md-8" style="margin-top: 20px;">
  				<div id="slideshow">
					<div class="container">
						<div class="slider">


						<!-- Slider d'images appelé en CSS3 qui récupère les flux RSS -->

						<!-- Commentaire conditionnel pour compatibilité d'IE <= à 9 pour le slider -->
						<!--[if lte IE 9]>
							<ul id="ticker02">
						<![endif]-->

<?php
							$xml = '<?xml version="1.0" encoding="utf-8"?>';
							$xml .= '<rss version="2.0">';
							$xml .= '<channel>';
							$xml .= '<title>Direction Système d\'Information Support Informatique</title>';
							$xml .= '<link>http://10.75.225.196/ConseilSiteBSU/</link>';

							while($tab = $res->fetch()){
								$id = $tab['id'];
								$name = $tab['name'];
								$date = $tab['date'];
								$title = $tab['title'];
								$img = $tab['img'];
								$description = $tab['description'];

								$img = substr($img, 3);
								$title = substr($title, 1, -1);
								$name = substr($name, 1, -1);
 
								$xml .= '<item>';
						  		$xml .= '<title>'.$name.'</title>';
						  		$xml .= '<title2>'.$title.'</title2>';
						 		$xml .= '<link>http://10.75.225.196/ConseilSiteBSU/web/showActus.php?actu='.$id.'</link>';
								$xml .= '<pubDate>'.$date.'</pubDate>';
								$xml .= '<description>'.$description.'</description>';
								$xml .= '</item>';

								$date = date("d-m-Y H:i", strtotime($date));


									if (preg_match("/MSIE/i", getenv("HTTP_USER_AGENT"))){
											echo '<li><a href="web/showActus.php?actu='.$id.'"><figure>
													<img src="'.$img.'" alt="" width="670" height="310"/>
													<div style="position: relative;"><figcaption>'.$date.'<br><strong>'.$name.'</strong><br>'.$title.'</figcaption>
												</div></figure></a></li>';


								  		} else{

											echo '<a href="web/showActus.php?actu='.$id.'"><figure>
													<img src="'.$img.'" alt="" width="670" height="310" />
													<figcaption>'.$date.'<br><strong>'.$name.'</strong><br>'.$title.'</figcaption>
												</figure></a>';
								  		}
									
							}

							$xml .= '</channel>';
							$xml .= '</rss>';

							$flux = fopen('rss/flux.xml', 'w+');
							fputs($flux, $xml);
							fclose($flux);

															 
											
?>
						<!--[if lte IE 9]>
							</ul>
						<![endif]-->

						</div>
					</div>
				</div>


				<div class="col-md-12 actus">
					<h3><a href="web/actus.php">Accédez à toutes les actualités</a></h3>

				</div>
				
				<div class="col-md-12 flashInfos">
						
					<ul id="ticker01">					
<?php
						while($repFlashInfo = $queryflash->fetch()){
							$text = $repFlashInfo['text'];
							$date = $repFlashInfo['date'];
							
							$text = substr($text, 1, -1);
							$date = dateUsToDateFr($date);
			 				 
		 				 	echo '
								<li><span>'.$date.'</span><a href="">'.$text.'</a></li>';
		 				   			
							}
?>
					</ul>
			
				</div>
				
  			</div>

  			<!-- Affichage du tableau des états des applications, requête via PHP -->
  			
  			<div class="col-md-4">

  				<div class="viewApps">
					<table class="table table-striped table-bordered table-hover" border style="text-align: center; margin: 10px; width: 25%;">
						
<?php 

						// Fonction while qui parcourt la base pour fournir au tableau les informations

					while ($resultats = $results->fetch()) {
						$name = $resultats['name'];
						$ok = $resultats['ok'];
						$workInProgress = $resultats['workInProgress'];
						$nonOk = $resultats['nonOk'];
						$tvx = $resultats['travaux'];
						$state = $resultats['state'];
						$tooltip = $resultats['tooltip'];
						$descripTvx = $resultats['descriptravaux'];

						// On set les images en fonction de la valeur de la base

						if ($ok == 1 && $workInProgress == 0 && $nonOk == 0){
							$ok = '<img src="img/OK.png" data-toggle="popover" class="symbol" style="height: 30px; width: 30px; vertical-align: middle;" title='.$state.' data-placement="left">';
							$workInProgress = '';
							$nonOk = '';
						} else if ($ok == 0 && $workInProgress == 1 && $nonOk == 0){
							$ok = '';
							$workInProgress = '<img src="img/work.png" data-toggle="popover" class="symbol" style="height: 30px; width: 30px; vertical-align: middle;" title='.$state.' data-placement="left" data-content='.$tooltip.'>';
							$nonOk = '';
						} else if ($ok == 0 && $workInProgress == 0 && $nonOk == 1){
							$ok = '';
							$workInProgress = '';
							$nonOk = '<img src="img/HS.png" data-toggle="popover" class="symbol" style="height: 30px; width: 30px; vertical-align: middle;" title='.$state.' data-placement="left" data-content='.$tooltip.'>';
						
						// Si la base est mal remplie, ou problème de mise à jour, affichage d'un indication qu'un problème est présent pour telle application

						} else {
							$ok = '';
							$workInProgress = '';
							$nonOk = '';
							echo '<strong>Problème dans la base pour '.$name.'</strong><br />';
						}

						if ($tvx == 1) {
							$tvx = '<img src="img/travaux.png" data-toggle="popover" class="symbol" style="height: 30px; width: 30px; vertical-align: middle;" title="Travaux" data-placement="left" data-content='.$descripTvx.'>';
						} else {
							$tvx = '';
						}

						// On fournit les infos au tableau

						echo '<tr>
							 	<td style="vertical-align: middle;">'.$name.'</td>
							 	<td style="vertical-align: middle;">'.$ok.$workInProgress.$nonOk.'</td>
							 	<td style="vertical-align: middle;">'.$tvx.'</td>
							  </tr>';
					}

?>					
						</div>	
					</table>
  				</div>

  				<!-- Image de la carte (Annuaire) avec lien vers la page annuaire.php -->

  				<div class="apercuAnnuaire">
  					<a href="web/annuaire.php"><img class="apercuMap" src="img/new_map.png"></a>
  				</div>

  			</div>
  			
		</div>

		<br><br>

		<!-- Pied de page commun à toutes les pages du site -->

		<div class="footer">
			<footer class="footer">
			    <div class="container">
			       <div class="col-md-4">
			       		<div class="glpi">
			       			<h5>GLPI : <a href="http://gesparc.conseil-etat.fr" target="_blank">gesparc.conseil-etat.fr</a></h5>
			       		</div>
			       </div>
			       <div class="col-md-4">
			       		<div class="maj">
			       			<h5>Dernière mise à jour : <strong> <?php echo $_SESSION['time']; ?> </strong></h5>
			       		</div>
			       </div>
			       <div class="col-md-4">
			       		<div class="contact">
			       			<h5><?php if ($_SESSION['isAdmin'] == 1) { echo '<a href="web/admin.php">Panneau Administrateur</a>'; }?></h5>
			       		</div>
			       </div>
			    </div>
			</footer>
		</div>
	</body>

</html>