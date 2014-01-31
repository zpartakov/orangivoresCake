<div class="NewsletterMails index">
	<h2><?php echo __('Newsletter Mails'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('modified','date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($NewsletterMails as $NewsletterMail): ?>
	<tr>
		<td><?php echo h($NewsletterMail['NewsletterMail']['id']); ?>&nbsp;</td>
		<td><?php echo h($NewsletterMail['NewsletterMail']['subject']); ?>&nbsp;</td>
		<td><?php echo h($NewsletterMail['NewsletterMail']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $NewsletterMail['NewsletterMail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $NewsletterMail['NewsletterMail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $NewsletterMail['NewsletterMail']['id']), null, __('Are you sure you want to delete # %s?', $NewsletterMail['NewsletterMail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nouvelle newsletter'), array('action' => 'add')); ?></li>
	</ul>
</div>
