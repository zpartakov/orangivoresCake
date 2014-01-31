<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo SITE ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('print', array('media' => 'print'));
				
		echo $this->Html->script('jquery/jquery');
		
		/*
		 * dynamic menus http://users.tpg.com.au/j_birch/plugins/superfish/
		*/
		echo $this->Html->css('superfish/superfish');
		echo $this->Html->script('superfish/superfish');
		echo $this->Html->script('superfish/hoverIntent');

		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		
	?>
	<script>

		(function($){ //create closure so we can safely use $ as alias for jQuery

			$(document).ready(function(){

				// initialise plugin
				var example = $('#example').superfish({
					//add options here if required
				});

				// buttons to demonstrate Superfish's public methods
				$('.destroy').on('click', function(){
					example.superfish('destroy');
				});

				$('.init').on('click', function(){
					example.superfish();
				});

				$('.open').on('click', function(){
					example.children('li:first').superfish('show');
				});

				$('.close').on('click', function(){
					example.children('li:first').superfish('hide');
				});
			});

		})(jQuery);


		</script>
	
</head>
<body>
	<div id="container">
	
		<div id="menu">
		<a href="http://<? echo SERVERNAME.CHEMIN."/";?>">
		<?php 
		echo 
					$this->Html->image('agrumes.jpg', array(
							'alt' => SITEDESC, 
							'title' => SITEDESC, 
							'style' => 'width: 110px; height: 73px; float: right; margin-right: 15%; margin-top: 10px',
							'border' => '0'))
				;?>
				</a>
		<?php
		if($_SESSION['Auth']['User']['role_id']=='1') {
			/*
			 * menu super-admin
			 */
			//if($_SERVER["REQUEST_URI"]!='/websites/orangivores/users/login') {
				echo $this->element('menuadmin');
			//}
		}
		
		if($_SESSION['Auth']['User']['role_id']=='2') {
			/*
			 * menu membres
			 */
			//echo "menu responsables";
			echo $this->element('menuresponsables');
				
		} 
		
		if($_SESSION['Auth']['User']['role_id']=='3') {
			/*
			 * menu membres
			 */
			//echo "menu membres";
			echo $this->element('menumembres');
				
		}	
		
		if(!($_SESSION['Auth']['User']['role_id'])){
			/*
			 * not superadmin, not logged
			 */
			echo $this->element('menuanonymous');
				
		}
		?> 
		</div>

		<div id="content" style="padding-top: 5px">

			<?php echo $this->Session->flash(); ?>

			<?php 
			/*
			 * the main content
			 */
			
			echo $this->fetch('content'); 
			
			?>
		</div>
		
<!-- footer -->
<div id="footer" style="margin-top: 10px">
	<div style="font-size: smaller; color: black; background-color: lightyellow; padding: 12px; margin-right: 10%; margin-left: 10%; margin-bottom: 20px">
		<div class="help">
			<table>
				<tr>
					<td class="tablepied">
						<?php
						echo "<a href=\"http://oblomov.info/websites/orangivores/aide\">";
						echo $this->Html->image('icons/help.png', array("alt"=>"Aide","title"=>"Aide","width"=>"50","height"=>"50"));
						echo "</a>";
						?>
					<td class="tablepied">
						<?php 
						//print page
						echo "<a class=\"logoprint\" href=\"javascript:window.print();\">";
						echo $this->Html->image('icons/icon-print.jpg', array("alt"=>"Imprimer","title"=>"Imprimer"));
						echo "</a>"; 
						?>
					</td>
					<!-- about -->
					<td class="tablepied">
						<?php
						echo '<a target="_blank" class="contact" href="http://radeff.net/c5/webmastering/" title="About">'.
						$this->Html->image('icons/tux_che.jpg', array("alt"=>"About")).'</a>';
						?>
					</td>
					<!-- github -->
					<td class="tablepied">
						<?php
						echo '<a target="_blank" class="contact" href="https://github.com/zpartakov/orangivoresCake" title="github repository">'.$this->Html->image('icons/github.png', array("alt"=>"github repository")).'</a>';
						?>
					</td>
					<!-- contact -->
					<td class="tablepied">
						<?php
						echo '<a class="contact" href="http://oblomov.info/websites/orangivores/contact" title="Contact">'.$this->Html->image('icons/ico-contact.gif', array("alt"=>"Contact")).'</a>';
						?>
					</td>
					<td class="tablepied">
						<?
						//license
						echo '<a target="_blank" href="http://www.gnu.org/licenses/gpl-3.0.txt">'
						.$this->Html->image('icons/copyleft.jpg', array("alt"=>"GPL License / CopyLeft","title"=>"GPL License / CopyLeft","width"=>"45","height"=>"45"))
						.'</a>';
						?>
					</td>
					<td>
						<?
						echo $this->Html->image('icons/qrcode.png', array("alt"=>"Code QR","title"=>"Code QR", 'width'=>'45'));
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>		
</div>

</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
