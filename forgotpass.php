<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<!--
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
         <link rel="stylesheet" href="css/common.css">
         <link rel="stylesheet" href="css/divisions.css">
          <link rel="stylesheet" href="css/fields.css">
          
          <script>
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
        <div id="fgps" class='forgotps' >
            <div id="popupContact" >
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
             </div>
          </div>
        <button id="popup" onclick="div_show();">Popup</button>
    </body>
</html>
-->

<HTML>
	<HEAD>
		<TITLE>Popup div with disabled background</TITLE>
		<style>
			.ontop {
				z-index: 999;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
				position: absolute;				
				background-color: #cccccc;
				color: #aaaaaa;
				opacity: .4;
				filter: alpha(opacity = 50);
			}
			#popup {
				width: 300px;
				height: 200px;
				position: absolute;
				color: #000000;
				background-color: #ffffff;
				/* To align popup window at the center of screen*/
				top: 50%;
				left: 50%;
				margin-top: -100px;
				margin-left: -150px;
			}
		</style>
		<script type="text/javascript">
			function pop(div) {
				document.getElementById(div).style.display = 'block';
			}
			function hide(div) {
				document.getElementById(div).style.display = 'none';
			}
			//To detect escape button
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					hide('popDiv');
				}
			};
		</script>
	</HEAD>
	<BODY>
		<div id="popDiv" class="ontop">
			<table border="1" id="popup">
				<tr>
					<td>
						This is can be used as a popup window
					</td>
				</tr>
				<tr>
					<td>
						Click Close OR escape button to close it
						<a href="#" onClick="hide('popDiv')">Close</a>
					</td>
				</tr>
			</table>
		</div>
		<CENTER>
			<h3>
				Simple popup div with disabled background
			</h3>
			<br/>
			<a href="#" onClick="pop('popDiv')">Click here to open a popup div</a>
		</CENTER>
	</BODY>
</HTML>
