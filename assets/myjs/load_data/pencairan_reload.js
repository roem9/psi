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
    ajax: {"url": url_base+"other/load_pencairan", "type": "POST"},
    columns: [
        {"data": "tgl_pencairan"},
        {"data": "periode", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.periode_pencairan;
        }},
        {"data": "nama_cs"},
        {"data": "nominal", render : function(row, data, iDisplayIndex){
            $(row).addClass("text-nowrap")
            return `Rp `+formatRupiah(iDisplayIndex.nominal);
        }},
        {"data": "menu"},
    ],
    order: [[0, 'asc']],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
        { "searchable": false, "targets": [""] },  // Disable search on first and last columns
        { "targets": [4], "orderable": false},
        { "className": "text-nowrap", "targets": [ 3 ] }
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});