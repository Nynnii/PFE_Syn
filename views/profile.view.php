<?php $title = "Profil"; ?>
<?php include 'partials/_header.php'; ?>

<div id="main-content">
   	<div class="container">
   		<div class="row">
   			<div class="col-md-4">
   				<div class="panel panel-default">
				 	<div class="panel-heading">
				    	<h3 class="panel-title text-center"><strong>Profil de <?= e($user->firstname) ?> <?= e($user->lastname) ?>&nbsp;&nbsp;&nbsp;<a href="modify_profile.php"><i class="fa fa-pencil"></i></a></strong></h3>
				    	
					</div>
				  	<div class="panel-body">
						<div class="row">
							<div class="col-xs-4 col-sm-2 col-md-3">
								<img src="<?= get_avatar_url($user->email) ?>" alt="Image de profil de <?= e($user->firstname) ?> <?= e($user->lastname) ?>">
							</div>
							<div class="col-xs-8 col-sm-8">
								<strong><?= e($user->firstname) ?> <?= e($user->lastname) ?></strong><br/>
								<a href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a><br/>
								<?=
									$user->class ? '<i class="fa fa-users"></i>&nbsp;Promo&nbsp;'.e($user->class).'<br/>' : '';
								?>
								<?=
									$user->sex == "F" ? '<i class="fa fa-female"></i>&nbsp;Femme<br/>' : '<i class="fa fa-male"></i>&nbsp;Homme<br/>';
								?>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-sm-6">
								<?=
									$user->status == "etudiant" ? '<i class="fa fa-graduation-cap"></i>&nbsp;Etudiant<br/>' : 
													("professeur" ? '<i class="fa fa-graduation-cap"></i>&nbsp;Professeur<br/>' : 
													'<i class="fa fa-graduation-cap"></i>&nbsp;Ancien<br/>');
								?>
								<?=
									$user->github ? '<i class="fa fa-github"></i>&nbsp;<a target="_blank" href="//github.com/'.e($user->github).'">'.e($user->github).'</a><br/>' : '' ;
								?>
							</div>
							<div class="col-sm-6">
								<?=
									$user->city && $user->country ? '<i class="fa fa-home"></i>&nbsp;'.e($user->city).' - '.e($user->country).'<br/>' : '' ;
								?>
							</div>
						</div>
						<div class=="row">
							<?=
								$user->employment_status ? 'Disponible pour emploi' : 'Non disponible pour emploi'; //Ternaire: 1ère partie->condition; si ça existe, on affiche dispo pour emploi sinon on affiche l'autre.
							?>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-12 well">
								<h4>Description</h4>
								<p>
									<?=
										$user->description ? nl2br(e($user->description)) : "Aucune description pour le moment ...";
									?>
								</p>
							</div>
						</div>
				  	</div>
				</div>
   			</div>
   			<div class="col-md-6">
   				<div class="panel panel-default">
				 	<div class="panel-heading">
				    	<h3 class="panel-title text-center"><strong>Mes contacts</strong></h3>
					</div>
				  	<div class="panel-body">
				  	</div>
				</div>
   			</div>   			
   		</div>
	</div>
</div>
<?php include 'partials/_footer.php'; ?>