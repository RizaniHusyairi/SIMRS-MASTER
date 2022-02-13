<?php
    session_start();
    include "asset/include/koneksi.php";
    include "asset/include/fungsi.php";

    $hitung = no_pasien()+1;
    $nom = "P00".$hitung;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">


    <!-- my css -->
    <link rel="icon" type="image/png" href="asset/img/logo-hospital.png">
    <link rel="stylesheet" href="asset/css/styleadmin.css">

    <title>Sistem informasi</title>
</head>

<body>
    <div class="menu-bar">
        <input type="checkbox"/>
        <div class="menu-btn_burger"></div>
        <div class="menu-btn_burger"></div>
        <div class="menu-btn_burger"></div>
    </div>
    <div class="sidebar container-fluid bg-white text-info ">
        <div class="sidebar-header text-center">
            <h3><?= $_SESSION['Name']?></h3>
            <small>level: <?= $_SESSION['level']?></small>
            <hr>
        </div>
        <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item active"> <a href="pendaftaran.php" class="sidebar-link"> <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Pendaftaran</a> </li>
                        <li class="sidebar-item "> <a href="Adminpage.php" class="sidebar-link"> <i
                                    class="fa fa-address-card pr-2" aria-hidden="true"></i> Daftar Pasien </a> </li>
                    </ul>
                    <ul class="menu" style="margin-top: 150px;">
                        <li class="sidebar-item  bg-danger"> <a href="logout.php" class="sidebar-link outlog"> <i
                                    class="fas fa-sign-out-alt"></i> Log-out </a> </li>
                    </ul>
                </div>
            </div>

            <div class="main">
                <div class="page-heading">
                    <div class="page-title">
                        
                        <div class="row">
                            <div class="col-12 col-md-7 order-md-1 order-last">
                                <h4>Sistem Informasi Manajemen Rumah Sakit</h4>
                            </div>
                            <div class="col-12 col-md-5 order-md-2 respon">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                Pendaftaran
                            </div>
                            <div class="card-body">


                                <form method="post">
                                    <div class="mb-3">
                                        <label for="No_p" class="form-label">Nomor pasien</label>
                                        <input type="text" id="No_p" class="form-control" value="<?= $nom ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama_P" class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" name ="Nama_p" id="Nama_P" placeholder="Masukkan nama pasien.." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Alamat_p" class="form-label">Alamat Pasien</label>
                                        <input type="text" class="form-control" id="Alamat_p" name="Alamat_p" placeholder="Masukkan Alamat pasien.." required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Jenis_p" id="exampleRadios1" value="L" required>
                                                <label class="form-check-label" for="exampleRadios1">Laki-Laki</label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input" type="radio" name="Jenis_p" id="exampleRadios2" value="P" required>
                                                <label class="form-check-label" for="exampleRadios2">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                                        <input type="date" style="width:220px;" class="form-control" name="Tgl_p"id="exampleFormControlInput1">
                                    </div>
                                    <div class="mb-3 d-flex flex-row-reverse" >
                                        <button type="Submit" name="daftar" class="btn btn-primary ms-2" style="width:92px;">Daftar</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </form>

                                <?php 
                                if(isset($_POST['daftar'])){
                                    $nama = $_POST['Nama_p'];
                                    $alamat = $_POST['Alamat_p'];
                                    $jenis = $_POST['Jenis_p'];
                                    $tgl = $_POST['Tgl_p'];
                                    $tgl = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $tgl);
                                    create("tb_pasien","NULL,'$nom','$nama','$alamat','$jenis','$tgl'");
                                    create("tb_pilihpoli(id_pasien)","'$nom'");
                                    create("tb_biaya(id_pasien,Status)","'$nom','Belum Lunas'");
                                    create("tb_beliobat(id_pasien)","'$nom'");
                                    echo "<script>Swal.fire('Terdaftar!','Data berhasil Ditambah','success').then((o)=>{
                                        window.location.href = 'Adminpage.php';
                                    });
                                    </script>";
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                    <footer>
                            <div class="footer clearfix mb-0 text-muted">
                                <div class="float-start">
                                    <p>2021 &copy; Rizani Husyairi</p>
                                </div>

                            </div>
                        </footer>
                    </div>
                </div>
                <!-- Option 2: Separate Popper and Bootstrap JS -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                    crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
                    integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
                    crossorigin="anonymous"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                <script src="asset/js/script.js"></script>
                <script>
                function alertS(){ 
                    Swal.fire('Terdaftar!','Data berhasil Ditambah','success').then((o)=>{
                        window.location.href = 'Adminpage.php';
                    });
                }
                </script>
                
</body>

</html>
