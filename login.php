<?php
	session_start();
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
					<img src="img/e1.gif" alt=""><br><br><br><br><br><br><br><br><br>


				</div>

				<form action="login.php" method="post">

					<h3>LOGIN</h3>
					<div class="form-holder active">
						<input type="text" name="username" placeholder="name" class="form-control">
					</div>
					<div class="form-holder">
						<input type="password" name="password" placeholder="Password" class="form-control" style="font-size: 15px;">
					</div>
					<div class="form-login">
						<button type="submit" name="login_btn">login</button><br>
						<p><strong><a href="register1.php">Register Now</a></strong></p>
					</div>
					
					
					
					<?php 
						//query from database
						if(isset($_POST['login_btn'])){
						$sql_statement = "SELECT * FROM user WHERE user_name = '" . $_POST['username'] . "' AND user_password = '" . $_POST['password'] . "'";
						$result = mysqli_query($con, $sql_statement);
						
						
						//echo $sql_statement
						while($user = mysqli_fetch_array($result)){
						
							//Admin case
							if($user['status_lv'] == 1){
								$_SESSION['ses_id'] = session_id();
								$_SESSION['username'] = $user['username'];
								$_SESSION['user_id'] = $user['user_id'];
								$_SESSION['status_lv'] = 1;
								//send to admin page
								header("Location: admin.php");
						
							}else if($user['status_lv'] == 2){
							//User case
								$_SESSION['ses_id'] = session_id();
								$_SESSION['username'] = $user['username'];
								$_SESSION['user_id'] = $user['user_id'];
								$_SESSION['status_lv'] = 2;
								//send to user page
								header("Location: exchangepoint.php");
								
							}
							}//end while
						mysqli_close($con);
							
							
						echo "<br/><br/><center> Login failed. Please try again.</center></br></br>";
						
						}
					?>
				</form>
			</div>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>