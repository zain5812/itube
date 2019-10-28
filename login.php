<?php 
session_start();
if(isset($_SESSION['userId']) && isset($_SESSION['userFullName'])){
	header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>I-Tube | Login</title>
	<meta charset=utf-8>
	<meta name=description content="Login">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/png" href="logo.png">
</head>
<body>
	<div class="login">
		<div class="loginContent">
			<h1>Login to I-Tube</h1>
			<?php 
			if(isset($_GET['msg'])){
				if($_GET['msg']==sha1(md5("incorrect"))){
					print "<div class='msg msg-err'>
					<strong>Error : </strong>Incorrect Username or Password.
					</div>";
				}
			}
			 ?>
			<form method="POST" action="process/login.php" name="loginForm">
				<div class="form-group">
					<input type="text" name="userName" placeholder="Username" tabindex="1" autocomplete="off">
					<div class="userErr">Username required</div>
				</div>
				<div class="form-group">
					<input type="password" name="userPass" placeholder="Password" tabindex="2">
					<div class="passErr">Password required</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="isLogin" value="<?=sha1(md5('login'))?>">
					<button class="loginBtn" type="submit">Login</button> or <a href="register.php" style="color: #2A5D84;">Sign up</a>
					<a class="forgot" style="color: #2A5D84;" href="#">Forgot Password ?</a>
				</div>
			</form>
		</div>
	</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/java.js"></script>
</body>
</html>