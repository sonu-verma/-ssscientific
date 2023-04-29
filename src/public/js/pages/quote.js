var quote = {
    listTable: '#quoteTable',
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
                    {data: 'property_address'},
                    {data: 'quote_no'},
                    {data: 'cust_info', className: 'text-center'},
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
    searchProduct:function (e) {
        alert('eres');
        var sku = $(e).val();
        sku = 'test'
        if(sku=='' || sku==null){
            return false;
        }
        var url = $(e).attr('data-action');
        // var state=$('#state').val();
        // purchase.disableSubmit(true);
        $('.productResultContainer').html('<p>Loading...</p>');
        $.get(url, {sku: sku}, function (date) {
            $('.productResultContainer').html(date);
            //$('.monthSwitch').trigger('change');
            // purchase.enableSubmit();
        }).error(function (data) {
            $('.productResultContainer').html(date);
        }).always(function () {
            // purchase.enableSubmit();
        });
        return false;
    },
}
$(document).on('click','#quoteFormBtn',function(e){
    e.preventDefault();
    var url = $('#quoteForm').attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: $('#quoteForm').serialize()+"&formType=",
        success:function(response){
            console.log("response =>", response);
            return false;
            if(response.status){
                messages.saved("Quote", response.message);
                $('#addQuote').modal('hide');
                $('#quoteForm')[0].reset();
                if(type == 'saveNext'){
                    console.log(adminUrl+'/prhsOrder/create?token='+response.token+'&quote_no='+response.quote_no);
                    window.location.href=adminUrl+'/prhsOrder/create?token='+response.token+'&quote_no='+response.quote_no;

                }else{
                    window.location.href=adminUrl+'/order/edit/quote/'+response.quoteId;
                }
                // window.location.reload();
            }else{
                $('.quoteFormBtn').prop('disabled', false);
                if(response.statusCode == 400){
                    var str = '';
                    $.each(response.errors, function(key, value) {
                        console.log('key,'+key);
                        if(key == 'id_second_user'){
                            console.log('isClass,'+$('#quoteFormBtn').hasClass('quoteNewForm'));
                            if($('#quoteFormBtn').hasClass('quoteNewForm')){
                                $('#'+key).after('<div class="quote-error" style="display: block;position: absolute;margin-top: 33px;line-height: 16px;">'+value[0]+'</div>');
                            }else{
                                $('#'+key).after('<div class="quote-error" style="display: block;position: absolute;margin-top: 33px;">'+value[0]+'</div>');
                            }

                        }else{
                            $('#'+key).after('<div class="quote-error">'+value[0]+'</div>');
                        }

                    });
                    $('.quote_error').html(str);
                }else{
                    messages.error('Error', response.message);
                }
                $('.nextQuoteBtn').attr('disabled', true);
                $('.nextQuoteBtn').addClass('fixedOption');
            }
        }
    });
});

function fillBillingAddress(){

    if($("#billingChk").prop('checked') == true){

        if($('#address').val() == '' || $('#zipcode').val() == '' || $('#city').val() == '' || $('#state').val() == ''){
            $('#billingChk').prop("checked",false);
            // messages.error("Billing Address", "Please enter staging address.");
            // return false;
        }

        $('#billing_address').val($('#address').val());
        $('#billing_apt_no').val($('#apt_no').val());
        $('#billing_zipcode').val($('#zipcode').val());
        $('#billing_city').val($('#city').val());
        $('#billing_state').val($( "#state option:selected" ).text());
    }else{
        $('#billing_address').prop('readonly',false);
        $('#billing_apt_no').prop('readonly',false);
        $('#billing_zipcode').prop('readonly',false);
        $('#billing_city').prop('readonly',false);
        $('#billing_state').prop('readonly',false);
    }
}

$(function (){
    quote.init();
});
