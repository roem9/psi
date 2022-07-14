// tambah produk 
$("#addProduk .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan produk baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#addProduk";
            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"produk/add_produk", "POST", formData);

                if(result == 1){
                    loadData();
                    $("#formAddProduk").trigger("reset");
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data produk',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

// detail produk 
$(document).on("click",".detailProduk", function(){
    let form = "#detailProduk";
    let id_produk = $(this).data("id");

    let data = {id_produk: id_produk};
    let result = ajax(url_base+"artikel/get_produk", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })
})

// edit produk 
$("#detailProduk .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan merubah data produk?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#detailProduk";
            
            let formData = {};
            $(form+" .form").each(function(){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"produk/edit_produk", "POST", formData);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil merubah data produk',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

// arsip produk 
$(document).on("click", ".arsipProduk", function(){
    let id_produk = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus produk ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_produk: id_produk}
            let result = ajax(url_base+"produk/arsip_produk", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus produk',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})

$("#addVarian .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan varian produk baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#addVarian";
            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
            let result = ajax(url_base+"produk/add_varian", "POST", formData);

                if(result == 1){
                    loadData();
                    $("#formAddVarian").trigger("reset");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data varian baru',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

$(document).on("click",".detailVarian", function(){
    let form = "#detailVarian";
    let id_varian = $(this).data("id");

    let data = {id_varian: id_varian};
    let result = ajax(url_base+"produk/get_varian", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })
})

// menyimpan hasil edit data
$("#detailVarian .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan merubah data varian produk?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#detailVarian";
            
            let formData = {};
            $(form+" .form").each(function(){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            if ($("[name='checkbox_komisi']").is(":checked")){
                formData = Object.assign(formData, {"all_komisi": "Yes"})
            } else {
                formData = Object.assign(formData, {"all_komisi": "No"})
            }

            if ($("[name='checkbox_harga']").is(":checked")){
                formData = Object.assign(formData, {"all_harga": "Yes"})
            } else {
                formData = Object.assign(formData, {"all_harga": "No"})
            }

            if ($("[name='checkbox_suplier']").is(":checked")){
                formData = Object.assign(formData, {"all_suplier": "Yes"})
            } else {
                formData = Object.assign(formData, {"all_suplier": "No"})
            }

            let eror = required(form);

            console.log(formData)
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"produk/edit_varian", "POST", formData);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil merubah data varian produk',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $("[name='checkbox']").prop("checked", false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

$(document).on("click", ".arsipVarian", function(){
    let id_varian = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengarsipkan data varian produk ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_varian: id_varian}
            let result = ajax(url_base+"produk/arsip_varian", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil mengarsipkan data varian produk',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})

$(document).on("click", ".bukaArsipVarian", function(){
    let id_varian = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan membuka arsip data varian produk ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_varian: id_varian}
            let result = ajax(url_base+"produk/buka_arsip_varian", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil membuka arsip data varian produk',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})
