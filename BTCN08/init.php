<?php
require_once 'functions.php';
session_start();
$db = new PDO('mysql:host=localhost;dbname=id7177239_btcn07;charset=utf8','id7177239_manh1','123456');
$currentUser = null;
if(isset($_SESSION ['userId']))
{
	$user = findUserById($_SESSION ['userId']);
	if($user)
	{
		$currentUser = $user;
	}
}
?>	
