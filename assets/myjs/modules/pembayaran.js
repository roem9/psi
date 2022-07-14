$(".btnAddPencairan").click(function(){
    let id_gudang = $(this).data("id_gudang");

    $("[name='id_gudang']").val(id_gudang)

    // let result = ajax(url_base+"gudang/load_belum_lunas", "POST", {id_gudang:id_gudang});

    // html = "";
    // for (let i = 0; i < 10; i++) {
    //     result.forEach(data => {
    //         // html += data.tgl_closing +" "+ data.nama_closing + " " + data.pembayaran;
    //         html += 
    //             `<label class="form-check">
    //                 <input class="form-check-input" type="checkbox" name="">
    //                 <span class="form-check-label">`+data.tgl_closing +` `+ data.nama_closing + ` ` + data.pembayaran + `</span>
    //             </label>`;
    //     });
    // }

    // $("#list_belum_lunas").html(html);
})

// tambah gudang 
$("#addPencairan .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan pencairan baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#addPencairan";
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
                let result = ajax(url_base+"gudang/add_pencairan", "POST", formData);

                if(result == 1){
                    id_gudang = $(form+" [name='id_gudang']").val()
                    loadData(id_gudang);

                    $("#formAddPencairan").trigger("reset");
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data pencairan',
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

function loadData(id_gudang) {
    let result = ajax(url_base+"gudang/load_pencairan", "POST", {id_gudang:id_gudang});
    
    let sisa_pembayaran = 0;
    if(result.pembayaran){
        result.pembayaran.periode.forEach(data => {
            sisa_pembayaran = parseInt(sisa_pembayaran) + parseInt(data.pembayaran) - parseInt(data.pencairan);
        })
    }

    $("#sisa_pembayaran").html(rupiah(sisa_pembayaran))

    html = "";
    result.pembayaran.periode.forEach(data => {
        status_pencairan = "";

        if(data['pencairan'] == 0) {
            status_pencairan = `<td class="text-nowrap bg-danger text-light"><center>Belum Lunas</center></td>`;
        } else if(data['pembayaran'] - data['pencairan'] == 0) {
            status_pencairan = `<td class="text-nowrap bg-success text-light"><center>Lunas</center></td>`;
        } else {
            status_pencairan = `<td class="text-nowrap bg-warning text-light"><center>Lunas Sebagian</center></td>`
        }

        html += `
            <tr>
                <td>`+data.periode+`</td>
                <td><center>`+rupiah(data.pembayaran)+`</center></td>
                <td><center>`+rupiah(data.pencairan)+`</center></td>
                <td><center>`+rupiah(parseInt(data.pembayaran) - parseInt(data.pencairan))+`</center></td>
                `+status_pencairan+`
            </tr>
        `;
    });

    $("#tablePembayaran").html(html);

    html = "";
    result.pencairan.forEach(data => {
        html += `
            <tr>
                <td>`+tgl_indo(data.tgl_pencairan)+`</td>
                <td class="text-nowrap">`+periode(data.periode)+`</td>
                <td class="text-nowrap">`+rupiah(data.nominal)+`</td>
                <td>`+data.catatan+`</td>
                <td><a href="#detailPencairan" data-bs-toggle="modal" data-id="`+data.id_pencairan+`" class="btn btn-info btnEditPencairan">`+tablerIcon("settings", "")+`</a></td>
            </tr>
        `;
    });

    $("#tablePencairan").html(html);

}

// detail gudang 
$(document).on("click",".btnEditPencairan", function(){
    let form = "#detailPencairan";
    let id_pencairan = $(this).data("id");

    let data = {id_pencairan: id_pencairan};
    let result = ajax(url_base+"gudang/get_pencairan", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })
})

// edit gudang 
$("#detailPencairan .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan merubah data pencairan?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#detailPencairan";
            
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
                let result = ajax(url_base+"gudang/edit_pencairan", "POST", formData);

                if(result == 1){
                    id_gudang = $(form+" [name='id_gudang']").val()
                    loadData(id_gudang);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil merubah data pencairan',
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