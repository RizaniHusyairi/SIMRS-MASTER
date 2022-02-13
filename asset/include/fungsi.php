<?php 
    include "koneksi.php";
    function cari($keyword,$tb,$nama,$id){
        global $conn;
        $result= mysqli_query($conn,"SELECT * FROM $tb WHERE $nama LIKE '%$keyword%' or $id LIKE '%$keyword%'");
        return $result;

    }
    function update($query){
        global $conn;
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<script> alert('Data berhasil diubah');
            window.history.back(); </script>";
          }
          else{
            echo "<script> alert('Data Error'); </script>";
          }
    }

    function create($tb,$value){
        global $conn;
        $result = mysqli_query($conn,"Insert into $tb values ($value)");
        
    }

    function read($tb){
        global $conn;
        $result = mysqli_query($conn,"SELECT * from $tb") or die ("<p> No data</p>");
        return $result;
    }

    function delete($tb,$id){
        global $conn;
        $result = mysqli_query($conn,"DELETE FROM $tb WHERE $id LIKE '%$_GET[id]%'");
        if(!$result){
            echo "<script> alert('Data Gagal dihapus".$_GET['id']."'); </script>";
            
                
        }
    }

    function no_pasien(){
        global $conn;
        $query = "SELECT MAX(kode) from tb_pasien";
        $res = mysqli_query($conn,$query);
        $result = mysqli_fetch_row($res);
        return $result[0];
    }

    function hitung($col,$tb,$val)
    {
        global $conn;
        $query = "SELECT COUNT($col) from $tb WHERE $col = '$val'";
        $res = mysqli_query($conn,$query);
        $result = mysqli_fetch_row($res);
        return $result[0];
    }
    

    
    
    
    
    
    
    
    
    
    
    
    
?>