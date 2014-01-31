<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php 
		
		echo __('Add User');

		 ?></legend>
	<?php
App::import('Vendor', 'functions');

		?>
		<div class="input select required">
		<label for="UserParentId">Parent</label>
		<select name="data[User][parent_id]" id="UserParentId" required="required">
		<?php 
		parents();
		?>
		</select>			
		</div>
				<?php 

		echo $this->Form->input('username', array("label"=>"Nom d'utilisateur"));
		//echo $this->Form->input('role_id');

		
		?>
				<div class="input select required">
				<label for="UserRole">Role</label>
				<select name="data[User][role_id]" id="UserRole" required="required">
				<?php 
				roles();
				?>
				</select>			
				</div>

		<div class="input select required">
		<label for="UserGroupe">Groupe</label>
		<select name="data[User][groupe_id]" maxlength="85" type="text" id="UserGroupe"/>
		<?php 
		groupes();
		?>
		
		</select>
		</div>
		<?
		
		echo $this->Form->input('nom');
		echo $this->Form->input('prenom');
		echo $this->Form->input('telephone');
		echo $this->Form->input('natel');
		echo $this->Form->input('email');
		echo $this->Form->input('password', array("label"=>"Choisir votre mot de passe"));
		echo $this->Form->input('notes');
		echo $this->Form->input('date_creation',array('dateFormat' => 'DMY'));
		echo $this->Form->input('last_connection',array('dateFormat' => 'DMY'));
	//	echo $this->Form->input('status');
		
		
	?>
	<div class="input select required">
		<label for="UserStatus">Status</label>
		<select name="data[User][status]" maxlength="85" type="text" id="UserStatus"/>
		<option value="1" selected>Actif</option>
		<option value="0">Inactif</option>
		</select>
	</div>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Commandes'), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Commande'), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
