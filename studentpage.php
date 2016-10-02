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


 //change password

if(isset($_REQUEST["s_passsub"]))
{
    
    $getst = mysqli_query($con,"select * from t_stud where s_email='". $_SESSION["ad"]."' and s_pswd='". $stold."'");
    
    if($stnew==$stcon)  
    {
      if(mysqli_num_rows($getst)>0)
      {
         mysqli_query($con,"update t_stud set s_pswd='".$stnew."' where s_email ='". $_SESSION["ad"]."'");

          echo "<script> alert('Password has been changed successfully');</script>";
      }

    else
       {
          echo "<script> alert('Old password does not match. Please try again');</script>";
       }
    }

   else
   {
      echo "<script> alert('Please confirm the password correctly.');</script>";
   }
}


//change password over



$gevtid=mysqli_query($con,"select e_id from t_tevent where e_id='EVT0001'");
$gevtid2=  mysqli_fetch_assoc($gevtid);
$showeid= $gevtid2["e_id"];

$sgetname = mysqli_query($con, "select s_name from t_stud where s_email='" . $_SESSION['ad'] ."'");
$sgotname = mysqli_fetch_assoc($sgetname);
$sshow    = $sgotname["s_name"];

$pgevtid=mysqli_query($con,"select p_cid from t_pevent where p_cid='EVP0001'");
$pgevtid2=  mysqli_fetch_assoc($pgevtid);
$pshoweid= $pgevtid2["p_cid"];

if(isset($_REQUEST["strok"]))
 
