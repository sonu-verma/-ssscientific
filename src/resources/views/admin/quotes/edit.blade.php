@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quote</li>
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
                            <h5>Proposal Request Form</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form name="quoteForm" id="quoteForm" action="{{ route('quote.update',['quote' => $model->id]) }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <input type="hidden" id="quote_id" name="quote_id" value="{{ $model->id }}">
                                <h6 class="title_in_caps" style="margin-bottom: 9px !important;">Customer Information:</h6>
                                <div class="proposal-boxx--View">
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4" style="text-align: left;margin-top: 9px;">
                                            <label class="">Select Primary Customer<span class="validateClass">*</span></label>
                                            <select data-resource="user"
                                                    class="form-control"
                                                    style="width: 100%;"
                                                    name="id_user"
                                                    id="quoteCustomer"
                                                    data-parent="#quoteForm"
                                                    onchange="return getUserDetails(this.value,1)"
                                                    required>
                                                <option value="">Select customer</option>
                                                @if(isset($model->user))
                                                    <option value="{{$model->user->id}}"
                                                            selected>{{$model->user->getFullname()}}
                                                        ({{$model->user->email}})
                                                    </option>
                                                @endif
                                            </select>
{{--                                            <select data-resource="user" style="width: 100%;" name="id_user" id="ddlUser" data-parent="#addQuote" style="width: 100%;">--}}
{{--                                                <option value="2" >Alaska</option>--}}
{{--                                                <option value="1" {{ $model->id_user == 1?'selected':'' }}>Alaska</option>--}}
{{--                                            </select>--}}
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4">
                                            <label for="phone_number">Phone Number:</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control fixedOption"  value="{{ $model->phone_number }}" required>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 2px;">
                                            <label for="email">E-Mail Address:<span class="validateClass">*</span></label>
                                            <input type="email" name="email" id="email"  value="{{ $model->email }}" class="form-control fixedOption">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="relation">Relationship to the property:<span class="validateClass">*</span></label>
                                            <select name="relation" id="relation" class="form-control fixedOption" required>
                                                <option value="">Select Option</option>
                                                <option value="Owner" {{ $model->related == 'Owner'?'selected':'' }}>Owner</option>
                                                <option value="Agent"  {{ $model->related == 'Agent'?'selected':'' }}>Agent</option>
                                                <option value="Developer"  {{ $model->related == 'Developer'?'selected':'' }}>Developer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="title_in_caps">
                                    Staging Address:
                                </h6>
                                <div class="proposal-boxx--View">
                                    <div class="row">
                                        <div class="col-md-8 margin-bottom-20">
                                            <label for="property_address">Street Address:<span class="validateClass">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ $model->address }}" required>

                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4">
                                            <label for="apt_no">Apt No<span class="noValidateClass">(optional)</span></label>
                                            <input type="text" class="form-control" name="apt_no" id="apt_no" value="{{ $model->apt_no }}" placeholder="Apt No">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city">City<span class="validateClass">*</span></label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $model->city }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="zipcode">Zipcode<span class="validateClass">*</span></label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode" value="{{ $model->zipcode }}" placeholder="Zipcode" required>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4" style="clear: both">
                                            <label class="" for="state">State<span class="validateClass">*</span></label>
                                            <select class="form-control" id="state" name="state">
                                                <option value="">Select State</option>
                                                <option value="1" {{ $model->state == 1?'selected':'' }}>MH</option>

                                            </select>
                                            <span class="text-danger" id="state_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="" style="display:flex">
                                    <span class="title_in_caps">Billing Address:</span><span class="noValidateClass">(optional)</span>&nbsp;
                                    <div class="icheck-primary d-inline billingCheckbox">
                                        <input type="checkbox" name="billingChk" id="billingChk"
                                               onclick="fillBillingAddress()" class="" {{ $model->billing_option?'checked':'' }}>
                                        <label for="billingChk">
                                            <span>Same as Staging Address</span>
                                        </label>
                                    </div>
                                </h6>
                                <div class="proposal-boxx--View">
                                    <div class="row">
                                        <div class="col-md-8 margin-bottom-20">
                                            <label for="billing_address">Billing Street Address:</label>
                                            <input type="text" class="form-control" name="billing_address" id="billing_address" value="{{ $model->billing_address }}" placeholder="Address" required>

                                        </div>
                                    </div>

                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4">
                                            <label for="billing_apt_no">Billing Apt No</label>
                                            <input type="text" class="form-control" name="billing_apt_no" id="billing_apt_no" value="{{ $model->billing_apt_no }}" placeholder="Billing Apt No">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="billing_city">Billing City<span class="validateClassOption">*</span></label>
                                            <input type="text" class="form-control" name="billing_city" id="billing_city" value="{{ $model->billing_city }}"  placeholder="Billing City" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="billing_zipcode">Billing Zipcode<span class="validateClassOption">*</span></label>
                                            <input type="text" class="form-control" name="billing_zipcode" id="billing_zipcode" value="{{ $model->billing_zipcode }}"  placeholder="Billing Zipcode" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4" style="clear: both">
                                            <div class="form-group">
                                                <label class="">Billing State<span class="validateClassOption">*</span></label>
                                                <input type="text" name="billing_state" id="billing_state" value="{{ $model->billing_state }}"  class="form-control">
                                            </div>
                                            <span class="text-danger" id="billing_state_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="title_in_caps">Miscellaneous Information:</h6>
                                <div class="proposal-boxx--View">
                                    <div class="form-group margin-bottom-20  m-t-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="reference_from" style="min-height: 33px">How did you hear about PRHS?<span class="noValidateClass">(optional)</span></label>
                                                <input type="text" name="reference_from"  value="{{ $model->reference_from }}" id="reference_from" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="referral_person" style="min-height: 33px">Who referred us to you?<span class="noValidateClass">(optional)</span><br> (Name)</label>
                                                <input type="text" name="referral"  value="{{ $model->referral }}" id="referral" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="referral_agency">Which agency?<span class="noValidateClass">(optional)</span></label>
                                                <input type="text" name="referral_agency"  value="{{ $model->referral_agency }}" id="referral_agency" class="form-control" style="margin-top: 14px;" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="is_enquired">Is previously enquired?<span class="noValidateClass">(optional)</span></label>
                                                <input type="text" name="is_enquired" id="is_enquired" class="form-control" value="{{ $model->is_enquired }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="notes">Proposal Request Notes<span class="noValidateClass">(optional)</span></label>
                                                <textarea cols="10" rows="5" class="form-control" id="notes" name="notes" aria-describedby="emailHelp" placeholder="Notes">{{ $model->notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right quoteFormBtn quoteNewForm" id="quoteFormBtn" data-type="save">Submit</button>
                                <button type="submit" class="btn btn-primary modalClose" data-dismiss="modal" aria-label="Close" >Cancel</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Product</h5>
                        </div>
                        <div class="card-body">
                            <form name="productForm" id="productForm" action="{{ route('quote.create') }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="proposal-boxx--View">
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-6" style="text-align: left;">
                                            <select class="form-control select2bs4" data-resource="product" data-parent="#addProduct" style="width: 100%;" name="sku" id="ddlProducts" onchange="return searchProduct(this.value,1)">
                                                <option value="">Select Product</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="productResultContainer"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Added Items</h5>
                        </div>
                        <div class="card-block">
                            <div class="cartItemsBlock">

                            </div>
                            <div class="btnRowList">
                                <button class="btn pull-right m-l-10 btn btn-success"
                                        type="button">Send Proposal to Internal
                                </button>
                                <button class="btn btn-primary pull-right m-l-10" type="button"
                                        id="update_proposal">View Proposal
                                </button>
                                <button class="btn btn-success pull-right m-l-10 approvedButton"
                                        type="button" data-toggle="modal" data-target="#confirmApprovalModal">Approve Proposal
                                </button>
                                <a class="btn btn-primary pull-right m-l-10" id="proposalDownload1"
                                   target="_blank" href="{{ route('quote.download',['quote_id' => $model->id]) }}">Download Proposal</a>
                                <button class="btn pull-right m-l-10 btn btn-success"
                                        type="button">Send Proposal to Customer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('pageScript')
    <script src="{{ asset('/js/pages/quote.js') }}"></script>
    <script>
        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // })
    </script>
@endsection
