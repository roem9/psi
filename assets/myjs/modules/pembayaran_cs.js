$(".btnAddPencairan").click(function(){
    let id_cs = $(this).data("id_cs");

    $("[name='id_cs']").val(id_cs)
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
                let result = ajax(url_base+"cs/add_pencairan", "POST", formData);

                if(result == 1){
                    id_cs = $(form+" [name='id_cs']").val()
                    loadData(id_cs);

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

function loadData(id_cs) {
    let result = ajax(url_base+"cs/load_pencairan", "POST", {id_cs:id_cs});
    
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
            status_pencairan = `<td class="text-nowrap bg-danger text-light"><center>Belum Cair</center></td>`;
        } else if(data['pembayaran'] - data['pencairan'] == 0) {
            status_pencairan = `<td class="text-nowrap bg-success text-light"><center>Cair Seluruhnya</center></td>`;
        } else {
            status_pencairan = `<td class="text-nowrap bg-warning text-light"><center>Cair Sebagian</center></td>`
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

// detail cs 
$(document).on("click",".btnEditPencairan", function(){
    let form = "#detailPencairan";
    let id_pencairan = $(this).data("id");

    let data = {id_pencairan: id_pencairan};
    let result = ajax(url_base+"cs/get_pencairan", "POST", data);
    
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
                let result = ajax(url_base+"cs/edit_pencairan", "POST", formData);

                if(result == 1){
                    id_cs = $(form+" [name='id_cs']").val()
                    loadData(id_cs);

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