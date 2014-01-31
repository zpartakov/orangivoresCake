<div class="commandes form">
<?php echo $this->Form->create('Commande'); ?>
	<fieldset>
		<legend><?php echo __('Passer une commande'); ?></legend>
	<?php
	App::import('Vendor', 'functions');
	
if($_SESSION['Auth']['User']['Role']['lib']!="superadmin") {
	$id=$_SESSION['Auth']['User']['id'];
	echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$id));
	$prochainelivraison=prochainelivraison(2);
	setlocale(LC_TIME, "fr_FR");
	echo "<br>Prochaines livraisons: ";
	echo $prochainelivraison;
	$livraisonid=prochainelivraisonid();
	echo $this->Form->input('user_id', array("type"=>"hidden", 'value'=>$_SESSION['Auth']['User']['id']));
	echo $this->Form->input('livraison_id', array("type"=>"hidden", 'value'=>$livraisonid));
	
} else {
	echo $this->Form->input('user_id');
	echo $this->Form->input('livraison_id');
	
}


		echo $this->Form->input('agrume_id');
				
		$options = array(
				'5' => '5 kg',
				'10' => '10 kg',
				'15' => '15 kg',
				'20' => '20 kg',
				'25' => '25 kg',
				'30' => '30 kg',
				'35' => '35 kg',
				'40' => '40 kg',
				'45' => '45 kg',
				'50' => '50 kg'
		);
		echo $this->Form->input('quant', array('options' => $options, 'label'=>'Quantité: <span class="position: relative; top: -50px"> (un cageot: 10kg; 1/2 cageot: 5 kg)</span>'));
		
		if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {

			echo $this->Form->input('paied', array("value"=>0));
			echo $this->Form->input('note');
				
		} else {
			echo $this->Form->input('paied', array("type"=>"hidden", "value"=>0));
				
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<hr/><?php echo $this->Html->link("J'ai fini mes commandes: récapitulatif", array('controller' => 'users', 'action' => 'view/'.$_SESSION['Auth']['User']['id'])); ?> 
</div>

<?php 
		if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {
			?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Commandes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Livraisons'), array('controller' => 'livraisons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livraison'), array('controller' => 'livraisons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agrumes'), array('controller' => 'agrumes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agrume'), array('controller' => 'agrumes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
		}
?>
		