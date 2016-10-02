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
$ad=$_SESSION['ad'];
/* PIC UPLOAD*/

$get_folder = $_REQUEST['textfield'];

mkdir ("./Photos/" . $get_folder, 0777);


if(isset($_FILES['images']['name'])):
    if($galhid == "")
    $galhid = GalCode();
  define ("MAX_SIZE","2000");
  for($i=0; $i<count($_FILES['images']['name']); $i++)  {
  $size=filesize($_FILES['images']['tmp_name'][$i]);    
  if($size < (MAX_SIZE*1024)):    
   $path = "Photos/$get_folder/";
   $name = $_FILES['images']['name'][$i];
   $size = $_FILES['images']['size'][$i];
   list($txt, $ext) = explode(".", $name);
   
   $file= time().substr(str_replace(" ", "_", $txt), 0);
   $info = pathinfo($file);
   $filename = $file.".".$ext;
    if(move_uploaded_file($_FILES['images']['tmp_name'][$i], $path.$filename)) :
       $fetch=mysqli_query($con,"INSERT INTO t_gallary(g_id,g_file_name,f_email,folder_name) VALUES('$galhid','$filename',
           '$ad','$get_folder')");
       if($fetch):
         header('Location:coordinatorpage.php');
       else :
         $error ='Data not inserting';
       endif;
    else :
        $error = 'File moving unsuccessful';
    endif;
  else:
     $error = 'You have exceeded the size limit!';
  endif;      
  }
else:
  $error = 'File not found!';
endif;          


/* PIC UPLOAD*/


/*training file upload*/


$cgetname = mysqli_query($con, "select f_name from t_faculty where f_email='" . $_SESSION['ad'] ."'");
$cgotname = mysqli_fetch_assoc($cgetname);
$cshow    = $cgotname["f_name"];
if(isset($_REQUEST["upevtsub"]))
{

    if($evthid == "")
    $evthid = EvCode();
    
    $sqlevt = "insert into t_tevent (e_id,e_title, e_venue, e_date, e_desc,e_upld, f_email) values (";
    $sqlevt.= "'" . $evthid . "',";
    $sqlevt.= "'" . $etitle . "',";
    $sqlevt.= "'" . $evenue . "',";
    $sqlevt.= "'" . $edate . "',";
    $sqlevt.= "'" . $edesc . "',";
     $sqlevt.= "sysdate(),";
     $sqlevt.= "'" .$_SESSION['ad']. "')";
   
  
    mysqli_query($con, $sqlevt);
   //echo $sqlevt;
  
 }
 
 /*training file upload*/

if(isset($_FILES['tfile']['name'])):
    if($fevthid == "")
    $fevthid = TfileCode();
  define ("MAX_SIZE","2000");
  for($i=0; $i<count($_FILES['tfile']['name']); $i++)  {
  $size=filesize($_FILES['tfile']['tmp_name'][$i]);    
  if($size < (MAX_SIZE*1024)):    
   $path = "TrainingFiles/";
   
   $name = $_FILES['tfile']['name'][$i];
   $size = $_FILES['tfile']['size'][$i];
   list($txt, $ext) = explode(".", $name);
   
   $file= time().substr(str_replace(" ", "_", $txt), 0);
   $info = pathinfo($file);
   $filename = $file.".".$ext;
    if(move_uploaded_file($_FILES['tfile']['tmp_name'][$i], $path.$filename)) :
       $fetch=mysqli_query($con,"INSERT INTO `t_tfile`(tf_id,t_file_name,f_email,e_id) VALUES('$fevthid','$filename',
           '$ad','$evthid')");
       if($fetch):
            echo "<script>alert('Event has been uploaded successfully');</script>";
         header('Location:coordinatorpage.php');
       else :
         $error ='Data not inserting';
       endif;
    else :
        $error = 'File moving unsuccessful';
    endif;
  else:
     $error = 'You have exceeded the size limit!';
  endif;      
  }
else:
  $error = 'File not found!';
