<?php 
/*
 * vue récapitulative commandes
 */
 
 $title_for_layout="Commandes ".SITE;
 App::import('Vendor', 'functions');


 if($_SESSION['Auth']['User']['Role']['lib']=='responsable'){
 	/*
 	 * commandes groupe
 	*/
 	echo "<p>" .$_SESSION['Auth']['User']['username'] .", voici les commandes de votre groupe: " .$_SESSION['Auth']['User']['Groupe']['lib'] ."</p>";
 }
 if($_SESSION['Auth']['User']['Role']['lib']!='superadmin'){
 
 ?>
 <p>
 <em>
 Note: seules les commandes non-payées sont listées
 </em>
 </p>
 <?php 
 } else {
 	if($_GET['commande']=='next') {
 		/*
 		 * display only next orders
 		*/
 		$dateprochainelivraison=prochainelivraisonid();
 		echo "<h2>Livraison du: ";
 		echo livraison_date($dateprochainelivraison);
 		echo  "</h2>";
 	}
 }
 ?>
 <div class="commandes index">
	<h2><?php echo __('Commandes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Membre','user_id'); ?></th>
			<th>Groupe</th>
<?php 
/*
 * display date only if it is not next livraison view
*/
if($_GET['commande']!='next') {
?>			
			<th><?php echo $this->Paginator->sort('livraison_id'); ?></th>
<?php 
}
?>
			<th><?php echo $this->Paginator->sort('agrume_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quant','Quantité'); ?></th>
			<th>Unité</th>
			<th>PU</th>
			<th>Prix</th>
			<?php if($_SESSION['Auth']['User']['Role']['lib']=='superadmin'){ ?>
			<th><?php echo $this->Paginator->sort('paied','Payé'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
			<?php } ?>
	</tr>
	<?php foreach ($commandes as $commande): 

	$test=0; $solde=0;

if($_SESSION['Auth']['User']['Role']['lib']=='responsable'){
	/*
	 * commandes groupe: que pour les membres du groupe, que les commandes non payées
	 */	
	if($commande['User']['groupe_id']==$_SESSION['Auth']['User']['Groupe']['id']
		&&
			$commande['Commande']['paied']==0
			){
		$test=1;
	}
		
} elseif($_SESSION['Auth']['User']['Role']['lib']=='membre'){
	
	
} elseif($_SESSION['Auth']['User']['Role']['lib']=='superadmin'){
	
	if($_GET['commande']=='next') {
		/*
		 * display only next orders
		 */
		$dateprochainelivraison=prochainelivraisonid();
		//echo $dateprochainelivraison; exit;
		
		if($commande['Livraison']['id']==$dateprochainelivraison){
			$test=1;
				
		}
		
	} else {
	$test=1;
	}

	
	
} else {
	$test=0;
}

/*
 * display results only if test=1
 */
if($test==1) {
			?>
	<tr>
		<td>
			<?php echo $this->Html->link($commande['User']['username'], array('controller' => 'users', 'action' => 'view', $commande['User']['id'])); ?>
		</td>
		<td><?php 
		groupe($commande['User']['groupe_id']); ?>&nbsp;</td>
<?php 
/*
 * display date only if it is not next livraison view
*/
if($_GET['commande']!='next') {
?>		
		<td>
			<?php echo $this->Html->link($commande['Livraison']['date'], array('controller' => 'livraisons', 'action' => 'view', $commande['Livraison']['id'])); ?>
		</td>
<?php 
}
?>
		<td>
			<?php echo $this->Html->link($commande['Agrume']['lib'], array('controller' => 'agrumes', 'action' => 'view', $commande['Agrume']['id'])); ?>
		</td>
		<td style="text-align: right">
<?php  echo $commande['Commande']['quant']; ?>
		</td>
				<td style="text-align: right">
<?php  echo $commande['Agrume']['unit']; ?>
		</td>
					<td style="text-align: right">
<?php  echo $commande['Agrume']['prix']; ?>
		</td>
		<td style="text-align: right">
			<?php 
$prix=intval($commande['Commande']['quant']*$commande['Agrume']['prix']);
			echo $prix;			
			?>
		</td>
					
			
<?php if($_SESSION['Auth']['User']['Role']['lib']=='superadmin'){ ?>
		<td style="text-align: right"><?php echo h($commande['Commande']['paied']); ?>&nbsp;</td>

		<td><?php echo h($commande['Commande']['note']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $commande['Commande']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $commande['Commande']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $commande['Commande']['id']), null, __('Are you sure you want to delete # %s?', $commande['Commande']['id'])); ?>
		</td>
<?php } ?>
		
	</tr>

<?php 
}; //end test condition
endforeach; ?>
	<?php 
	if($_SESSION['Auth']['User']['Role']['lib']=='responsable'){
	?>
<tr style="background-color: lightyellow">
	<td>Total à payer</td>
	<td style="text-align: right" colspan="7">CHF 
		<?php echo intval(prix_total_groupe($commande['User']['groupe_id'])); ?>
	</td>
</tr>
	<?php 
	} elseif($_SESSION['Auth']['User']['Role']['lib']=='membre'){
		?>
<tr style="background-color: lightyellow"><td>Total à payer</td><td style="text-align: right"><?php  echo prix_total($commande['User']['id']); ?>.- CHF</td></tr>
		
<?php 	}
	?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} de {:pages}, montre {:current} enregistrements d\'un total de {:count}, 
			commence à l\'enregistrement {:start}, finit à l\'enregistrement {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?php if($_SESSION['Auth']['User']['Role']['lib']=='superadmin'){ ?>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Commande'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Livraisons'), array('controller' => 'livraisons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livraison'), array('controller' => 'livraisons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agrumes'), array('controller' => 'agrumes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agrume'), array('controller' => 'agrumes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php } ?>
