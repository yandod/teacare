<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>NAMIKARE > <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('debug', 'lithium')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
	<div id="container">
		<div id="header">
			<h1>NAMIKARE 2010 edition.</h1>
			<h2>
				Powered by <?php echo $this->html->link('Lithium', 'http://lithify.me/'); ?>.
			</h2>
		<?php if(is_array($info)):?>
		    <?php //var_dump($info); ?>
			<?= $this->html->image($info['profile_image_url'],array('width'=>30,'height'=>30)); ?> 
			<?= $info['screen_name']?> 
			(<?php echo $this->html->link('Logout', 'Tweet::logout'); ?>)
		<?php else: ?>
			<?php echo $this->html->link('Login', 'Tweet::login'); ?>
		<?php endif;?>
		</div>
		<div id="content">
			<?php echo $this->content(); ?>
		</div>
	</div>
</body>
</html>