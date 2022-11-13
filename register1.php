<?php

include('connect.php');
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

		<div class="wrapper">
			<div class="inner">
				<div class="image-holder">
					<br><br><br><br><br><img src="img/fg.gif" alt="">
				</div>
				<form action="register1.php" method="post">
					<h3>Registration-Form</h3>
					<input type="hidden" name="total" value="0" />	
					<div class="form-holder active">
						<input type="text" name="username" placeholder="Enter your Username"class="form-control">
					</div>
					<div class="form-holder">
						<input type="password" name="psw" placeholder="Enter you Password" class="form-control">
					</div>
					<div class="form-holder">
						<input type="password" name="psw-repeat"placeholder="Password" class="form-control" style="font-size: 15px;">
					</div>
					<div class="radio"><center>
						<label >Status :</label>
						<input type="radio" name="status" id="gender" value="Student" required autofocus >Student</input>
						<input type="radio" name="status" id="gender" value="Personnal">Personnal</input> </center>				
					</div>
					<input type="hidden" name="status_lv" value="2" />	
					<div class="form-login">
						<button type="submit" name="register_btn">Register</button><br><br><br><br><br><br>
						<p><align = 'right'><a href="index.html"  >back</a></strong></p>
					</div>
					

					
					<br>
					
					<?php
	
    if(isset($_POST['register_btn'])){
        $total = $_POST['total'];
        $username = $_POST['username'];
        $password = $_POST['psw'];
        $password2 = $_POST['psw-repeat'];
        $status = $_POST['status'];
		$st_lv = $_POST['status_lv'];
        if($username ==""){
			echo "<br/><div class=\"alert alert-warning\">Please enter your username. </div>";
		}else if($password==$password2){
            //create user
            $sql = "INSERT INTO user(total_point,user_name,user_password,user_status,status_lv) VALUES('$total','$username','$password','@$status','$st_lv')";
            mysqli_query($con,$sql);
            $_SESSION['username'] = $username;
         
            header('location: login.php');
        }else{
            //failed
			echo "<div class=\"alert alert-warning\" >The two passwords do not match!!</div>";

        }
    }
?>
				<br><br>
				</form>
			</div>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>