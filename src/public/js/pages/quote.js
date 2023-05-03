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

var itemlist = {
    add:function (e, url, combination_sku,product_sku) {
        var $tr = $(e).closest('tr');

        if($tr.find('._Qty').val()==''){
            messages.error('Required','Please enter qty of product');
            $tr.find('._Qty').focus();
            return;
        }
        if($tr.find('._AssetValue').val()==''){
            messages.error('Required','Please enter purchase cost');
            $tr.find('._AssetValue').focus();
            return;
        }

        var productId = $tr.find('._productId').val();
        var qty = $tr.find('._Qty').val();
        var assetValue=$tr.find('._AssetValue').val();
        var originalAssetValue=$('._originalAssetValue').val();

        $.post(url, {
            quote_id: $('#quote_id').val(),
            productId: productId,
            quantity: qty,
            assetValue:assetValue,
            originalAssetValue:originalAssetValue
        }, function(data){
            console.log('data ',data);
            return false;
            messages.saved('','Item added successfully');
            itemlist.refreshView();
        });

    },
    refreshView:function(url, e){
        // if(typeof url === typeof undefined){
        //     url = itemsUrl;
        // }
        if(typeof e === typeof undefined || !$(e).length){
            e = '.cartItemsBlock';
        }
        var quote_id = $('#quote_id').val();
        itemsUrl = '/quote/items/'+quote_id;
        $.get(itemsUrl, function(data){
            $(e).html(data.html);
        });
    },
    deleteRow:function(e, url, productinventoryid){
        if(confirm('Are you sure want to delete this Product? If you delete this product, it cannot be restored.')) {
            $.post(url, {
                productinventoryid: productinventoryid
            }, function (data) {
                messages.saved('', 'Item deleted successfully');
                itemlist.refreshView();
            });
        }
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
    initializeCustomerSelect2();
    initializeProductSelect2();
    itemlist.refreshView();
});

function initializeCustomerSelect2(){
    $('#quoteCustomer').select2({
        ajax: {
            url: "/user/details",
            dataType: 'json',
            delay: 250,
            method: 'post',
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data, params) {
                console.log('data',data);
                console.log('params',params);
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        page: (params.page * data.per_page) < data.total
                    }
                };
            },
            cache: false
        },
        minimumInputLength: 1,
        dropdownParent: $('#quoteForm'),
        templateResult: function (user) {
            console.log('user',user);
            if (!user.id) {
                return user.first_name + ' ' + user.last_name;
            }
            var $state = $(
                '<span clas="user-list">' + user.first_name + ' ' + user.last_name + '(<em>' + user.email + '</em>)</span>'
            );
            return $state;
        },
        templateSelection: function (user) {
            console.log('user 1',user);
            if (!user.id) {
                return 'Select User';
            }
            var $state = $(
                '<span>' + user.full_name + ' (' + user.email + ')</span>'
            );
            if (typeof user.full_name === typeof undefined && typeof user.email === typeof undefined) {
                $state = $(
                    '<span>' + user.text + '</span>'
                );
            }

            return $state;
        }
    });
}

function initializeProductSelect2(){
    $('#ddlProducts').select2({
        ajax: {
            url: "/ajax/products",
            dataType: 'json',
            delay: 250,
            method: 'get',
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data, params) {
                console.log('data',data);
                console.log('params',params);
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        page: (params.page * data.per_page) < data.total
                    }
                };
            },
            cache: false
        },
        minimumInputLength: 1,
        dropdownParent: $('#productForm'),
        templateResult: function (product) {
            console.log('product',product);
            if (!product.id) {
                return product.name;
            }
            var $state = $(
                '<span clas="user-list">' + product.name + '</span>'
            );
            return $state;
        },
        templateSelection: function (product) {
            console.log('user 1',product);
            if (!product.id) {
                return 'Select Product';
            }
            var $state = $(
                '<span>' + product.name + '</span>'
            );
            if (typeof product.name === typeof undefined) {
                $state = $(
                    '<span>' + product.text + '</span>'
                );
            }

            return $state;
        }
    });
}

function getUserDetails(val,type, isUpdate = false){
    $.ajax({
        type: 'get',
        url: "/user/info",
        data: {id:val},
        success: function (data) {
            console.log('data',data)
            if(data.email){
                $('#email').val(data.email);
            }
            if(data.phone_number){
                $('#phone_number').val(data.phone_number);
            }
        }
    });
}
function searchProduct(val,type, isUpdate = false){
    var sku = val;
    if(sku=='' || sku==null){
        return false;
    }
    $('.productResultContainer').html('<p>Loading...</p>');
    $.ajax({
        type: 'get',
        url: "/ajax/product",
        data: {id:val},
        success: function (data) {
            console.log('data',data)
            $('.productResultContainer').html(data);
        }
    });
}
