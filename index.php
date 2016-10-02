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

//auotocomlete crd reg---------------------
if($_REQUEST["srchk"]!="")
{
    $id = $_REQUEST["srchk"];
    $ra = mysqli_query($con, "select f_reg from t_faculty where f_email = '$id'");
    echo mysqli_fetch_array($ra)[0];
    die();
}
if($_REQUEST["srchk1"]!="")
{
    $id1 = $_REQUEST["srchk1"];
    $ra1= mysqli_query($con, "select f_name from t_faculty where f_email='$id1'");
    echo mysqli_fetch_array($ra1)[0];
    die();
}
$q1=mysqli_query($con,"select f_reg from t_faculty where f_email='".$crml."'");
$n1=  mysqli_fetch_assoc($q1);
$freg= $n1['f_reg'];


$q2=mysqli_query($con,"select f_name from t_faculty where f_email='".$crml."'");
$n2=  mysqli_fetch_assoc($q2);
$fname= $n2['f_name'];

//auotocomlete crd reg-----------------------







if(isset($_REQUEST["sloginsub"]))
{
    $slgid = $_REQUEST["sloginid"];
    $slgps= $_REQUEST["sloginpas"];
    
    if($slgid!=''&&$slgps!=='')
    {
        $query = mysqli_query($con, "select * from t_admin where a_email ='" .$slgid. "' and a_pswd ='" .$slgps. "'");
        $res   = mysqli_fetch_row($query);
        
        $query1 = mysqli_query($con, "select * from t_reg_coord where f_email ='" .$slgid. "' and rc_pswd ='" .$slgps. "'");
        $res1  = mysqli_fetch_row($query1);
        
        $query2 = mysqli_query($con, "select * from t_stud where s_email ='" .$slgid. "' and s_pswd ='" .$slgps. "'");
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
    $sqlcr = "insert into t_reg_coord (f_email,rc_pswd,rc_status,rc_date) values (";
    $sqlcr.= "'" . $crml . "',";
    $sqlcr.= "'" . $crphid . "',";
    $sqlcr.= "'PENDING',";
    $sqlcr.= "sysdate())";
    
  $chkem= mysqli_query($con, "select * from t_reg_coord where f_email='$crml'");
    if(mysqli_num_rows($chkem)>0)
    {
         echo '<script>alert("This Email Id already exits. Please enter another email.")</script>';
        
    }

    require_once "Mail.php";  
  
$from    = "cutmtnp@gmail.com";  
$to      = $crml; 
$subject = "Registration Successful";  
$body    = "Dear $fname, \n Your request has been sent to the Super User. \n Please wait for the approval. \n
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
   mysqli_query($con, $sqlcr);
    ///echo $sqlcr;
    echo "<script>alert('Please check your email.');</script>";
 }  
}


	
	
//forgot pswd

  $fr=mysqli_query($con,"select * from t_reg_coord where f_email='".$frgeml."'");
  $fr1=  mysqli_fetch_assoc($fr);
  $fr2= $fr1['f_email'];
  
  $fq22=mysqli_query($con,"select f_name from t_faculty where f_email='".$frgeml."'");
  $fn22=  mysqli_fetch_assoc($fq22);
  $fname2= $fn22['f_name'];
  
   $sq22=mysqli_query($con,"select s_name from t_stud where s_email='".$frgeml."'");
  $sn22=  mysqli_fetch_assoc($sq22);
  $fnames= $sn22['s_name'];
  
   $aq22=mysqli_query($con,"select a_name from t_admin where a_email='".$frgeml."'");
  $an22=  mysqli_fetch_assoc($aq22);
  $fnamea= $an22['a_name'];

        $qquery = mysqli_query($con, "select * from t_admin where a_email ='" .$frgeml. "'");
        $rres   = mysqli_fetch_row($qquery);
        
        $qquery1 = mysqli_query($con, "select * from t_reg_coord where f_email ='" .$frgeml. "'");
        $rres1  = mysqli_fetch_row($qquery1);
        
        $qquery2 = mysqli_query($con, "select * from t_stud where s_email ='" .$frgeml. "'");
        $rres2   = mysqli_fetch_row($qquery2);
        
          
   
  if(isset($_REQUEST["frgsub"]))
  { 
     
   if($rres1)
        {
            $frgph = StFPas();
            mysqli_query($con,"update t_reg_coord set rc_pswd='".$frgph."' where f_email='".$frgeml."'");
            require_once "Mail.php";  
  
            $from    = "cutmtnp@gmail.com";  
            $to      = $frgeml; 
            $subject = "$fname2, your password was successfully reset";  
            $body    = "Hi $fname2, \n\n You've successfully changed your password. Your new password is $frgph .\n
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

            if (PEAR::isError($mail))
                {  
              echo("<p>" . $mail->getMessage() . "</p>");  
             } 
             else {  
               
                echo "<script>alert('Password has been sent to your mail.');</script>";
             }
        }
        else if($rres)
        {
            $frgph = StFPas();
            mysqli_query($con,"update t_admin set a_pswd='".$frgph."' where a_email='".$frgeml."'");
            require_once "Mail.php";  
  
            $from    = "cutmtnp@gmail.com";  
            $to      = $frgeml; 
            $subject = " $fnamea, your password was successfully reset";  
            $body    = "Hi  $fnamea, \n\n You've successfully changed your password. Your new password is $frgph .\n
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

            if (PEAR::isError($mail))
                {  
              echo("<p>" . $mail->getMessage() . "</p>");  
             } 
             else {  
               
                echo "<script>alert('Password has been sent to your mail.');</script>";
             }
        
        }
        
        
        
        else if($rres2)
        {
            $frgph = StFPas();
            mysqli_query($con,"update t_stud set s_pswd='".$frgph."' where s_email='".$frgeml."'");
            require_once "Mail.php";  
  
            $from    = "cutmtnp@gmail.com";  
            $to      = $frgeml; 
            $subject = "$fnames, your password was successfully reset";  
            $body    = "Hi  $fnames, \n\n You've successfully changed your password. Your new password is $frgph .\n
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
            
            if (PEAR::isError($mail))
                {  
              echo("<p>" . $mail->getMessage() . "</p>");  
             } 
             else {  
               
                echo "<script>alert('Password has been sent to your mail.');</script>";
             }
        }
        
         else {  
               
                echo "<script>alert('You are not a registered member. Please enter a registered Email-ID.');</script>";
             }
       
  } 



