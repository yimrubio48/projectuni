<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php

	$username = $_POST['username'];
	$password = $_POST['psw'];
	$tpoint = $_POST['totalpoint'];
  @$status = $_POST['status'];

		$conn = mysqli_connect("it2.sut.ac.th","project61_g9","965996","project61_g9");
		$conn->query("SET NAMES UTF8");
		$sql="INSERT INTO `user` (`user_name`,`user_password`, `total_point`, `user_status`)
		VALUES ('$username', '$password','$tpoint','@$status')";
		$rs=$conn->query($sql);
		echo "เพิ่มข้อมูลสำเร็จ !! ";
		$conn->close();
	?>
	<p><a href="admin.php">Go to Home</a></p>
</body>
</html>
