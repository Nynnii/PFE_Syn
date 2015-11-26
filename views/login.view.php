<?php $title = "Connexion"; ?>
<?php include 'partials/_header.php'; ?>

<div id="main-content">
   	 <div class="container">
   	 	<div class="jumbotron col-sm-8 col-sm-offset-2">
   	 		<div class="col-sm-6 col-sm-offset-3">
   	 			<h1 id="lead">Connexion</h1>
   	 			<?php include 'partials/_error.php'; ?>   	 			
   	 			<form data-parsley-validate method="post">
   	 				<!-- Champs adresse mail -->
   	 				<div class="form-group">
   	 					<input type="email" value="<?= get_input('email') ?>" class="form-control" name="email" placeholder="Adresse e-mail" required="required" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				
   	 				<!-- Champs mot de passe -->
   	 				<div class="form-group">
   	 					<input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe" required="required" data-parsley-trigger="change" />   	 					
   	 				</div>
   	 				<input type="submit" class="btn btn-primary" value="Connexion" name="login" />
   	 			</form>
   	 		</div>
   	 	</div>
	</div>
</div>
</div>
<?php include 'partials/_footer.php'; ?>