<?php 

include('connect.php');
//รับค่าจากฟอร์ม exchangepoint 
	$ex_barcode = $_REQUEST["barcode"];
	$barcode = $_POST["barcode"];
	echo $user_id = $_REQUEST["user_id"];
	$point_plus = '1';
//ตรวจสอบว่ามีรหัสหรือไม่
		$check = "select * from barcode  where barcode_gp = '$ex_barcode' and status_code = '1' ";
	    $query = mysqli_query($con,$check) or die(mysqli_error());
		$num = mysqli_num_rows($query); 
        if($num==0)   		
        {
		  	echo "code นี้ถูกใช้แล้ว";
			 

		}else{
		
		$sqlinsert = "INSERT INTO point(point,user_id,barcode) VALUES ('1','$user_id',$barcode)";
		$resultinsert  = mysqli_query($con,$sqlinsert) or die(mysqli_error());

		while($re = mysqli_fetch_array($query)){
		$querytt = "select total_point from user where user_id = ".$user_id;
		$re = mysqli_query($con,$querytt) or die(mysqli_error());
		
	       echo "$querytt";
		
			
		}
		$plus = $querytt += $point_plus;
		$tt_update = "UPDATE user SET total_point ='$plus' WHERE user_id =  ".$user_id;		
		$tt  = mysqli_query($con,$tt_update) or die(mysqli_error()); 


		while($result = mysqli_fetch_array($query)){
		$sqlupdate = "UPDATE barcode SET status_code = '0' WHERE id_code = '".$result['id_code']."'";		
		$result  = mysqli_query($con,$sqlupdate) or die(mysqli_error());
		//echo "$querytt";	
		echo "code นี้ถูกต้อง";
		mysqli_close($con);
	       
		
			
		}
	}
?>