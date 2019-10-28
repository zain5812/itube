<?php 
session_start();
if(!isset($_SESSION['userId']) || !isset($_SESSION['userFullName'])){
	header("Location:login.php");
}
$status="Sign Out";
?>
<!DOCTYPE html>
<html>
<head>
	<title>I-Tube | Upload</title>
	<meta charset=utf-8>
	<meta name=description content="Upload">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/png" href="logo.png">
</head>
<body>
	<?php include "header.html" ?>
<div class="upload_box">
	<div class="upload-box-content">
		<form method="POST" enctype="multipart/form-data" action="process/uploadMedia.php">
			<div class="form-group">
					<input type="file" name="mediaFile[]" placeholder="Video" tabindex="1" multiple>
				</div>
			<!--<div class="form-group">
					<input type="text" name="mediaTitle" placeholder="Title for Video" tabindex="1" autocomplete="off">
					<div class="titleErr">Title for vido is required</div>
				</div>
				<div class="form-group">
					<textarea type="text" name="mediaDesc" placeholder="Description for Video" tabindex="2" autocomplete="off"></textarea>
					<div class="descErr"></div>
				</div>!-->
				<div class="form-group">
					<input type="hidden" name="isUpload" value="<?=sha1(md5('upload'))?>">
					<button class="uploadBtn" type="submit">Upload</button>
				</div>
		</form>
	</div>
</div>
</body>
</html>