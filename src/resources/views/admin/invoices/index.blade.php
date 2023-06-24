@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoices</li>
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
                            <div class="pull-right">
                                <a href="{{ route('create.invoice') }}" class="pull-right btn btn-primary" >Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="invoiceTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="subj_name">Id</th>
                                    <th>Invoice No</th>
                                    <th>Quote No</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
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
    <script>

        var invoiceSuccessMsg = "{{ session('invoiceSuccessMsg') }}";
        var invoiceErrorMsg = "{{ session('invoiceErrorMsg') }}";
        if(invoiceSuccessMsg){
            messages.saved("Invoice", invoiceSuccessMsg);
        }

        if(invoiceErrorMsg){
            messages.error("Invoice", invoiceErrorMsg);
        }
    </script>
@endsection
