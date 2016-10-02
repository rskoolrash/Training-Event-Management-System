<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect("localhost","root","","tpevent");
    
    $query=mysqli_query($con,"select f_name from t_faculty where f_name LIKE '%{$key}%' OR f_email LIKE '%{$key}%'
                              OR f_reg LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['f_name'];

      
    }
    echo json_encode($array);
?>
