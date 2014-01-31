<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php 
        //echo phpinfo();
        echo __('Merci de renseigner votre nom d\'utilisateur et votre mot de passe'); ?></legend>
        <?php 
        echo $this->Form->input('username', array('label'=>'Nom d\'utilisateur'));
        echo $this->Form->input('password', array('label'=>'Mot de passe'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Connexion'));?>

<h2>Problème de connexion?</h2>
<ul>
<li>
<?php
	echo $this->Html->link(__('Je n\'ai pas de comptes sur "'.SITE.'" et j\'aimerai participer'), array('controller' => 'contacts', 'action' => 'add'));
?>
</li>
<li>
<?php
	echo $this->Html->link(__('J\'ai oublié mon mot de passe'), array('controller' => 'users', 'action' => 'login'));
?>
</li>
</ul>
</div>
