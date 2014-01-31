<div class="zzzAgrumes form">
<?php echo $this->Form->create('Agrume'); ?>
	<fieldset>
		<legend><?php echo __('Add Agrume'); ?></legend>
	<?php
		echo $this->Form->input('lib');
		echo $this->Form->input('unit');
		echo $this->Form->input('prix');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Agrumes'), array('action' => 'index')); ?></li>
	</ul>
</div>
