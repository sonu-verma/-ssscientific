@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                                <a href="{{ route('create.product') }}" class="pull-right btn btn-primary" >Add</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="productTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="subj_name">Id</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>SKU</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                            <td class="subj_name">{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category?$product->category->category_name:'NA' }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->slug }}</td>
                                            <td>{{ status($product->status) }}</td>
                                            <td>
                                                @php
                                                    $buttons = [
                                                        'trash' => [
                                                            'label' => 'Delete',
                                                            'attributes' => [
                                        //                        'id' => $property->id.'_view',
                                                                'href' => route('delete.product', ['product' => $product->id]),
                                                            ]
                                                        ],
                                                        'edit' => [
                                                            'label' => 'Edit',
                                                            'attributes' => [
                                                                'href' => route('edit.product', ['product' => $product->id]),
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

    var productSuccessMsg = "{{ session('productSuccessMsg') }}";
    var productErrorMsg = "{{ session('productErrorMsg') }}";
    if(productSuccessMsg){
        messages.saved("Product", productSuccessMsg);
    }

    if(productErrorMsg){
        messages.error("Product", productErrorMsg);
    }

  $(function () {
    $("#productTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#productTable_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
