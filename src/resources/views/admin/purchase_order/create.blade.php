@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Purchase Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add User</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form name="poForm" id="poForm" action="{{ route('store.purchaseOrder') }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="proposal-boxx--View">
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4" style="text-align: left;">
                                            <label class="">Select Vendor<span class="validateClass">*</span></label>
                                            <select data-resource="vendor"
                                                    class="form-control"
                                                    style="width: 100%;"
                                                    name="vendor"
                                                    id="vendorUser"
                                                    data-parent="#poForm"
                                                    onchange="return getVendorDetails(this.value,1)"
                                                    required>
                                                <option value="">Select Vendor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone_number">ATTN:</label>
                                            <input type="text" name="attn_no" id="attn_no" class="form-control fixedOption" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="relation">Status:</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">Select Option</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row  " style=" margin-top: 19px;">
                                        <div class="col-md-12">
                                            <select class="form-control select2bs4" data-resource="product" data-parent="#addVendorProduct" style="width: 100%;" name="product[]" id="ddlVendorProducts" onchange="return searchVendorProduct(this.value,1)" multiple>
                                                <option value="">Select Product</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right customerFormBtn" id="customerFormBtn" data-type="save">Submit</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('pageScript')
    <script src="{{ asset('/js/pages/purchase_order.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
