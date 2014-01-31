<div class="NewsletterMails view">
<h2><?php echo __('Newsletter Mail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Email'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['from_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo nl2br($NewsletterMail['NewsletterMail']['content']); ?>
			&nbsp;
		</dd>
	
		<dt><?php echo __('Sent'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['sent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($NewsletterMail['NewsletterMail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Newsletter Mail'), array('action' => 'edit', $NewsletterMail['NewsletterMail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Newsletter Mail'), array('action' => 'delete', $NewsletterMail['NewsletterMail']['id']), null, __('Are you sure you want to delete # %s?', $NewsletterMail['NewsletterMail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Newsletter Mails'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Newsletter Mail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