{
    
$sqlse = "insert into tr_event (s_email,e_id) values ('" .$_SESSION['ad']. "','" .$showeid. "')";
//$sqlse = "insert into tr_event(s_email,e_id) values ('130301csl062@cutm.ac.in','EVT0003')";
$chkse= mysqli_query($con, "select * from tr_event where s_email='".$_SESSION['ad']."' and 
                                           e_id='".$showeid."'");
       if(mysqli_num_rows($chkse)>0)
       {
            echo '<script>alert("You have already registered for this event.")</script>';

       }
    
 else {
           
    require_once "Mail.php";  
  
$from    = "cutmtnp@gmail.com";  
$to      = $_SESSION['ad']; 
$subject = "Participation Confirmed.";  
$body    = "Dear $sshow, \n Congratulations,  Your participation request has been sent to the coordinator of the event.\nThankyou.
            ";
  
/* SMTP server name, port, user/passwd */  
$smtpinfo["host"] = "ssl://smtp.gmail.com";  
$smtpinfo["port"] = "465";  
$smtpinfo["auth"] = true;  
$smtpinfo["username"] = "cutmtnp@gmail.com";  
$smtpinfo["password"] = "dilrajrashmi@";  
  
$headers = array ('From' => $from,'To' => $to,'Subject' => $subject);  
$smtp = &Mail::factory('smtp', $smtpinfo );  
  
$mail = $smtp->send($to, $headers, $body);  
  
if (PEAR::isError($mail)) {  
  echo("<p>" . $mail->getMessage() . "</p>");  
 } 
 else 
    {
    mysqli_query($con, $sqlse);
    // echo $sqlse;
      echo "<script>alert('Please check your e-mail.');</script>";
    }
       }
}	






if(isset($_REQUEST["sprok"]))
{
   
$sqlse1 = "insert into pl_event (s_email,p_cid) values ('" .$_SESSION['ad']. "','" .$pshoweid. "')";
//$sqlse = "insert into tr_event(s_email,e_id) values ('130301csl062@cutm.ac.in','EVT0003')";
$chkse1= mysqli_query($con, "select * from pl_event where s_email='".$_SESSION['ad']."' and 
                                           p_cid='".$pshoweid."'");
       if(mysqli_num_rows($chkse1)>0)
       {
            echo '<script>alert("You have already registered for this event.")</script>';

       }
    
 else {
           
    require_once "Mail.php";  
  
$from    = "cutmtnp@gmail.com";  
$to      = $_SESSION['ad']; 
$subject = "Participation Confirmed.";  
$body    = "Dear $sshow, \n Congratulations,  Your participation request has been sent to the coordinator of the event.\nThankyou.
            ";
  
/* SMTP server name, port, user/passwd */  
$smtpinfo["host"] = "ssl://smtp.gmail.com";  
$smtpinfo["port"] = "465";  
$smtpinfo["auth"] = true;  
$smtpinfo["username"] = "cutmtnp@gmail.com";  
$smtpinfo["password"] = "dilrajrashmi@";  
  
$headers = array ('From' => $from,'To' => $to,'Subject' => $subject);  
$smtp = &Mail::factory('smtp', $smtpinfo );  
  
$mail = $smtp->send($to, $headers, $body);  
  
if (PEAR::isError($mail)) {  
  echo("<p>" . $mail->getMessage() . "</p>");  
 } 
 else 
    {
    mysqli_query($con, $sqlse1);
    // echo $sqlse;
      echo "<script>alert('Please check your e-mail.');</script>";
    }
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
      <link rel="stylesheet" href="css/tablescss.css">
	<link rel="stylesheet" type="text/css" href="tabcss/tabs1.css" />
	<link rel="stylesheet" type="text/css" href="tabcss/tabstyles1.css" />
         <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
         <script src="bootstrap/jquery.min.js"></script>
         <script src="bootstrap/bootstrap.min.js"></script>
  	<script src="js/modernizr.custom.js"></script>
              
		
         <title> Students's Cell </title>
         
       
         <style>
            body
            {
                background-image:url(images/bglog2.jpg);
            }
            body:before
            {
                opacity:0.2;
            }
        </style>
    </head>
     <form id="studentpage" action="studentpage.php" method="post">    
    <body>
        <?php  

            include 'coordsession.php';

        ?>
        
             <div class="container-fluid" id="pagebar">
                <div class="row">
                    <a href='coordlogout.php'>
                             <img src='images/logout1.png' style="margin-left:4px;margin-top:4px;height:30px;width:30px"></img>
                            </a>
                    <?php
                       
                        echo "<span>
                            <font style='margin-left:5px;color: white;font-family: Verdana;  font-size:15px;'>";
                        
                        


                        date_default_timezone_set('Asia/Calcutta');
                        $Hour = date('G');
                        if ( $Hour >= 5 && $Hour < 12 ) {
                            echo "
                                Good Morning, " . $sshow . "";
                        } else if ( $Hour >= 12 && $Hour < 17 ) {
                            echo "
                                Good Afternoon, " . $sshow . "";
                        } else if ( $Hour >= 17 || $Hour <= 21 ) {
                            echo "Good Evening, " . $sshow . "";
                        }
                        else  {
                            echo "Welcome, " . $sshow . "</font></span>";
                        }
                            
                         
                    ?>   
                  
                </div>
            </div>
            <div class="container">
                <section>
				<div class="tabs tabs-style-linebox">
					<nav>
						<ul>

                                                    <li><a href="#section-linebox-1"><span>Training Events</span></a></li>
                                                  <li><a href="#section-linebox-2"><span>Placement Events</span></a></li>
                                                   <li><a href="#section-linebox-3"><span>My Events</span></a></li>
                                                   <li><a href="#section-linebox-4"><span>Gallery</span></a></li>
                                                   <li><a href="#section-linebox-5"><span>Change Password</span></a></li>
						</ul>
					</nav>
					<div class="content-wrap" >
						<section id="section-linebox-1" >
                                                  <div class="hometable"> 
                                                    <?php
                                                       $schkt1= mysqli_query($con, "select * from t_tevent");
                                                    
                                                       if(mysqli_num_rows($schkt1)==0)
                                                        {
                                                             echo "<center><font style='color:black; font-size:16px'; 
                                                                 font-size: 14px;font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";

                                                        }
                                                          else
                                                     {
                                                        echo" <table>
                                                                <thead>
                                                                  <tr>
                                                                    <th>Title</th>
                                                                    <th>Date</th>
                                                                    <th>Venue</th>
                                                                    <th>Uploaded On</th>
                                                                  </tr>
                                                                </thead>
                                                            <tbody>";
                                                     
                                                      while($stevt = mysqli_fetch_array($schkt1))
                                                            {

                                                               echo "<tr>
                                                                <td> <a style='cursor:pointer; color:black; font-weight:normal;'
                                                                    data-toggle='modal' data-target='#ctrmodal'>" . $stevt[1] ."
                                                                    </a></td>";
                                                               echo "<td>". $stevt[3] ."</td>";
                                                               echo "<td>" . $stevt[2] ."</td>";
                                                               echo "<td>" . $stevt[5] ."</td>";
                                                            ?>

                                                            <?php   
                                                               echo "</tr> ";
                                                            }
                                                         
                                                     }  
                                                  echo "</tbody>
                                               </table>";
                                                   
                                                     ?>
                                                 </div> 
                                                </section>
						
                                            
                                            
                                                 <section id="section-linebox-2" >
                                                  <div class="hometable"> 
                                                <?php
                                                       $schkt2= mysqli_query($con, "select * from t_pevent");
                                                        if(mysqli_num_rows($schkt2)==0)
                                                        {
                                                             echo "<center><font style='color:black; font-size:16px'; 
                                                                 font-size: 14px;font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";

                                                        }
                                                     else
                                                     { 
                                                        echo "<table>
                                                         <thead>
                                                           <tr>
                                                             <th>Company's Name</th>
                                                             <th>Arriving On</th>
                                                             <th>Package</th>
                                                             <th>Uploaded On</th>
                                                           </tr>
                                                         </thead>
                                                         <tbody>";
                                                                                                    

                                                            
                                                            while($spevt = mysqli_fetch_array($schkt2))
                                                            {

                                                               echo "<tr><td>
                                                                   <a style='cursor:pointer; color:black; font-weight:normal;'
                                                                    data-toggle='modal' data-target='#cplmodal'>
                                                               " . $spevt[1] ."</a></td>";
                                                               echo "<td>". $spevt[2] ."</td>";
                                                               echo "<td>" . $spevt[3] ."</td>";
                                                               echo "<td>" . $spevt[7] ."</td>";
                                                            ?>
                                                              
                                                               <?php   
                                                               echo "</tr> ";
                                                            }
                                                        }   
                                                  
                                                echo "</tbody>
                                               </table>";
                                                
                                                     ?>
                                               </div> 
                                                </section>   
                                            
                                                <section id="section-linebox-3">
                                                  <div class="hometable"> 
                                                    <?php
                                                       $schkt3= mysqli_query($con, "select e.e_title,e.e_date from t_tevent e where e_id in (select e_id from tr_event
                                                           where s_email = '".$_SESSION['ad']."') union
                                                           select p.p_cname, p.p_carrv from t_pevent p where p_cid in (select p_cid from pl_event where s_email = '".$_SESSION['ad']."')");
                                                        $pprcount1=0;
                                                       if(mysqli_num_rows($schkt3)==0)
                                                        {
                                                             echo "<center><font style='color:black; font-width:bold'; 
                                                                 font-size: 14px;font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";

                                                        }
                                                          else
                                                     {
                                                        echo" <table>
                                                                <thead>
                                                                  <tr>
                                                                     <th>S. No</th>
                                                                    <th>Title</th>
                                                                    <th>Event's Date</th>
                                                                   
                                                                 
                                                                  </tr>
                                                                </thead>
                                                            <tbody>";

                                                      while($stevt = mysqli_fetch_array($schkt3))
                                                            {


                                                               echo "<tr>";

                                                                echo "<td>"  .++$pprcount1 ."</td>";
                                                               echo "<td>". $stevt[0] ."</td>";
                                                               echo "<td>" . $stevt[1] ."</td>";
                                                               


                                                            ?>

                                                            <?php   
                                                               echo "</tr> ";
                                                            }

                                                     }  
                                                  echo "</tbody>
                                               </table>";

                                                     ?>

                                                  </div>  
                                                </section>
                                            
                                            
						<section id="section-linebox-4">
                                                    <?php 
                                                        $picfile_path ='Photos/';
                                                      $sql1 = mysqli_query($con,"SELECT * FROM t_gallary ");
                                                        if(isset($sql1) && count($sql1)) { 
                                                          foreach ($sql1 as $key => $row) { 
                                                          $picsrc=$picfile_path.$row['folder_name'].'/'.$row['g_file_name'];
                                                          echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='margin-top:20px;
                                                              height:180px;'>"; 
                                                        }}
                                                      ?>    
                                                </section>
                                            
                                            
                                            
                                                <section id="section-linebox-5">
                                                    
                                                    <center>   
                                                    <div id="snewpass" class="container-fluid">    
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:2px; font-size: xx-large ">
                                                                   Get a new password !
                                                               </p>
                                                            </div> 
                                                        </div>    

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="s_oldpass" placeholder="What's The Old Password ?" style="color:#666666  ;">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="s_newpass" placeholder="Enter your new password" style="color:#666666  ;">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="s_connpass" placeholder="Confirm New Password" style="color:#666666  ;">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="s_passsub" id="schangep" value="Change" >
                                                                </div>
                                                            </div>

                                                         </div>
                                                   </center>
                                                </section>
						
					</div><!-- /content -->
				</div><!-- /tabs -->
			</section>
            </div>
            
            
            
            
          <!-- training row pop up -->  
       
           <div id="ctrmodal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                      <?php
                        
                        $trdet= mysqli_query($con, "select * from t_tevent where e_id= 'EVT0001'");
                        while($tdet = mysqli_fetch_array($trdet))              
                         {
                      
                      ?>
                      
                         <h4 class="modal-title" style="color:black ; font-family: verdana"><?php echo $tdet[1];  ?></h4>
                     
                      
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                          <div class="col-sm-6">
                            <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                 <strong>Venue:  </strong> 
                            </font>

                            <font style="color:black ; font-family: verdana; font-weight: normal;">
                                <?php echo $tdet[2];?>
                            </font>
                          </div>
                
                                <div class="col-sm-6">     
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                         <strong>Date:  </strong> 
                                    </font>

                                    <font style="color:black ; font-family: verdana; font-weight: normal;">
                                        <?php echo $tdet[3];?>
                                    </font>

                                </div>
                            </div>
                        
                            <div class="row" style="margin-top:14px;">
                             <div class="col-sm-12">
                                 <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                      <strong>Details:  </strong>
                                 </font>

                                 <p style="color:black ; font-family: verdana; font-weight: normal;margin-top:4px;margin-left:14px;">
                                     <?php echo $tdet[4];?>
                                 </p>
                             </div>
                         </div>    
                        
                 
                            <div class="row">
                                <div class="col-sm-12">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Uploaded By </strong>
                                    </font>

                                     <font style="color:black ; font-family: verdana; font-weight: normal;">
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

                                    <font style="color:black ; font-family: verdana; font-weight: normal;">
                                        <?php echo $tdet[5];  } ?>
                                    </font>

                                </div>
                             </div>
                        
                             <div class="row" style="margin-top:14px;">
                                <div class="col-sm-12">
                                   <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Attachments : </strong>
                                    </font>
                                </div>
                                 </div>
                                <div class="row">
                                <div class="col-sm-12">
                                  <?php
                                  
                                $cfile = mysqli_query($con, "select e_id from t_tfile where e_id='EVT0001'");
                                $cgotfile = mysqli_fetch_assoc($cfile);
                                $cshowfile    = $cgotfile["e_id"];
                                
                                $Trainfile_path ='TrainingFiles/';
                                $tresult1 = mysqli_query($con,"SELECT * FROM t_tfile where e_id='$cshowfile'");


                                while($trow = mysqli_fetch_array($tresult1))
                                  {

                                    $trdoc=$Trainfile_path.$trow['t_file_name'];
                                    echo "<a href='$trdoc.' style='color:black ; font-family: verdana; font-weight: normal;'>".$trow['t_file_name']."</a><br>";

                                  }
                                  ?>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                     
                      <input type="submit" name="strok" class="btn btn-default" value="Participate" style="color:black;"> 
                     
                    </div>
                  </div>

                </div>
              </div> 
    
            
           <!-- /training row pop up -->   
            
                      
            
            
            <!-- PLACEMENT row pop up -->  
            
           <div id="cplmodal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                      <?php
                        
                        $pldet= mysqli_query($con, "select * from t_pevent where p_cid= 'EVP0001'");
                        while($pdet = mysqli_fetch_array($pldet))              
                         {
                      
                      ?>
                      
                         <h4 class="modal-title" style="color:black ; font-family: verdana"><?php echo $pdet[1];  ?></h4>
                     
                      
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                          <div class="col-sm-6">
                            <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                 <strong>Arriving On:  </strong> 
                            </font>

                            <font style="color:black ; font-family: verdana; font-weight: normal;">
                                <?php echo $pdet[2];?>
                            </font>
                          </div>
                
                                <div class="col-sm-6">     
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                         <strong>Package:  </strong> 
                                    </font>

                                    <font style="color:black ; font-family: verdana; font-weight: normal;">
                                        <?php echo $pdet[3];?>
                                    </font>

                                </div>
                            </div>
                        
                            <div class="row" style="margin-top:14px;">
                             <div class="col-sm-12">
                                 <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                      <strong>Documents Required:  </strong>
                                 </font>

                                 <p style="color:black ; font-family: verdana; font-weight: normal;margin-top:4px;margin-left:14px;">
                                     <?php echo $pdet[4];?>
                                 </p>
                             </div>
                         </div>    
                        
                 
                            <div class="row">
                                <div class="col-sm-12">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>About the Company: </strong>
                                    </font>

                                     <font style="color:black ; font-family: verdana; font-weight: normal;">
                                        <?php echo $pdet[5];   ?>
                                    </font>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Criteria: </strong>
                                    </font>

                                    <font style="color:black ; font-family: verdana; font-weight: normal;">
                                        <?php echo $pdet[6];   ?>
                                    </font>

                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-12">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Uploaded By </strong>
                                    </font>

                                     <font style="color:black ; font-family: verdana; font-weight: normal;">
                                         <?php 


                                         $cpdname = mysqli_query($con, "select f_name from t_faculty where f_email='" . $pdet[8] ."'");
                                         $cpname = mysqli_fetch_assoc($cpdname);
                                         $cpshow    = $cpname["f_name"];

                                         echo $cpshow ;

                                         ?>
                                    </font>

                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>On </strong>
                                    </font>

                                    <font style="color:black ; font-family: verdana; font-weight: normal;">
                                        <?php echo $pdet[7];  } ?>
                                    </font>

                                </div>
                                </div>
                        
                                <div class="row" style="margin-top:14px;">
                                <div class="col-sm-12">
                                   <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Attachments :  </strong>
                                    </font>
                                </div>
                                 </div>
                                <div class="row">
                                <div class="col-sm-12">
                                  <?php
                                  
                                 $cpfile = mysqli_query($con, "select p_cid from t_pfile where p_cid='EVP0001'");
                                $cpgotfile = mysqli_fetch_assoc($cpfile);
                                $cpshowfile    = $cpgotfile["p_cid"];
                                
                                $Placement_path ='PlacementFiles/';
                                $presult1 = mysqli_query($con,"SELECT * FROM t_pfile where p_cid='$cpshowfile'");


                                while($prow = mysqli_fetch_array($presult1))
                                  {

                                    $prdoc=$Placement_path.$prow['p_file_name'];
                                    echo "<a href='$prdoc.' style='color:black ; font-family: verdana; font-weight: normal;'>".$prow['p_file_name']."</a><br>";

                                  }
                                  ?>
                                </div>
                            </div>
                        
                      
                      
                    </div>
                    <div class="modal-footer">
                      
                      <input type="submit" name="sprok" class="btn btn-default" value="Apply Now" style="color:black;"> 
                    
                    </div>
                      
                    
                  </div>

                </div>
              </div> 
            
            
           <!-- /PLACEMENT row pop up -->    
            
          </form>  
        
        
        
        
        
        <script src="js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
                
              
    </body>
</html>
