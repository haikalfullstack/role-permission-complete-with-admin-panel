@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Permission </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Permission </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                <form id="myForm" method="post" action="{{ route('update.permission') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $permission->id }}">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Permission Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $permission->name }}" />
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Group Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="group_name" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option selected="">Open this select Group</option>
                                                <option value="add_enquiry"
                                                    {{ $permission->group_name == 'add_enquiry' ? 'selected' : '' }}>Add
                                                    Enquiry</option>
                                                <option
                                                    value="enquiry_status"{{ $permission->group_name == 'enquiry_status' ? 'selected' : '' }}>
                                                    Enquiry Status</option>
                                                <option
                                                    value="quotation_requisite"{{ $permission->group_name == 'quotation_requisite' ? 'selected' : '' }}>
                                                    Quotation Requisite</option>
                                                <option
                                                    value="quotation_rental"{{ $permission->group_name == 'quotation_rental' ? 'selected' : '' }}>
                                                    Quotation Rental</option>
                                                <option
                                                    value="'credit_approval"{{ $permission->group_name == 'credit_approval' ? 'selected' : '' }}>
                                                    Credit Approval</option>
                                                <option
                                                    value="booking_confirms"{{ $permission->group_name == 'booking_confirms' ? 'selected' : '' }}>
                                                    Booking Confirms</option>
                                                <option
                                                    value="vehichle_requisite"{{ $permission->group_name == 'vehichle_requisite' ? 'selected' : '' }}>
                                                    Vehichle Requisite</option>
                                                <option
                                                    value="customer_agreement"{{ $permission->group_name == 'customer_agreement' ? 'selected' : '' }}>
                                                    Customer Agreement</option>
                                                <option
                                                    value="add_rate_database"{{ $permission->group_name == 'add_rate_database' ? 'selected' : '' }}>
                                                    Add Rate Database</option>
                                                <option
                                                    value="order"{{ $permission->group_name == 'awd_code' ? 'selected' : '' }}>
                                                    AWD Code</option>
                                                <option
                                                    value="voucher"{{ $permission->group_name == 'voucher' ? 'selected' : '' }}>
                                                    Voucher</option>
                                                <option
                                                    value="partnership"{{ $permission->group_name == 'partnership' ? 'selected' : '' }}>
                                                    Partnership</option>
                                                <option
                                                    value="inventory"{{ $permission->group_name == 'inventory' ? 'selected' : '' }}>
                                                    Inventory</option>
                                                <option
                                                    value="job_requisition"{{ $permission->group_name == 'job_requisition' ? 'selected' : '' }}>
                                                    Job Requisition</option>
                                                <option
                                                    value="fleet_database"{{ $permission->group_name == 'fleet_database' ? 'selected' : '' }}>
                                                    Fleet Database</option>
                                                <option
                                                    value="credit_note"{{ $permission->group_name == 'credit_note' ? 'selected' : '' }}>
                                                    Blog</option>
                                                <option
                                                    value="debit_note"{{ $permission->group_name == 'debit_note' ? 'selected' : '' }}>
                                                    Role</option>
                                                <option
                                                    value="manage_debtor"{{ $permission->group_name == 'manage_debtor' ? 'selected' : '' }}>
                                                    Manage Debtor</option>
                                                <option
                                                    value="payment_claim"{{ $permission->group_name == 'payment_claim' ? 'selected' : '' }}>
                                                    Payment Claim</option>
                                                <option
                                                    value="debtor_database"{{ $permission->group_name == 'debtor_database' ? 'selected' : '' }}>
                                                    Debtor Database</option>
                                                <option
                                                    value="customer_enquiry"{{ $permission->group_name == 'customer_enquiry' ? 'selected' : '' }}>
                                                    Customer Enquiry</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                        </div>
                                    </div>
                            </div>

                            </form>



                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Permission Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
