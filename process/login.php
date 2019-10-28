<?php 
session_start();
if(isset($_SESSION['userId']) && isset($_SESSION['userFullName'])){
	header("Location:../index.php");
}
function getData($fieldName,$value){
	global $link;
	$query="SELECT $fieldName FROM users WHERE userName='$value'";
	$result=mysqli_query($link,$query);
	$row=mysqli_fetch_assoc($result);
	return $row[$fieldName];
}
require "../include/dbcon.php";
include "../include/modules.php";
if(isset($_POST['isLogin']) && $_POST['isLogin']==sha1(md5("login"))){
	$userName=text_protection($_POST['userName']);
	$userPass=pass_protection($_POST['userPass']);
	$query="SELECT * FROM users WHERE userName='$userName' AND userKey='$userPass'";
	$result=mysqli_query($link,$query);
	if(mysqli_num_rows($result)>0){
		if(isset($_POST['rememberMe']) && $_POST['rememberMe']=="on"){
			$cookieName=bin2hex("username");
			$cookieValue=bin2hex($userName);
			setcookie($cookieName,$cookieValue,time()+(86400*30),"/");
			$cookieName=bin2hex("password");
			$cookieValue=bin2hex($userPass);
			setcookie($cookieName,$cookieValue,time()+(86400*30),"/");
		}
		$_SESSION['userId']=getData("userId",$userName);
		$_SESSION['userFullName']=getData("userFullName",$userName);
		print "<script>window.open('../index.php','_self')</script>";
	}else{
		$msg=sha1(md5("incorrect"));
		print "<script>window.open('../login.php?msg=$msg','_self')</script>";
	}
}else{
	print "<script>window.open('../index.php','_self')</script>";
}
 ?>
