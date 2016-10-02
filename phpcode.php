<?php

            //-------INDEX PAGE REGISTER COORDINATOR SECTION--------

$crml = $_REQUEST["cregemail"];

$crid  = $_REQUEST["cregid"];
$crhid = $_REQUEST["crhid"];
$crphid = $_REQUEST["crphid"];


           //-------INDEX PAGE REGISTER PARTICIPANT SECTION--------

$srml = $_REQUEST["sregemail"];
$srid  = $_REQUEST["sregid"];
$srnm = $_REQUEST["sregname"];
$pshid = $_REQUEST["pshid"];


        //-------ADMIN CHANGE PASSWORD SECTION--------
$adold = $_REQUEST["adoldpas"];
$adnew  = $_REQUEST["adnewpas"];
$adcon = $_REQUEST["adconnpas"];

            //-------COORDINATOR CHANGE PASSWORD SECTION--------
$crold = $_REQUEST["coldpass"];
$crnew  = $_REQUEST["cnewpass"];
$crcon = $_REQUEST["cconpas"];
   
    //-------STUDENT CHANGE PASSWORD SECTION--------
$stold = $_REQUEST["s_oldpass"];
$stnew  = $_REQUEST["s_newpass"];
$stcon = $_REQUEST["s_connpass"];

        //------- TRAINING EVENT UPLOAD SECTION--------

$etitle = $_REQUEST["evttitle"];
$edate  = $_REQUEST["evtdate"];
$evenue = $_REQUEST["evtvenue"];
$edesc = $_REQUEST["evtdesc"];
$evthid = $_REQUEST["evthid"];
$fevthid = $_REQUEST["fevthid"];



                //------- PLACEMENT EVENT UPLOAD SECTION--------

$epname = $_REQUEST["evttitle1"];
$epdate  = $_REQUEST["evtdate1"];
$epack = $_REQUEST["evtpack"];
$epdoc = $_REQUEST["evtdoc"];
$evpabt = $_REQUEST["evtabt1"];
$evpcri = $_REQUEST["evtdesc1"];
$evphid = $_REQUEST["evphid"];
$fevphid = $_REQUEST["fevphid"];


                //------- FORTGOT PASSWORD SECTION--------

$frgeml = $_REQUEST["frgeml"];
$frgph = $_REQUEST["frgpashid"];

                   //------- COORDINATOR GALLERY UPLOAD--------

//$glfolder = $_REQUEST["glfolder"];
$galhid = $_REQUEST["galhid"];

?>

   


<?php
             //-------GET CONNECTION FUNCTION--------

function GetConn()
{
     $con = mysqli_connect("localhost","root","","tpevent");
     return $con;
}

            //-------GENERATE COORDINATOR ID--------

function CrCode()
{
     $con = GetConn();
     $crc = mysqli_query($con,"select CONCAT('CRD',LPAD(RIGHT(ifnull(max(f_id),'CRD0000'),4) + 1,4,'0')) from t_reg_coord");
     return mysqli_fetch_array($crc)[0];
}
            //-------GENERATE COORDINATOR PASSWORD--------

function CrPas()
{
      $alphabet = "!@#$&*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $pass = array();
      $alphaLength = strlen($alphabet) - 1;
      for($i=0;$i<8;$i++)
      {
          $n=rand(0,$alphaLength);
          $pass[]=$alphabet[$n];
      }
      return implode($pass);
}



                //-------GENERATE STUDENT PASSWORD--------

function StPas()
{
      $alphabet = "!@#$&*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $pass = array();
      $alphaLength = strlen($alphabet) - 1;
      for($i=0;$i<8;$i++)
      {
          $n=rand(0,$alphaLength);
          $pass[]=$alphabet[$n];
      }
      return implode($pass);
}   

                        //-------GENERATE TRAINING EVENT ID--------

function EvCode()
{
     $con = GetConn();
     $crc = mysqli_query($con,"select CONCAT('EVT',LPAD(RIGHT(ifnull(max(e_id),'EVT0000'),4) + 1,4,'0')) from t_tevent");
     return mysqli_fetch_array($crc)[0];
}

                    //-------GENERATE PLACEMENT EVENT ID--------

function EvPCode()
{
     $con = GetConn();
     $crc1 = mysqli_query($con,"select CONCAT('EVP',LPAD(RIGHT(ifnull(max(p_cid),'EVP0000'),4) + 1,4,'0')) from t_pevent");
     return mysqli_fetch_array($crc1)[0];
}

                  //-------GENERATE Gallery ID--------

function GalCode()
{
     $con = GetConn();
     $gal1 = mysqli_query($con,"select CONCAT('GAL',LPAD(RIGHT(ifnull(max(g_id),'GAL0000'),4) + 1,4,'0')) from t_gallary");
     return mysqli_fetch_array($gal1)[0];
}

                //-------GENERATE Gallery ID--------

function TfileCode()
{
     $con = GetConn();
     $tfile1 = mysqli_query($con,"select CONCAT('TFL',LPAD(RIGHT(ifnull(max(tf_id),'TFL0000'),4) + 1,4,'0')) from t_tfile");
     return mysqli_fetch_array($tfile1)[0];
}


                //-------GENERATE Gallery ID--------

function PfileCode()
{
     $con = GetConn();
     $pfile1 = mysqli_query($con,"select CONCAT('PFL',LPAD(RIGHT(ifnull(max(pf_id),'PFL0000'),4) + 1,4,'0')) from t_pfile");
     return mysqli_fetch_array($pfile1)[0];
}

//-------GENERATE FORGOT PASSWORD--------

function StFPas()
{
      $alphabet = "!@#$&*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $pass = array();
      $alphaLength = strlen($alphabet) - 1;
      for($i=0;$i<8;$i++)
      {
          $n=rand(0,$alphaLength);
          $pass[]=$alphabet[$n];
      }
      return implode($pass);
}   
?>


