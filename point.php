<?php 
session_start();
	include('connect.php');
	//check login
if($_SESSION['ses_id']== ''){
	header ("Location: point.php");
}elseif($_SESSION['status_lv'] != 2){
	header ("Location: logout.php");
}else{
?>
<?php
//รับค่าจากฟอร์ม exchangepoint 
	$ex_barcode = $_REQUEST["barcode"];
	$user_id = $_REQUEST["user_id"];
	date_default_timezone_set("Asia/Bangkok");
	$today = date("Y-m-d H:i:s ");
	$pointt = 1;
//ตรวจสอบว่ามีรหัสหรือไม่
		$check = "select * from barcode  where barcode_gp = '$ex_barcode' and status_code = '1' ";
	    $query = mysqli_query($con,$check) or die(mysqli_error());
		$num = mysqli_num_rows($query); 
		//มีรหัสอยู่แล้ว
        if($num==0)   		
        {
	        echo "<script type='text/javascript'>";
		  	echo "alert ('No code , Please enter code again.');";
			echo "window.location='exchangepoint.php';";
			echo "</script>";			 
		//ถ้าไม่มีรหัส ให้ insert ข้อมูลลงไป
		}else{
		
		$sqlinsert = "INSERT INTO point(point_t,user_id,barcode,datepoint) VALUES ('$pointt','$user_id','$ex_barcode','".date("Y-m-d H:i:s")."')";
		$resultinsert  = mysqli_query($con,$sqlinsert);
		
		//และเปลี่ยนสเตตัส
		while($result = mysqli_fetch_array($query)){
		$sqlupdate = "UPDATE barcode SET status_code = '0' WHERE id_code = '".$result['id_code']."'";		
		$result  = mysqli_query($con,$sqlupdate) or die(mysqli_error());
	        echo "<script type='text/javascript'>";
		  	echo "alert ('This code is OK');";
			echo "window.location='pre_point.php';";
			echo "</script>";	
		}
	}
?>
<?php
}
?>