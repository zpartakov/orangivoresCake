<div class="groupes view">
<h2><?php echo __('Groupe'); ?></h2>
<?php 
/*
 * securité
 * 
 */ 
 if($_SESSION['Auth']['User']['Role']['lib']!="superadmin") {
 	
 	App::import('Vendor', 'functions');
 	check_usergroup($_SESSION['Auth']['User']['id'],$groupe['Groupe']['id']);
 
 }
 ?>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupe['Groupe']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lib'); ?></dt>
		<dd>
			<?php echo h($groupe['Groupe']['lib']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupe['User']['username'], array('controller' => 'users', 'action' => 'view', $groupe['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
	
	<h2>Membres de ce groupe</h2>
<?php 
	//$prixglobal=0;
	foreach ($groupe['User'] as $user):
		echo $this->Html->link($user['username'], array('controller' => 'users', 'action' => 'view/'.$user['id'])); 
		echo " | ";
	endforeach;
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Groupe'), array('action' => 'edit', $groupe['Groupe']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Groupe'), array('action' => 'delete', $groupe['Groupe']['id']), null, __('Are you sure you want to delete # %s?', $groupe['Groupe']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groupes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Groupe'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>

			