var quote = {
    listTable: '#customerTable',
    init: function () {
        var obj = this;
        var $table = $(obj.listTable);
        if ($table.length) {
            var dt = $table.DataTable({
                dom: 'Bfrtip',
                bProcessing: false,
                bServerSide: true,
                sAjaxSource: quoteAjax,
                // fnServerParams: function (aoData) {
                //     //d.type = 'bo';
                //     aoData.push(
                //         {
                //             'name': 'quote_status',
                //             'value': $('#quote_status').val()
                //         }, {
                //             'name': 'quote_type',
                //             'value': $('#chkTestQuote').is(':checked')
                //         });
                // },
                pageLength: 15,
                rowGroup: {
                    enable: false
                },
                autoWidth: false,
                columns: [
                    {data: 'id'},
                    {data: 'fullname'},
                    {data: 'email'},
                    {data: 'contact', className: 'text-center'},
                    {data: 'status'},
                    {data: 'created_at'},
                    {data: 'controls'}
                ],
                columnDefs: [
                    {className: 'text-center', "targets": [0]},
                    {className: 'text-center', "targets": [1]},
                    {className: 'text-center', "targets": [2]},
                    {className: 'text-center', "targets": [3]},
                    {className: 'text-center', "targets": [4]},
                    {className: 'text-center', "targets": [5]},
                    {className: 'text-center', "targets": [6]}
                ],
                order: [[0, 'desc']],
                buttons: [
                    //'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                stateSave: false,
                // stateSaveCallback: function (settings, data) {
                //     localStorage.setItem('invoice_' + settings.sInstance, JSON.stringify(data));
                // },
                // stateLoadCallback: function (settings) {
                //     return JSON.parse(localStorage.getItem('invoice_' + settings.sInstance));
                // }
            });
            // $('body').on('click', '#refreshInvoices', function () {
            //     dt.ajax.reload();
            // });
            $('body').on('change', '#quote_status', function () {
                dt.ajax.reload();
            });
        }
    },
}

$(function (){
    quote.init();
});
