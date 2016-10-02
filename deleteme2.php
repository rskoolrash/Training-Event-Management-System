<?php

session_start();
error_reporting(0);
//$getid= $_REQUEST["id"];


$con = mysqli_connect("localhost", "root", "","tpevent");

if(!isset($con))
{
    die("Database Not Found");
}
    

$gevtid=mysqli_query($con,"select e_id from t_tevent where e_title='Group Discussion'");
$gevtid2=  mysqli_fetch_assoc($gevtid);
$showeid= $gevtid2["e_id"];


 if(isset($_REQUEST["stpart"]))
       {

 //$sqlse = "insert into tr_event (s_email,e_id) values ('" .$_SESSION['ad']. "','" .$showeid. "')";
$sqlse = "insert into tr_event (s_email,e_id) values ('".$_SESSION['ad']."','".$showeid."')";
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
              
		
         <title>Test </title>
    
    </head>
    <form action="deleteme2.php" method="post">
        
        
        <div class="hometable"> 
            <?php
               $schkt1= mysqli_query($con, "select * from t_tevent");

               if(mysqli_num_rows($schkt1)==0)
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

              while($stevt = mysqli_fetch_array($schkt1))
                    {


                       echo "<tr>";

                        echo "<td> <a style='cursor:pointer; text-decoration: none;' 
                            data-toggle='modal' data-target='#thisdiv'> <strong>" . $stevt[1] ."</strong></a></td>";
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
                                                
         <a style="cursor:pointer; text-decoration: none;" data-toggle="modal" data-target="#thisdiv">
         Click here
         </a>
                                   
        
                            
                            
                            
                               
            <div id="thisdiv" class="modal fade" role="dialog">
                <div class="modal-dialog">
                 
                  <!-- Modal content-->
                  <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                        $trdet= mysqli_query($con, "select * from t_tevent where e_id= 'EVT0005'");
                                        while($tdet = mysqli_fetch_array($trdet))              
                                         {
                                     ?>
                                </div>
                            </div>
                            <h4 class="modal-title"><?php echo $tdet[1];  ?></h4>
                             
                        </div>
                      
                        <div class="modal-body">
                         
                            <div class="row">
                                <div class="col-sm-6">
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                        <strong>Venue:  </strong> 
                                    </font>
                         
                                    <font style="  font-family:Verdana; font-weight: normal;">
                                            <?php echo $tdet[2];?>
                                    </font>
                                </div>
                
                                <div class="col-sm-6">     
                                    <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                        <strong>Date:  </strong> 
                                    </font>
                         
                                    <font style=" font-family:Verdana; font-weight: normal;">
                                            <?php echo $tdet[3];?>
                                    </font>
                      
                              </div>
                            </div>

                             <div class="row" style="margin-top:14px;">
                                   <div class="col-sm-12">
                                       <font style="color: #999999 ;  font-family:Verdana; font-weight: bold;">
                                           <strong>Details:  </strong>
                                       </font>

                                       <p style="color: black;font-family:Verdana; font-weight: normal;margin-top:4px;margin-left:14px;">
                                               <?php echo $tdet[4];?>
                                       </p>
                                   </div>
                            </div>


                            <div class="row">
                               <div class="col-sm-12">
                                   <font style="color: #999999 ;  font-family:Verdana; font-weight: bold">
                                       <strong>Uploaded By </strong>
                                   </font>

                                   <font style="  font-family:Verdana; font-weight: normal;">
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

                                   <font style="font-family:Verdana; font-weight: normal;">
                                       <?php echo $tdet[5];  
                                           } 
                                       ?>
                                   </font>
                               </div>
                           </div>
                            
                        </div>
                      
                        <div class="modal-footer">
                          
                              <input type="submit" name="stpart" value="Participate" style="margin-left: 100px;">   
                              
                        </div>
                   </div>

                </div>
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
