
<?php

session_start();


error_reporting(0);

$getid= $_GET["id"];

include 'phpcode.php';
$con = GetConn();
if(!isset($con))
{
    die("Database Not Found");
}


?>
<div id="ctrpop" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                      <?php
                        $trdet= mysqli_query($con, "select * from t_tevent where e_title='$getid'");
                        while($tdet = mysqli_fetch_array($trdet))
                        {
                      ?>
                      
                        <!-- <p style="color: #999999 ;  text-align: center; font-family:Verdana; font-weight: bold;
                            margin-top:2px; font-size: x-large; color:#fff; ">
                            
                         </p>-->
                         <h4 class="modal-title"><?php echo $tdet[1];  ?></h4>
                     
                      
                    </div>
                    <div class="modal-body">
                      
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
                                        <?php echo $tdet[5];  } ?>
                                    </font>

                                </div>
                         </div>
                      
                    </div>
                    <div class="modal-footer">
                      <input type="submit" name="part" value="Participate">
                      <input type="submit" name="login" value="Register" >
                    </div>
                      
                    
                  </div>

                </div>
              </div>