
<?php
error_reporting(0);
session_start();
include 'phpcode.php';
$con = GetConn();


$q=mysqli_query($con,"select a_name from t_admin where a_email='".$_SESSION['ad']."'");
$n=  mysqli_fetch_assoc($q);
$adname= $n['a_name'];



/*if (isset($_POST["reqdel"])) {
	
	if (count($_POST["ids"]) > 0 ) {
		$all = implode(",", $_POST["ids"]);
		$sql = mysqli_query($con,"DELETE FROM t_reg_coord WHERE 1 AND f_email in($all)");
		if ( ($sql))
                {
                    	
                        require_once "Mail.php";  
                        $from    = "cutmtnp@gmail.com";  
                        $to      = "130301csl062@cutm.ac.in"; 
                        $subject = "Registration Rejected";  
                        $body    = "Sorry ! Your request for coordinator has been rejected by the Super User. 
                            \n Please mail at" .$_SESSION['ad'] ."for the approving the request.\n
                                    Thankyou.
                                    ";

                        /* SMTP server name, port, user/passwd */  
   /*                   $smtpinfo["host"] = "ssl://smtp.gmail.com";  
                        $smtpinfo["port"] = "465";  
                        $smtpinfo["auth"] = true;  
                        $smtpinfo["username"] = "cutmtnp@gmail.com";  
                        $smtpinfo["password"] = "dilrajrashmi@";  

                        $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);  
                        $smtp = &Mail::factory('smtp', $smtpinfo );  

                        $mail = $smtp->send($to, $headers, $body);  

                        if (PEAR::isError($mail)) {  
                          echo("<p>" . $mail->getMessage() . "</p>");  
                         } else {  
                          
                             echo "<script>alert('Requests Deleted !!');</script>";
                         }
                   }
                else
                {
			 echo "<script>alert('Error deleting row(s) !!');</script>";
		}
	} else {
		echo "<script>alert('You need to select atleast one checkbox to delete!');</script>";
	}
	
}*/


//change password

if(isset($_REQUEST["adpassub"]))
{
    
    $getad = mysqli_query($con,"select * from t_admin where a_email='". $_SESSION["ad"]."' and a_pswd='". $adold."'");
    
    if($adnew==$adcon)  
    {
      if(mysqli_num_rows($getad)>0)
      {
         mysqli_query($con,"update t_admin set a_pswd='".$adnew."' where a_email ='". $_SESSION["ad"]."'");

          echo "<script> alert('Password has been changed successfully');</script>";
      }

    else
       {
          echo "<script> alert('Old password is incorrect. Please try again.');</script>";
       }
    }

   else
   {
      echo "<script> alert('New password and confirm password should match. Please try again');</script>";
   }
}

//change password over

 
//Delete record for coordinator request
 if(isset($_REQUEST['adreqdel'])){
for($i=0;$i<count($_REQUEST['checkbox']);$i++){
$del_id=$_REQUEST['checkbox'][$i];


$result1 = mysqli_query($con,"DELETE FROM t_reg_coord WHERE f_email='$del_id'");
}
// if successful redirect to adminpage.php
if($result1)
{
    
    require_once "Mail.php";  
        $from    = "cutmtnp@gmail.com";  
        $to      = $del_id; 
        $subject = "Registration Rejected";  
        $body    = "Sorry ! Your request for coordinator has been rejected by the Super User. 
            \n Please mail at " .$_SESSION['ad'] ." for the approving the request.\n
                    Thankyou.
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
         } else {  

             echo "<meta http-equiv=\"refresh\" content=\"0;URL=adminpage.php\">";
         }

}
}