//forgot pswd    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
         <link rel="stylesheet" href="css/fields.css">   
         <link rel="stylesheet" href="css/divisions.css">
         <link rel="stylesheet" href="css/common.css">
         <link rel="stylesheet" href="css/tablescss.css">
       <!--  <link rel="stylesheet" type="text/css" href="tabcss/normalize.css" />
         <link rel="stylesheet" type="text/css" href="tabcss/demo.css" />-->
	<link rel="stylesheet" type="text/css" href="tabcss/tabs1.css" />
	<link rel="stylesheet" type="text/css" href="tabcss/tabstyles1.css" />
         <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
         <script src="bootstrap/jquery.min.js"></script>
         <script src="bootstrap/bootstrap.min.js"></script>
  	<script src="js/modernizr.custom.js"></script>
              
        <!--autocomplete-->
        <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
        <link href="css/autoc.css" rel="stylesheet" type="text/css" />
        
        
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
         <title> Welcome </title>
          
      
         
        
        
   <!--auto search-->       
        
      <script type="text/javascript"> 

$(function() {

$("#cregmail").autocomplete({
source: "global_search.php",
minLength: 2,
select: function(event, ui) {
var getUrl = ui.item.id;
if(getUrl != '#') {
    
    var kk = $("#cregmail").val();
    
    $.ajax({
        type : "GET",
        cache : false,
        url : "index.php",
        data : {
            srchk : kk
           
        },
             
          success : function(response) {
          //alert(response);
            $("#cregid").val(response);
           
        }
    });
    
    $.ajax({
        type : "GET",
        cache : false,
        url : "index.php",
        data : {
            srchk1 : kk
           
        },
             
          success : function(response) {
          //alert(response);
            $("#cregname").val(response);
           
        }
    });
    
}
},

html: true, 
//    cregemail cregid cregname

});

});
</script>


 <!-- table data search-->
      
       <script>
            
            $(document).ready(function()
{
	$('#searchtb').keyup(function()
	{
		searchTable($(this).val());
                
	});
        $('#searchtb1').keyup(function()
	{
		searchTable1($(this).val());
                
	});
});

function searchTable(inputVal)
{
	var table = $('#tblData');
	table.find('tr').each(function(index, row)
	{
		var allCells = $(row).find('td');
		if(allCells.length > 0)
		{
			var found = false;
			allCells.each(function(index, td)
			{
				var regExp = new RegExp(inputVal, 'i');
				if(regExp.test($(td).text()))
				{
					found = true;
					return false;
				}
			});
			if(found == true)$(row).show();
				else $(row).hide();
		}
	});
}


