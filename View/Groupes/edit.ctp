<div class="groupes form">
<?php echo $this->Form->create('Groupe'); ?>
	<fieldset>
		<legend><?php echo __('Edit Groupe'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('lib');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Groupe.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Groupe.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groupes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
