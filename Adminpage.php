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


        <?php 
        
      if($_SESSION['level'] == ""){
        header("location:logout.php");
      }
      if($_SESSION['level']=="Super Admin"){
      
        ?>
        <!-- MENU SUPER ADMIN -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item active"> 
                    <a href="" class="sidebar-link"> 
                        <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Data User </a> 
                </li>
                <li class="sidebar-item"> <a href="datapasien.php" class="sidebar-link"> 
                    <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Data pasien </a> </li>
                <li class="sidebar-item"> 
                    <a href="dataobat.php" class="sidebar-link"> <i class="fas fa-tablets"></i>Data Obat </a> 
                </li>
                <li class="sidebar-item"> <a href="jenispoli.php" class="sidebar-link">  <i class="fas fa-person-booth"></i> Data Poli </a> </li>
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
                                <li class="breadcrumb-item active" aria-current="page">data User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">Data User</div>
                    <div class="card-body">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="d-sm-flex justify-content-between">

                            <form class=" flex-grow-1" method="post">
                                        <input type="text" name="search" class="search" size="30"
                                            placeholder="Cari User.." autocomplete="off">
                                        <button type="submit" name="cari"><i class="fa fa-search"
                                                aria-hidden="true"></i>
                                        </button>
                                    </form>
                                <span class="badge bg-info btnadd_user mt-1">
                                    <i class="fas fa-user-plus"></i> Tambah User</span>
                            </div>
                            <div class="datatable-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th data-sortable="">No</a></th>
                                            <th data-sortable="">Nama</a></th>
                                            <th data-sortable="">Username</th>
                                            <!-- <th data-sortable="">Password</th> -->
                                            <th data-sortable="">Level</th>
                                            <th data-sortable="" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if(isset($_POST['cari'])){
                                            $q = cari($_POST['search'],'tb_user','Nama','id');
                                            
                                        }else{
                                            
                                            $q = mysqli_query($conn,"SELECT * from tb_user");
                                        }
                                        $no=1;
                                        foreach ($q as $key) {
                                            if($key['Status']=="Super Admin"){
                                                continue;
                                            }
                                        ?>

                                
                                        <tr>
                                            <td style="display:none"><?= $key['id_user']?></td>
                                            <td><?= $no++?></td>
                                            <td><?= $key['Nama']?></td>
                                            <td><?= $key['Username']?></td>
                                            <td><?= $key['Status']?></td>
                                            
                                            <td class="text-end">
                                                <span class="badge bg-warning btnedit_user"><i
                                                        class="fas fa-user-edit text-white"></i></span>
                                                <span class="badge bg-danger btnhps_user"><i class="fas fa-trash"></i></span>
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
            <!-- AKHIR MENU SUPER ADMIN -->
            <?php
          }elseif ($_SESSION['level']=="Admin Poliklinik") {
            
          
          ?>
            <!-- MENU ADMIN Poliklinik -->
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item active">
                        <a href="#" class="sidebar-link">
                            <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Daftar Pasien</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="jenispoli.php" class="sidebar-link"><i class="fas fa-person-booth"></i>Jenis Poli</a>
                    </li>

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
                        <div class="col-12 col-md-5 order-md-2  respon">
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
                                <div class="datatable-container">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>No. Pasien</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Poli</th>
                                                <th class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query = "SELECT tb_pasien.*, tb_poli.*,tb_obat.nama_obat,tb_biaya.biaya_pemeriksaan,tb_biaya.Status,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis 
                                                      FROM tb_pilihpoli 
                                                      inner join tb_pasien on tb_pasien.id_pasien = tb_pilihpoli.id_pasien 
                                                      LEFT join tb_poli on tb_poli.id_poli = tb_pilihpoli.id_poli
                                                      LEFT join tb_beliobat on tb_beliobat.id_pasien = tb_pasien.id_pasien
                                                      LEFT join tb_obat on tb_beliobat.id_obat = tb_obat.id_obat
                                                      LEFT join tb_biaya on tb_pasien.id_pasien = tb_biaya.id_pasien;";
                                            if(isset($_POST['cari'])){
                                                $cari = $_POST['search'];
                                                $query = "SELECT tb_pasien.*, tb_poli.*,tb_obat.nama_obat,tb_biaya.biaya_pemeriksaan,tb_biaya.Status,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis 
                                                      FROM tb_pilihpoli 
                                                      inner join tb_pasien on tb_pasien.id_pasien = tb_pilihpoli.id_pasien 
                                                      LEFT join tb_poli on tb_poli.id_poli = tb_pilihpoli.id_poli
                                                      LEFT join tb_beliobat on tb_beliobat.id_pasien = tb_pasien.id_pasien
                                                      LEFT join tb_obat on tb_beliobat.id_obat = tb_obat.id_obat
                                                      LEFT join tb_biaya on tb_pasien.id_pasien = tb_biaya.id_pasien
                                                      WHERE tb_pasien.Nama LIKE '%$cari%' or tb_pasien.id_pasien LIKE '%$cari%';"; 

                                            }
                                            $result = mysqli_query($conn,$query);
                                            foreach ($result as $key) {
                                                
                                            ?>
                                            <tr>
                                                <td style="display: none; "><?= $key['Alamat'] ?></td>
                                                <td style="display: none; "><?= $key['Tgl_lahir_pasien'] ?></td>
                                                <td style="display: none; "><?= $key['Keluhan'] ?></td>
                                                <td style="display: none; "><?= $key['Catatan_medis'] ?></td>
                                                <td style="display: none; "><?= $key['biaya_pemeriksaan'] ?></td>
                                                <td style="display: none; "><?= $key['id_poli'] ?></td>
                                                <td><?= $key['id_pasien'] ?></td>
                                                <td><?= $key['Nama'] ?></td>
                                                <td><?= $key['Jenis_kelamin'] ?></td>
                                                <td><?php if($key['nama_poli'] == NULL){
                                                            echo "-";
                                                          }else{
                                                            echo $key['nama_poli'];  
                                                          } ?></td>
                                                <td style="display: none; "><?= $key['nama_obat'] ?></td>
                                                <td class="text-end">
                                                <div class="d-md-inline-flex flex-row">
                                                    <?php 
                                                    if($key['id_poli'] == NULL){

                
                                                    ?>
                                                    <span class="badge bg-warning btn_addpoli mb-1"><i
                                                            class="fas fa-user-edit text-white"></i> input poli</span>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <span class="badge bg-primary btn_editpoli mb-1"><i
                                                            class="fas fa-user-edit text-white"></i> ubah poli</span>
                                                    <?php 
                                                    }
                                                    ?>
                                                    
                                                    <span class="badge bg-secondary btn_detailpsn mb-1 ms-1">
                                                     Detail Pasien</span>
                                                    </div>
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
                <!-- AKHIR MENU ADMIN POLIKLINIK-->
            <?php
          }elseif ($_SESSION['level']=="Admin Apotik") {
          ?>
            <!-- MENU ADMIN APOTIK -->
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item active">
                        <a href="#" class="sidebar-link">
                            <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Daftar Pasien</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dataobat.php" class="sidebar-link"><i class="fas fa-tablets"></i>Data Obat</a>
                    </li>

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
                        <div class="col-12 col-md-5 order-md-2  respon">
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
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="d-sm-flex justify-content-between">
                                <form class="flex-grow-1" method="post">
                                    <input type="text" name="search" class="search" size="30"
                                        placeholder="Cari Nama atau nomor Pasien.." autocomplete="off">
                                    <button type="submit" name="cari"><i class="fa fa-search"
                                            aria-hidden="true"></i>
                                    </button>
                                </form>
                                </div>
                                <div class="datatable-container">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Nomor pasien</th>
                                                <th>Nama</th>
                                                <th>jenis kelamin</th>
                                                <th>Obat</th>
                                                <th class="text-end" >Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query = "SELECT tb_pasien.*, tb_poli.*,tb_obat.*,tb_biaya.Status,tb_biaya.biaya_pemeriksaan,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis 
                                                      FROM tb_pilihpoli 
                                                      inner join tb_pasien on tb_pasien.id_pasien = tb_pilihpoli.id_pasien 
                                                      LEFT join tb_poli on tb_poli.id_poli = tb_pilihpoli.id_poli
                                                      LEFT join tb_beliobat on tb_beliobat.id_pasien = tb_pasien.id_pasien
                                                      LEFT join tb_obat on tb_beliobat.id_obat = tb_obat.id_obat
                                                      LEFT join tb_biaya on tb_pasien.id_pasien = tb_biaya.id_pasien;";
                                            if(isset($_POST['cari'])){
                                                $cari = $_POST['search'];
                                                $query = "SELECT tb_pasien.*, tb_poli.*,tb_obat.id_obat,tb_obat.nama_obat,tb_biaya.Status,tb_biaya.biaya_pemeriksaan,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis 
                                                      FROM tb_pilihpoli
                                                      inner join tb_pasien on tb_pasien.id_pasien = tb_pilihpoli.id_pasien 
                                                      LEFT join tb_poli on tb_poli.id_poli = tb_pilihpoli.id_poli
                                                      LEFT join tb_beliobat on tb_beliobat.id_pasien = tb_pasien.id_pasien
                                                      LEFT join tb_obat on tb_beliobat.id_obat = tb_obat.id_obat
                                                      LEFT join tb_biaya on tb_pasien.id_pasien = tb_biaya.id_pasien
                                                      WHERE tb_pasien.Nama LIKE '%$cari%' or tb_pasien.id_pasien LIKE '%$cari%';"; 

                                            }
                                            $result = mysqli_query($conn,$query);
                                            foreach ($result as $key) {
                                                
                                            ?>
                                            <tr>
                                                <td style="display: none; "><?= $key['Alamat'] ?></td>
                                                <td style="display: none; "><?= $key['Tgl_lahir_pasien'] ?></td>
                                                <td style="display: none; "><?= $key['Keluhan'] ?></td>
                                                <td style="display: none; "><?= $key['Catatan_medis'] ?></td>
                                                <td style="display: none; "><?= $key['biaya_pemeriksaan'] ?></td>
                                                <td style="display: none; "><?= $key['id_obat'] ?></td>
                                                <td><?= $key['id_pasien'] ?></td>
                                                <td><?= $key['Nama'] ?></td>
                                                <td><?= $key['Jenis_kelamin'] ?></td>
                                                <td style="display: none;"><?php if($key['nama_poli'] == NULL){
                                                            echo "-";
                                                          }else{
                                                            echo $key['nama_poli'];  
                                                          } ?></td>
                                                
                                                <td ><?php if($key['nama_obat'] == NULL){
                                                            echo "-";
                                                          }else{
                                                            echo $key['nama_obat'];
                                                          } ?>
                                                    </td>
                                                
                                                <td class="text-end">
                                                <div class="d-md-inline-flex flex-row">
                                                    <?php 
                                                    if ($key['nama_obat']==NULL) {
                                                    ?>
                                                    <span class="badge bg-warning btn_addobat mb-1"><i class="fas fa-capsules"></i> input obat</span>                        
                                                    <?php 
                                                    }else{
                                                    ?>
                                                    <span class="badge bg-primary btn_ubahobat mb-1"><i class="fas fa-capsules"></i> ubah obat</span>                        
                                                    <?php
                                                    } 
                                                    ?>
                                                    <span class="badge bg-secondary btn_detailpsn mb-1 ms-1"> Detail Pasien</span>
                                                    </div>
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
                <!-- AKHIR MENU ADMIN Apotik -->
                <?php 
          }elseif($_SESSION['level']=="Admin Pendaftaran"){
          ?>

                <!-- MENU ADMIN PENDAFTARAN -->
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item"> <a href="pendaftaran.php" class="sidebar-link"> <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Pendaftaran</a> </li>
                        <li class="sidebar-item active"> <a href="#" class="sidebar-link"> <i
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
                    <!-- AKHIR MENU ADMIN PENDAFTARAN -->
                    <?php 
          }elseif($_SESSION['level']=="Admin Kasir"){
          ?>

                    <!-- MENU ADMIN KASIR -->
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>
                            <li class="sidebar-item active"> <a href="#" class="sidebar-link"> <i
                                        class="fa fa-address-card pr-2" aria-hidden="true"></i>Rekap Pembayaran</a>
                            </li>
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
                                            <li class="breadcrumb-item active" aria-current="page">Rekap Pembayaran
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-header">Rekap Pembayaran</div>
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
                                        <div class="datatable-container">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th data-field="Nama" data-sortable="true">No.Pasien</th>
                                                        <th data-field="Nama" data-sortable="true">Nama</th>
                                                        <th data-sortable="true">Biaya Pemeriksaan</th>
                                                        <th data-sortable="true">Biaya Obat</th>
                                                        <th data-sortable="true">Total Biaya</th>
                                                        <th data-sortable="true">Status</th>
                                                        <th data-sortable="true" class="text-end">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT tb_pasien.*,tb_poli.*,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis,tb_obat.nama_obat,tb_biaya.biaya_pemeriksaan,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis,tb_biaya.biaya_pemeriksaan, tb_biaya.biaya_obat, tb_biaya.total_biaya, tb_biaya.status 
                                                    FROM tb_pasien
                                                    LEFT join tb_pilihpoli on tb_pilihpoli.id_pasien = tb_pasien.id_pasien 
                                                    LEFT join tb_biaya on tb_biaya.id_pasien = tb_pasien.id_pasien
                                                    LEFT join tb_poli on tb_poli.id_poli = tb_pilihpoli.id_poli
                                                    LEFT join tb_beliobat on tb_beliobat.id_pasien = tb_pasien.id_pasien
                                                    LEFT join tb_obat on tb_beliobat.id_obat = tb_obat.id_obat;";
                                                    if(isset($_POST['cari'])){
                                                        $cari = $_POST['search'];
                                                        $query = "SELECT tb_pasien.*,tb_poli.*,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis,tb_obat.nama_obat,tb_biaya.biaya_pemeriksaan,tb_pilihpoli.Keluhan,tb_pilihpoli.Catatan_medis,tb_biaya.biaya_pemeriksaan, tb_biaya.biaya_obat, tb_biaya.total_biaya, tb_biaya.status 
                                                              FROM tb_pasien
                                                              LEFT join tb_pilihpoli on tb_pilihpoli.id_pasien = tb_pasien.id_pasien
                                                              LEFT join tb_biaya on tb_biaya.id_pasien = tb_pasien.id_pasien
                                                              LEFT join tb_poli on tb_poli.id_poli = tb_pilihpoli.id_poli
                                                              LEFT join tb_beliobat on tb_beliobat.id_pasien = tb_pasien.id_pasien
                                                              LEFT join tb_obat on tb_beliobat.id_obat = tb_obat.id_obat
                                                              where tb_pasien.id_pasien LIKE '%$cari%' or tb_pasien.Nama LIKE '%$cari%';";
                                                    }
                                                    $res = mysqli_query($conn,$query);
                                                    foreach ($res as $key){
                                                    ?>
                                                    <tr>
                                                        <td style="display:none"><?=$key['Alamat']?></td>
                                                        <td style="display:none"><?=$key['Jenis_kelamin']?></td>
                                                        <td style="display:none"><?=$key['Tgl_lahir_pasien']?></td>
                                                        <td style="display:none"><?=$key['nama_poli']?></td>
                                                        <td style="display:none"><?=$key['nama_obat']?></td>
                                                        <td style="display:none"><?=$key['Keluhan']?></td>
                                                        <td style="display:none"><?=$key['Catatan_medis']?></td>
                                                        <td><?= $key['id_pasien']?></td>
                                                        <td><?= $key['Nama']?></td>
                                                        <td>Rp<?= $key['biaya_pemeriksaan']?></td>
                                                        <td><?php
                                                         if($key['biaya_obat'] == NULL){
                                                             echo "-";
                                                         }else{
                                                             echo " Rp".$key['biaya_obat'];
                                                         }?></td>
                                                        <td>Rp<?= $key['total_biaya']?></td>
                                                        <td><?php 
                                                                if($key['status'] == "Belum Lunas"){ 
                                                                ?>
                                                                    <span style="cursor: default;" class="badge bg-danger"><?= $key['status'] ?></span>        
                                                                <?php 
                                                                }else{
                                                                ?>
                                                                <span style="cursor: default;" class="badge bg-success"><?= $key['status'] ?></span>        
                                                                <?php 
                                                                } 
                                                            ?>                                                        
                                                        </td>
                                                        <td class="text-end">
                                                        <?php
                                                        if($key['status'] == "Belum Lunas"){
                                                        ?>
                                                            <span class="badge bg-warning konfirmasi">konfirmasi pembayaran</span>
                                                        <?php 
                                                        } 
                                                        ?>
                                                            <span class="badge bg-secondary btn_detailpsn2"> <i
                                                                    class="fas fa-user-edit text-white"></i> Detail Pasien</span>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                    }

                                                    if(isset($_GET['konfirm'])){
                                                        $id = $_GET['id'];
                                                        $status = $_GET['konfirm'];
                                                        $q = "UPDATE tb_biaya SET Status = '$status' WHERE id_pasien = '$id'";
                                                        update($q);
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php 
                        }
                        ?>
                        <footer>
                            <div class="footer clearfix mb-0 text-muted">
                                <div class="float-start">
                                    <p>2021 &copy; Rizani Husyairi</p>
                                </div>

                            </div>
                        </footer>
                    </div>
                </div>
                <!-- MODAL Ubah&tambah user -->
                <div class="modal fade" id="ubahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="mb-3" style="display:none">
                                        <label for="iduser" class="form-label">Nomor user</label>
                                        <input type="text" id="iduser" name="iduser" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_user" class="form-label">Nama User</label>
                                        <input type="text" class="form-control" name ="nama_user" id="nama_user" placeholder="Masukkan nama lengkap.." autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username.." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pass_user" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="newpass_user" name="newpass_user" placeholder="Masukkan password.." required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="jenis_p">level</label>
                                        <select name="jenislevel" class="form-select" id="jenis_L" required>
                                            <option id="pilihlevel" selected>Pilih level...</option>
                                            <option id="level1" value="Admin Pendaftaran">Admin Pendaftaran</option>
                                            <option id="level2" value="Admin Poliklinik">Admin Poliklinik</option>
                                            <option id="level3" value="Admin Apotik">Admin Apotik</option>
                                            <option id="level4" value="Admin Kasir">Admin Kasir</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 d-flex flex-row-reverse" >
                                        <button type="Submit" id="sub-user" class="btn btn-primary ms-2" style="width:92px;">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                if (isset($_POST["update_user"])) {
                    $id = $_POST['iduser'];
                    $nama = $_POST['nama_user'];
                    $usern = $_POST['username'];
                    $pass = password_hash($_POST['newpass_user'],PASSWORD_DEFAULT);
                    $level = $_POST['jenislevel'];
                    $sql = "UPDATE tb_user 
                            SET Nama = '$nama', Status = '$level', Username = '$usern', Password = '$pass' 
                            WHERE id_user = $id";
                    update($sql);
                }
                if (isset($_POST["create_user"])) {
                    $nama = $_POST['nama_user'];
                    $usern = $_POST['username'];
                    $pass = password_hash($_POST['newpass_user'],PASSWORD_DEFAULT);
                    $level = $_POST['jenislevel'];
                    create('tb_user',"'','$usern','$pass','$level','$nama'");
                }
                
                ?>
                <!-- akhir Modal Ubah&tambah user -->

                <!-- MODAL INPUT POLI -->
                <div class="modal fade" id="inputpoli" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Input Poliklinik</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="id_psn" id="id_psn">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="jenis_p">Jenis Poliklinik</label>
                                        <select name="jenispoli" class="form-select" id="jenis_p">
                                            <option id="pilihjenis" selected>Pilih jenis poliklinik...</option>
                                            <?php
                                            $poli = read('tb_poli');
                                            foreach ($poli as $jenis) {
                                            
                                            ?>
                                            <option id=<?=$jenis['id_poli']?> value="<?= $jenis['nama_poli']?>"><?= $jenis['nama_poli'] ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="biaya_P" class="form-label">Biaya Pemeriksaan</label>
                                        <input type="text" class="form-control" name="Biaya" id="biaya_P" placeholder="masukkan biaya..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Catatan" class="form-label">Catatan medis</label>
                                        <textarea class="form-control" name="Catatan" id="Catatan"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Ktrng_psn" class="form-label">Keterangan</label>
                                        <textarea class="form-control" name="Ktrng_psn" id="Ktrng_psn"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit_poli" class="btn btn-info ml-1">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php 
                if(isset($_POST['submit_poli'])){
                    $Jpoli = $_POST['jenispoli'];
                    $idpoli = cari($Jpoli,'tb_poli','nama_poli','id_poli');
                    $idpoli = mysqli_fetch_row($idpoli);
                    $idpsn = $_POST['id_psn'];
                    $idbiaya = cari($idpsn,'tb_biaya','id_pasien','id_biaya');
                    $idbiaya = mysqli_fetch_row($idbiaya);
                    $Biaya = $_POST['Biaya'] + $idbiaya[3];
                    $Catatan = $_POST['Catatan'];
                    $keterangan = $_POST['Ktrng_psn'];

                    $Upbiaya = "UPDATE tb_biaya 
                                SET biaya_pemeriksaan = $Biaya, total_biaya = $Biaya
                                WHERE id_pasien = '$idpsn'"; 
                    $sql = "UPDATE tb_pilihpoli
                            SET id_poli = $idpoli[0], Keluhan = '$keterangan', Catatan_medis = '$Catatan'  
                            WHERE id_pasien = '$idpsn'";
                    $B_update=mysqli_query($conn,$Upbiaya);
                    update($sql);
                }
                ?>
                <!-- akhir Modal akhir input poli -->

                <!-- MODAL INPUT OBAT -->
                <div class="modal fade" id="addobat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Input Obat Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="id_psn" id="kode_psn">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="jenis_O">Obat</label>
                                        <select name="jenisobat" class="form-select" id="jenis_O">
                                            <option id="pilihobat" value="" selected>Pilih Obat...</option>
                                            <?php
                                            $obat = read('tb_obat');
                                            foreach ($obat as $jenis) {
                                            
                                            ?>
                                            <option id=<?=$jenis['id_obat']?> value="<?=$jenis['nama_obat']?>"><?= $jenis['nama_obat'] ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit_obat" class="btn btn-info ml-1">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_POST['submit_obat'])){
                    $idpsn = $_POST['id_psn'];
                    $obat = $_POST['jenisobat'];
                    $dtobat = cari($obat,'tb_obat','nama_obat','id_obat');
                    $dtobat =  mysqli_fetch_row($dtobat);
                    $idbiaya = cari($idpsn,'tb_biaya','id_pasien','id_biaya');
                    $idbiaya = mysqli_fetch_row($idbiaya);
                    $Biaya = $dtobat[2] + $idbiaya[2];
                    $sql = "UPDATE tb_biaya SET biaya_obat = $dtobat[2], total_biaya = $Biaya  WHERE id_pasien = '$idpsn'";
                    mysqli_query($conn,$sql);
                    $sql2 = "UPDATE tb_beliobat SET id_obat = $dtobat[0] WHERE id_pasien = '$idpsn'";
                    update($sql2);
                }
                ?>
                
                <!-- Akhir modal input obat -->

                <!-- MODAL Ubah Pasien -->
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
                <!-- akhir Modal akhir Ubah pasien-->
           
                <!-- MODAL detail Pasien -->
                <div class="modal fade" id="Detailpsn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Detail Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="D_no" class="form-label">Nomor pasien</label>
                                        <input type="text" id="D_no" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="D_nama" class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" name ="Nama_p" id="D_nama" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Alamat_p" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="D_Alamat" name="Alamat_p" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis" class="form-label">Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="D_jenis" name="Alamat_p" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Tgl" class="form-label">Tanggal Lahir</label>
                                        <input type="date" style="width:220px;" class="form-control" name="Tgl_p" id="D_tgl" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="D_poli" class="form-label">Poli</label>
                                        <input type="text" class="form-control" id="D_poli" name="D_poli" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="D_obat" class="form-label">Obat</label>
                                        <input type="text" class="form-control" id="D_obat" name="D_obat" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="D_catatan" class="form-label">Catatan_medis</label>
                                        <textarea class="form-control" name="D_catatan" id="D_catatan" disabled></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="D_Ktrng" class="form-label">Keterangan</label>
                                        <textarea class="form-control" name="D_Ktrng" id="D_Ktrng" disabled></textarea>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal Detail Pasien-->

                
                
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