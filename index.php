<?php
    include "koneksi.php";

    $sql = mysqli_query($konek, "SELECT * FROM tb_control");
    $data = mysqli_fetch_array($sql);
    //ambil status relay
    $relay = $data['relay'];
    //ambil posisi servo
    $servo = $data['servo'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Control Esp</title>
  </head>
  <body>
    <h1 class="text-center">Control Relay dan Servo</h1>

    <div class="container d-flex justify-content-center">
        <div class="row" >
            <div class="col-md-6">
                <div class="card text-black mb-3" style="max-width: 20rem;">
                    <div class="card-header text-center" style="font-size: 30px; background:red; color: white">Relay</div>
                        <div class="card-body">
                            <div class="form-check form-switch" style="font-size:40px;">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus(this.checked)" <?php if($relay==1) echo "checked";?> >
                                <label class="form-check-label" for="flexSwitchCheckDefault"><span id="status"><?php if($relay==1) echo "ON"; else echo "OFF";?></span></label>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-black mb-3" style="max-width: 20rem;">
                    <div class="card-header text-center" style="font-size: 30px; background:blue; color: white">Servo</div>
                        <div class="card-body text-center">
                            <label for="customRange1" class="form-label">Posisi Servo <span id="posisi"><?= $servo ?></span> derajat</label>
                            <input type="range" class="form-range" id="customRange1" min="0" max="80" step="5" value="<?= $servo ?>" onchange="ubahposisi(this.value)">
                        </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function ubahstatus(value) {
            if(value == true) value = "ON";
            else value = "OFF";
            document.getElementById('status').innerHTML = value;
            //AJAK untuk merubah status relay
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    document.getElementById('status').innerHTML = value;
                    responseText;
                }
            }
            xmlhttp.open("GET", "relay.php?stat=" + value, true);
            xmlhttp.send();
        }
        
        function ubahposisi(value) {
            document.getElementById('posisi').innerHTML = value;
            //AJAK untuk merubah nilai posisi servo
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    document.getElementById('posisi').innerHTML = value;
                    responseText;
                }
            }
            xmlhttp.open("GET", "servo.php?pos=" + value, true);
            xmlhttp.send();
        }

    </script>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>