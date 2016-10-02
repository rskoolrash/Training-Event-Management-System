<?php
session_start();
error_reporting(0);
include 'phpcode.php';
$con = GetConn();
if(!isset($con))
{
    die("Database Not Found");
}


if(isset($_REQUEST["sloginsub"]))
{
    $slgid = $_REQUEST["sloginid"];
    $slgps= $_REQUEST["sloginpas"];
    
    if($slgid!=''&&$slgps!=='')
    {
        $query = mysqli_query($con, "select * from t_admin where a_email ='" .$slgid. "' and a_pswd ='" .$slgps. "'");
        $res   = mysqli_fetch_row($query);
        
        $query1 = mysqli_query($con, "select * from t_reg_coord where rc_email ='" .$slgid. "' and rc_pswd ='" .$slgps. "'");
        $res1  = mysqli_fetch_row($query1);
        
        $query2 = mysqli_query($con, "select * from t_reg_stud where rs_email ='" .$slgid. "' and rs_pswd ='" .$slgps. "'");
        $res2   = mysqli_fetch_row($query2);
        if($res)
        {
            $_SESSION['ad'] = $slgid;
            header('location:adminpage.php');
        }
        
        else if($res1)
        {
            $_SESSION['ad'] = $slgid;
            header('location:coordinatorpage.php');
        }
        
        else if($res2)
        {
            $_SESSION['ad'] = $slgid;
            header('location:studentpage.php');
        }
        else
        {
            echo '<script> alert("Invalid Login ! Please try again. ")</script>';
        }
    }
    else
    {
        echo '<script>';
        echo 'alert("Enter both username and password")';
        echo '</script>';
 
    }
}

if(isset($_REQUEST["cregsub"]))
{

    if($crhid == "" && $crphid == "")
    $crhid = CrCode();
    $crphid = CrPas();
    $sqlcr = "insert into t_reg_coord (rc_id,rc_email,rc_pswd,rc_status,rc_date) values (";
    $sqlcr.= "'" . $crhid . "',";
    $sqlcr.= "'" . $crml . "',";
    $sqlcr.= "'" . $crphid . "',";
    $sqlcr.= "'PENDING',";
    $sqlcr.= "sysdate())";
	
	include_once("Mail.php"); 

$regnno="P00418";
$password="";
$From = "laxmicutm@gmail.com"; 
                $uname = "Rashmi Ranjan Kar";
                $email="130301csl062@cutm.ac.in";
			
		$Subject = "Registration Successfull"; 
                $Message = "Dear $uname, \n You have successfully Registered for the Free Elective Subject Registration Portal .\n Please use the following Your Userid and Password for the Further Processing.\n Your User Id :$regnno.\n Password :$password";
		$Host = "smtp.gmail.com"; 			
		// Do not change bellow 
		$Headers = array ('From' => $From, 'To' => $email, 'Subject' => $Subject); 
		$SMTP = Mail::factory('smtp', array ('host' => $Host, 'auth' => true, 'username' => "prativa.mamun@gmail.com", 'password' => 'Prativa@#6')); 			  			  			 
                $mail = $SMTP->send($email, $Headers, $Message); 		  
		if (PEAR::isError($mail))
		{ 
                    echo($mail->getMessage()); 
		} 
		else
		{ 	
		mysqli_query($con, $sqlcr);
		echo "<script>alert('Message Sent Successfully. Check Your mail. Request has been sent to the Super User. Please wait for the approval.');</script>";
		}
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
          <link rel="stylesheet" href="css/fields.css">   
         <link rel="stylesheet" href="css/divisions.css">
         <link rel="stylesheet" href="css/common.css">
       <!--  <link rel="stylesheet" type="text/css" href="tabcss/normalize.css" />
         <link rel="stylesheet" type="text/css" href="tabcss/demo.css" />-->
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
                background-image:url(images/bglogin1.png);
            }
            body:before
            {
                opacity:0.2;
            }
        </style>	
         <title> Welcome 
            
         </title>
         
       
         
         
         <script>
            
                
                //Function To Display Popup  for forgot pswd
                function div_show() {
                document.getElementById('fgps').style.display = "block";
                }
                //Function to Hide Popup  for forgot pswd
                function div_hide(){
                document.getElementById('fgps').style.display = "none";
                }
                </script>
         
         
    </head>
    <body>
        <form id="index" action="index.php" method="post">
            
            
            <div class="container-fluid">    
            
                <section>
				<div class="tabs tabs-style-circle" style="margin-top:50px;">
					<nav>
						<ul>
							<li><a href="#section-circle-1" class="icon icon-home"><span>Home</span></a></li>
							<li><a href="#section-circle-2" class="icon icon-gift"><span>Gallery</span></a></li>
							<li><a href="#section-circle-3" class="icon icon-box"><span>Login</span></a></li>
							<li><a href="#section-circle-4" class="icon icon-display"><span>Co-ordinator</span></a></li>
							<li><a href="#section-circle-5" class="icon icon-upload"><span>Participate</span></a></li>
						</ul>
					</nav>
					<div class="content-wrap">
                                            <section id="section-circle-1">
                                                
                                                
                                                 <div class="container-fluid">    
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                
                                                             <div class="searchdiv">    
                                                                 <input type="search" placeholder="What are you looking for?">		    	
                                                                 <button>Search</button>
                                                             </div>
                                   
                                                      </div>
                                                   </div>
                                                 </div>
        
                                               <div class="hometable"> 
                                                <table>
                                                 <thead>
                                                   <tr>
                                                     <th>Title</th>
                                                     <th>Venue</th>
                                                     <th>Date</th>
                                                   </tr>
                                                 </thead>
                                                 <tbody>
                                                   <tr>
                                                     <td><strong>Group Discussions</strong></td>
                                                     <td>Hall no. 6</td>
                                                     <td>19<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Mock Interview</strong></td>
                                                     <td>Room No 13</td>
                                                     <td>17<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Apitute Test</strong></td>
                                                     <td>Room No 114</td>
                                                     <td>14<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Verbal Ability</strong></td>
                                                     <td>Lobby</td>
                                                     <td>14<sup>th</sup> January, 2016</td>
                                                   </tr>					
                                                   <tr>
                                                     <td><strong>Google It</strong></td>
                                                     <td>Ground Floor</td>
                                                     <td>14<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Programming Hub</strong></td>
                                                     <td>Room No 114</td>
                                                     <td>14<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Spoken English</strong></td>
                                                     <td>Lobby</td>
                                                     <td>14<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Quiz </strong></td>
                                                     <td> Room No 103</td>
                                                     <td>13<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                   <tr>
                                                     <td><strong>Quantitative Apti</strong></td>
                                                     <td>Hall No 6</td>
                                                     <td>12<sup>th</sup> January, 2016</td>
                                                   </tr>
                                                 </tbody>
                                               </table>
                                               </div> 
                                                
                                                
                                            </section>
                                            
                                            
                                            
                                            
                                            
                                            <section id="section-circle-2">
