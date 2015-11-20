<?php
//Si il y a X erreurs avec X > 0, alors on les affiche
if(isset($errors) && count($errors) != 0){
	echo '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	foreach ($errors as $error){
		echo '<li>'.$error.'</li>';
	}
	echo '</div>';
}