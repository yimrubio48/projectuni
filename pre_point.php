<?php
session_start();
	include('connect.php');	
	
	//check login
if($_SESSION['ses_id']== ''){
	header ("Location: pre_point.php");
}elseif($_SESSION['status_lv'] != 2){
	header ("Location: logout.php");
}else{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>smart garbar</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>
<body>
			<div class="city main"><center>
				<form action="exchangepoint.php
				" method="post">
					<br><br><h3>POINT</h3>
					
					<div >
						<input type="hidden" name="user_id" value ="<?php echo $_SESSION['user_id'] ?> " vclass="form-control">
					</div >
					<div class="image-holder">
					<img src="img/75_smile.gif" width="180" alt=""><br>
					</div>	
					<div ><br>
					
					<?php
					
						$user_id = $_SESSION['user_id'];
						include('connect.php');
						
						$pshow = mysqli_query($con,"SELECT * FROM point WHERE user_id= " .$_SESSION['user_id']);
						if (!$con) die(''. mysqli_connect_error());
						$row = mysqli_fetch_array($pshow);
						echo "Successfully"."<br/><br/>";
						echo "You get "."&nbsp;&nbsp;&nbsp;".$row['point_t']."&nbsp;&nbsp;&nbsp;"."points"."<br/><br/>";
						
						//sum point
						$sql = "SELECT SUM(point_t) AS 'value_sum' FROM point WHERE user_id = '".$user_id."'";
						$stt = mysqli_query($con,$sql); 
						$row = mysqli_fetch_assoc($stt); 
						$sum = $row['value_sum'];

						//update sum to totalpoint
						$ins = "UPDATE user SET 
						total_point ='$sum'
						WHERE user_id = '".$user_id."'";	
						$resum  = mysqli_query($con,$ins);
					?>
						<br>
						<br>
					</div>
						
						<button type="submit" name="ex_point" >back</button><br><br><br><br><br><br>
					</div>
				</form></center>
			</div>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<?php
}
?>
