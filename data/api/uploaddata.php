<?php
 
//importing dbDetails file
require_once 'databaseinfo.php';
 
//this is our upload folder
$upload_path = 'uploads/';
 
//Getting the server ip
$server_ip = gethostbyname(gethostname());
 
//creating the upload url
$upload_url = '/data/api/'.$upload_path;
 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
 
    //checking the required parameters from the request
    if(isset($_POST['name']) and isset($_FILES['gz']['name'])){
 
        //connecting to the database
        $con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die('Unable to Connect...');
 
        //getting data from the request
        $name = $_POST['name'];
		$location = $_POST['location'];
		$month = $_POST['month'];
		$day = $_POST['day'];
		$year = $_POST['year'];
		$hour = $_POST['hour'];
		$minute = $_POST['minute'];
 
        //getting file info from the request
        $fileinfo = pathinfo($_FILES['gz']['name']);
 
        //getting the file extension
        $extension = $fileinfo['extension'];
 
        //file url to store in the database
        $file_url =  getFileName() . '.' . $extension;
 
        //file path to upload in the server
        $file_path = $upload_path . getFileName() . '.'. $extension;
		
		
        //trying to save the file in the directory
        try{
            //saving the file
            move_uploaded_file($_FILES['gz']['tmp_name'],$file_path);
            $sql = "INSERT INTO phivolcs (id, FileName, Location, Month, Day, Year, Hour, Minute) VALUES (NULL, '$file_url', '$location', '$month', '$day', '$year', '$hour', '$minute')";
 
            //adding the path and name to database
            if(mysqli_query($con,$sql)){
 
                //filling response
             
				$message = 'Successfully Uploaded,'.getFileName();
            }
            //if some error occurred
	    $sql = "DELETE t1 FROM phivolcs t1 INNER JOIN phivolcs t2 WHERE t1.id>t2.id AND t1.FileName = t2.FileName AND t1.Location = t2.Location";
            if(mysqli_query($con,$sql)){}
        }catch(Exception $e){
           
			$message = $e->getMessage();
        } 
        //closing the connection
        mysqli_close($con);
    }else{
		$message = 'Error';
    }
    
    //displaying the response
    echo $message;
	
}
 
/*
We are generating the file name
so this method will return a file name for the image to be upload
*/
function getFileName(){
   
	return $_POST['name'];
}