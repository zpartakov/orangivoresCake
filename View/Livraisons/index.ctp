<div class="livraisons index">
	<h2><?php echo __('Livraisons'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('montant'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($livraisons as $livraison): ?>
	<tr>
		<td><?php echo h($livraison['Livraison']['id']); ?>&nbsp;</td>
		<td><?php echo h($livraison['Livraison']['date']); ?>&nbsp;</td>
		<td><?php echo h($livraison['Livraison']['montant']); ?>&nbsp;</td>
		<td><?php echo h($livraison['Livraison']['note']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $livraison['Livraison']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $livraison['Livraison']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $livraison['Livraison']['id']), null, __('Are you sure you want to delete # %s?', $livraison['Livraison']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Livraison'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
