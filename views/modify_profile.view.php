<?php $title = "Modifier le profil"; ?>
<?php include 'partials/_header.php'; ?>

<div id="main-content">
   	<div class="container">
   		<div class="row">
   			<div class="col-md-12">
   				<div class="panel panel-default">
				 	<div class="panel-heading">
				    	<h3 class="panel-title text-center"><strong>Modifier mon profil</strong></h3>
					</div>
				  	<div class="panel-body">
				    	<?php include('partials/_error.php'); ?>

				    	<form data-parsley-validate method="post" autocomplete="off">
				    		<div class="row">
				    			<div class="col-md-4">
				   	 				<!-- Champs Prénom -->
				   	 				<img src="images/evlilly.jpg" class="img-responsive"></img>		 			
				   	 			</div>

				    			<div class="col-md-4">
				   	 				<!-- Champs Prénom -->
				   	 				<div class="form-group">
				   	 					<label for="firstname">Prénom<span class="text-danger"> *</span></label>
				   	 					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" value="<?= e($user->firstname) ?>" required="require" />   	 					
				   	 				</div>		   	 			
				   	 			</div>
				    			<div class="col-md-4">
				   	 				<!-- Champs Nom -->
				   	 				<div class="form-group">
				   	 					<label for="lastname">Nom<span class="text-danger"> *</span></label>
				   	 					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" value="<?= e($user->lastname) ?>" required="require" />   	 					
				   	 				</div>		   	 			
				   	 			</div>
				    			<div class="col-md-4">
				   	 				<!-- Champs Sexe -->
				   	 				<div class="form-group">
				   	 					<label for="sex">Sexe</label>
				   	 					<select name="sex" id="sex" class="form-control">
				   	 						<option value="H" <?= $user->sex =="H" ? "selected" : "" ?>>
				   	 							Homme
				   	 						</option>
				   	 						<option value="F" <?= $user->sex =="F" ? "selected" : "" ?>>
				   	 							Femme
				   	 						</option>
				   	 					</select>
				   	 				</div>				   	 			
				   	 			</div>
				    			<div class="col-md-4">
				   	 				<!-- Champs Ville -->
				   	 				<div class="form-group">
				   	 					<label for="city">Ville</label>
				   	 					<input type="text" class="form-control" id="city" name="city" placeholder="Ville" value="<?= e($user->city) ?>" />   	 					
				   	 				</div>				   	 			
				   	 			</div>
				    			<div class="col-md-4">
				   	 				<!-- Champs Pays -->
				   	 				<div class="form-group">
				   	 					<label for="country">Pays</label>
				   	 					<input type="text" class="form-control" id="country" name="country" placeholder="Pays" value="<?= e($user->country) ?>" />   	 					
				   	 				</div>				   	 			
				   	 			</div>
				    			<div class="col-md-4">
				   	 				<!-- Champs Github -->
				   	 				<div class="form-group">
				   	 					<label for="github">Github</label>
				   	 					<input type="text" class="form-control" id="github" name="github" placeholder="Github" value="<?= e($user->github) ?>" />   	 					
				   	 				</div>				   	 			
				   	 			</div>
				    		</div>
				    		<div class="row">
				    			<div class="col-md-4">
				    				<input type="submit" class="btn btn-primary" value="Changer sa photo de profil" name="update_photo">
				    			</div>
				    			<div class="col-md-4">
				   	 				<!-- Champs Emploi -->
				   	 				<div class="form-group">
				   	 					<label for="employment_status">
				   	 						<input type="checkbox" name="employment_status" <?= $user->employment_status ? "checked" : "" ?> />

				   	 						Disponible pour emploi ?
				   	 					</label>  	 					
				   	 				</div>				   	 			
				   	 			</div>
				    		</div>
				    		<div class="row">
				    			<div class="col-md-12">
				   	 				<!-- Champs Description -->
				   	 				<div class="form-group">
				   	 					<label for="description">Description</label>
				   	 					<textarea class="form-control" id="description" name="description" cols="30" rows="10" placeholder="Ajouter une description ici..." /><?= e($user->description) ?></textarea>   	 					
				   	 				</div>				   	 			
				   	 			</div>
				    		</div>
				    		<input type="submit" class="btn btn-primary" value="Valider" name="update">
				    	</form>
				  	</div>
				</div>
   			</div>
   		</div>
	</div>
</div>
<?php include 'partials/_footer.php'; ?>