<?php

session_start();
error_reporting(0);
$getid= $_REQUEST["id"];


$con = mysqli_connect("localhost", "root", "","tpevent");

if(!isset($con))
{
    die("Database Not Found");
}
    

$gevtid=mysqli_query($con,"select e_id from t_tevent where e_title='$getid'");
$gevtid2=  mysqli_fetch_assoc($gevtid);
$showeid= $gevtid2["e_id"];


 if(isset($_REQUEST["spart"]))
       {

 //$sqlse = "insert into tr_event (s_email,e_id) values ('" .$_SESSION['ad']. "','" .$showeid. "')";
$sqlse = "insert into tr_event (s_email,e_id) values ('dilraj@gmail.com','EVT0010')";
       $chkse= mysqli_query($con, "select * from tr_event where s_email='".$_SESSION['ad']."' and 
                                           e_id='".$showeid."'");
       if(mysqli_num_rows($chkse)>0)
       {
            echo '<script>alert("You have already registered for this event.")</script>';

       }
    else 
    {
   $result1= mysqli_query($con, $sqlse);
    // echo $sqlse;
      echo "<script>alert('You have been registered successfully.');</script>";
    }
   if($result1)
       {
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=studentpage.php\">";
       }



   }	



?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
            <link rel="stylesheet" href="css/fields.css">   
           <link rel="stylesheet" href="css/common.css">
         <link rel="stylesheet" href="css/divisions.css">
      	<link rel="stylesheet" type="text/css" href="tabcss/tabs1.css" />
	<link rel="stylesheet" type="text/css" href="tabcss/tabstyles1.css" />
         <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
         <script src="bootstrap/jquery.min.js"></script>
         <script src="bootstrap/bootstrap.min.js"></script>
  	<script src="js/modernizr.custom.js"></script>
              
		
         <title></title>
         
       
    </head>
    <body >
         <form  action="doc.php" method="post">
             
           
                <div id="popuptablerow" >
                        <div id="" class="container-fluid">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                        $trdet= mysqli_query($con, "select * from t_tevent where e_id='$showeid'");
                                        while($tdet = mysqli_fetch_array($trdet))
                                         {
                                     ?>
                                    <p style="color: #999999 ;  text-align: center; font-family:Verdana; font-weight: bold;
                                    margin-top:2px; font-size: x-large; color:#fff; ">
                                           <?php echo $tdet[1];  ?>
                                    </p>
                         
                                </div>
                           </div>
                            
                           <div class="row">
                                <div class="col-sm-6">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                        <strong>Venue:  </strong> 
                                    </font>
                         
                                    <font style="color: #fff ;  font-family:Verdana; font-weight: normal;">
                                            <?php echo $tdet[2];?>
                                    </font>
                                </div>
                
                                <div class="col-sm-6">     
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                        <strong>Date:  </strong> 
                                    </font>
                         
                                    <font style="color: #fff ;  font-family:Verdana; font-weight: normal;">
                                            <?php echo $tdet[3];?>
                                    </font>
                      
                              </div>
                         </div>
                            
                          <div class="row" style="margin-top:14px;">
                                <div class="col-sm-12">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                        <strong>Details:  </strong>
                                    </font>
                         
                                    <p style="color: #fff ;  font-family:Verdana; font-weight: normal;margin-top:4px;margin-left:14px;">
                                            <?php echo $tdet[4];?>
                                    </p>
                                </div>
                         </div>
                            
                            
                         <div class="row">
                            <div class="col-sm-12">
                                <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                    <strong>Uploaded By </strong>
                                </font>
                         
                                <font style="color: #fff ;  font-family:Verdana; font-weight: normal;">
                                   <?php 
                                        $ctdname = mysqli_query($con, "select f_name from t_faculty where f_email='" . $tdet[6] ."'");
                                        $ctname = mysqli_fetch_assoc($ctdname);
                                        $ctshow    = $ctname["f_name"];
                              
                                        echo $ctshow ;
                              
                                    ?>
                                </font>
                         
                                <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                    <strong>On </strong>
                                </font>     
                             
                                <font style="color: #fff ;  font-family:Verdana; font-weight: normal;">
                                    <?php echo $tdet[5];  
                                        } 
                                    ?>
                                </font>
                            </div>
                        </div>    
                          
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" name="stpart" value="Participate" style="margin-left: 100px;">
                            </div>
                       </div>    
                     </div>
                </div>
                
         </form>
    </body>
</html>
