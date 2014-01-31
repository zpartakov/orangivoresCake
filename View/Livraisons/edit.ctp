<div class="livraisons form">
<?php echo $this->Form->create('Livraison'); ?>
	<fieldset>
		<legend><?php echo __('Edit Livraison'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Livraison.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Livraison.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Livraisons'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
