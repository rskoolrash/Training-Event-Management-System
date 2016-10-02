
<?php

extract($_POST);

if (!isset($_SESSION[ad]))
{
    header("Location:index.php");
        exit();
}

?>