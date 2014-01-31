<div class="livraisons form">
<?php echo $this->Form->create('Livraison'); ?>
	<fieldset>
		<legend><?php echo __('Add Livraison'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('montant');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Livraisons'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
