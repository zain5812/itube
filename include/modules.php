<?php 
function text_protection($str){	
	$str=htmlspecialchars(addslashes(trim($str)));
	return $str;
}
function pass_protection($str){	
	$str=htmlspecialchars(addslashes($str));
	return $str;
}

function fetch_all(){
	global $link;
	$query="SELECT * FROM itube_media";
	$res=mysqli_query($link,$query);
	$array=array();
	while($row=mysqli_fetch_assoc($res)){
		$array[]=$row;
	}
	$_SESSION['total']=$array;	
}

function getTotalLength($query){
	global $link;
	$res=mysqli_query($link,$query);
	$row=mysqli_fetch_array($res);
	return $row[0];
}

function getRandoms(){
	$selected=array();
	for($i=0;$i<30;$i++){
		$random=rand(0,sizeof($_SESSION['total'])-1);
		$selected[]=$_SESSION['total'][$random];
	}
	return $selected;
}
?>