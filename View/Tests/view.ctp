<div class="tests view">
<h2><?php echo __('Test'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($test['Test']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lib'); ?></dt>
		<dd>
			<?php echo h($test['Test']['lib']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($test['Test']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Test'), array('action' => 'edit', $test['Test']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Test'), array('action' => 'delete', $test['Test']['id']), null, __('Are you sure you want to delete # %s?', $test['Test']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Test'), array('action' => 'add')); ?> </li>
	</ul>
</div>
