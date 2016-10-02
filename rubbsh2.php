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
   echo "<script>alert('Event has been uploaded successfully');</script>";
 }
 
 
 //Delete record for coordinator training event
 if(isset($_REQUEST['cteventdel'])){
for($i=0;$i<count($_REQUEST['checkbox']);$i++){
$del_id=$_REQUEST['checkbox'][$i];


$result1 = mysqli_query($con,"DELETE FROM t_tevent WHERE e_id='$del_id'");
}
// if successful redirect to delete_multiple.php
if($result1)
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
    echo "<script>alert('Event has been uploaded successfully');</script>";
 }
 
 
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
          echo "<script> alert('New Password and Confirm password must be same !');</script>";
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
      
    </head>
    <body style="background-image:url(images/bgloginn.jpg)">
        <?php  

            include 'coordsession.php';

        ?>
        <form id="coordinatorpage" action="coordinatorpage.php" method="post">
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
                            <font style='margin-left:5px;color:white; font-family: Verdana;  font-size:15px;'>";
                        
                        date_default_timezone_set('Asia/Calcutta');
                        $Hour = date('G');
                        if ( $Hour >= 5 && $Hour < 12 ) {
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
                                                 <div class="hometable"> 
                                                    <?php
                                                       $chkt1= mysqli_query($con, "select * from t_tevent where f_email='".$_SESSION['ad']."'");
                                                    
                                                       if(mysqli_num_rows($chkt1)==0)
                                                        {
                                                             echo "<center><font style='color:#eada3c; font-width:bold'; 
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
                                                     $vtevt = mysqli_query($con, "select * from t_tevent");
                                                      while($tevt = mysqli_fetch_array($vtevt))
                                                            {

                                                               echo "<tr>
                                                                <td> <a href='doc.php?id=".$tevt[1]."'> <strong>" . $tevt[1] ."</strong></a></td>";
                                                               echo "<td>". $tevt[3] ."</td>";
                                                               echo "<td>" . $tevt[2] ."</td>";
                                                               echo "<td>" . $tevt[5] ."</td>";
                                                            ?>
                                                             <td><input name="checkbox[]" type="checkbox" id="checkbox[]" 
                                                            value="<?php echo $tevt[0];?>"></td>
                                                            <?php   
                                                               echo "</tr> ";
                                                               
                                                            }
                                                         
                                                     }  
                                                  echo "</tbody>
                                               </table>";
                                                   echo '<center><input type="submit" name="cteventdel" 
                                                       value ="Remove Selected Event(s)" onclick="validate();"
                                                       style="
                                                        position: relative; padding: 5px 20px;  margin: 0px 10px 10px 0px;
                                                        width:25%;  border-radius: 5px;   font-size: 19px;  color: #FFF;
                                                        text-decoration: none;  background-color: #dccc32;  border-bottom: 5px solid #cc9900;
                                                        text-shadow: 0px -2px #cc9900;   margin-top:30px;"></center>';
                                                         
                                                     ?>
                                                 </div> 
                                                </section>

                                    
                                    
						<section id="section-linebox-2" >
                                                 <div class="hometable"> 
                                                     
                                                    <?php
                                                       $chkt2= mysqli_query($con, "select * from t_pevent where f_email='".$_SESSION['ad']."'");
                                                        if(mysqli_num_rows($chkt2)==0)
                                                        {
                                                             echo "<center><font style='color:#eada3c; font-width:bold'; 
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
                                                                                                    

                                                            $vpevt = mysqli_query($con, "select * from t_pevent");
                                                            while($pevt = mysqli_fetch_array($vpevt))
                                                            {

                                                               echo "<tr>
                                                               <td><strong>" . $pevt[1] ."</strong></td>";
                                                               echo "<td>". $pevt[2] ."</td>";
                                                               echo "<td>" . $pevt[3] ."</td>";
                                                               echo "<td>" . $pevt[7] ."</td>";

                                                               echo '<td><input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo stripslashes($rs->f_email); ?>" ></td>';
                                                               echo "</tr>";
                                                            }
                                                        }   
                                                  
                                                echo "</tbody>
                                               </table>";
                                                ?>
                                               </div> 
                                                </section>
						
                                            	
                                                <section id="section-linebox-3">
                                                    
                                                </section>
                                    
                                            
						<section id="section-linebox-4">
                                                    <center>   
                                                    <div id="uploadevt" class="container-fluid">    
                                                        <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ; font-family:Verdana; font-weight: bold;margin-top:2px; font-size: xx-large ">
                                                                  Training Event's Details
                                                               </p>
                                                            </div> 
                                                        </div>    

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" id="evttitle" name="evttitle" placeholder="Enter Event's Title" style='margin-top: 5px;'>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="date" id="evtdate" name="evtdate" placeholder="Registration ID">
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
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="upevtsub" value="Upload" >
                                                                </div>
                                                            </div>

                                                         <div class="row">
                                                           <div class="col-sm-12">
                                                                <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:2px; font-size: xx-large ">
                                                                  Placement Event's Details
                                                               </p>
                                                            </div> 
                                                        </div>    

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" id="evttitle1" name="evttitle1" placeholder="Enter Company's Name" style='margin-top: 5px;'>
                                                                </div>
                                                            </div>
                                                            
                                                    
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="date" id="evtdate1" name="evtdate1" style='margin-top: 25px;' >
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
                                                                    <input type="submit" name="upevtsub1" value="Upload" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                   </center>
                                                    
                                                    <input type="hidden" name="evthid">
                                                    <input type="hidden" name="evphid">
                                                </section>
                                                <section id="section-linemove-5">
                                                    
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
                                                                   <input type="password" name="coldpass" placeholder="What's The Old Password ?">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="cnewpass" placeholder="Enter your new password">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="cconpas" placeholder="Confirm New Password">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="cpasub" value="Change" >
                                                                </div>
                                                            </div>

                                                         </div>
                                                   </center>
                                                    
                                                    
                                                </section>
						
					</div><!-- /content -->
				</div><!-- /tabs -->
			</section>
            </div>    
            
            
            
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
