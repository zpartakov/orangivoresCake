<?php 
/*
 * menu destiné aux membres
 */
?>
<!-- dynamic menu/navigation -->
<!-- <div id="cakephp-global-navigation"> -->
<ul class="sf-menu" id="example">
<li>
<?php
	echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));
?>
</li>
<li>
<?php echo $this->Html->link("Ma page", array('controller' => 'users', 'action' => 'view/'.$_SESSION['Auth']['User']['id'])); ?>
</li> 
<li>
<?php
	echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));
?>
</li>
</ul>	
