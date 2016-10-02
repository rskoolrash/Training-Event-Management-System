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
        
        
        	
         <title> Welcome </title>
          
      <script>
         
          $(document).ready(function(){
              $("#abc").click(function(){
                  $("#training").show();
                  
                  
              });
              
          });
         </script>
         
        
         <style>
             
             
             
        a {
	padding: 0 1.5em;
	color: black;
	font-weight: 700;
	-webkit-transition: color 0.3s;
	transition: color 0.3s;
        }

.a:hover,
.a:focus {
	color: #fff;
}

.li.tab-current a {
	color: #005f5f;
        box-shadow: -3px 3px 15px gray; transition: color 0.3s cubic-bezier(0.7,0,0.3,1);
}

 a::after {
	position: absolute;
	top: 0;
	left: 0;
	z-index: -1;
	width: 100%;
	height: 100%;
	background: gray;
	content: '';
	-webkit-transition: background-color 0.3s, -webkit-transform 0.3s;
	transition: background-color 0.3s, transform 0.3s;
	-webkit-transition-timing-function: ease, cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: ease, cubic-bezier(0.7,0,0.3,1);
	-webkit-transform: translate3d(0,100%,0) translate3d(0,-3px,0);
	transform: translate3d(0,100%,0) translate3d(0,-3px,0);
}

.tabs-style-linebox nav li.tab-current a::after {
	-webkit-transform: translate3d(0,0,0);
	transform: translate3d(0,0,0);
}

 a:hover::after,
 a:focus::after,
 a::after {
    background: transparent;
}
             
             
         </style>
        
      
         
    </head>
    <body>
         
            
        <form id="index" action="deleteme.php" method="post">
          <?php
               /*   if ($handle = opendir('.')) {
                  while (false !== ($file = readdir($handle)))
                     {
                         if ($file != "." && $file != "..")
                         {
                               $thelist = '<a href="'.$file.'">'.$file.'</a>';
                               echo "<br>" .$thelist  ;
                         }
                      }
                 closedir($handle);
                 } */
            ?>
            <?php
                
              if ($handle = opendir('./Photos/')) 
                {
                   while (false !== ($file = readdir($handle)))
                      {
                          if ($file != "." && $file != "..")
                          { 
                              $thelist = '<a id="abc" style="cursor:pointer">'.$file.'</a>';
                              // $thelist = '<a href="./Photos/'.$file.'">'.$file.'</a>';
                                 echo '<br>'.$thelist .'<br>' ;
                                 
                          }
                       }
                       
                        
                  closedir($handle);
                  } 
            
            
           
              /* $picfile_path ='Photos/';
               $sql1 = mysqli_query($con,"SELECT * FROM t_gallary where folder_name ='abc' ");
              //$sql1 = mysqli_query($con,"SELECT * FROM t_gallary ");
                if(isset($sql1) && count($sql1)) 
                    {  
                         foreach ($sql1 as $key => $row)
                             { 
                                $picsrc=$picfile_path.$row['folder_name'].'/'.$row['g_file_name'];
                                echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='height:180px;'>"; 
                             }; 
                     };*/
              ?>  

                <div id="training" class="container-fluid" hidden style="color: black ;font-family:Verdana;">    
                    <div class="row">
                       <div class="col-sm-12">
                           <?php
                            $picfile_path ='Photos/';
                             $sql1 = mysqli_query($con,"SELECT * FROM t_gallary where folder_name ='abc' ");
                            //$sql1 = mysqli_query($con,"SELECT * FROM t_gallary ");
                              if(isset($sql1) && count($sql1)) 
                                  {  
                                       foreach ($sql1 as $key => $row)
                                           { 
                                              $picsrc=$picfile_path.$row['folder_name'].'/'.$row['g_file_name'];
                                              echo "<img src='$picsrc.' class='img-thumbnail' width='180px' style='height:180px;'>"; 
                                           }; 
                                   };
                     ?>
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