$(document).ready(function(){
    $('.menu-bar input').on('click',()=>{
        $('.sidebar')[0].classList.toggle('slide');
    })


    // tombol Tambah obat pasien
    $(".btn_addobat").on('click',function(){
        $("#addobat").modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#kode_psn").val(data[6]);
        var select = $("option[selected]");
        for (var i = 0; i < select.length; i++) {
            select[i].removeAttribute("selected");    
        }
        $("#pilihobat")[0].setAttribute('selected','');
        
        

    })
    $(".btn_ubahobat").on('click',function(){
        $("#addobat").modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#kode_psn").val(data[6]);
        var select = $("option[selected]");
        for (var i = 0; i < select.length; i++) {
            select[i].removeAttribute("selected");    
        }
        $("#"+data[5])[0].setAttribute('selected','');
    })

    // tombol edit data obat
    $(".edit_obat").on('click',function(){
        $("#Obat_A").modal("show");
        $(".modal-title")[0].innerHTML = "Ubah Obat";
        $('#subs').attr('name','update');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#no_obat").val(data[0]);
        $("#Nama_obat").val(data[1]);
        $("#Harga_obat").val(data[2]);
        $("#keterangan_obat").val(data[3]);

    })
    $(".add_obat ").on('click',function(){
        $("#Obat_A").modal("show");
        $(".modal-title")[0].innerHTML = "Tambah Obat";
        $('#subs').attr('name','create');
        $("#no_obat").val("");
        $("#Nama_obat").val("");
        $("#Harga_obat").val("");
        $("#keterangan_obat").val("");

    })
    //Tombol Input Poli Pasien
    $('.btn_editpoli').on('click',function(){
        $("#inputpoli").modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#id_psn').val(data[6]);
        var select = $("option[selected]");
        for (var i = 0; i < select.length; i++) {
            select[i].removeAttribute("selected");    
        }
        if(data[5]){
            $('#'+data[5])[0].setAttribute('selected','');
        }
        $("#biaya_P").val(data[4]);
        $("#Catatan").val(data[3]);
        $("#Ktrng_psn").val(data[2]);

    })
    $('.btn_addpoli').on('click',function(){
        $("#inputpoli").modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#id_psn').val(data[6]);
        var select = $("option[selected]");
        for (var i = 0; i < select.length; i++) {
            select[i].removeAttribute("selected");    
        }
        $("#pilihjenis")[0].setAttribute('selected','');
        
        $("#biaya_P").val("");
        $("#Catatan").val("");
        $("#Ktrng_psn").val("");
        
    })


    // tombol edit jenis poli
    $('.btn_poli').on('click',function(){
        $("#Poliklinik").modal('show');
        $('#subs').attr('name','update');
        $(".modal-title")[0].innerHTML = "Ubah Poliklinik";
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#no_poli").val(data[0]);
        $("#Nama_Poli").val(data[1]);
    })



    // detail pasien 1
    $('.btn_detailpsn').on("click",function(){
        $('#Detailpsn').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#D_no").val(data[6]);
        $("#D_nama").val(data[7]);
        $("#D_Alamat").val(data[0]);
        
        if(data[8]=="L"){
            $("#D_jenis").val("Laki-Laki");
        }else{
            $("#D_jenis").val("Perempuan");
        }
        $("#D_tgl").val(data[1]);
        $("#D_poli").val(data[9]);
        $("#D_obat").val(data[10]);
        $('#D_catatan').val(data[3]);
        $('#D_Ktrng').val(data[2]);

    })
    // detail pasien 2
    $('.btn_detailpsn2').on("click",function(){
        $('#Detailpsn').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#D_no").val(data[7]);
        $("#D_nama").val(data[8]);
        $("#D_Alamat").val(data[0]);
        
        if(data[1]=="L"){
            $("#D_jenis").val("Laki-Laki");
        }else{
            $("#D_jenis").val("Perempuan");
        }
        $("#D_tgl").val(data[2]);
        $("#D_poli").val(data[3]);
        $("#D_obat").val(data[4]);
        $('#D_catatan').val(data[6]);
        $('#D_Ktrng').val(data[5]);

    })


    // Tombol tambah jenis poli
    $(".add_poli").on("click",()=>{
        $("#Poliklinik").modal('show');
        $('#subs').attr('name','create');
        $(".modal-title")[0].innerHTML = "Tambah Poliklinik";
        $("#no_poli").val("");
        $("#Nama_Poli").val("");
        
    })


    $('.btn_editpsn').on('click',function(){
        $("#ubahpasien").modal('show');
        
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#No_p').val(data[0]);
        $('#Nama_P').val(data[1]);
        $('#Alamat_p').val(data[2]);
        if(data[3] == "L"){
            $('#JK1')[0].setAttribute("checked","");
        }else{
            $('#JK2')[0].setAttribute("checked","");
        }
        $('#Tgl').val(data[4]);
    })


    $(".btnedit_user").on('click',function(){
        $("#ubahuser").modal('show');
        $(".modal-title")[0].innerHTML = "Edit User";
        $("#sub-user").attr('name','update_user');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $("#iduser").val(data[0]);
        $("#nama_user").val(data[2]);
        $("#username").val(data[3]);
        var select = $("option[selected]");
        for (var i = 0; i < select.length; i++) {
            select[i].removeAttribute("selected");    
        }    
        $("option[value='"+data[4]+"'")[0].setAttribute('selected','')
        
        
        
        
    })
    $(".btnadd_user").on('click',function(){
        $("#ubahuser").modal('show');
        $(".modal-title")[0].innerHTML = "Tambah User";
        $("#sub-user").attr('name','create_user');
        $("#iduser").val("");
        $("#nama_user").val("");
        $("#username").val("");
        var select = $("option[selected]");
        for (var i = 0; i < select.length; i++) {
            select[i].removeAttribute("selected");    
        }
        $("#pilihlevel")[0].setAttribute('selected','');

    })


    $(".btnhps_psn").on('click',function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Apa kamu yakin ingin menghapus data ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!',
        cancelButtonText:'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire(
            'Terhapus!',
            'Data berhasil Dihapus',
            'success'    
        ).then((p)=>{
            window.location = window.location.href+"?hal=pasien&id="+data[0];
        })
    }
    })
    })

    $(".btnhps_user").on('click',function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get(); 
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Apa kamu yakin ingin menghapus data ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!',
        cancelButtonText:'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire(
            'Terhapus!',
            'Data berhasil Dihapus',
            'success'    
        ).then((p)=>{
            window.location = window.location.href+"?hal=user&id="+data[0];
        })
    }
    })
    })

    $(".btnhps_poli").on('click',function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Apa kamu yakin ingin menghapus data ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!',
        cancelButtonText:'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire(
            'Terhapus!',
            'Data berhasil Dihapus',
            'success'    
        ).then((p)=>{
            window.location = window.location.href+"?hal=hapus&id="+data[0];
        })
    }
    })
    })

    const sweetalert = ($tb,id) => {
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "Apa kamu yakin ingin menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText:'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
            Swal.fire(
                'Terhapus!',
                'Data berhasil Dihapus',
                'success'    
            ).then((p)=>{
                window.location = window.location.href+"?hal="+tb+"&id="+id;
            })
        }
        })


    }

    $(".konfirmasi").on('click',function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
        return $(this).text();  
        }).get();
        Swal.fire({
            title: '<strong>Total Biaya: </strong> <br> '+data[11],
            text: 'Konfirmasi Pembayaran?',
            showCancelButton: true,
            confirmButtonText: `IYA`
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              Swal.fire('Lunas!', '', 'success').then((o)=>{
                window.location = "Adminpage.php?konfirm=Lunas&id="+data[7];
              })
            
            }
          })
    })
    

 



    
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
 
});