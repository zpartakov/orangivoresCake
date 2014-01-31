<p>Bonjour,</p>
<?php 		
echo "<p>" .$_SESSION['Auth']['User']['prenom'] ." " .$_SESSION['Auth']['User']['nom'];
echo "<p>Vous êtes correctement enregistré.</p>";
//echo "<br/>Votre dernière visite : ".$_SESSION['Auth']['User']['last_connection'];

if($_SESSION['Auth']['User']['Role']['lib']=='superadmin'){
	echo "<p>Votre rôle: " .$_SESSION['Auth']['User']['Role']['lib'] ."</p>";
	
echo "<p>" .$this->Html->link('Voir les messages',array('controller'=>'contacts','action'=>'index'))."</p>";
	}


if($_SESSION['Auth']['User']['Role']['lib']=='responsable'){
	echo "<p>Votre rôle: " .$_SESSION['Auth']['User']['Role']['lib'] ."</p>";
	echo "<p>Votre groupe: " .$_SESSION['Auth']['User']['Groupe']['lib'] ."</p>";
	echo "<p>" .$this->Html->link('Les commandes de mon groupe',array('controller'=>'commandes','action'=>'index')) ."</p>";
	
}
echo "<p>" .$this->Html->link('Passer une commande',array('controller'=>'commandes','action'=>'add')) ."</p>";

?>
<hr style="margin-bottom: 20px"/><?php echo $this->Html->link("Mon récapitulatif", array('controller' => 'users', 'action' => 'view/'.$_SESSION['Auth']['User']['id'])); ?> 
