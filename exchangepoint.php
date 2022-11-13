<?php
session_start();
include('connect.php');

//check login
if($_SESSION['ses_id']== ''){
	header ("Location: exchangpoint.php");
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
				<form action="point.php" method="post">
					<br><br><h3>EXCHANG POINT</h3>

					<?php
					$result = mysqli_query($con,"SELECT * FROM user WHERE user_id= " .$_SESSION['user_id']);
					if (!$con) die(''. mysqli_connect_error());
					$row = mysqli_fetch_array($result);
					
					echo "Hello : ".$row['user_name']."<br/><br/>";
					
					date_default_timezone_set("Asia/Bangkok");
					$today = date("d/m/Y h:i:sa");
					echo "Today is  "."&nbsp;&nbsp;&nbsp;".$today."<br/><br/>";
					
					$show = mysqli_query($con,"SELECT * FROM user WHERE user_id= " .$_SESSION['user_id']);
					if (!$con) die(''. mysqli_connect_error());
					$row = mysqli_fetch_array($show);
					echo "You have "."&nbsp;&nbsp;&nbsp;".$row['total_point']."&nbsp;&nbsp;&nbsp;"."points"."<br/><br/>";
					?>
					<?php
					
					include('connect.php');
						
						
						$tdp = "SELECT SUM(point_t) AS abc FROM point WHERE user_id= " .$_SESSION['user_id']." GROUP BY datepoint";
						$ttp = mysqli_query($con,$tdp); 
						
						
						$row = mysqli_fetch_assoc($ttp); 
						$s = $row['abc'];
						echo  "<td>".$row["abc"] .  "</td> "; 
					
					?>
					<br>
					<div >
						<input type="hidden" name="point1" value ="1"> 
						<input type="hidden" name="user_id" value ="<?php echo $_SESSION['user_id'] ?> " vclass="form-control">
					</div >
					<br><br>
					<div >
						<input  type="text" name="barcode" placeholder="Enter your barcode"class="form-control">
					</div>
						<br>
						<button type="submit" name="ex_point">EXCHANG</button><br><br><br><br><br><br>
						<p><strong><a href="logout.php">Log out</a></strong></p>
						
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