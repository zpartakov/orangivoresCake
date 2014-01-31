<div class="commandes form">
<?php echo $this->Form->create('Commande'); ?>
	<fieldset>
		<legend><?php echo __('Edit Commande'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('livraison_id');
		echo $this->Form->input('agrume_id');
		echo $this->Form->input('quant');
		echo $this->Form->input('paied');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Commande.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Commande.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Livraisons'), array('controller' => 'livraisons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livraison'), array('controller' => 'livraisons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agrumes'), array('controller' => 'agrumes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agrume'), array('controller' => 'agrumes', 'action' => 'add')); ?> </li>
	</ul>
</div>
