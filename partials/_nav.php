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
			         	 <form class="navbar-form navbar-right" data-parsley-validate method="post">
			            	<div class="form-group">
			              		<input type="email" value="<?= get_input('email') ?>" class="form-control" name="email" placeholder="Adresse e-mail" required="required" /> 
			            	</div>
			            	<div class="form-group">
   	 							<input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe" required="required" />   	 					
			            	</div>
			            	<input type="submit" class="btn btn-primary" value="Connexion" name="login" />
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
			       	   	</form>
					</div>
				</div>
			</nav>