function searchTable1(inputVal)
{
	var table = $('#tblData1');
	table.find('tr').each(function(index, row)
	{
		var allCells = $(row).find('td');
		if(allCells.length > 0)
		{
			var found = false;
			allCells.each(function(index, td)
			{
				var regExp = new RegExp(inputVal, 'i');
				if(regExp.test($(td).text()))
				{
					found = true;
					return false;
				}
			});
			if(found == true)$(row).show();
				else $(row).hide();
		}
	});
}

            </script>
      
      
      
      <!--table data search over-->


      
      
      <style>
             
/**THE SAME CSS IS USED IN ALL 3 DEMOS**/

/**gallery margins**/
ul.gallery{
  margin-left: 3px; 
  margin-right:3px;
}


.zoom {  
  -webkit-transition: all 0.35s  ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out; 
  cursor: -webkit-zoom-in;  
  cursor: -moz-zoom-in;  
  cursor: zoom-in;
} 

.zoom:hover,
.zoom:active, 
.zoom:focus {  
  /**adjust scale to desired size
  add browser prefixes**/
  -ms-transform: scale(2.5);
  -moz-transform: scale(2.5);
  -webkit-transform: scale(2.5);
  -o-transform: scale(2.5);
  transform: scale(2.5);
  position:relative;  
  z-index:100;
}

/**To keep upscaled images visible on mobile, 
increase left & right margins**/
@media only screen and (max-width: 768px) {
  ul.gallery {
    margin-left: 15px; 
    margin-right: 15px;}
}
/**TIP: To provide touch screen users an easy escape, 
give your gallery's parent container a cursor: pointer.**/ 

