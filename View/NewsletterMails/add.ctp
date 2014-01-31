<div class="zzzNewsletterMails form">
<?php echo $this->Form->create('NewsletterMail'); ?>
	<fieldset>
		<legend><?php echo __('Add Newsletter Mail'); ?></legend>
	<?php
	echo $this->Html->script('ckeditor/ckeditor');
	
	
		echo $this->Form->input('from', array('value'=>'Agustin Guardiola'));
		echo $this->Form->input('from_email', array('value'=>'aguardiola@bluewin.ch'));
		echo $this->Form->input('subject', array('value'=>'Oranges: prochaine livraison'));
	/*	echo $this->Form->input('content', array('value'=>'
Bonjour,

Une prochaine livrason est prévue pour le: 

Jeudi ... de 16h à 19h
Vendredi ... de 16h à 19h

Merci de me donner les sous avant, les tarifs et toutes les informations sont sur le site:

<a href="http://oblomov.info/websites/agrumes/">http://oblomov.info/websites/agrumes/</a>

Meilleures salutations vitaminées,

Agu
				',
				'style'=>'height: 500px'
				));
		*/
		echo $this->Form->textarea('content', array(
				'class' => 'ckeditor',
				'value'=>'
				Bonjour,<br>
				<br>
				Une prochaine livrason est prévue pour le:<br>
				<br>
				Jeudi ... de 16h à 19h<br>
				Vendredi ... de 16h à 19h<br>
				<br>
				Merci de me donner les sous avant, les tarifs et toutes les informations sont sur le site:<br>
				<br>
				<a href="http://oblomov.info/websites/agrumes/">http://oblomov.info/websites/agrumes/</a><br>
				<br>
				Meilleures salutations vitaminées,<br>
				<br>
				Agu
				',
		));
	?>
	Test? <input type="checkbox" name="test" checked=1">
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

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