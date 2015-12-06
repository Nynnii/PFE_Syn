<?php $title = "Cours"; ?>
<?php include 'partials/_header.php'; ?>

<?php
	// par defaut, trier par...
	$orderby = 'nom';
	  
	// par defaut, tri ascendant 
	$order = 'asc';

	// par defaut, repertoire courant
	$repertoire_courant = BASE;
	if( isset($_GET['p']) && !empty($_GET['p']) ) {
		$repertoire_courant =  secureDir($_GET['p']);
		
		$pos = strpos($repertoire_courant, BASE);
		if( (0 != $pos) or ($pos === false) ) {
			$repertoire_courant = BASE;
		}
	}
?>

<!-- JQUERY -->
	<script src="assets/js/jquery-1.11.0.min.js"></script>	
	
	<!-- SHADOWBOX -->
	<script src="assets/js/shadowbox-3.0.3/shadowbox.js"></script>
	<script>
		Shadowbox.init();
	</script>


<!-- SCRIPTS DIVERS -->	
	<script>
		$(document).ready(function(){
		
			$(".element3").hover( 
				function () { $(this).addClass("hover"); }, function () { $(this).removeClass("hover"); }
			);			
			
			$(".repertoire").click(function () { 
				$(".element3").removeClass("stay");
				$(this).addClass("stay");
			});
			$(".image").click(function () { 
				$(".element3").removeClass("stay");
				$(this).addClass("stay");
			});
			$(".fichier").click(function () { 
				$(".element3").removeClass("stay");
				$(this).addClass("stay");
			});
			$(".inconnu").click(function () { 
				$(".element3").removeClass("stay");
				$(this).addClass("stay");
			});

			$(".repertoire").dblclick(function(){		
				window.location.href = 'cours3.php?p='+$(this).attr("id").slice(8);
			});
			$(".image").dblclick(function(){		
				window.location.href = 'ressource.php?id='+$(this).attr("id").slice(8);
			});
			$(".fichier").dblclick(function(){		
				window.location.href = 'ressource.php?id='+$(this).attr("id").slice(8);
			});
			$(".inconnu").dblclick(function(){		
				window.location.href = 'ressource.php?id='+$(this).attr("id").slice(8);
			});
			
		});
	</script>

