<?php
	include('connect.php');
	
//รับค่าจากฟอร์ม exchangepoint 
	$point_me =$_POST["1"];
	$total = $_REQUEST["barcode"];
	echo $user_id = $_REQUEST["user_id"];
//ตรวจสอบว่ามีรหัสหรือไม่
		$sql = "select * from point where point,user_id = '1','$user_id' ";
	    $query = mysqli_query($con,$sql) or die(mysqli_error());
        if($point_me==1)   		
        {
	        echo "window.location='exchangepoint.php';";	 

		}else{
		//header("Location: pre_point.php");
		//$sql = "INSERT INTO barcode(barcode_gp,status_code) VALUES ($ex_barcode,'1');";
		
		$sqlinsert = "INSERT INTO point(point,user_id) VALUES ('1','$user_id');";
		$resultinsert  = mysqli_query($con,$sqlinsert) or die(mysqli_error());
		while($result = mysqli_fetch_array($query)){
		$sqlupdate = "UPDATE barcode SET status_code = '0' WHERE id_code = '".$result['id_code']."'";		
		$result  = mysqli_query($con,$sqlupdate) or die(mysqli_error());
	        echo "<script type='text/javascript'>";
		  	echo "alert ('code นี้ถูกต้อง');";
			echo "window.location='pre_point.php';";
			echo "</script>";	
		}
	}/*
?>