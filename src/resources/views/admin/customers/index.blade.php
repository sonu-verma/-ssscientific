@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
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
                                <a href="{{ route('create.customer') }}" class="pull-right btn btn-primary" >Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="customersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="subj_name">Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                    <tr>
                                            <td class="subj_name">{{ $customer->id }}</td>
                                            <td>{{ $customer->full_name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone_number }}</td>
                                            <td>{{ $customer->status }}</td>
                                            <td>{{ $customer->created_at }}</td>
                                            <td>
                                                @php
                                                    $buttons = [
                                                        'trash' => [
                                                            'label' => 'Delete',
                                                            'attributes' => [
                                        //                        'id' => $property->id.'_view',
                                                                'href' => route('delete.customer', ['user' => $customer->id]),
                                                            ]
                                                        ],
                                                        'edit' => [
                                                            'label' => 'Edit',
                                                            'attributes' => [
                                                                'href' => route('edit.customer', ['user' => $customer->id]),
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

    var isMessage = "{{ session('customerMsg') }}";
    if(isMessage){
        messages.saved("Customer", isMessage);
    }

  $(function () {
    $("#customersTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#customersTable_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
