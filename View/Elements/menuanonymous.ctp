<!-- dynamic menu/navigation -->
<!-- <div id="cakephp-global-navigation"> -->
<ul class="sf-menu" id="example">
<li>
<?php
	echo $this->Html->link(__('Inscription'), array('controller' => 'users', 'action' => 'inscription'));
?>
</li>
<li>
<?php
	echo $this->Html->link(__('Contact'), array('controller' => 'contacts', 'action' => 'add'));
?>
</li>
<li>
<?php
	echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login'));
?>
</li>
<li>
<?php
	echo $this->Html->link(__('À propos'), '../apropos');
?>
