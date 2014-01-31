<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('parent_id', array('value'=>'0','type'=>'text'));
		
		/*$options = array('H' => 'Homme', 'F' => 'Femme');
		print_r($utilisateurs);*/
		
		//echo $this->Form->select('parent_id', $utilisateurs, array('label'=>'Responsable'));
		/*
		echo $this->Form->select('parent_id', $utilisateurs, null, 
				array('label' => 'Select a the Plan Detail', 'empty' => '-- Select a the Plan Detail --'));
		*/
		
		#echo $this->Form->select('parent_id', $options);
		
		
		echo $this->Form->input('username');
echo "&nbsp;&nbsp;Responsable<br>";
		echo $this->Form->select('parent_id', $utilisateurs, 
				array('label' => 'Responsable', 'empty' => '-- Choisir un responsable --'));
		echo $this->Form->input('role_id');
		echo $this->Form->input('groupe_id');
		echo $this->Form->input('nom');
		echo $this->Form->input('prenom');
		echo $this->Form->input('telephone');
		echo $this->Form->input('natel');
		echo $this->Form->input('email');
		echo $this->Form->input('password', array('value'=>''));
		echo $this->Form->input('notes');
		echo $this->Form->input('date_creation');
		echo $this->Form->input('last_connection');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
