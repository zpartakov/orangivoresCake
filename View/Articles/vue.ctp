<?php 
$title_for_layout=$article['Article']['title'];
?>
<div style="margin-top: 10px;" class="articles view">
<h2><?php echo $title_for_layout; ?></h2>
<h3><?php echo $article['Article']['subtitle']; ?></h3>
<p>
			<?php echo nl2br($article['Article']['content']); ?>
			</p>