<!-- Login Section -->
                                            </section>

                                            <section id="section-circle-3">
                                               <center> 
                                                <div id="dlogin" class="container-fluid">    
                                                            <div class="row">
                                                                 <div class="col-sm-12">
                                                                     <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:60px; font-size: xx-large ">
                                                                        Log in
                                                                    </p>
                                                                 </div>
                                                             </div>

                                                             <div class="row">
                                                                 <div class="col-sm-12">
                                                                    <input type="text" name="sloginid" placeholder="Enter ID">
                                                                 </div>
                                                             </div>

                                                             <div class="row">
                                                                 <div class="col-sm-12">
                                                                    <input type="password" name="sloginpas" placeholder="Enter Password">
                                                                 </div>
                                                             </div>

                                                             <div class="row">
                                                                 <div class="col-sm-12">
                                                                 <input type="submit" name="sloginsub" value="Login">
                                                                 </div>
                                                             </div>

                                                             <div class="row">
                                                                 <div class="col-sm-12">
                                                                     
                                                                     <a onclick="div_show();" style="cursor:pointer;transition: all 0.3s ease-out;">
                                                                         Forgot your password?
                                                                     </a>
                                                                     
                                                                 </div>
                                                             </div>
                                                         </div>

                                                 </center> 
                                            
                                            </section>
                                            
                                            
                                          
                                            
<!--Co-ordinator registration section -->                                            
                                            <section id="section-circle-4">
                                                <center>   
                                                    <div id="regcord" class="container-fluid">    
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:60px; font-size: xx-large ">
                                                                       Register
                                                                   </p>
                                                                </div>
                                                            </div>

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="email" name="cregemail" placeholder="Email ID">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" name="cregid" placeholder="Registration ID">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" name="cregname" placeholder="Name">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="cregsub" value="Register">
                                                                </div>
                                                            </div>

                                                         </div>
                                                   </center>
                                                <input type="hidden" name="crhid" >
                                                <input type="hidden" name="crphid" >
                                            </section>
<!--Participant registration-->
                                            <section id="section-circle-5">
                                                <center>   
                                                    <div id="regpartc" class="container-fluid">    
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:60px; font-size: xx-large ">
                                                                       Register
                                                                   </p>
                                                                </div>
                                                            </div>

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="email" name="sregemail" placeholder="Email ID">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" name="sregid" placeholder="Registration ID">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" name="sregname" placeholder="Name">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="sregsub" value="Register">
                                                                </div>
                                                            </div>

                                                         </div>
                                                   </center>
                                                </section>
                                            </div>
                                       </div>
                    <input type="hidden" name="prhid" >
			</section>
                
                
 
           </div>
 
            
          </form> 
      
         <?php
           include 'footer.php'
           ?>
        
        
       <script src="js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
                
          <!-- Forgot pasword pop up -->
                                    <div id="fgps" class='forgotps' >
                                                <div id="popupContact" >
                                                    <form action="#" id="form" method="post" name="form">
                                                <div  class="container-fluid">
                                                        <div class="row">
                                                             <div class="col-sm-12">
                                                                 <img id="close" src="images/close1.png" onclick ="div_hide();">
                                                                 <h2><span >Forgot Password</span></h2>

                                                                    <p> Forgot your password?<br>
                                                                        No problem. We'll email it to you!<br>
                                                                    </p> 

                                                                    <input type="email" name="frgeml" placeholder="Enter Your Email Here" >
                                                                    <input type="submit" name="frgsub" value="Send"  >
                                                                 </div>
                                                             </div>
                                                        </div>   
                                                        </form>
                                                 </div>
                                              </div>
          
           <!-- Forgot pasword pop up -->
    </body>
</html>