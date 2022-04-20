<?php
	include("../index/connect.php");
	$id=$_GET['id'];
	$mysql_query =mysqli_query($conn,"DELETE FROM product WHERE id_product=".$id);
	header("Location: ad-product.php");
?>