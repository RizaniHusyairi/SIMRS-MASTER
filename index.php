<?php 
session_start();

include "asset/include/koneksi.php";

$gagal = "";
$sukses = "";
if(isset($_POST['SUBMIT'])){
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $Q = mysqli_query($conn,"select * from tb_user WHERE Username='$user'") 
        or die ("ERROR DATABASE");
  $pro=mysqli_fetch_row($Q);
  if($pro == ""){
    $sukses = "";
    $gagal = "Username atau password yang anda masukkan salah";
  }else{
      $verify = password_verify($pass,$pro[2]);
      if($verify){
          $gagal="";
          $sukses = "BERHASIL";
          $_SESSION['Name'] = $pro[4];
          $_SESSION['level'] = $pro[3];
          header("Location: Adminpage.php");
      }else{
        $sukses = "";
        $gagal = "Username atau password yang anda masukkan salah";
      }

  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />

    <!-- my css -->
    <link rel="icon" type="image/png" href="asset/img/logo-hospital.png">
    <link rel="stylesheet" href="asset/css/styles.css">
    <title>SIMRS</title>
</head>

<body>
    <div class="text-center text-uppercase text-white" style="background: #6ebdde">
        <h1 class="title-rs">
            Sistem Informasi Manajemen Rumah Sakit
        </h1>
    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="asset/img/logo-hospital.png" alt="Hospital" class="img-fluid" />
        </div>
        <div class="col-md-6 text-center" style="align-self: center;">
            <form method="post">
                <h1> <b>LOGIN</b></h1>
                <p class="gagal m-auto alert-danger"><?php echo $gagal ?></p>
                <p class="sukses m-auto alert-success"><?php echo $sukses ?></p>
                <div class="input-group setinput">
                    <span class="input-group-text Log" id="inputGroup-sizing-default"><i
                            class="fas fa-user text-white"></i></span>
                    <input type="text" class="form-control" name="username" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Masukkan Username" autocomplete="off" Required>
                </div>
                <div class="input-group setinput">
                    <span class="input-group-text Log" id="inputGroup-sizing-default"><i
                            class="fas fa-key text-white"></i></span>
                    <input type="Password" name="password" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Masukkan Password" Required>
                </div>
                <button type="Submit" name="SUBMIT" class="btn btn-info"
                    style="width: 85px; color: #fff; font-weight: bold;">Login</button>
            </form>
        </div>

    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/424a4485fc.js" crossorigin="anonymous"></script>
</body>

</html>