endif;          




 //Delete record for coordinator training event 
 if(isset($_REQUEST['cteventdel'])){
for($i=0;$i<count($_REQUEST['checkbox']);$i++){
$del_id=$_REQUEST['checkbox'][$i];

$fresult1 = mysqli_query($con,"DELETE FROM tr_event WHERE e_id='$del_id'");
$tresult1 = mysqli_query($con,"DELETE FROM t_tfile WHERE e_id='$del_id'");
$result1 = mysqli_query($con,"DELETE FROM t_tevent WHERE e_id='$del_id'");
}
// if successful redirect to delete_multiple.php
if($fresult1 && $tresult1 && $result1)
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=coordinatorpage.php\">";
}
}

//Delete record for coordinator placement event 
 if(isset($_REQUEST['cpeventdel1'])){
for($i=0;$i<count($_REQUEST['checkbox']);$i++){
$del_id1=$_REQUEST['checkbox'][$i];

$fresult2 = mysqli_query($con,"DELETE FROM pl_event WHERE e_id='$del_id'");
$presult2 = mysqli_query($con,"DELETE FROM t_pfile WHERE p_cid='$del_id1'");
$result2 = mysqli_query($con,"DELETE FROM t_pevent WHERE p_cid='$del_id1'");
}
// if successful redirect to delete_multiple.php
if( $fresult2 && $presult2 && $result2)
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=coordinatorpage.php\">";
}
}


//Insert placement event coordinator
 if(isset($_REQUEST["upevtsub1"]))
{

    if($evphid == "")
    $evphid = EvPCode();
            
    $sqlevp = "insert into t_pevent (p_cid,p_cname, p_carrv, p_pakage, p_docreq,p_abt,p_crit,p_upl, f_email) values (";
    $sqlevp.= "'" . $evphid . "',";
    $sqlevp.= "'" . $epname . "',";
    $sqlevp.= "'" . $epdate . "',";
    $sqlevp.= "'" . $epack . "',";
    $sqlevp.= "'" . $epdoc . "',";
    $sqlevp.= "'" . $evpabt . "',";
    $sqlevp.= "'" . $evpcri . "',";
    $sqlevp.= "sysdate(),";
    $sqlevp.= "'" .$_SESSION['ad']. "')";
   
  
    mysqli_query($con, $sqlevp);
    //echo $sqlevp;
  
 }
 
 /*placement file upload*/

if(isset($_FILES['pfile']['name'])):
    if($fevphid == "")
    $fevphid = PfileCode();
  define ("MAX_SIZE","2000000");
  for($i=0; $i<count($_FILES['pfile']['name']); $i++)  {
  $size=filesize($_FILES['pfile']['tmp_name'][$i]);    
  if($size < (MAX_SIZE*1024)):    
   $path = "PlacementFiles/";
   
   $name = $_FILES['pfile']['name'][$i];
   $size = $_FILES['pfile']['size'][$i];
   list($txt, $ext) = explode(".", $name);
   
   $file= time().substr(str_replace(" ", "_", $txt), 0);
   $info = pathinfo($file);
   $filename = $file.".".$ext;
    if(move_uploaded_file($_FILES['pfile']['tmp_name'][$i], $path.$filename)) :
       $fetch=mysqli_query($con,"INSERT INTO t_pfile(pf_id,p_file_name,f_email,p_cid) VALUES('$fevthid','$filename',
           '$ad','$evphid')");
       if($fetch):
           echo "<script>alert('Event has been uploaded successfully');</script>";  
         header('Location:coordinatorpage.php');
       else :
         $error ='Data not inserting';
       endif;
    else :
        $error = 'File moving unsuccessful';
    endif;
  else:
     $error = 'You have exceeded the size limit!';
  endif;      
  }
else:
  $error = 'File not found!';
endif;          


/*placement file upload*/

 


 //change password

if(isset($_REQUEST["cpasub"]))
{
    
    $getcr = mysqli_query($con,"select * from t_reg_coord where f_email='". $_SESSION["ad"]."' and rc_pswd='". $crold."'");
    
    if($crnew==$crcon)  
    {
      if(mysqli_num_rows($getcr)>0)
      {
         mysqli_query($con,"update t_reg_coord set rc_pswd='".$crnew."' where f_email ='". $_SESSION["ad"]."'");

          echo "<script> alert('Password has been changed.');</script>";
      }

    else
       {
          echo "<script> alert('Incorrect old password !');</script>";
       }
    }

   else
   {
      echo "<script> alert('Please confirm the password correctly.');</script>";
   }
}

