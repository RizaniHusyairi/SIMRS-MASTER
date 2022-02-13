<?php
session_start();
include "asset/include/koneksi.php";
include "asset/include/fungsi.php";

if(isset($_GET['hal'])){
    if($_GET['hal']=="pasien"){
    delete('tb_biaya','id_pasien');
    delete('tb_pilihpoli','id_pasien');
    delete('tb_beliobat','id_pasien');
    delete('tb_pasien','id_pasien');
    }else if($_GET['hal']=="user"){
    delete('tb_user','id_user');
    }
}
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
                <li class="sidebar-item "> 
                    <a href="Adminpage.php" class="sidebar-link"> 
                        <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Data User </a> 
                </li>
                <li class="sidebar-item active"> <a href="#" class="sidebar-link"> 
                    <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Data pasien </a> </li>
                <li class="sidebar-item"> 
                    <a href="dataobat.php" class="sidebar-link"> <i class="fas fa-tablets"></i> Data Obat </a> 
                </li>
                <li class="sidebar-item"> <a href="datapasien.php" class="sidebar-link"> <i class="fas fa-person-booth"></i> Data Poli </a> </li>
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
                                        <li class="breadcrumb-item active" aria-current="page">Daftar Pasien</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                Daftar Pasien
                            </div>
                            <div class="card-body">
                                <div
                                    class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                    <div class="d-sm-flex justify-content-between">

                                <form class=" flex-grow-1" method="post">
                                            <input type="text" name="search" class="search" size="30"
                                                placeholder="Cari Nama atau nomor Pasien.." autocomplete="off">
                                            <button type="submit" name="cari"><i class="fa fa-search"
                                                    aria-hidden="true"></i>
                                            </button>
                                        </form>
                                </div>
                                    <br>
                                    <div class="datatable-container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>No. pasien</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Jenis kelamin</th>
                                                    <th>Tanggal Lahir</th>
                                                   
                                                    <th class="text-end">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                    
                                    $no = 1;
                                    $get;
                                    if(isset($_POST['cari'])){
                                        $get = cari($_POST['search'],'tb_pasien','Nama','id_pasien');
                                    }else{
                                        $get = read('tb_pasien');
                                    }
                                    foreach ($get as $key) {
                                                ?>
                                                <tr>
                                                    <td><?= $key['id_pasien']?></td>
                                                    <td><?= $key['Nama']?></td>
                                                    <td><?= $key['Alamat']?></td>
                                                    <td><?= $key['Jenis_kelamin']?></td>
                                                    <td><?= $key['Tgl_lahir_pasien']?></td>
                                                    <td class="text-end">
                                                        <span class="badge bg-warning btn_editpsn"><i
                                                                class="fas fa-user-edit text-white"></i></span>
                                                        <span class="badge bg-danger btnhps_psn"><i
                                                                class="fas fa-trash"></i></span>
                                                    </td>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
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
                <div class="modal fade" id="ubahpasien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Ubah data pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="mb-3" style="display:none">
                                        <label for="No_p" class="form-label">Nomor pasien</label>
                                        <input type="text" id="No_p" name="No_p" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama_P" class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" name ="Nama_p" id="Nama_P" placeholder="Masukkan nama pasien..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Alamat_p" class="form-label">Alamat Pasien</label>
                                        <input type="text" class="form-control" id="Alamat_p" name="Alamat_p" placeholder="Masukkan Alamat pasien..">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Jenis_p" id="JK1" value="L">
                                                <label class="form-check-label" for="JK1">Laki-Laki</label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input" type="radio" name="Jenis_p" id="JK2" value="P">
                                                <label class="form-check-label" for="JK2">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Tgl" class="form-label">Tanggal Lahir</label>
                                        <input type="date" style="width:220px;" class="form-control" name="Tgl_p" id="Tgl">
                                    </div>
                                    <div class="mb-3 d-flex flex-row-reverse" >
                                        <button type="Submit" name="ubahpsn" class="btn btn-primary ms-2" style="width:92px;">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                if(isset($_POST['ubahpsn'])){
                    $id = $_POST['No_p'];
                    $nama = $_POST['Nama_p'];
                    $alamat = $_POST['Alamat_p'];
                    $jenis = $_POST['Jenis_p'];
                    $tgl = $_POST['Tgl_p'];
                    $tgl = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $tgl);
                    update("UPDATE tb_pasien SET Nama = '$nama', Alamat = '$alamat', Jenis_kelamin = '$jenis', Tgl_lahir_pasien = '$tgl' WHERE id_pasien = '$id'");
                }
                ?>
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
</body>

</html>