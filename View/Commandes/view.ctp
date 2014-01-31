<div class="commandes view">
<h2><?php echo __('Commande'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($commande['Commande']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($commande['User']['identifiant'], array('controller' => 'users', 'action' => 'view', $commande['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Livraison'); ?></dt>
		<dd>
			<?php echo $this->Html->link($commande['Livraison']['date'], array('controller' => 'livraisons', 'action' => 'view', $commande['Livraison']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agrume'); ?></dt>
		<dd>
			<?php echo $this->Html->link($commande['Agrume']['lib'], array('controller' => 'agrumes', 'action' => 'view', $commande['Agrume']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quant'); ?></dt>
		<dd>
			<?php echo h($commande['Commande']['quant']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paied'); ?></dt>
		<dd>
			<?php echo h($commande['Commande']['paied']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($commande['Commande']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Commande'), array('action' => 'edit', $commande['Commande']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Commande'), array('action' => 'delete', $commande['Commande']['id']), null, __('Are you sure you want to delete # %s?', $commande['Commande']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Livraisons'), array('controller' => 'livraisons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livraison'), array('controller' => 'livraisons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agrumes'), array('controller' => 'agrumes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agrume'), array('controller' => 'agrumes', 'action' => 'add')); ?> </li>
	</ul>
</div>
