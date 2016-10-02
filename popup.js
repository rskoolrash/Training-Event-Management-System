// Validating Empty Field for forgot pswd
function check_empty() {
if 
(document.getElementById('frgeml').value == "") {
alert("Please enter your email ID !");
} else {
document.getElementById('form').submit();
alert("Please check your mail");
}
}
//Function To Display Popup  for forgot pswd
function div_show() {
document.getElementById('fgps').style.display = "block";
}
//Function to Hide Popup  for forgot pswd
function div_hide(){
document.getElementById('fgps').style.display = "none";
}
