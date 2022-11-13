<?php
session_start();
include('connect.php');

//check login
if($_SESSION['ses_id']== ''){
	header ("Location: insertForm.php");
}elseif($_SESSION['status_lv'] != 1){
	header ("Location: logout.php");
}else{
?>
<!DOCTYPE html>
<html>
<head>


</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<header class="masthead d-flex">
	<div class="container text-center my-auto">
		<h1 class="mb-2">SMART GARBAGE</h1>
<h1 class="mb-2">ADMIN เพิ่มข้อมูล</h1>

	</div>

	<div class="overlay"></div>
</header>
<body>
<Table align="center">

</Table>
<BR>
<BR>
<form action="insert.php" method="post" autocomplete="on" enctype="multipart/form-data" >
	<table  align="center">
	<tr>

<td><input type="hidden"  id ="example"  name ="ac" value="./avatar/avatar1.jpg"><td>
  </tr>
  <tr>
	 <td> User name: <td>
	 <td><input type="text" name="username" class="form-control"><td>
  </tr>
	<tr>
		 <td> Password:  <td>
	 <td><input type="text" name="psw" size="20" class="form-control"></td>
	</tr>

  <tr>
  	 <td> Total point: <td>
	 <td><input type="text" name="totalpoint" size="20" class="form-control"></td>
  </tr>
  <tr>
		<tr>

	  	 <td> Status: <td>
		 <td>
	 	<select name="status">
	 	 <option value="Student">Student</option>
	  	<option value="Personal">Personal</option>
		</select>
	   </td>
	  </tr>
  </tr>
  </table>

  <center>
  		<input type="submit" value="Save" class="btn btn-primary">
  		<input type="reset" value="cancel" class="btn btn-secondary">
  </center>


</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</body>
</html>
<?php
}
?>