//Accept record for coordinator request
 if(isset($_REQUEST['adreqcon'])){
    
for($i=0;$i<count($_REQUEST['checkbox']);$i++)
{
$del_id=$_REQUEST['checkbox'][$i];
 
$result2 = mysqli_query($con,"UPDATE t_reg_coord set rc_status='ACCEPTED',rc_pswd='DsHT!Rw' WHERE f_email='$del_id'");
  
}
// if successful redirect to adminpage.php

if($result2)
{
      
        require_once "Mail.php";  
        $from    = "cutmtnp@gmail.com";  
        $to      = $del_id;  
        $subject = "Registration Accepted";  
        $body    = "Hi, ! Your request for coordinator has been accepted by the Super User. 
                    \n You can now login to your account. Your password is DsHT!Rw. \n
                    Thankyou.
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
         } else {  

             echo "<meta http-equiv=\"refresh\" content=\"0;URL=adminpage.php\">";
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
              
		
         <title> Super User's Cell </title>
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
    <body style="background-image:url(images/bglog2.jpg)">
        
         <?php  

            include 'adsession.php';

        ?>
        
        <form id="adminpage" action="adminpage.php" method="post">
          
            <div class="container-fluid" id="pagebar">
                <div class="row">
                    <a href='coordlogout.php'>
                             <img src='images/logout1.png' style="margin-left:4px;margin-top:4px;height:30px;width:30px"></img>
                            </a>
                    <?php
                       
                                     
                        echo "<span>
                            <font style='margin-left:5px;color:white; font-family: Verdana;  font-size:15px;'>";
                        
                        date_default_timezone_set('Asia/Calcutta');
                        $Hour = date('G'); //24 hrs format hrs
                        if ( $Hour >= 5 && $Hour < 12 ) {
                            echo "
                                Good Morning, " . $adname . "";
                        } else if ( $Hour >= 12 && $Hour < 17 ) {
                            echo "
                                Good Afternoon, " . $adname . "";
                        } else if ( $Hour >= 17 || $Hour <= 21 ) {
                            echo "Good Evening, " . $adname . "";
                        }
                        else  {
                            echo "Welcome, " . $adname . "</font></span>";
                        }
                            
                         
                    ?>   
                  
                </div>
            </div>
            <div class="container">
                          
                <section>
				<div class="tabs tabs-style-linebox">
					<nav>
						<ul>
							<li><a href="#section-linebox-1"><span>New Coordinator Requests</span></a></li>
							<li><a href="#section-linebox-2"><span>Existing Coordinators</span></a></li>
							<li><a href="#section-linebox-3"><span>Change Password</span></a></li>
							
						</ul>
					</nav>
                                    
				<div class="content-wrap" >
						<section id="section-linebox-1" >
                                                 <div class="hometable"> 
                                                
                                                     <?php
                                                     $corres = mysqli_query($con, "select * from t_reg_coord where rc_status='PENDING'");
                                                     if(mysqli_num_rows($corres)==0)
                                                        {
                                                             echo "<center><font style='color:black;
                                                                 font-size: 16px;font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";

                                                        }
                                                        
                                                        else
                                                     {
                                                    echo" <table>
                                                            <thead>
                                                              <tr>
                                                                 <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Email ID</th>
                                                                <th>Contact</th>
                                                                <th>Sent On</th>
                                                                <th>Status</th>
                                                              </tr>
                                                            </thead>
                                                        <tbody>";
                                                     while($corar = mysqli_fetch_array($corres))
                                                     {
                                                        $fnq=mysqli_query($con,"select f_name from t_faculty where f_email='".$corar[0]."'");
                                                        $fna=  mysqli_fetch_assoc($fnq);
                                                        $fn= $fna['f_name'];


                                                        $frq = mysqli_query($con, "select f_reg from t_faculty where f_email='" . $corar[0]."'");
                                                        $fra = mysqli_fetch_array($frq);
                                                        $fr =  $fra['f_reg'];

                                                        $fpq = mysqli_query($con, "select f_phn from t_faculty where f_email='" . $corar[0]."'");
                                                        $fpa = mysqli_fetch_array($fpq);
                                                        $fp =  $fpa['f_phn'];
                                                       
                                                        echo "<tr>
                                                        <td><strong>" . $fr ."</strong></td>";
                                                        echo "<td>". $fn ."</td>";
                                                        echo "<td>" . $corar[0] ."</td>";
                                                        echo "<td>" . $fp ."</td>";
                                                        echo "<td>" . $corar[3] ."</td>";
                                                        echo "<td>" . $corar[2] ."</td>";
                                                        ?>
                                                        <td><input name="checkbox[]" type="checkbox" id="checkbox[]" 
                                                            value="<?php echo  $corar[0] ; ?>"></td>
                                                            <?php   
                                                               echo "</tr> ";
                                                               
                                                            }
                                                     }  
                                                  
                                                 echo "</tbody>
                                               </table>";
                                                     ?>
                                                     
                                                     <input type="submit" name="adreqdel" 
                                                       value ="Remove Selected Event(s)" onclick="return validate();">
                                                     
                                                     
                                                      <input type="submit" name="adreqcon" 
                                                       value ="Confirm Selected Event(s)" onclick="return validate();">
                                                     
                                               </div> 
                                                </section>
						
                                                <section id="section-linebox-2">
                                                     <div class="hometable"> 
                                                      <?php
                                                     $corres1 = mysqli_query($con, "select * from t_reg_coord where rc_status='ACCEPTED'");
                                                     if(mysqli_num_rows($corres1)==0)
                                                        {
                                                         echo "<center><font style='color:black;
                                                                 font-size: 16px;font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";
                                                        }
                                                        
                                                        else
                                                     {
                                                    echo" <table>
                                                            <thead>
                                                              <tr>
                                                                 <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Email ID</th>
                                                                <th>Contact</th>
                                                                <th>Sent On</th>
                                                              
                                                              </tr>
                                                            </thead>
                                                        <tbody>";
                                                     while($corar1 = mysqli_fetch_array($corres1))
                                                     {
                                                        $fnq=mysqli_query($con,"select f_name from t_faculty where f_email='".$corar1[0]."'");
                                                        $fna=  mysqli_fetch_assoc($fnq);
                                                        $fn= $fna['f_name'];


                                                        $frq = mysqli_query($con, "select f_reg from t_faculty where f_email='" . $corar1[0]."'");
                                                        $fra = mysqli_fetch_array($frq);
                                                        $fr =  $fra['f_reg'];

                                                        $fpq = mysqli_query($con, "select f_phn from t_faculty where f_email='" . $corar1[0]."'");
                                                        $fpa = mysqli_fetch_array($fpq);
                                                        $fp =  $fpa['f_phn'];
                                                       
                                                        echo "<tr>
                                                        <td><strong>" . $fr ."</strong></td>";
                                                        echo "<td>". $fn ."</td>";
                                                        echo "<td>" . $corar1[0] ."</td>";
                                                        echo "<td>" . $fp ."</td>";
                                                        echo "<td>" . $corar1[3] ."</td>";
                                                 
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
                                            
                                            
                                                <section id="section-linemove-3">
                                                    
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
                                                                   <input type="password" name="adoldpas" placeholder="What's The Old Password ?" style="color:#666666  ;">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="adnewpas" placeholder="Enter your new password" style="color:#666666  ;">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="password" name="adconnpas" placeholder="Confirm New Password" style="color:#666666  ;">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                               <input type="submit" name="adpassub" value="Change" > 
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
