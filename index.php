<?php 
session_start();
$status="Sign in";
/*$_SESSION['userId']=5;
$_SESSION['userFullName']="Za";*/
if(isset($_SESSION['userId']) && isset($_SESSION['userFullName'])){
	$status="Sign Out";
}
if(!isset($_SESSION['total']) || $_SESSION['total']==null){
	$_SESSION['total']=null;
}
$start=0;
$step=30;
require "include/dbcon.php";
require "include/modules.php";

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>I-Tube</title>
	<meta charset=utf-8>
	<meta name=description content="Positioning">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/png" href="logo.png">
	
</head>
<body>
	<?php include "header.html" ?>
	<div class="search_bar">
		<form method="GET" action="index.php">
			<input type="text" name="skey" placeholder="Keyword" />
			<input type="hidden" name="isSearch" value="<?=md5('true')?>">
			<button style="padding:8px;" type="submit">Search</button>
		</form>
	</div>
	<div class="main">
		<h1>I-Tube Videos</h1><hr>
		<div class="row">
		<?php
		if(isset($_GET['np'])){
			$page=$_GET['np']-1;
			$start=($page!=0)?($page*30):0;
		}
		if((isset($_GET['isSearch']) && $_GET['isSearch']==md5('true'))){
			$keyword=$_GET['skey'];
			$query="SELECT * FROM itube_media WHERE mediaTitle LIKE '%$keyword%' LIMIT $start,$step";
			$countQuery="SELECT count(*) FROM itube_media WHERE mediaTitle LIKE '%$keyword%'";
		}else{
			$query="SELECT * FROM itube_media LIMIT $start,$step";
			$countQuery="SELECT count(*) FROM itube_media";
			$_SESSION['inSearch']=false;
		}
		$result=mysqli_query($link,$query);
		$totla=mysqli_num_rows($result);
		$n=0;
		while ($row=mysqli_fetch_assoc($result)){
		?>
			<div class="player_box">
		 		<a href="player.php?src=<?=bin2hex($row['mediaId'])?>&isPlay=<?=md5("play")?>">
		 		<video class="player" preload="metadata">
		 			<source src="media/<?=$row['mediaPath']?>" type="video/mp4">
		 		</video>
		 		<p title="<?=$row['mediaTitle']?>">
		 			<?php
							if(strlen($row['mediaTitle'])>99){ 
								print substr($row['mediaTitle'],0,99)." ....";
							}
							else{
								print $row['mediaTitle'];
							}
							?>
		 			</p>
		 		</a>
		 	</div>
		<?php
		$n++;
		if($n%4==0){
			print "<div style='clear:both'></div>";
		}
		}
		 ?>
		 </div>
		 <div style="clear: both;height:30px;"></div>
		 <div class="pagination">
		 	<?php
		 		$chunks=getTotalLength($countQuery)/$step;
		 		if($chunks>0){
		 			for($i=1;$i<=$chunks;$i++){
		 				if(isset($_GET['isSearch'])){
		 					$token=md5('true');
		 					print "<a href='index.php?np=$i&isSearch=$token&skey=$keyword'>$i</a>";
		 				}else{
		 					print "<a href='index.php?np=$i'>$i</a>";
		 				}
		 			}
		 		}
		 		fetch_all();
		 	?>
		 </div>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/java.js"></script>
</body>
</html>