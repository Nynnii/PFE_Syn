<?php $title = "Connexion ou inscription"; ?>
<?php include 'partials/_header.php'; ?>
<div id="main-content">
   	 <div class="container">
   	 	<div class="jumbotron">
	   	 	<div class="col-sm-6">
		    	<p class="font-size-15">
		    		<strong><?php echo WEBSITE_NAME; ?></strong> est le réseau social de partage pour l'Efrei. <br/>
		    		Grâce à cette plateforme, vous pouvez tisser des liens d'amitiés avec d'autres étudiants et des anciens, échanger du code source, être aidé ou aider d'autres étudiants dans leurs travaux. Vous pouvez également accéder à votre emploi du temps et à vos cours. Mais ce n'est pas tout, <strong><?php echo WEBSITE_NAME; ?></strong> c'est aussi plein d'autres fonctionnalités !<br/>
		    		Rejoignez dès maintenant la communauté.
		    	</p>
		    	<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				    <li data-target="#myCarousel" data-slide-to="3"></li>
				  </ol>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					    <div class="item active">
						      <img src="images/evlilly.jpg" alt="Evangeline Lilly">
						      <div class="carousel-caption"></div>
					    </div>
					
					    <div class="item">
						      <img src="images/evagreen.jpg" alt="Eva Green">
						      <div class="carousel-caption"></div>
					    </div>
					
					    <div class="item">
						      <img src="images/meganfox.jpg" alt="Megan Fox">
						      <div class="carousel-caption"></div>
					    </div>
					
					    <div class="item">
						      <img src="images/modelstair.jpg" alt="Model posing on the stairs">
						      <div class="carousel-caption"></div>
					    </div>
				  </div>
				
				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Précédent</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Suivant</span>
				  </a>
				</div>
		    </div>
	    	<div class="col-sm-offset-7">
   	 			<h1 id="inscription-title">Inscription</h1>
   	 			<?php include 'partials/_error.php'; ?>   	 			
   	 			<form data-parsley-validate method="post">
   	 				<!-- Champs Prénom -->
   	 				<div class="form-group">
   	 					<input type="text" value="<?= get_input('firstname') ?>" class="form-control" name="firstname" placeholder="Prénom" required="required" data-parsley-minlength="2" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				
   	 				<!-- Champs Nom -->
   	 				<div class="form-group">
   	 					<input type="text" value="<?= get_input('lastname') ?>" class="form-control" name="lastname" placeholder="Nom" required="required" data-parsley-minlength="2" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				
   	 				<!-- Champs Statut -->
   	 				<select class="form-control form-group" name="status" required data-parsley-trigger="change">
					    <option value="etudiant">Etudiant</option>
					    <option value="professeur">Professeur</option>
					    <option value="ancien">Ancien</option>
					</select>
   	 				   	 				
   	 				<!-- Champs Promo -->
   	 				<div class="form-group">
   	 					<input type="number" value="<?= get_input('class') ?>" class="form-control" name="class" placeholder="Promo" required="required" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				
   	 				<!-- Champs adresse mail -->
   	 				<div class="form-group">
   	 					<input type="email" value="<?= get_input('email') ?>" class="form-control" name="email" placeholder="Adresse e-mail" required="required" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				
   	 				<!-- Champs mot de passe -->
   	 				<div class="form-group">
   	 					<input type="password" class="form-control" id="password1" name="password" placeholder="Mot de passe" required="required" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				
   	 				<!-- Champs confirmer mot de passe -->
   	 				<div class="form-group">
   	 					<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirmer le mot de passe" required="required" data-parsley-trigger="change" data-parsley-equalto="#password1" />   	 					
   	 				</div>
   	 				
   	 				<input type="submit" class="btn btn-primary" value="S'inscrire" name="register" />
   	 				
   	 			</form>
   	 		</div>
   	 	</div>
   	 </div>

</div>
<?php include 'partials/_footer.php'; ?>


