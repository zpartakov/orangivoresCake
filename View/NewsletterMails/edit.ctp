<div class="zzzNewsletterMails form">
<?php echo $this->Form->create('NewsletterMail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Newsletter Mail'); ?></legend>
	<?php
	echo $this->Html->script('ckeditor/ckeditor');
	
		echo $this->Form->input('id');
		echo $this->Form->input('from');
		echo $this->Form->input('from_email');
		echo $this->Form->input('subject');
		echo $this->Form->input('content', array("style"=>"height: 500px", 'class' => 'ckeditor',));
		echo $this->Form->input('sent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('NewsletterMail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('NewsletterMail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Newsletter Mails'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	/*toolbar: [[ 'Bold', 'Italic','Underline','Subscript','Superscript'],],
	*/
CKEDITOR.replace( 'NewsletterMailContent', {
width: '100%',
height: '600',
});
</script>