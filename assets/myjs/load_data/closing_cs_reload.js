var pathArray = window.location.pathname.split("/").pop()

var datatable = $('#dataTable').DataTable({ 
    initComplete: function() {
        var api = this.api();
        $('#mytable_filter input')
            .off('.DT')
            .on('input.DT', function() {
                api.search(this.value).draw();
        });
    },
    oLanguage: {
    sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {"url": url_base+"cs/load_closing", "type": "POST", "data" : {id_cs : pathArray}},
    columns: [
        {"data": "tgl_closing", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.tgl_closing
        }},
        {"data": "nama_closing", className : "text-wrap", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.nama_closing + iDisplayIndex.status_input + `<br>` + iDisplayIndex.no_hp;
        }},
        {"data": "produk_closing", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.produk_closing +`<br><span style="color: #118C4F"><b>`+ formatRupiah(iDisplayIndex.nominal_transaksi, "Rp.") +`</b></span>`
        }},
        // {"data": "nominal_transaksi", render : function(data){
        //     return formatRupiah(data, "Rp.");
        // }, className : "text-nowrap"},
        {"data": "nama_cs"},
        {"data": "nama_gudang", className:'text-nowrap'},
        {"data": "durasi", className:'text-nowrap'},
        {"data": "status", className:'text-nowrap', render : function(row, data, iDisplayIndex){
            return iDisplayIndex.status + iDisplayIndex.status_delivered;
        }},
        {"data": "menu"},
        {"data": "jenis_closing"},
        {"data": "catatan"},
        {"data": "no_hp"},
    ],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
    { "searchable": false, "targets": [""] },  // Disable search on first and last columns
    { "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], "orderable": false},
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});