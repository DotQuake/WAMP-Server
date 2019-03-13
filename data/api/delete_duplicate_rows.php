<?php
require_once 'databaseinfo.php';
$sql = "DELETE t1 FROM phivolcs t1 INNER JOIN phivolcs t2 WHERE t1.id<t2.id AND t1.FileName = t2.FileName AND t1.Location = t2.Location";
$con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die("Unable to connect");
if(mysqli_query($con,$sql)){
	echo "success!";
}else{
	echo "failed";
}
?>