<div class="contacts form">
<?php echo $this->Form->create('Contact'); ?>
	<fieldset>
		<legend><?php echo __('Participer'); ?></legend>
		<h2>Merci de remplir ce formulaire, nous reprendrons rapidement contact avec vous</h2>
	<?php
		echo $this->Form->input('nom');
		echo $this->Form->input('prenom');
		echo $this->Form->input('adresse');
		echo $this->Form->input('code_postal');
		echo $this->Form->input('commune');
		echo $this->Form->input('telephone');
		echo $this->Form->input('natel');
		echo $this->Form->input('email');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer')); ?>
</div>

