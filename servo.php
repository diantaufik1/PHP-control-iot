<?php

include "koneksi.php";

$pos = $_GET['pos'];

mysqli_query($konek, "UPDATE tb_control SET servo='$pos'");
    
echo $pos;