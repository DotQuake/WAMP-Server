<?php
/**
 * Created by PhpStorm.
 * User: Manish
 * Date: 11/1/2016
 * Time: 6:55 PM
 */
require_once 'databaseinfo.php';
$server_ip = gethostbyname(gethostname());
$protocol = 'http://';
$upload_path = 'uploads/';
$upload_url = '/data/api/'.$upload_path;
//$name = $_GET["name"];
$location = $_GET['location'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$hour = $_GET['hour'];
$minute = $_GET['minute'];
//connecting to the db
$con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die("Unable to connect");
 
//sql query
$sql = "SELECT * FROM `phivolcs` WHERE Location= '$location' AND Month = '$month' AND Day = '$day' AND Year = '$year' AND Hour = '$hour' AND Minute = '$minute'";
 
//getting result on execution the sql query
$result = mysqli_query($con,$sql);

$row =mysqli_fetch_array($result);
 
$response = array('id' => $row['id'], 'url' => $protocol.$server_ip.$upload_url.$row['FileName'], 'location' => $row['Location']);

echo json_encode($response);
?>