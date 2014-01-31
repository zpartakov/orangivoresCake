<div class="zzzAgrumes view">
<h2><?php echo __('Agrume'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($zzzAgrume['Agrume']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lib'); ?></dt>
		<dd>
			<?php echo h($zzzAgrume['Agrume']['lib']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo h($zzzAgrume['Agrume']['unit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prix'); ?></dt>
		<dd>
			<?php echo h($zzzAgrume['Agrume']['prix']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Agrume'), array('action' => 'edit', $zzzAgrume['Agrume']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Agrume'), array('action' => 'delete', $zzzAgrume['Agrume']['id']), null, __('Are you sure you want to delete # %s?', $zzzAgrume['Agrume']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Agrumes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agrume'), array('action' => 'add')); ?> </li>
	</ul>
</div>