//change password over

?>

   

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
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
              
		
         <title> Coordinator's Cell </title>
     <!-- row click link -->    
         <script>
                jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
                });
            });

        </script>
       
        <script language="javascript">
            
            //Delete record for coordinator training event
            function validate()
            {
            var chks = document.getElementsByName('checkbox[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++)
            {
            if (chks[i].checked)
            {
            hasChecked = true;
            break;
            }
            }
            if (hasChecked == false)
            {
            alert("No records selected.");
            return false;
            }
            return true;
            }
      </script>
      
      <!--Display upload event div-->    
      <script>
         
          $(document).ready(function(){
              $("#train").click(function(){
                  $("#training").show();
                  $("#placement").hide();
                  
              });
              $("#place").click(function(){
                  $("#placement").show();
                  $("#training").hide();
             }); 
          });
         </script>
        <!--Display upload event div-->   
        
        
         <!--Display participant;s list training-->    
      <script>
         
          $(document).ready(function(){
              $("#ctrok").click(function(){
                  $("#cvpt").show();
                });
               
          });
         </script>
       <!--Display participant;s list training-->    
      
         
        
        
        <!--Display participant;s list training-->    
      <script>
         
          $(document).ready(function(){
              $("#cprok").click(function(){
                  $("#cvpp").show();
                });
               
          });
         </script>
       <!--Display participant;s list training--> 
       
       
       
  <!--file bootstrap-->    
      
      <style>
            .btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}
        </style>
   
      
   
   
   <script>
            
            $(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
            </script>
            
            
<!--file bootstrap--> 
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
                            <font style='margin-left:3px;color: white; font-family: Verdana;  font-size:15px;'>";
                        
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
            
            <div class="container">
                <section>
				<div class="tabs tabs-style-linebox">
					<nav>
						<ul>
							<li><a href="#section-linebox-1"><span>Training Events</span></a></li>
							<li><a href="#section-linebox-2"><span>Placement Events</span></a></li>
							<li><a href="#section-linebox-3"><span>Gallery</span></a></li>
							<li><a href="#section-linebox-4"><span>Upload New Event</span></a></li>
							<li><a href="#section-linebox-5"><span>Change Password</span></a></li>
						</ul>
					</nav>
                                    
				<div class="content-wrap" >
                                    
                                                <section id="section-linebox-1" >
                                                    
                                                  <form id="coordinatorpage" action="coordinatorpage.php" method="post" >  
                                                    
                                                 <div class="hometable"> 
                                                    <?php
                                                       $chkt1= mysqli_query($con, "select * from t_tevent where f_email='".$_SESSION['ad']."'");
                                                    
                                                       if(mysqli_num_rows($chkt1)==0)
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
                                                     $vtevt = mysqli_query($con, "select * from t_tevent where f_email='".$_SESSION['ad']."'");
                                                      while($tevt = mysqli_fetch_array($vtevt))
                                                            {

                                                               echo "<tr>
                                                                <td> <a style='cursor:pointer; color:black; font-weight:normal;'
                                                                    data-toggle='modal' data-target='#ctrmodal'> 
                                                                <strong>" . $tevt[1] ."</strong></a></td>";
                                                               echo "<td>". $tevt[3] ."</td>";
                                                               echo "<td>" . $tevt[2] ."</td>";
                                                               echo "<td>" . $tevt[5] ."</td>";
                                                            ?>
                                                             <td><input name="checkbox[]" type="checkbox" id="checkbox[]" 
                                                            value="<?php echo $tevt[0];?>"></td>
                                                            <?php   
                                                               echo "</tr> ";
                                                               
                                                            }
                                                           
                                                     
                                                  echo "</tbody>
                                               </table>";
                                                 echo '<center><input type="submit" name="cteventdel" 
                                                       value ="Remove Selected Event(s)" onclick="validate();"></center>';
                                                      }     
                                                     ?>
                                                 </div> 
                                                  </form>
                                                </section>

                                    
                                    
						<section id="section-linebox-2" >
                                                    
                                                  <form id="coordinatorpage" action="coordinatorpage.php" method="post" >  
                                                 <div class="hometable"> 
                                                     
                                                    <?php
                                                       $chkt2= mysqli_query($con, "select * from t_pevent where f_email='".$_SESSION['ad']."'");
                                                        if(mysqli_num_rows($chkt2)==0)
                                                        {
                                                             echo "<center><font style='color:black; font-size:16px';
                                                                 font-size: 14px; font-style:Verdana'>
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
                                                                                                    

                                                            $vpevt = mysqli_query($con, "select * from t_pevent where f_email='".$_SESSION['ad']."'");
                                                            while($pevt = mysqli_fetch_array($vpevt))
                                                            {

                                                               echo "<tr>
                                                               <td><a style='cursor:pointer; color:black; font-weight:normal;'
                                                                    data-toggle='modal' data-target='#cplmodal'>
                                                               <strong>" . $pevt[1] ."</strong></a></td>";
                                                               echo "<td>". $pevt[2] ."</td>";
                                                               echo "<td>" . $pevt[3] ."</td>";
                                                               echo "<td>" . $pevt[7] ."</td>";
                                                            ?>
                                                               <td><input name="checkbox[]" type="checkbox" id="checkbox[]" 
                                                            value="<?php echo $pevt[0];?>"></td>
                                                               <?php   
                                                               echo "</tr> ";
                                                            }
                                                            
                                                         
                                                  
                                                echo "</tbody>
                                               </table>";
                                                
                                                echo '<center><input type="submit" name="cpeventdel1" 
                                                       value ="Remove Selected Event(s)" onclick="validate();" ></center>';
                                                      } 
                                               
                                                         
                                                     ?>
                                                
                                               </div> 
                                                  </form>
                                                </section>
						
                                            	
                                                <section id="section-linebox-3">
                                                     <form id="coordinatorpage" action="coordinatorpage.php" method="post" enctype="multipart/form-data">   
                                                    <div class="container-fluid" id="crgal" >
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                  <input type="text" id="textfield" name="textfield" placeholder="Enter Target Folder's Name" style='margin-top:30px;color:#666666'>
                                                                </div>
                                                               
                                                             
                                                                <div class="col-sm-6 ">

                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <span class="btn btn-primary btn-file" style="margin-top:30px;height:40px;">
                                                                                Browse&hellip; <input type="file" name="images[]"  multiple="multiple" accept="image/*" />
                                                                            </span>
                                                                     </span>
                                                                    <input type="text" class="form-control" style="width:380px;margin-left:2px;"readonly >
                                                                     
                                                                    </div>
                                                                  </div>
                                                               </div>
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                    <center>   <input type="submit" name="sub" value="Upload!"
                                                                          style="width:20%"/></center>
                                                             </div>   
                                                             </div>
                                                        <input type="hidden" name="galhid" />
                                                    </div>
                                                    
                                                    
                                                   <?php 
                                                        $picfile_path ='Photos/';
                                                      $sql1 = mysqli_query($con,"SELECT * FROM t_gallary where f_email='$ad'");
                                                        if(isset($sql1) && count($sql1)) :  
                                                          foreach ($sql1 as $key => $row) : 
                                                          $picsrc=$picfile_path.$row['folder_name'].'/'.$row['g_file_name'];
                                                          echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='margin-top:20px;
                                                              height:180px;'>"; 
                                                  
                                                      ?>    


                                                  <?php       
                                                   endforeach;   endif;       
                                                  ?>
                                                     </form>   
                                                </section>
                                    
                                            
						<section id="section-linebox-4">
                                                    
                                                   <form id="coordinatorpage" action="coordinatorpage.php" method="post" enctype="multipart/form-data"> 
                                                    <a id="train" style="cursor:pointer">Training Event</a>
                                                    <a id="place" style="cursor:pointer">Placement Event</a>
                                                    <center>   
                                                    <div id="training" class="container-fluid" hidden style="color: black ;font-family:Verdana;">    
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ; font-family:Verdana; font-weight: bold;margin-top:2px; font-size: x-large ">
                                                                  Training Event's Details
                                                               </p>
                                                            </div> 
                                                        </div>    

                                                           <div class="row">
                                                                <div class="col-sm-8">
                                                                   <input type="text" id="evttitle" name="evttitle" placeholder="Enter Event's Title" >
                                                                </div>
                                                            
                                                                <div class="col-sm-4">
                                                                   <input type="text" id="evtdate" onFocus="(this.type='date')" onBlur="(this.type='text')" name="evtdate" placeholder="Event's Date">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" id="evtvenue" name="evtvenue" placeholder="Enter Event's Venue">
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: normal;margin-top:2px; font-size: small">
                                                                  Enter the description.
                                                               </p>
                                                            </div> 
                                                          </div>
                                                        
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <textarea id="evtdesc" name="evtdesc" >
                                                                   </textarea>
                                                                </div>
                                                            </div>
                                                            
                                                        <div class="row">
                                                            <div class="col-sm-12 ">
                                                                <div class="input-group">
                                                                    <span class="input-group-btn">
                                                                        <span class="btn btn-primary btn-file" style="margin-top:30px;height:40px;">
                                                                            Browse&hellip; <input type="file" name="tfile[]"  multiple="multiple" />
                                                                        </span>
                                                                 </span>
                                                                <input type="text" class="form-control" style="width:380px;margin-left:2px;"readonly >

                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="upevtsub" value="Upload" >
                                                                </div>
                                                            </div>
                                                         <input type="hidden" name="fevthid" />
                                                      </div>
                                                        
                                                      <div id="placement" class="container-fluid" hidden style="color: black ;font-family:Verdana;">  
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:2px; font-size: x-large ">
                                                                  Placement Event's Details
                                                               </p>
                                                            </div> 
                                                        </div>    

                                                           <div class="row">
                                                                <div class="col-sm-8">
                                                                   <input type="text" id="evttitle1" name="evttitle1" placeholder="Enter Company's Name" >
                                                                </div>
                                                            
                                                                <div class="col-sm-4">
                                                                   <input type="text" id="evtdate1" onFocus="(this.type='date')" onBlur="(this.type='text')" name="evtdate1" placeholder='Arrival' style='margin-top: 25px;' >
                                                                </div>
                                                            </div>
                                                 
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" id="evtpack" name="evtpack" placeholder="Enter Package" style='margin-top: 25px;'>
                                                                </div>
                                                            </div>
                                                            
                                                        
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: normal;margin-top:2px; font-size: small">
                                                                 Enter Document's Required.
                                                               </p>
                                                            </div> 
                                                          </div>
                                                            
                                                             <div class="row">
                                                                <div class="col-sm-12">
                                                                    <textarea id="evtdoc" name="evtdoc" placeholder="Enter the documents required...">
                                                                     </textarea>
                                                                </div>
                                                            </div>
                                                            
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: normal;margin-top:2px; font-size: small">
                                                                 Enter About The Company..
                                                               </p>
                                                            </div> 
                                                          </div>
                                                        
                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                    <textarea id="evtabt1" name="evtabt1" >
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                   
                                                            <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: normal;margin-top:2px; font-size: small">
                                                                 Enter the Criteria.
                                                               </p>
                                                            </div> 
                                                          </div>
                                                       
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <textarea id="evtdesc1" name="evtdesc1" >
                                                                    </textarea>
                                                                </div>
                                                            </div>

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                      <div class="input-group">
                                                                          <span class="input-group-btn">
                                                                              <span class="btn btn-primary btn-file" style="margin-top:30px;height:40px;">
                                                                                  Browse&hellip; <input type="file" name="pfile[]"  multiple="multiple" />
                                                                              </span>
                                                                       </span>
                                                                      <input type="text" class="form-control" style="width:380px;margin-left:2px;"readonly >

                                                                      </div>
                                                                  </div>
                                                             </div>
                                                          
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="upevtsub1" value="Upload" >
                                                                </div>
                                                            </div>
                                                          <input type="hidden" name="fevphid" />
                                                        </div>
                                                       
                                                   </center>
                                                    
                                                    <input type="hidden" name="evthid">
                                                    <input type="hidden" name="evphid">
                                                    
                                                    
                                                   </form>
                                                </section>
                                    
                                    
                                                <section id="section-linemove-5">
                                                    <form id="coordinatorpage" action="coordinatorpage.php" method="post">
                                                    <center>   
                                                    <div id="newpass" class="container-fluid">    
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:2px; font-size: xx-large ">
                                                                   Get a new password !
                                                               </p>
                                                            </div> 
                                                        </div>    

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="coldpass" placeholder="What's The Old Password ?" style="color:#666666  ;">>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="cnewpass" placeholder="Enter your new password" style="color:#666666  ;">>
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="cconpas" placeholder="Confirm New Password" style="color:#666666  ;">>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="cpasub" value="Change" >
                                                                </div>
                                                            </div>

                                                         </div>
                                                   </center>
                                                    
                                                    </form>
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
                        <div id="cvpt" hidden>
                            <div class="row" style="margin-top:14px;">
                                <div class="col-sm-12">
                                   <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Participants : </strong>
                                    </font>
                                </div>
                            </div>
                        
                            <div class="row" >
                                <div class="col-sm-12">
                                   <div class="hometable" style="overflow: scroll">
                                        <?php

                                        $cgetid = mysqli_query($con, "select e_id from t_tevent where e_id='EVT0001'");
                                        $cgetii = mysqli_fetch_assoc($cgetid);
                                        $cgeti    = $cgetii["e_id"];

                                          $trchkt1= mysqli_query($con, "
                                          select e.s_name,e.s_email,e.s_reg,e.s_branch,e.s_ph from t_stud e where s_email in (select s_email from tr_event where e_id = '".$cgeti."')");
                                          $trcount=0;
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
                                                       <th>S. No</th>
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
                                                  echo "<td>". ++$trcount .".</td>";
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
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                     
                      <input type="button" id="ctrok" class="btn btn-default" value="View Participants" style="color:black;"> 
                      <a href="training_pl.php" class="btn btn-default" style="color:black;"> Download Excel File </a>
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
                        
                      
                        <div id="cvpp" hidden>
                            <div class="row" style="margin-top:14px;">
                                <div class="col-sm-12">
                                   <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                        <strong>Applicants : </strong>
                                    </font>
                                </div>
                            </div>
                        
                            <div class="row" >
                                <div class="col-sm-12">
                                   <div class="hometable" style="overflow: scroll">
                                        <?php

                                        $cgetid1 = mysqli_query($con, "select p_cid from t_pevent where p_cid='EVP0001'");
                                        $cgetii1 = mysqli_fetch_assoc($cgetid1);
                                        $cgeti1    = $cgetii1["p_cid"];

                                          $trchkt2= mysqli_query($con, "
                                          select e.s_name,e.s_email,e.s_reg,e.s_branch,e.s_ph from t_stud e where s_email in (select s_email from pl_event where p_cid = '".$cgeti1."')");
                                          $trcount1=0;
                                          if(mysqli_num_rows($trchkt2)==0)
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
                                                       <th>S. No</th>
                                                       <th>Name</th>
                                                       <th>Email</th>
                                                       <th>Reg. No</th>
                                                       <th>Branch</th>
                                                       <th>Contact</th>
                                                     </tr>
                                                   </thead>
                                               <tbody>";

                                              while($trid1 = mysqli_fetch_array($trchkt2))
                                              {
                                                  echo "<tr>";
                                                  echo "<td>". ++$trcount1 .".</td>";
                                                  echo "<td>". $trid1[0] ."</td>";
                                                  echo "<td>". $trid1[1] ."</td>";
                                                  echo "<td>". $trid1[2] ."</td>";
                                                  echo "<td>". $trid1[3] ."</td>";
                                                  echo "<td>". $trid1[4] ."</td>";

                                              } 


                                               ?>

                                               <?php   
                                                  echo "</tr> ";

                                               }

                                     echo "</tbody>
                                      </table>";
                                      ?> 
                                   </div>
                                </div>
                            </div>
                      </div>
                      
                    </div>
                    <div class="modal-footer">
                       <input type="button" id="cprok" class="btn btn-default" value="View Applicants" style="color:black;"> 
                      <a href="placement_pl.php" class="btn btn-default" style="color:black;"> Download Excel File </a>
                    
                    </div>
                      
                    
                  </div>

                </div>
              </div> 
            
            
           <!-- /PLACEMENT row pop up -->   
            
          
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
