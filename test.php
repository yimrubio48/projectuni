<?php 

include('connect.php');
	$user_id = $_REQUEST["user_id"];
	$point_plus = $_POST["point1"];

		$querytt = "select total_point from user where user_id = ".$user_id;
		$plus = $querytt += $point_plus;
		echo "$querytt";
		echo "$plus";
	       
?>