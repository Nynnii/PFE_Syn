<?php $title = "Afficher du code source"; ?>
<?php include 'partials/_header.php'; ?>

<div id="main-content">
   <div class="container">
      	<div id="main-content-share-code">
      		<pre class="prettyprint linenums"><?= e($data->code); ?></pre>
      		<div class="nav-code">
      			<a href="share_code.php" class="btn btn-primary">Nouveau</a>
               	<a href="share_code.php?id=<?= $_GET['id'] ?>" class="btn btn-warning">Cloner</a>
            </div>
     	</div>
   </div>
</div>

</div> <!-- Ferme le <div id="wrap"> du _header.php-->	

<footer>
	<div class="footer-mentions">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
				<a class="col-xs-2 col-sm-2 col-md-3" href="">SYN@2015</a>
				<a class="col-xs-2 col-sm-2 col-md-3" href="">Mentions légales</a>
				<a class="col-xs-2 col-sm-2 col-md-3" href="http://www.groupe-efrei.fr/" target="_blank">Groupe Efrei</a>
				</div>
				<div class="col-md-6">
				<a class="col-xs-2 col-sm-2 col-md-3" href="https://www.facebook.com/groups/1511900572456300/" target="_blank"><img id="facebook" src="images/fb_icon.png" style="height:40px" alt="Logo facebook" /></a>
				<img class="col-xs-2 col-sm-2 col-md-3" src="images/responsive-design.png" style="height:50px; width:90px;" alt="Icone responsive" />
				</div>
			</div>
		</div>
	</div>
</footer>

<script src="assets/js/jquery.min.js"></script>	
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/google-code-prettify/prettify.js"></script>
<script>
	prettyPrint();
</script>

</body>
</html>