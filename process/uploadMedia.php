<?php 
session_start();
if(!isset($_SESSION['userId']) || !isset($_SESSION['userFullName'])){
	print "<script>alert('Session not set.')</script>";
	header("Location:../login.php");
}
$userId=$_SESSION['userId'];
require "../include/dbcon.php";
@include "../include/modules.php";

date_default_timezone_set("Asia/Karachi");

if(isset($_POST['isUpload']) && $_POST['isUpload']==sha1(md5("upload"))){
	
	if(isset($_FILES['mediaFile'])){
		$f=$_FILES['mediaFile'];
		$name=$f['name'];
		$temp=$f['tmp_name'];

		//$title=text_protection($_POST['mediaTitle']);
		//$desc=text_protection($_POST['mediaDesc']);
		$cdate=date('Y-m-d');
		for($i=0;$i<sizeOf($name);$i++){
			$title=text_protection($name[$i]);
			$desc=text_protection("Empty");
			$extension=PATHINFO($name[$i],PATHINFO_EXTENSION);
			if($extension=="mp4" || $extension=="MP4" || $extension=="mkv" || $extension=="MKV" || $extension=="Mp4"){
				$fileName=rand(000000000,999999999).".".$extension;
				$destination="../media/$fileName";
				if(move_uploaded_file($temp[$i],$destination)){
					$query="INSERT INTO itube_media (mediaTitle,mediaDesc,mediaUploader,uploadDate,mediaPath) VALUES ('$title','$desc','$userId','$cdate','$fileName')";
					if(mysqli_query($link, $query)){
						print "<script>alert('File uploaded successfully.')</script>";
						print "<script>window.open('../upload.php','_self')</script>";
					}else{
						print "<script>alert('Something Went Wrong.')</script>";
						print "<script>window.open('../upload.php','_self')</script>";
					}
				}
			}else{
				print "<script>alert('Invalid File Format.')</script>";
				print "<script>window.open('../upload.php','_self')</script>";
			}
		}
	}else{
		print "<script>alert('Please Choose File.')</script>";
		print "<script>window.open('../upload.php','_self')</script>";
	}
}else{
	print "<script>alert('Form not submit.')</script>";
	header("Location:../index.php");
}
?>
