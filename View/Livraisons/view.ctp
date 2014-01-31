<div class="livraisons view">
<h2><?php echo __('Livraison'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($livraison['Livraison']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($livraison['Livraison']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Montant'); ?></dt>
		<dd>
			<?php echo h($livraison['Livraison']['montant']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($livraison['Livraison']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Livraison'), array('action' => 'edit', $livraison['Livraison']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Livraison'), array('action' => 'delete', $livraison['Livraison']['id']), null, __('Are you sure you want to delete # %s?', $livraison['Livraison']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Livraisons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livraison'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Commandes'); ?></h3>
	<?php if (!empty($livraison['Commande'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Livraison Id'); ?></th>
		<th><?php echo __('Agrume Id'); ?></th>
		<th><?php echo __('Quant'); ?></th>
		<th><?php echo __('Paied'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($livraison['Commande'] as $commande): ?>
		<tr>
			<td><?php echo $commande['id']; ?></td>
			<td><?php echo $commande['user_id']; ?></td>
			<td><?php echo $commande['livraison_id']; ?></td>
			<td><?php echo $commande['agrume_id']; ?></td>
			<td><?php echo $commande['quant']; ?></td>
			<td><?php echo $commande['paied']; ?></td>
			<td><?php echo $commande['note']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'commandes', 'action' => 'view', $commande['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'commandes', 'action' => 'edit', $commande['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'commandes', 'action' => 'delete', $commande['id']), null, __('Are you sure you want to delete # %s?', $commande['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