<div id="main-content">
	<div class="container">
		<div class="jumbotron">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
				<ul>
					<?php 
					$noeud = 0;
					$t_fildariane = array();
					foreach(getBreadcrumb($repertoire_courant) as $element) { 
						$noeud++;
						$t_fildariane[] = $element;
						$p = implode("/", $t_fildariane);
						// j'affiche la racine
						if($noeud == 1) { ?>
							<li class="racine"><a href="cours3.php"><img alt="racine" src="themes/original/images/repertoire.png" />&nbsp;racine</a></li>
							<?php $nb_elements = count(getBreadcrumb($repertoire_courant));
								if($nb_elements > 0) { ?>
									<li><img alt="&gt;" src="themes/original/images/arrow.gif" /></li>
								<?php } ?>						
						<?php }
						else {
							echo "<li><a href=\"cours3.php?p=" , rawurlencode($p) , "&amp;orderby=nom&amp;order=". $order ."\">" , normalizeString($element) , "</a></li>";
							// s'il n'y a pas d'elements enfants, on n'affiche pas le marqueur
							if(hasChildren($p)) { ?>
								<li><img alt="&gt;" src="themes/original/images/arrow.gif" /></li>
							<?php }
						}
					} ?>
				</ul>
				</div><!-- fin contenu -->
			</nav>
	
			<div class="container-fluid">
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="cours.php?p=<?php echo rawurlencode($repertoire_courant) ?>">Mosa&iuml;que</a></li>
						<li><a href="cours2.php?p=<?php echo rawurlencode($repertoire_courant) ?>">D&eacute;tail</a></li>
						<li id="vue_courante"><a href="#">Grandes ic&ocirc;nes</a></li>
					</ul>
				</div><!-- fin contenu -->
			</div><!-- fin vues -->
	
	
			<div class="container">		
				
				<div class="col-sm-3">		
				
					<div id="arborescence">
					
						<ul>
							<li class="racine"><a href="cours3.php"><img alt="racine" src="themes/original/images/repertoire.png" />racine</a></li>
							<?php foreach(getDir(BASE) as $element) { ?>
								<li>
									<a href="cours3.php?p=<?php echo rawurlencode(BASE . "/" . $element['nom']) ?>">
										<img alt="repertoire" src="themes/original/images/repertoire.png" />
										<span <?php echo rawurlencode(BASE . "/" . $element['nom']) == rawurlencode($repertoire_courant) ? 'style="font-weight:bold"' : '' ?> title="<?php echo normalizeString($element['nom']) ?>"><?php echo shortenString(normalizeString($element['nom']), 18) ?></span>
									</a>
								</li>
							<?php } ?>
						</ul>
					
					</div><!-- fin arborescence -->
				</div>
	
			<div class="col-sm-9">
				<div id="contenu_repertoire">
		
					<?php 
					$contenu_repertoire = listDir($repertoire_courant);
					
					if(isset($contenu_repertoire) && !empty($contenu_repertoire) ){
					
						foreach($contenu_repertoire as $element) {
						
							switch($element['type']) {
							
								case 'repertoire': ?>
									<div class="element3 repertoire" id="element_<?php echo rawurlencode($repertoire_courant."/".$element['nom']), "&amp;orderby=nom&amp;order=", $order ?>" title="<?php echo $element['nom.extension'] ?>">
										<div class="element3_1"><img alt="repertoire" src="themes/original/images/96/repertoire.png" /></div>				
										<div class="element3_2"><span> <?php echo normalizeString($element['nom']) ?></span></div>								
									</div>
									<?php break;
									
								case 'fichier':
									if( in_array(strtolower($element['extension']), $t_extensions_reconnues) ) { ?>
										<div class="element3 fichier" id="element_<?php echo rawurlencode($repertoire_courant."/".$element['nom.extension']), "&amp;orderby=nom&amp;order=", $order ?>" title="<?php echo $element['nom.extension'] ?>">
											<div class="element3_1"><img alt="fichier" src="themes/original/images/96/<?php echo strtolower($element['extension']) ?>.png" /></div>				
											<div class="element3_2"><span><?php echo shortenString(normalizeString($element['nom.extension']), 50) ?></span></div>			
										</div>
									<?php }
									else { ?>
										<div class="element3 inconnu" id="element_<?php echo rawurlencode($repertoire_courant."/".$element['nom.extension']), "&amp;orderby=nom&amp;order=", $order ?>" title="<?php echo $element['nom.extension'] ?>">
											<div class="element3_1"><img alt="inconnu" src="themes/original/images/96/inconnu.png" /></div>
											<div class="element3_2"><span><?php echo shortenString(normalizeString($element['nom.extension']), 50) ?></span></div>												
										</div>							
									<?php }
									break;
									
								case 'image': ?>
									<div class="element3 image" id="element_<?php echo rawurlencode($repertoire_courant."/".$element['nom.extension']), "&amp;orderby=nom&amp;order=", $order ?>" title="<?php echo $element['nom.extension'] ?>">
										<div class="element3_1">
										<img alt="" src="miniatures/timthumb.php?w=96&h=96&src=<?php echo rawurlencode($repertoire_courant."/".$element['nom.extension']) ?>" />
											<a href="miniatures/timthumb.php?w=<?php echo $element["largeur"] ?>&h=<?php echo $element["hauteur"] ?>&src=<?php echo rawurlencode($repertoire_courant."/".$element['nom.extension']) ?>" rel="shadowbox;height=<?php echo $element["hauteur"]?>;width=<?php echo $element["largeur"]?>"><img id="glass" alt="apercu" src="themes/original/images/glass.png" /></a>
										</div>				
										<div class="element3_2">
											<span><?php echo shortenString(normalizeString($element['nom.extension']), 50) ?></span>
										</div>									
									</div>								
									<?php break;			
						
							}
						
						}
						
					}
					else { ?>
					
						<img id="info" alt="[i]" src="themes/original/images/info.png" /> R&eacute;pertoire vide
						
					<?php } ?>
			
				</div><!-- fin contenu_repertoire -->
			</div>
			
	
			</div><!-- fin contenu -->
		
			</div><!-- fin corps -->
		</div>
	</div>
</div>

<?php include 'partials/_footer.php'; ?>