<?php

include "koneksi.php";

$stat = $_GET['stat'];
if($stat == "ON")
{
    mysqli_query($konek, "UPDATE tb_control SET relay=1");
    
    echo "ON";
}
else {
    mysqli_query($konek, "UPDATE tb_control SET relay=0");
    
    echo "ON";
}

//