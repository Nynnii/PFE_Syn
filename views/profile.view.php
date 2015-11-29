<?php $title = "Profil"; ?>
<?php include 'partials/_header.php'; ?>

<div id="main-content">
   	<div class="container">
   		<div class="row">
   			<div class="col-md-3">
   				<div class="panel panel-default">
				 	<div class="panel-heading">
				    	<h3 class="panel-title text-center"><strong>Profil de <?= e($user->firstname) ?> <?= e($user->lastname) ?></strong></h3>
					</div>
				  	<div class="panel-body">
						<div class="row">
							<div class="col-md-5">
								<img src="<?= get_avatar_url($user->email) ?>" alt="Image de profil de <?= e($user->firstname) ?> <?= e($user->lastname) ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong><?= e($user->firstname) ?> <?= e($user->lastname) ?></strong>
								<a href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a>
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