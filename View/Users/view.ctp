<?php 
/*
 * vue récapitulative
 */
 
 $title_for_layout="Ma page ".SITE;
 App::import('Vendor', 'functions');

/*
 * securité
 * 
 */ 
 if($_SESSION['Auth']['User']['Role']['lib']!="superadmin") {
 	if($_SESSION['Auth']['User']['id']!=$user['User']['id']) {
 		
 		echo '	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 		
 		echo "Désolé, vous ne pouvez voir que votre fiche récapitulative";
 		
 		exit;
 	}
 }
 
 
 ?>
 
 <div class="users view">
<div class="related">
	<h3>			<?php echo h($user['User']['username']); ?>
	 - <a name="commandes"</a><?php echo __('Mes commandes'); ?></h3>
	<?php if (!empty($user['Commande'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Livraison'); ?></th>
		<th><?php echo __('Agrume'); ?></th>
		<th><?php echo __('Quantité'); ?></th>
		<th><?php echo __('Prix'); ?></th>
		<th><?php echo __('Payé'); ?></th>
<?php 
if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {
?>		
		<th><?php echo __('Note'); ?></th>
		
		<th class="actions"><?php echo __('Actions'); ?></th>
<?php 
}
?>		
	</tr>
	<?php 
	//$prixglobal=0;
	foreach ($user['Commande'] as $commande): ?>
		<tr>
			<td>
			<?php 
				echo livraison_date($commande['livraison_id']); 
			?>
			</td>
			<td>
			<?php 
				agrume_lib($commande['agrume_id']); 
			?>
			</td>
			<td><?php echo $commande['quant']; ?></td>
			
			<td style="text-align: right">
			<?php 
		$prixleg=	prix_du_legume($commande['agrume_id']);
			
$prix=intval($commande['quant']*$prixleg);
			echo $prix;		
			?>
			.-
			</td>
			
			
			<td><?php 
			//echo $commande['paied'];
			if($commande['paied']==1){
			echo
			$this->Html->image('check.png', array(
					'alt' => 'payé',
					'title' => 'payé',
					'style' => 'width: 25px; height: 25px;',
					'border' => '0'))
							;
}?>
			</td>
<?php 
if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {
?>	
			<td><?php echo $commande['note']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'commandes', 'action' => 'view', $commande['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'commandes', 'action' => 'edit', $commande['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'commandes', 'action' => 'delete', $commande['id']), null, __('Are you sure you want to delete # %s?', $commande['id'])); ?>
			</td>
<?php 
}
?>
		</tr>
	<?php endforeach; ?>
	<tr style="background-color: lightyellow">
	<td>Total à payer</td>
	<td colspan="3" style="text-align: right">
	<?php  echo prix_total_user($user['User']['id'],'grandtotal'); ?>.-</td></tr>
		<tr style="background-color: cornsilk">
		<td>Total payé</td>
		<td  colspan="3" style="text-align: right">
		<?php 
		
		echo prix_total_user($user['User']['id'],'paye'); ?>.-</td></tr>
		<tr style="background-color: azure">
		<td>Solde</td>
		<td  colspan="3" style="text-align: right">
		<?php  echo prix_total_user($user['User']['id'],'paspaye'); ?>.-</td></tr>
		</table>
<?php endif; ?>

<p><?php echo $this->Html->link(__('Nouvelle Commande'), array('controller' => 'commandes', 'action' => 'add')); ?></p>

</div>
<h2><?php echo $title_for_layout; ?> | <a href="#commandes">Mes commandes</a></h2>
	<dl>
		<dt><?php echo __('Identifiant'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
	<?php 
if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {
?>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role_id']); ?>
			&nbsp;
		</dd>
<?php 
}
?>
		<dt><?php echo __('Groupe'); ?></dt>
		<dd>
			<?php groupe($user['User']['groupe_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($user['User']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prenom'); ?></dt>
		<dd>
			<?php echo h($user['User']['prenom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone'); ?></dt>
		<dd>
			<?php echo h($user['User']['telephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Natel'); ?></dt>
		<dd>
			<?php echo h($user['User']['natel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		
		<?php 
if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {
?>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($user['User']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Creation'); ?></dt>
		<dd>
			<?php echo h($user['User']['date_creation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Connection'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_connection']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<?php 
}
?>
	</dl>
</div>
<?php 
if($_SESSION['Auth']['User']['Role']['lib']=="superadmin") {
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
}
?>
