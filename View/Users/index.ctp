<div class="users index" style="padding-top: 70px">
<?php 
$details=$_GET['details'];
//echo "Détail: ".$details;
if($details!=1){
	echo "<p><a href=\"?details=1\">Détails</a></p>";
}
App::import('Vendor', 'functions');

//        echo "Votre rôle: " .$_SESSION['Auth']['User']['role_id'];
?>
<h2><?php echo __('Users'); ?></h2>
	<!-- begin search form -->
<table>
	<tr>
	<td> 
		<div class="input">
			<?php echo $this->Form->create('User', array('url' => array('action' => 'index'))); ?>
			<?php echo $this->Form->input('q', array('label' => false, 'size' => '50', 'class'=>'txttosearch')); ?>
		</div>
	</td>
	<td>
		<input type="submit" class="chercher" value="Chercher" /> 
	</td>
	</tr>
</table>
<!-- end search form -->
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php 
			echo $this->Paginator->sort('parent_id'); 
			?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th><?php echo $this->Paginator->sort('groupe_id'); ?></th>
		<?php 
			if($details==1){
		?>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('prenom'); ?></th>
		<?php 
			}
		?>	
			<th><?php echo $this->Paginator->sort('telephone'); ?></th>
			<th><?php echo $this->Paginator->sort('natel'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
		<?php 
			if($details==1){
		?>
	
			<th><?php echo $this->Paginator->sort('date_creation'); ?></th>
			<th><?php echo $this->Paginator->sort('last_connection'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
		<?php 
			}
		?>	
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td>
		
		<?php 
		parent($user['User']['parent_id']);
		$parent=parent($user['User']['parent_id']);
		echo $this->Html->link($parent, array('action' => 'parent', $user['User']['parent_id'])); 
				
		?>&nbsp;</td>
		<td>
			<?php 
			echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id'])); ?>
		</td>
		<td><?php 
		echo $user['Role']['lib'];
		//echo h($user['User']['role_id']); 
		?>&nbsp;</td>
		<td><?php 
		//echo $user['User']['groupe_id']; 
		echo $user['Groupe']['lib']; 
		
		?>&nbsp;</td>
		<?php 
			if($details==1){
		?>
		<td><?php echo h($user['User']['nom']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['prenom']); ?>&nbsp;</td>
		<?php 
			}
		?>
		
		<td><?php echo h($user['User']['telephone']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['natel']); ?>&nbsp;</td>
		<td><?php 
		echo "<a href=\"mailto:";
		echo  $user['User']['email'];
		echo "\">" .$user['User']['email'];
		echo "</a>";
		 ?>&nbsp;</td>
		<?php 
			if($details==1){
		?>
		<td><?php echo h($user['User']['date_creation']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_connection']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<?php 
			}
		?>
				
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
