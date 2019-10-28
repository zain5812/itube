<?php 
session_start();
$status="Sign in";
if(isset($_SESSION['userId']) && isset($_SESSION['userFullName'])){
	$status="Sign Out";
}
require "include/dbcon.php";
require "include/modules.php";
if(!isset($_SESSION['total'])){
	$_SESSION['total']=null;
	fetch_all();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ITube | player</title>
	<meta charset=utf-8>
	<meta name=description content="Player">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<link rel="icon" type="image/png" href="logo.png">
</head>
<body>
	<?php 
	include "header.html";
	if(isset($_GET['isPlay']) && $_GET['isPlay']==md5("play")){
		$mediaId=hex2bin($_GET['src']);
		$selected=getRandoms();
		$query="SELECT * FROM itube_media WHERE mediaId='$mediaId'";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_assoc($result);
	}
	?>
		<div class="play">
			<video class="vdo" autoplay controls>
				<source src="media/<?=$row['mediaPath']?>" type="video/mp4">
			</video>
			<p class="video-title" title="<?=$row['mediaTitle']?>">
				<?php
							if(strlen($row['mediaTitle'])>99){ 
								print substr($row['mediaTitle'],0,99)." ....";
							}
							else{
								print $row['mediaTitle'];
							}
							?>
				<i class="fas fa-caret-down" style="cursor: pointer"></i>
			</p>

			<p class="play-video-desc">
				<small>uploaded <?=$row['uploadDate']?></small><br>
				<?=$row['mediaDesc']?>
			</p>
		</div>

		<div class="list">
			<?php
			for ($i=0;$i<sizeof($selected);$i++){
				?>
				<div class="list-frame">
					<a style="outline: none" href="player.php?src=<?=bin2hex($selected[$i]['mediaId'])?>&isPlay=<?=md5('play')?>">
					<div class="list-video">
						<video preload="metadata">
							<source src="media/<?=$selected[$i]['mediaPath']?>" type="video/mp4">
						</video>
					</div>
					<div class="description">
						<span class="list-title" title="<?=$selected[$i]['mediaTitle']?>">
							<?php
							if(strlen($selected[$i]['mediaTitle'])>99){ 
								print substr($selected[$i]['mediaTitle'],0,99)." ....";
							}
							else{
								print $selected[$i]['mediaTitle'];
							}
							?>	
							</span>
						<br>
						<span>date : <?=$selected[$i]['uploadDate']?></span>
						<!--<br>
						<span><?=$list['mediaDesc']?></span>-->
					</div>	
					</a>	
				</div>
			<?php	
			}
			 ?>
		</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/java.js"></script>
</body>
</html>