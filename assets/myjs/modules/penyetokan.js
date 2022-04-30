let id_urut = 0;
let nomor_urut = 0;

$("[name='cari_varian']").on('keyup', function(){
    var value = $(this).val().toLowerCase();
    if(value == "") $(".listOfVarianSelect").hide();
    else $(".listOfVarianSelect").show();

    $(".listOfVarianSelect li").each(function () {
        if ($(this).text().toLowerCase().search(value) > -1) {
            $(this).show();
            $(this).prev('.subjectName').last().show();
        } else {
            $(this).hide();
        }
    });
})

$(".btnAddPenyetokan").click(function(){
    $("#listOfVarian").html("");

    id_urut = 0;
    nomor_urut = 0;

    listOfVarian('varian');
})

$(document).on("click", ".varianDetail", function(){
    id_urut++;
    nomor_urut++;

    let id_varian = $(this).data("id");
    let result = ajax(url_base+"produk/get_varian", "POST", {id_varian : id_varian});
    $("#listOfVarianDetail").append(`
        <tr id="`+id_urut+`">
            <td>
                <input type="hidden" name="id_varian" value="`+result.id_varian+`">
                <span class="urut">`+nomor_urut+`</span>
            </td>
            <td><a href="javascript:void(0)" class="hapusVarian text-danger" data-form="#formDetailPenyetokan" data-id="`+id_urut+`" data-nama="`+result.nama_varian+`">`+result.nama_varian+`</a></td>
            <td class="text-right"><input type="number" name="qty" class="form form-control form-control-md required"></td>
        </tr>
    `)

    $("#btnSimpan").show();

    $("[name='cari_varian']").val("");
    $(".listOfVarianSelect").hide();
})

$(document).on("click", ".varian", function(){
    id_urut++;
    nomor_urut++;

    let id_varian = $(this).data("id");
    let result = ajax(url_base+"produk/get_varian", "POST", {id_varian : id_varian});
    $("#listOfVarian").append(`
        <tr id="`+id_urut+`">
            <td>
                <input type="hidden" name="id_varian" value="`+result.id_varian+`">
                <span class="urut">`+nomor_urut+`</span>
            </td>
            <td><a href="javascript:void(0)" class="hapusVarian text-danger" data-form="#formPenyetokan" data-id="`+id_urut+`" data-nama="`+result.nama_varian+`">`+result.nama_varian+`</a></td>
            <td class="text-right"><input type="number" name="qty" class="form form-control form-control-md required"></td>
        </tr>
    `)

    $("#btnSimpan").show();

    $("[name='cari_varian']").val("");
    $(".listOfVarianSelect").hide();
})

$(document).on("click", ".hapusVarian", function(){
    let id = $(this).data("id");
    let nama = $(this).data("nama");
    let form = $(this).data("form");

    Swal.fire({
        icon: 'question',
        text: 'Yakin menghapus '+nama+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            nomor_urut--;
            $(form+" #"+id).remove();
            let index = 1;
            $.each($(form+" .urut"), function(){
                $(this).html(index)
                index++
            })

            if(nomor_urut == 0){
                $("#btnEdit").hide();
                $("#btnSimpan").hide();
            }
        }
    })
})

$("#btnSimpan").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan penyetokan baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#formPenyetokan";
            let formData = {};
            $(form+" .form").each(function(){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            id_varian = new Array();
            $.each($(form+" [name='id_varian']"), function(){
                id_varian.push($(this).val());
            });

            qty = new Array();
            $.each($(form+" [name='qty']"), function(){
                qty.push($(this).val());
            });

            formData = Object.assign(formData, {id_varian:id_varian});
            formData = Object.assign(formData, {qty:qty});

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"penyetokan/add_penyetokan", "POST", formData);

                if(result == 1){
                    loadData();

                    urut = 0;
                    $("#btnSimpan").hide();
                
                    $(form).trigger('reset');
                    $("#listOfVarian").html("");
                    listOfVarian("varian");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data penyetokan',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    id_urut = 0;
                    nomor_urut = 0;
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

$(document).on("click", ".detailPenyetokan", function(){
    $("#btnEdit").show();

    id_urut = 0;
    nomor_urut = 0;

    let id_penyetokan = $(this).data("id");
    let result = ajax(url_base+"penyetokan/detail_penyetokan", "POST", {id_penyetokan:id_penyetokan});

    let  form = "#formDetailPenyetokan";

    $(form+" [name='id_penyetokan']").val(result.penyetokan.id_penyetokan);
    $(form+" [name='tgl_penyetokan']").val(result.penyetokan.tgl_penyetokan);
    $(form+" [name='keterangan']").html(result.penyetokan.keterangan);

    html_detail = "";

    result.detail_penyetokan.forEach(detail => {
        id_urut++;
        nomor_urut++;

        html_detail += `
        <tr id="`+id_urut+`">
            <td>
                <input type="hidden" name="id_varian" value="`+detail.id_varian+`">
                <span class="urut">`+nomor_urut+`</span>
            </td>
            <td>
                <a href="javascript:void(0)" class="hapusVarian text-danger" data-form="`+form+`" data-id="`+id_urut+`" data-nama="`+detail.nama_varian+`">`+detail.nama_varian+`</a>
            </td>
            <td class="text-right">
                <input type="number" name="qty" class="form form-control form-control-md required" value="`+detail.qty+`">
            </td>
        </tr>
        `
    })

    $("#listOfVarianDetail").html(html_detail);

    listOfVarian('varianDetail');
})

$("#btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data penyetokan?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#formDetailPenyetokan";
            let formData = {};
            $(form+" .form").each(function(){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            id_varian = new Array();
            $.each($("input[name='id_varian']"), function(){
                id_varian.push($(this).val());
            });

            qty = new Array();
            $.each($("input[name='qty']"), function(){
                qty.push($(this).val());
            });

            formData = Object.assign(formData, {id_varian:id_varian});
            formData = Object.assign(formData, {qty:qty});

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"penyetokan/edit_penyetokan", "POST", formData);

                if(result == 1){
                    listOfVarian('varianDetail');
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data penyetokan',
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

$(document).on("click", ".arsipPenyetokan", function(){
    let id_penyetokan = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengarsipkan data penyetokan ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_penyetokan: id_penyetokan}
            let result = ajax(url_base+"penyetokan/arsip_penyetokan", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil mengarsipkan data',
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

$(document).on("click", ".bukaArsipPenyetokan", function(){
    let id_penyetokan = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan membuka arsip data penyetokan ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_penyetokan: id_penyetokan}
            let result = ajax(url_base+"penyetokan/buka_arsip_penyetokan", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil membuka arsip data',
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

function listOfVarian(class_varian){
    let result = ajax(url_base+"produk/get_all_varian", "POST");
    let html = "";

    result.forEach(varian => {
        html += `
        <li class="list-group-item list-group-item-light text-dark">
            <div class="d-flex justify-content-between">
                `+ varian.kode_varian +` - `+ varian.nama_varian + ` (` + varian.stok + `)
                <a href="javascript:void(0)" class="`+class_varian+` text-success" data-id="`+varian.id_varian+`">
                    `+tablerIcon("square-plus", "me-1")+`
                </a>
            </div>
        </li>
        `
    })

    $(".listOfVarianSelect").html(html);
}