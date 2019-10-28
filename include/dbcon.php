<?php
if(!preg_match("/connection.php/",$_SERVER['SCRIPT_FILENAME'])){
$link=mysqli_connect("localhost","root","","itube");
if(!$link){
die("Error : ".mysqli_error($link));
}
}
?>