.DivName {cursor: pointer}
         </style>
      
    </head>
    <body>
         
            
        <div id="index" >
            
            
            <div class="container">    
              
                <section>
				<div class="tabs tabs-style-circle" style="margin-top:50px;">
                                    <nav>
					<ul>
                                        	<li><a href="#section-circle-1" class="icon icon-home"><span>Training</span></a></li>
                                                <li><a href="#section-circle-2" class="icon icon-upload"><span>Placement</span></a></li>
						<li><a href="#section-circle-3" class="icon icon-gift"><span>Gallery</span></a></li>
						<li><a href="#section-circle-4" class="icon icon-box"><span>Login</span></a></li>
						<li><a href="#section-circle-5" class="icon icon-display"><span>Co-ordinator</span></a></li>
						
					</ul>
				     </nav>
                                    
                                    
                                    
				     <div class="content-wrap">
                                            <section id="section-circle-1">
                                                
                                    <!--        <div class="container-fluid">    
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                
                                                            <div class="searchdiv">    
                                                                 <input type="search" id="searchtb" name="searchtb" placeholder="What are you looking for?">		    	
                                                                <!-- <button>Search</button> -->
                                                          <!--   </div>
                                   
                                                      </div>
                                                   </div>
                                                 </div> -->
                                                          <br>
                                           <br>  <br>  
        
                                              <div class="hometable"> 
                                                     <?php
                                                       $chkt1= mysqli_query($con, "select * from t_tevent");
                                                        if(mysqli_num_rows($chkt1)==0)
                                                        {
                                                             echo "<center><font style='color:black;
                                                                 font-size: 16px;font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";

                                                        }
                                                     else
                                                     {
                                                        echo" <table id='tblData'>
                                                                <thead>
                                                                  <tr>
                                                                    <th>Title</th>
                                                                    <th>Date</th>
                                                                    <th>Venue</th>
                                                                    
                                                                  </tr>
                                                                </thead>
                                                            <tbody>";
                                                     
                                                  
                                                            $vtevt = mysqli_query($con, "select * from t_tevent");
                                                            while($tevt = mysqli_fetch_array($vtevt))
                                                            {

                                                               echo "<tr>
                                                               <td><a style='cursor:pointer; color:black; font-weight:normal;'
                                                                    data-toggle='modal' data-target='#ctrmodal'> 
                                                               <strong>" . $tevt[1] ."</strong></a></td>";
                                                               echo "<td>". $tevt[3] ."</td>";
                                                               echo "<td>" . $tevt[2] ."</td>";
                                                               
															   
							?>
															   
															   
															   
															   
															   
															   
															   			
				
         <!-- training row pop up -->  
            
           <div id="itrmodal<?php echo $tevt[0];?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                      <?php
                        
                        $trdet= mysqli_query($con, "select * from t_tevent where e_id= '$tevt[0]'");
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
                                  
                                 $cfile = mysqli_query($con, "select e_id from t_tfile where e_id='$tevt[0]'");
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
                      <input type="submit" name="ctrok" value="OK" style="color:black;margin-left: 100px;">  
                    
                    </div>
                      
                    
                  </div>

                </div>
              </div> 
            
            
           <!-- /training row pop up -->   
  
															   
															   
															   
															   
						<?php	   
							  }
                                                     }  
                                                  
                                                 echo "</tbody>
                                               </table>";
                                                     
                                                     
                                                     ?>
                                               </div>                                         
                                            </section>
                                            
                                         <section id="section-circle-2">
                                           <!--     <div class="container-fluid">    
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                
                                                            <div class="searchdiv">    
                                                                 <input type="search" id="searchtb1" name="searchtb1" placeholder="What are you looking for?">		    	
                                                                 
                                                             </div>
                                   
                                                      </div>
                                                   </div>
                                                 </div> --><br>
                                           <br>  <br>  
                                                    <div class="hometable"> 
                                                <?php
                                                       $chkp2= mysqli_query($con, "select * from t_pevent");
                                                        if(mysqli_num_rows($chkp2)==0)
                                                        {
                                                             echo "<center><font style='color:black; 
                                                                 font-size: 16px; font-style:Verdana'>
                                                                 No records to display.
                                                                    </font></center>";

                                                        }
                                                     else
                                                     { 
                                                        echo "<table id='tblData1'>
                                                         <thead>
                                                           <tr>
                                                             <th>Company's Name</th>
                                                             <th>Arriving On</th>
                                                             <th>Package</th>
                                                             <th>Uploaded On</th>
                                                           </tr>
                                                         </thead>
                                                         <tbody>";
                                                                                                    

                                                            
                                                            while($ppevt = mysqli_fetch_array($chkp2))
                                                            {

                                                               echo "<tr>
                                                               <td><a style='cursor:pointer; color:black; font-weight:normal;'
                                                                    data-toggle='modal' data-target='#cplmodal'>
                                                               <strong>" . $ppevt[1] ."</strong></a></td>";
                                                               echo "<td>". $ppevt[2] ."</td>";
                                                               echo "<td>" . $ppevt[3] ."</td>";
                                                               echo "<td>" . $ppevt[7] ."</td>";
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

                                            <section id="section-circle-3">
                                                <div class="container" style="margin-top:50px;" >
                                                    <div class="row" >
                                                   <?php 
                                                       $picfile_path ='Photos/';
                                                      $sql1 = mysqli_query($con,"SELECT * FROM t_gallary ");
                                                       if(isset($sql1) && count($sql1)){ 
                                                          foreach ($sql1 as $key => $row) {
                                                          $picsrc=$picfile_path.$row['folder_name'].'/'.$row['g_file_name'];
                                                          echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='margin-top:20px;
                                                              height:180px;'>";
                                                      ?>    


                                                  <?php       
                                                        };  
                                                        
                                                        
                                                          };       
                                                  ?>
                                                   </div>     
                                                </div>    
                                            </section>
                                            
                                            
                                          
               <!-- Login Section -->                             
                                         
                                            <section id="section-circle-4">
                                                
                                                <form action="index.php" method="post">
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
                                                                    
                                                                    
                                                                   <input type="text" name="sloginid" placeholder="Enter Email">
                                                                        
                                                                     
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
                                                                     
                                                                   <a style="cursor:pointer;color:black; font-size:16px; text-decoration: none" data-toggle="modal" data-target="#frgtpas">
                                                                         Forgot your password?
                                                                   </a>
                                                                     
                                                                 </div>
                                                             </div>
                                                         </div>

                                                 </center> 
                                            </form>
                                            </section>
                                         
<!--Co-ordinator registration section -->   

                                            <section id="section-circle-5">
                                                <form action="index.php" method="post">
                                                 <center>   
                                                    <div id="regcord" class="container-fluid">    
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:10px; font-size: xx-large ">
                                                                       Register
                                                                   </p>
                                                                </div>
                                                            </div>

                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="email" name="cregemail" id="cregmail" placeholder="Email ID">
                                                                </div>
                                                            </div>
                                                       
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" value="<?php echo $freg ?>" name="cregid" id="cregid" placeholder="Registration ID">
                                                                </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-sm-12">
                                                                   <input type="text" name="cregname" value="<?php echo $fname ?>" id="cregname" placeholder="Name">
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
                                                </form>
                                            </section>
                </div>
        </div> 
                    
         
                </section>
            </div>
            
        </div>
        
             
        
        
                                                
                                                
        
               
            <!-- Forgot pasword pop up -->
            
            <form action="index.php" method="post">
            <div id="frgtpas" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Forgot Password ?</h4>
                      <p> 
                        No problem. We'll email it to you!
                      </p> 
                    </div>
                    <div class="modal-body">
                      <input type="email" name="frgeml" placeholder="Enter Your Email Here" >
                      
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-default" name="frgsub" value="Send" >
                    </div>
                      
                    
                  </div>

                </div>
              </div>
    </form>
           <!-- Forgot pasword pop up  -->
                
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