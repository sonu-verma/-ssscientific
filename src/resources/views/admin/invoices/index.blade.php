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
                                        <th>PO No</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->invoice_no }}</td>
                                            <td>{{ $invoice->quote->quote_no }}</td>
                                            <td>{{ $invoice->purchaseOrder->po_no }}</td>
                                            <td>{{ status($invoice->status) }}</td>
                                            <td>{{ date('d-M-Y', strtotime($invoice->created_at)) }}</td>
                                            <td>
                                                @php
                                                    $buttons = [
                                                        'trash' => [
                                                            'label' => 'Delete',
                                                            'attributes' => [
                                        //                        'id' => $property->id.'_view',
                                                                'href' => route('delete.invoice', ['invoice' => $invoice->id]),
                                                            ]
                                                        ],
                                                        'edit' => [
                                                            'label' => 'Edit',
                                                            'attributes' => [
                                                                'href' => route('edit.invoice', ['invoice_id' => $invoice->id]),
                                                            ]
                                                        ],
                                                        'download' => [
                                                            'label' => 'Download',
                                                            'attributes' => [
                                                                'href' => route('invoice.download',['invoice_id' => $invoice->id,'type'=>'pdf']),
                                                                'target' => '_blank'
                                                            ]
                                                        ]
                                                    ];
                                                @endphp
                                                {!! table_buttons($buttons, false) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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

        $(function () {
            $("#invoiceTable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#invoiceTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
