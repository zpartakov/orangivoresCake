<?php 
/*
 * superadmin menu
 */
if($_SESSION['Auth']['User']['role_id']=='1') {
?>
<!-- dynamic menu/navigation -->
<!-- <div id="cakephp-global-navigation"> -->
<ul class="sf-menu" id="example">


<li><?php
	echo $this->Html->link('Articles', array('controller'=>'Articles', 'action'=>'index'));
	?>
	<ul>
	<li><?php
	echo $this->Html->link('Ajout Article', array('controller'=>'Articles', 'action'=>'add'));
	?></li>
	</ul>
</li>
<li><?php
	echo $this->Html->link('Agrumes', array('controller'=>'Agrumes', 'action'=>'index'));
	?>
	<ul>
	<li><?php
	echo $this->Html->link('Ajout agrume', array('controller'=>'Agrumes', 'action'=>'add'));
	?></li>
	</ul>
</li>

<li><?php
	echo $this->Html->link('Membres', array('controller'=>'Users', 'action'=>'index'));
	?>
	<ul>
		<li>
<?php
	echo $this->Html->link('Nouveau Membre', array('controller'=>'Users', 'action'=>'add'));
	?>		</li>
		<li>
		<?php
			echo $this->Html->link('Roles', array('controller'=>'Roles', 'action'=>'index'));
			?>
		</li>
		<li>
		<?php
			echo $this->Html->link('Groupes', array('controller'=>'Groupes', 'action'=>'index'));
			?>
		</li>
			<li>
			<?php
			echo $this->Html->link('Newsletter', array('controller'=>'NewsletterMails', 'action'=>'index'));
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Contacts', array('controller'=>'Contacts', 'action'=>'index'));
			?>
		</li>
	</ul>
</li>


<li>
<?php
echo $this->Html->link('Livraisons', array('controller'=>'Livraisons', 'action'=>'index'));
?>
	<ul>
		<li>
			<?php
			echo $this->Html->link('Nouvelle Livraison', array('controller'=>'Livraisons', 'action'=>'add'));
			?>
		</li>
	</ul>
</li>

<li>
	<?php
	echo $this->Html->link('Commandes', array('controller'=>'Commandes', 'action'=>'index'));
	?>
		<ul>
			<li>
				<?php
				echo $this->Html->link('Prochaine commande', array('controller'=>'Commandes', 'action'=>'index?commande=next'));
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link('Nouvelle commande', array('controller'=>'Commandes', 'action'=>'add'));
				?>
			</li>
		</ul>
</li>
<li>
<?php
	echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));
?>
</li>
</ul>	
<?php 
}
?>
