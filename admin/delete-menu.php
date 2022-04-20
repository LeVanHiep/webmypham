<?php
	include("../index/connect.php");
	$id = $_GET['id'];
	$mysql_query =mysqli_query($conn,"DELETE FROM menu WHERE id_menu=".$id);
	header("Location: change-menu.php");
	
?>