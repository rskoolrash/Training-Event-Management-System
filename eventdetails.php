<?php

session_start();
error_reporting(0);
$getid= $_GET["id"];
include_once("Mail.php"); 
include 'phpcode.php';
$con = GetConn();
if(!isset($con))
{
    die("Database Not Found");
}

$cgetname = mysqli_query($con, "select f_name from t_faculty where f_email='" . $_SESSION['ad'] ."'");
$cgotname = mysqli_fetch_assoc($cgetname);
$cshow    = $cgotname["f_name"];


$cfile = mysqli_query($con, "select e_id from t_tevent where e_title='" . $getid ."'");
$cgotfile = mysqli_fetch_assoc($cfile);
$cshowfile    = $cgotfile["e_id"];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Event Details</title>
        
         <link rel="stylesheet" href="css/fields.css">   
         <link rel="stylesheet" href="css/common.css">
         <link rel="stylesheet" href="css/divisions.css">
         <link rel="stylesheet" href="css/tablescss.css">
         <!--file bootstrap-->
           <script src="js/jquery-1.11.0.min.js"></script>
         <!--file bootstrap-->
      
	 <link rel="stylesheet" type="text/css" href="tabcss/tabs1.css" />
	 <link rel="stylesheet" type="text/css" href="tabcss/tabstyles1.css" />
         <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
         <script src="bootstrap/jquery.min.js"></script>
         <script src="bootstrap/bootstrap.min.js"></script>
  	 <script src="js/modernizr.custom.js"></script>
         
         
        <style>
            body
            {
                background-image:url(images/bglogin2.jpg);
            }
            body:before
            {
                opacity:0.2;
            }
        </style>
    </head>
    <body >
        
            <div class="container-fluid" id="pagebar">
                <div class="row">
                    <a href='coordlogout.php'>
                             <img src='images/logout.png' style="margin-left:4px;margin-top:4px;height:30px;width:30px"></img>
                    </a>
                    <?php
                       
                        /*echo '<script>
                        var now = new Date();
                        var hrs = now.getHours();
                        var msg = "";
                        if (hrs >  0) msg = "Welcome, "; // REALLY early
                        if (hrs >  6) msg = "Good morning, ";      // After 6am
                        if (hrs > 12) msg = "Good afternoon, ";    // After 12pm
                        if (hrs > 17) msg = "Good evening, ";      // After 5pm
                        if (hrs > 22) msg = "Welcome, ";        // After 10pm

                        document.write(msg);
                        echo </script>';*/
                                     
                        echo "<span>
                            <font style='margin-left:3px;color:white; font-family: Verdana;  font-size:15px;'>";
                        
                        date_default_timezone_set('Asia/Calcutta');
                        $Hour = date('G');
                        if ( $Hour >= 5 && $Hour < 11 ) {
                            echo "
                                Good Morning, " . $cshow . "";
                        } else if ( $Hour >= 12 && $Hour < 17 ) {
                            echo "
                                Good Afternoon, " . $cshow . "";
                        } else if ( $Hour >= 17 || $Hour <= 21 ) {
                            echo "Good Evening, " . $cshow . "";
                        }
                        else  {
                            echo "Welcome, " . $cshow . "</font></span>";
                        }
                            
                         
                    ?>   
                  
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                      <?php
                        $trdet= mysqli_query($con, "select * from t_tevent where e_title= '$getid'");
                        while($tdet = mysqli_fetch_array($trdet))              
                         {
                      ?>
                        <h2 style="color:gray ; font-family: verdana"><b><?php echo $tdet[1];  ?></b></h2>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                      <b><h4 style="color:gray ; font-family: verdana">Venue :</h4></b>
                    </div>
                    <div class="col-sm-8">
                      <h4 style="color:gray ; font-family: verdana"><?php echo $tdet[2];?></h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                      <b><h4 style="color:gray ; font-family: verdana">Date :</h4></b>
                    </div>
                    <div class="col-sm-8">
                      <h4 style="color:gray ; font-family: verdana"><?php echo $tdet[3];?></h4>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-sm-4">
                      <b><h4 style="color:gray ; font-family: verdana">Details :</h4></b>
                    </div>
                    <div class="col-sm-8">
                      <h4 style="color:gray ; font-family: verdana"><?php echo $tdet[4];?></h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <strong><h4 style="color:gray ; font-family: verdana">Uploaded on :</h4></b>
                    </div>
                    <div class="col-sm-8">
                      <h4 style="color:gray ; font-family: verdana"><?php echo $tdet[5];
                         }?>
                      </h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <strong><h4 style="color:gray ; font-family: verdana">Files :</h4></b>
                    </div>
                    <div class="col-sm-8">
                      <?php
                    $Trainfile_path ='TrainingFiles/';
                    $tresult1 = mysqli_query($con,"SELECT * FROM t_tfile where e_id='$cshowfile'");
                        
                    
                    while($trow = mysqli_fetch_array($tresult1))
                      {
                                              
                        $trdoc=$Trainfile_path.$trow['t_file_name'];
                        echo "<a href='$trdoc.' style='text-decoration:none;color:gray ; font-family: verdana';font-weight:lighter>".$trow['t_file_name']."</a><br>";
                      
                      }
                      ?>
                    </div>
                </div>
            </div>
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                      <h2 style="color:gray ; font-family: verdana"><b><u>Participants</u></b></h2>
                    </div>
                </div>
            </div>
        
            
        
         <div class="hometable">
              <?php
                                                       
              $cgetid = mysqli_query($con, "select e_id from t_tevent where e_title='" . $getid ."'");
              $cgetii = mysqli_fetch_assoc($cgetid);
              $cgeti    = $cgetii["e_id"];

                $trchkt1= mysqli_query($con, "
                select e.s_name,e.s_email,e.s_reg,e.s_branch,e.s_ph from t_stud e where s_email in (select s_email from tr_event where e_id = '".$cgeti."')");

                if(mysqli_num_rows($trchkt1)==0)
                 {
                      echo "<center><font style='color:black; font-width:bold'; 
                          font-size: 14px;font-style:Verdana'>
                          Sorry! No records to display.
                             </font></center>";
                 }
                   else
                   {
                    echo" <table>
                         <thead>
                           <tr>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Reg. No</th>
                             <th>Branch</th>
                             <th>Contact</th>
                           </tr>
                         </thead>
                     <tbody>";

                    while($trid = mysqli_fetch_array($trchkt1))
                    {
                        echo "<tr>";
                        echo "<td>". $trid[0] ."</td>";
                        echo "<td>". $trid[1] ."</td>";
                        echo "<td>". $trid[2] ."</td>";
                        echo "<td>". $trid[3] ."</td>";
                        echo "<td>". $trid[4] ."</td>";

                    } 


                     ?>

                     <?php   
                        echo "</tr> ";

                     }

           echo "</tbody>
            </table>";
            ?> 
         </div>
    </body>
</html>
