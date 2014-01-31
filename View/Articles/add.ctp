<div class="articles form">
<?php echo $this->Form->create('Article'); ?>
	<fieldset>
		<legend><?php echo __('Add Article'); ?></legend>
	<?php
	
	echo $this->Html->script('ckeditor/ckeditor');
	
		echo $this->Form->input('title');
		echo $this->Form->input('subtitle');
		//echo $this->Form->input('content');
		
		echo $this->Form->textarea('content', array(
				'class' => 'ckeditor'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Articles'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	/*toolbar: [[ 'Bold', 'Italic','Underline','Subscript','Superscript'],],
	*/
CKEDITOR.replace( 'ArticleContent', {
width: '100%',
height: '600',
});
</script>