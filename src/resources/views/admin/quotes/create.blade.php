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
                        <li class="breadcrumb-item active">DataTables</li>
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
                            <form name="quoteForm" id="quoteForm" action="{{ route('quote.create') }}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <h6 class="title_in_caps" style="margin-bottom: 9px !important;">Customer Information:</h6>
                                <div class="proposal-boxx--View">
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4" style="text-align: left;margin-top: 9px;">
                                            <label class="">Select Primary Customer<span class="validateClass">*</span></label>
{{--                                            <select data-resource="user" style="width: 100%;" name="id_user" id="ddlUser" data-parent="#addQuote"--}}
{{--                                                    onchange="return getUserDetails(this.value,1)"  --}}
{{--                                                    required>--}}
{{--                                                <option value="">Select customer</option>--}}
{{--                                                <option value="1">Sonu Verma</option>--}}
{{--                                            </select>--}}
                                            <select class="form-control select2bs4"  data-resource="user" style="width: 100%;" name="id_user" id="ddlUser" data-parent="#addQuote" style="width: 100%;">
                                                <option value="1">Alaska</option>
                                                <option value="1">California</option>
                                                <option value="1">Delaware</option>
                                                <option value="1">Tennessee</option>
                                                <option value="1">Texas</option>
                                                <option value="1">Washington</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                    <div class="col-md-4">
                                        <label for="phone_number">Phone Number:</label>
                                        <input type="number" name="phone_number" id="phone_number" class="form-control fixedOption" required>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 2px;">
                                        <label for="email">E-Mail Address:<span class="validateClass">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control fixedOption">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="relation">Relationship to the property:<span class="validateClass">*</span></label>
                                        <select name="relation" id="relation" class="form-control fixedOption" required>
                                            <option value="">Select Option</option>
                                            <option value="Owner">Owner</option>
                                            <option value="Agent">Agent</option>
                                            <option value="Developer">Developer</option>
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
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>

                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4">
                                            <label for="apt_no">Apt No<span class="noValidateClass">(optional)</span></label>
                                            <input type="text" class="form-control" name="apt_no" id="apt_no" placeholder="Apt No">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city">City<span class="validateClass">*</span></label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="zipcode">Zipcode<span class="validateClass">*</span></label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode" required>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                    <div class="col-md-4" style="clear: both">
                                        <label class="" for="state">State<span class="validateClass">*</span></label>
                                        <select class="form-control" id="state" name="state">
                                            <option value="">Select State</option>
                                            <option value="1">MH</option>

                                        </select>
                                        <span class="text-danger" id="state_error"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="" style="display:flex">
                                    <span class="title_in_caps">Billing Address:</span><span class="noValidateClass">(optional)</span>&nbsp;
                                    <div class="icheck-primary d-inline billingCheckbox">
                                        <input type="checkbox" name="billingChk" id="billingChk"
                                               onclick="fillBillingAddress()" class="">
                                        <label for="billingChk">
                                            <span>Same as Staging Address</span>
                                        </label>
                                    </div>
                                </h6>
                                <div class="proposal-boxx--View">
                                    <div class="row">
                                        <div class="col-md-8 margin-bottom-20">
                                            <label for="billing_address">Billing Street Address:</label>
                                            <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="Address" required>

                                        </div>
                                    </div>

                                    <div class="row margin-bottom-20">
                                        <div class="col-md-4">
                                            <label for="billing_apt_no">Billing Apt No</label>
                                            <input type="text" class="form-control" name="billing_apt_no" id="billing_apt_no" placeholder="Billing Apt No">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="billing_city">Billing City<span class="validateClassOption">*</span></label>
                                            <input type="text" class="form-control" name="billing_city" id="billing_city" placeholder="Billing City" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="billing_zipcode">Billing Zipcode<span class="validateClassOption">*</span></label>
                                            <input type="text" class="form-control" name="billing_zipcode" id="billing_zipcode" placeholder="Billing Zipcode" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-4" style="clear: both">
                                        <div class="form-group">
                                            <label class="">Billing State<span class="validateClassOption">*</span></label>
                                            <input type="text" name="billing_state" id="billing_state" class="form-control">
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
                                                <input type="text" name="reference_from" id="reference_from" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="referral_person" style="min-height: 33px">Who referred us to you?<span class="noValidateClass">(optional)</span><br> (Name)</label>
                                                <input type="text" name="referral" id="referral" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="referral_agency">Which agency?<span class="noValidateClass">(optional)</span></label>
                                                <input type="text" name="referral_agency" id="referral_agency" class="form-control" style="margin-top: 14px;" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="is_enquired">Is previously enquired?<span class="noValidateClass">(optional)</span></label>
                                                <input type="text" name="is_enquired" id="is_enquired" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="notes">Proposal Request Notes<span class="noValidateClass">(optional)</span></label>
                                            <textarea cols="10" rows="5" class="form-control" id="notes" name="notes" aria-describedby="emailHelp" placeholder="Notes"></textarea>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('pageScript')
    <script src="{{ asset('/js/pages/quote.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
