<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Participation Form</title>
        
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
         <script src="bootstrap/jquery.min.js"></script>
         <script src="bootstrap/bootstrap.min.js"></script>
         
         <link rel="stylesheet" href="css/fields.css">
    </head>
     <body style="background-image:url(images/bglogin1.png)">
        <form id="fsregf" action="regparticipate.php" method="post">
            <center>   
                <div id="dreg" class="container-fluid">    
                      <div class="row">
                            <div class="col-sm-12">
                                <p style="color: #999999 ;font-family:Verdana; font-weight: bold;margin-top:60px; font-size: xx-large ">
                                   Register Form
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
                               <input type="text" name="sregname" placeholder="Name">
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-sm-12">
                               <input type="text" name="sregid" placeholder="Registration ID">
                            </div>
                        </div>
                    
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="sregdept" placeholder="Department">
                        </div>                      
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <select id="sregevent" name="sregevent">
                                <option value="">Select Event Title </option>
                                <option value=""> </option>
                                <option value=""> </option>
                                <option value=""> </option>
                                <option value=""> </option>   
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="sregdate" placeholder="Date">
                        </div>                      
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="sregvenue" placeholder="Venue">
                        </div>                      
                    </div>
                        
                    <div class="row">
                        <div class="col-sm-12">
                            <select id="sregact" name="sregact">
                                <option value="">Select Activity </option>
                                <option value=""> </option>
                                <option value=""> </option>
                                <option value=""> </option>
                                <option value=""> </option>
                            </select>
                        </div>                      
                    </div>
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" name="sregfsub" value="Register" style="margin-left: 150px">
                            </div>
                        </div>
                       
                     </div>
               </center>
        </form> 
    </body>
</html>