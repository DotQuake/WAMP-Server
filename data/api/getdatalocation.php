<?php
/**
 * Created by PhpStorm.
 * User: Manish
 * Date: 11/1/2016
 * Time: 6:55 PM
 */
require_once 'databaseinfo.php';
//$name = $_GET["name"];
//connecting to the db
$con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die("Unable to connect");
 
//sql query
$sql = "SELECT DISTINCT Location FROM `phivolcs` ";
 
//getting result on execution the sql query
$result = mysqli_query($con,$sql);

/*$row =mysqli_fetch_array($result);
 
$response = array('location' => $row['Location']);*/

$response['location']= array();
while($row =mysqli_fetch_array($result)){
    $temp = array();
    $temp= $row['0'];
    array_push($response['location'],$temp);
}

echo json_encode($response);