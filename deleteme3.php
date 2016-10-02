<?php 

session_start();
error_reporting(0);

include_once("Mail.php"); 
include 'phpcode.php';
$con = GetConn();
if(!isset($con))
{
    die("Database Not Found");
}



               $picfile_path ='Photos/';
              $sql1 = mysqli_query($con,"SELECT * FROM t_gallary ");
                if(isset($sql1) && count($sql1)) 
                    {  
                         foreach ($sql1 as $key => $row)
                             { 
                                $picsrc=$picfile_path.$row['folder_name'].'/'.$row['g_file_name'];
                                echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='height:180px;'>"; 
                             }; 
                     };
        

?>





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
            <link rel="stylesheet" href="css/fields.css">   
           <link rel="stylesheet" href="css/common.css">
         <link rel="stylesheet" href="css/divisions.css">
      <link rel="stylesheet" href="css/tablescss.css">
	<link rel="stylesheet" type="text/css" href="tabcss/tabs1.css" />
	<link rel="stylesheet" type="text/css" href="tabcss/tabstyles1.css" />
         <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
         <script src="bootstrap/jquery.min.js"></script>
         <script src="bootstrap/bootstrap.min.js"></script>
  	<script src="js/modernizr.custom.js"></script>
              
		
         <title> Students's Cell </title>
         
       
    </head>
    <body>
     
    </body>
</html>
