
    <div class="row">
        <div class="col-md-6">
            <h6>Product Name</h6>
        </div>
    </div>
    <!-- Combinations -->
    <div class="row">
        <div class="col-md-12">
            <table id="widget-product-list productCombinationTable"
                   class="table dt-responsive nowrap" width="100%"
                   cellspacing="0">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Combination</th>
                    <th>Quantity</th>
                    <th>No. Of Box</th>
                    <th>Asset Value</th>
                    <th>{{--Action--}}</th>
                </tr>
                </thead>
                <tbody>
                    <?php $cnt=1;?>
                        <tr id="tr<?php echo $cnt;?>">
                            <td>
                                SKU
                            </td>
                            <td>
                                Info
                            </td>
                            <td><input type="text" class="form-control _Qty" value="1" style="width:50px;"></td>
                            <td><input type="text" class="form-control _NoOfBox" value="1"></td>
                            <td><input type="text" class="form-control _AssetValue" value=""></td>
                            <td>
                                <button type="button"
                                        class="btn btn-mini btn-primary m-r-15 f-18"
{{--                                        onclick="itemlist.add(this, '{{route('purchase.additem')}}', 'sku','{{$product->sku}}')"--}}
                                >
                                    <i class="icofont icofont-plus"></i> Add
                                </button>
                            </td>
                        </tr>
                        <?php $cnt++;?>
                </tbody>
            </table>
        </div>
    </div>
{{--@else--}}
{{--    <div class="alert alert-info">--}}
{{--        <strong>Not Found!</strong>--}}
{{--    </div>--}}
{{--@endif--}}
