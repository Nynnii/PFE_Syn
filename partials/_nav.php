
	   		 <nav class="navbar navbar-inverse navbar-fixed-top">
		     	 <div class="container">
			        <div class="navbar-header">
			          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			           		<span class="sr-only">Toggle navigation</span>
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
			          	</button>
			          	<a class="navbar-brand" href="index.php">SYN</a>
			        </div>
			        <div id="navbar" class="navbar-collapse collapse">
			        	<?php if(is_logged_in()): ?>
			        	<ul class="nav navbar-nav navbar-right">
			        		<li class="<?= set_active('accueil') ?>">
			        			<a href="#"><?= $trad['accueil'][get_current_locale()] ?></a>
			        		</li>
			        		<li class="<?= set_active('timetable') ?>">
			        			<a href="#"><?= $trad['emploi_du_temps'][get_current_locale()] ?></a>
			        		</li>
			        		<li class="<?= set_active('cours') ?> <?= set_active('cours') ?>">
			        			<a href="cours.php?id=<?= get_session('user_id') ?>">Cours</a>
			        		</li>
			        		<li class="<?= set_active('share_code') ?>">
			        			<a href="share_code.php">Partager du code</a>
			        		</li>	
			        		
			        		<li class="dropdown">
					            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					            	<img src="<?= get_avatar_url(get_session('email')) ?>" alt="Image de profil de <?= get_session('firstname') ?> <?= get_session('lastname') ?>">
					            	<span class="caret"></span>
					            </a>
					            <ul class="dropdown-menu">
					        		<li class="<?= set_active('profile') ?> ?>">
					        			<a href="profile.php?id=<?= get_session('user_id') ?>">Mon profil</a>
					        		</li>
					        		<li class="<?= set_active('modify_profile') ?> ?>">
					        			<a href="modify_profile.php?id=<?= get_session('user_id') ?>">Modifier mon profil</a>
					        		</li>
					            	<li>
					        			<a href="logout.php">Déconnexion</a>
					        		</li>
					            </ul>
				            </li>
			        		<li class="dropdown">
					            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					            	Langue
					            	<span class="caret"></span>
					            </a>
					            <ul class="dropdown-menu">
					        		<li>
					        			<a href="?lang=fr"><img src="images/french_flag_icon.png">&nbsp;&nbsp;Français</a>
					        		</li>
					            	<li>
					        			<a href="?lang=en"><img src="images/usa_flag_icon.png">&nbsp;&nbsp;Anglais</a>
					        		</li>
					            </ul>
				            </li>				            
			        	</ul>

			        	<?php else: ?>
			         	<form class="navbar-form navbar-right" data-parsley-validate method="post">
			            	<div class="form-group">
			              		<input type="email" value="<?= get_input('email') ?>" class="form-control" name="email" placeholder="Adresse e-mail" required="required" /> 
			            	</div>
			            	<div class="form-group">
   	 							<input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe" required="required" />   	 					
			            	</div>
			            	<input type="submit" class="btn btn-primary" value="Connexion" name="login" />
			            	<!--
			            	<div class="row">
				            	<div class="col-sm-5">
					            	<div class="checkbox">
									   	 <label>
									    	  <input type="checkbox"> Garder ma session active
									   	 </label>
									</div>					            	
				            	</div>	
				            	<div id="forgotten-pswd">
					            	<a href="#">Mot de passe oublié ?</a>				            	
				            	</div>	          		
			            	</div>
			           		-->
			       	   	</form>
			       	   	<?php endif; ?>
					</div>
				</div>
			</nav>
