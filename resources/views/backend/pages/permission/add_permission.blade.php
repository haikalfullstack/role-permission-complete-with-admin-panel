@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Permission </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Permission </li>
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

                                <form id="myForm" method="post" action="{{ route('store.permission') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Permission Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control" />
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
                                                <option value="add_enquiry">Add Enquiry</option>
                                                <option value="enquiry_status">Enquiry Status</option>
                                                <option value="quotation_requisite">Quotation Requisite</option>
                                                <option value="quotation_rental">Quotation Rental</option>
                                                <option value="credit_approval">Credit Approval</option>
                                                <option value="booking_confirms">Booking Confirms</option>
                                                <option value="vehichle_requisite">Vehicle Requisite</option>
                                                <option value="customer_agreement">Customer Agreement</option>
                                                <option value="add_rate_database">Add Rate Database</option>
                                                <option value="awd_code">AWD Code</option>
                                                <option value="voucher">Voucher</option>
                                                <option value="partnership">Partnership</option>
                                                <option value="inventory">Inventory</option>
                                                <option value="job_requisition">Job Requisition</option>
                                                <option value="fleet_database">Fleet Database</option>
                                                <option value="credit_note">Credit Note</option>
                                                <option value="debit_note">Debit Note</option>
                                                <option value="manage_debtor">Manage Debtor</option>
                                                <option value="payment_claim">Payment Claim</option>
                                                <option value="debtor_database">Debtor Database</option>
                                                <option value="customer_enquiry">Customer Enquiry</option>

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
