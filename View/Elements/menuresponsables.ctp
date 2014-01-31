<?php 
/*
 * menu destiné aux responsables
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
</ul>	