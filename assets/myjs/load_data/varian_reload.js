var pathArray = window.location.pathname.split("/").pop()

if(pathArray == "arsipvarian"){
    var url = url_base+"produk/load_varian/arsip";
} else {
    var url = url_base+"produk/load_varian";
}

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
    ajax: {"url": url, "type": "POST"},
    columns: [
        {"data": "kode_varian"},
        {"data": "nama_varian"},
        {"data": "produk"},
        {"data": "stok", render : function(data, row, iDisplayIndex){
            if(data == 0) data = "-"
            else data += "";

            if(jQuery.browser.mobile == true) return data
            else return "<center>"+data+"</center>"
        }},
        {"data": "harga_suplier", render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' ) },
        {"data": "harga", render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' ) },
        {"data": "komisi", render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' ) },
        {"data": "menu"},
    ],
    order: [[1, 'asc']],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
    { "searchable": false, "targets": [""] },  // Disable search on first and last columns
    { "targets": [3, 7], "orderable": false},
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});