<?php 
/*
 * activate user login
 */
		App::import('Vendor', 'functions');
		connect();
		$sql="UPDATE users SET status=1 WHERE id=".$_GET['id'];
		$sql=mysql_query($sql);
		$url="http://".SERVERNAME.CHEMIN ."/users/login";	 
?>
<p>Confirmation enregistrée</p>

<P>Vous allez être redirigé automatiquement sur la page de login</P>
<p>
<a href="<?php echo $url;?>">Se connecter maintenant</a>
</p>
<meta http-equiv="refresh" content="20;URL=<?php echo $url;?>">