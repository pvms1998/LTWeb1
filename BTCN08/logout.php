<?php ob_start(); ?>
<?php 
	require_once 'init.php';
	require_once 'functions.php';
	unset($_SESSION['userId']);
	header('Location: index.php');
	ob_enf_fluch();
?>