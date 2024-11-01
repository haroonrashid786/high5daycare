@extends('layouts.app')
@section('title', 'Generate Invoice | Admin | High5 Daycare')
@section('content')

<style>
    .invoice-container {
        box-shadow: 1px 1px 10px -4px rgba(0, 0, 0, 0.329);
        padding: 3rem;
        background: #ffffff;
    }

    .invoice-header-row1 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(6, 138, 138, 0.616);
        padding-bottom: 0.625rem;
    }

    .invoice-header-row1>h2 {
        font-size: 1.5rem;
        font-weight: 300;
        color: rgb(29, 29, 29)
    }

    .invoice-header-row2 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 2rem;
    }

    .invoice-header-row2>.right {
        display: flex;
        align-items: center;
        gap: 2rem;
        text-align: right;
    }

    .invoice-header-logo {
        width: 10rem;
    }

    .invoic-table-heading {
        text-align: center;
        border-bottom: 1px solid rgb(0, 0, 0) !important;
        padding-bottom: 0.625rem;
    }

    .table-row {
        border-bottom: 1px solid rgba(6, 122, 122, 0.507) !important;
        padding: 10px 0 !important;
    }

    .table-input {
        background: transparent;
        border: none;
        outline: none;
        padding: 4px;
        width: 160px;
    }

    .table-heading {
        color: orange;
        font-weight: 800 !important;
    }

    .colSpan3 input {
        width: 100%;
    }

    .table-last-row {
        border-bottom: 1px solid rgb(0, 0, 0) !important;
    }

    .table-wrap {
        overflow-x: scroll;
    }

    table {
        min-width: 800px;
    }
</style>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-stack flex-row-fluid">
                <!--begin::Toolbar container-->
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Toolbar wrapper-->
                    <!--begin::Page title-->
                    <div class="page-title d-flex align-items-center me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Invoice</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise') href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole class="text-white text-hover-primary">
                                <img src="{{asset('assets/media/Home.svg')}}" class="" alt="" />
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <i class="ki-outline ki-right fs-7 text-[#fff] mx-n1"></i>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white">Invoice</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->

            <div class="invoice-container">
                <div class="invoice-header">
                    <div class="invoice-header-row1">
                        <img src="{{ asset('assets/media/logos/High5_Daycare_Logo.png') }}" class="invoice-header-logo" alt="logo" />
                        <h2 class="">Invoice Detail</h2>
                    </div>
                    <div class="invoice-header-row2">
                        <div class="left">
                            <!-- <h3 class="">High5 Daycare Inc </h3> -->
                            <!-- <p class="">Licensed Home Childcare <br> 1434 Orr Terrace, Milton </p> -->
                        </div>
                        <div class="right">
                            <div class="">
                                <p class="">DATE:</p>
                                <p class="">INVOICE #: </p>
                                <p class="">Kid ID:</p>
                            </div>
                            <div class="">
                                <p>{{ isset($invoice->date) ? \Carbon\Carbon::parse($invoice->date)->format('F j, Y') : \Carbon\Carbon::parse($invoice->created_at)->format('F j, Y')  }}</p>
                                <p>{{ $invoice->invoice_number }}</p>
                                <p>{{ optional($invoice->kid)->code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h4 class="">{{ optional($invoice->parent)->name }}</h4>
                    <p class="">{{ optional($invoice->parent)->address }}</p>
                </div>
                <div class="invoic-table-container">
                    <h4 class="invoic-table-heading">Invoice detail for {{ \Carbon\Carbon::parse($invoice->created_at)->format('F,Y') }}</h4>

                    <div class="table-wrap">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-row">
                                    <th class="table-heading" scope="col">Kid Name </th>
                                    <th class="table-heading" scope="col">No of day</th>
                                    <th class="table-heading" scope="col">Rate</th>
                                    <th class="table-heading" scope="col">AMOUNT CAD </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($invoice) && !empty($invoice->invoiceData) && count($invoice->invoiceData) > 0)
                                @foreach ($invoice->invoiceData as $item)
                                @if($item->isSubsidized)

                                <tr class="table-row">
                                    <th scope="row"><input type="text" name="" id="" class="table-input" value="{{ ucFirst(optional($item->kid)->full_name) }}" readonly></th>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->presence_count }}" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->kid_rate_for_non_subsidized_days }}" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->presence_count * $item->kid_rate_for_non_subsidized_days }}" readonly></td>
                                </tr>

                                <tr class="table-row">
                                    <th scope="row"><input type="text" name="" id="" class="table-input" value="Less: Subsidized Amount" readonly></th>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->subsidized_days }}" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->kid_rate_for_subsidized_days }}" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->kid_rate_for_subsidized_days * $item->subsidized_days }}" readonly></td>

                                </tr>
                                @else
                                <tr class="table-row">
                                    <th scope="row"><input type="text" name="" id="" class="table-input" value="{{ ucFirst(optional($item->kid)->full_name) }}" readonly></th>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->presence_count }}" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->kid_rate }}" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $item->kid_total }}" readonly></td>

                                </tr>
                                @endif

                                @endforeach
                                @endif

                                @if(isset($invoice->registeration_fee) && !empty($invoice->registeration_fee))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3"><input type="text" name="" id="" class="table-input" value="Kid Registration Fee"></th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{$invoice->registeration_fee}}"></td>
                                </tr>
                                @endif

                                @if(isset($invoice->security_deposit) && !empty($invoice->security_deposit))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3"><input type="text" name="" id="" class="table-input" value="Kid Security Deposit"></th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{$invoice->security_deposit}}"></td>
                                </tr>
                                @endif

                                @if(isset($invoice->subsidary_amount) && !empty($invoice->subsidary_amount))
                                <!-- <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Subsidary Amount</th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{ $invoice->subsidary_amount }}" readonly></td>
                                </tr> -->
                                @endif


                                @if(isset($invoice->funds) && !empty($invoice->funds) && count($invoice->funds) > 0)
                                @foreach($invoice->funds as $fund)
                                <tr class="table-row">
                                    <th scope="row"><input type="text" name="" id="" class="table-input" value="{{ $fund->name }}" readonly></th>
                                    <td><input type="number" name="" id="" class="table-input" value="" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="" readonly></td>
                                    <td><input type="number" name="" id="" class="table-input" value="{{ $fund->amount }}" readonly></td>

                                </tr>

                                @endforeach
                                @endif


                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Sub Total</th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{ $invoice->grand_total }}" readonly></td>
                                </tr>
                                <!-- <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3"><input type="text" name="" id="" class="table-input" value="Less : Ministry Share" readonly></th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{ $invoice->ministry_amount }}" readonly></td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Grand Total</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" value="{{ $invoice->grand_total }}"></td>
                                </tr> -->


                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3"><input type="text" name="modified_description" id="modified_description" class="table-input" value="{{ $invoice->modified_description }}" placeholder="Enter description for adding or subtracting any amount"></th>
                                    <td><input type="number" name="modified_amount" id="modified_amount" class="table-input" value="{{ $invoice->modified_amount }}" placeholder="123"> <button type="button" class="btn btn-primary btn-sm" onclick="modifyInvoice()">Modify</button></td>
                                </tr>

                                {{-- <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">
                                        <select name="ministry_fund" id="ministry_fund" class="table-input">
                                            <!-- Populate the dropdown with Ministry Fund options from your table -->
                                            @php
                                            $ministryFunds = App\Models\FundingCategory::where('type','kids')->get();
                                            @endphp
                                            @if(isset($ministryFunds) && !empty($ministryFunds))
                                            <option value="">Select Fund</option>
                                            @foreach($ministryFunds as $fund)
                                            <option value="{{ $fund->name }}" @if(isset($invoice) && $invoice->added_ministry_fund_type == $fund->name) selected @endif>{{ $fund->name }}</option>
                                @endforeach
                                @endif
                                </select>
                                </th>
                                <td>
                                    <input type="number" name="ministry_fund_amount" id="ministry_fund_amount" class="table-input" value="{{ !empty($invoice->added_ministry_fund_amount) ? $invoice->added_ministry_fund_amount : '' }}" placeholder="Enter Amount">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addMinistryFund()">Add Fund</button>
                                </td>
                                </tr> --}}

                                @if(isset($invoice->kid) && !empty($invoice->kid))
                                @if(isset($invoice->kid->advance_payment) && !empty($invoice->kid->advance_payment))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">
                                        <input type="text" name="" id="" readonly class="table-input" value="Security Deposit">
                                    </th>
                                    <td>
                                        <input type="number" name="kid_security_deposit" id="kid_security_deposit" class="table-input" value="{{ !empty($invoice->kid->advance_payment) ? $invoice->kid->advance_payment : '' }}" placeholder="Kid Security Deposit">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addSecurityDeposit()">Adjust</button>
                                    </td>
                                </tr>
                                @endif
                                @endif

                                @if(isset($invoice->advance_payment) && !empty($invoice->advance_payment))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Less: Security Deposit</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" value="{{ $invoice->advance_payment }}"></td>
                                </tr>
                                @endif

                                @if(isset($invoice->previous_balance) && !empty($invoice->previous_balance))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Less: Previous Balance</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" value="{{ $invoice->previous_balance }}"></td>
                                </tr>
                                @endif

                                @if(isset($alreadyPaid) && !empty($alreadyPaid))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Already Paid</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" value="{{ $alreadyPaid }}"></td>
                                </tr>
                                @endif

                                @if(isset($invoice->balance) && !empty($invoice->balance))
                                <!-- <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Balance</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" value="{{ $invoice->balance }}"></td>
                                </tr> -->
                                @endif

                                @php
                           
                                $netAmount = round($invoice->net_amount,2);
                                
                                @endphp

                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Net Payment</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" @if(isset($invoice->balance) && !empty($invoice->balance)) value="- {{ $invoice->balance }}" @else value="{{ $netAmount }}" @endif></td>
                                </tr>
                                <tr class="table-row">
                                    @if(isset($netAmount) && $netAmount > 0)
                                    <th scope="row" colspan="4" class="colSpan3">
                                        @php
                                        $invoiceTotal = App\Helper\GlobalHelper::convertNumberToWords($netAmount, 'en', 'Dollars', 'Cents');
                                        @endphp
                                        <p class="">{{ ucfirst($invoiceTotal) }}</p>
                                    </th>
                                    @endif

                                </tr>
                                <tr class="table-row">
                                    <th scope="row" colspan="4" class="colSpan3 text-end">
                                        <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('send-email').submit();">
                                            <button class="btn btn-primary btn-sm ">Send as Email</button>
                                        </a>
                                        <a href="{{ route('view.invoice',['invoiceId' => $invoice->invoice_number, 'view_pdf' => 1]) }}" target="_blank">
                                            <button class="btn btn-primary btn-sm ">View as PDF</button>
                                        </a>
                                        <button class="btn-pay btn btn-sm btn-secondary text-white">Receive</button>

                                        <form id="send-email" action="{{ route('send.payment.email') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" value="invoice" name="type">
                                            <input type="hidden" value="{{ $invoice->invoice_number }}" name="number">
                                        </form>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div style="box-shadow: 1px 1px 10px -4px rgba(0, 0, 0, 0.329); padding: 3rem; background: #ffffff;">

                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(6, 138, 138, 0.616); padding-bottom: 0.625rem;">
                    <h2 style="font-size: 1.5rem; font-weight: 300; color: rgb(29, 29, 29);">Invoice</h2>
                </div>
        
                <h4 style="text-align: center; border-bottom: 1px solid rgb(0, 0, 0); padding-bottom: 0.625rem;">Payment detail for October 2023</h4>
        
                <div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid rgba(6, 122, 122, 0.507); padding: 10px 0;">
                                <th style="color:#eb6f45; font-weight: 800; padding: 10px;">Kid Name</th>
                                <th style="color:#eb6f45; font-weight: 800; padding: 10px;">No of day</th>
                                <th style="color:#eb6f45; font-weight: 800; padding: 10px;">Rate</th>
                                <th style="color:#eb6f45; font-weight: 800; padding: 10px;">AMOUNT CAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid rgba(6, 122, 122, 0.507); padding: 10px 0;">
                                <th style="padding: 10px;"><input type="text" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></th>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(6, 122, 122, 0.507); padding: 10px 0;">
                                <th style="padding: 10px;"><input type="text" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></th>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(6, 122, 122, 0.507); padding: 10px 0;">
                                <th style="padding: 10px;"><input type="text" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></th>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(6, 122, 122, 0.507); padding: 10px 0;">
                                <th style="padding: 10px;"><input type="text" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></th>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                                <td style="padding: 10px;"><input type="number" name="" id="" style="background: transparent; border: none; outline: none; padding: 4px; width: 160px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->
        </div>

        <!--end::Row-->
        <!--begin::Row-->

        <!--end::Row-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
<!--begin::Footer-->

<!--end::Footer-->
</div>

<script>
    // document.addEventListener('DOMContentLoaded', function() {

    const invoiceNumber = '{{ $invoice->invoice_number }}';

    function modifyInvoice() {
        // Get values from the form
        const description = document.getElementById('modified_description').value;
        const amount = parseFloat(document.getElementById('modified_amount').value);

        if (isNaN(amount) || amount === undefined || description.trim() === "") {
            Snackbar.show({
                pos: 'bottom-center',
                text: 'Please enter both amount and description.',
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff',
                duration: 100000,
            });
            return; // Stop further execution
        }

        const apiUrl = '{{ route("api.update-invoice", ["invoiceNumber" => ":invoiceNumber"]) }}'.replace(':invoiceNumber', invoiceNumber);
        console.log(apiUrl);
        // Make an API call to update the invoice
        fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    description: description,
                    amount: amount,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response, e.g., show a success message
                // console.log(data);
                Snackbar.show({
                    pos: 'bottom-center',
                    text: data.message,
                    backgroundColor: '#556d33',
                    actionTextColor: '#fff',
                    duration: 100000,
                });
                window.location.reload();

            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    }

    // });

    function addMinistryFund() {
        // Get values from the form
        const ministryFundName = document.getElementById('ministry_fund').value;
        const ministryAmount = parseFloat(document.getElementById('ministry_fund_amount').value);

        if (isNaN(ministryAmount) || ministryAmount === undefined || ministryFundName.trim() === "") {

            Snackbar.show({
                pos: 'bottom-center',
                text: 'Please select a Ministry Fund and enter an amount.',
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff',
                duration: 100000,
            });
            return; // Stop further execution
        }

        if (ministryAmount <= 0) {
            Snackbar.show({
                pos: 'bottom-center',
                text: 'Please enter a positive amount for the Ministry Fund.',
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff',
                duration: 100000,
            });
            return; // Stop further execution
        }

        const apiUrl = '{{ route("api.add-ministry-fund", ["invoiceNumber" => ":invoiceNumber"]) }}'.replace(':invoiceNumber', invoiceNumber);

        // Make an API call to add Ministry Fund to the invoice
        fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    ministry_fund_name: ministryFundName,
                    ministry_amount: ministryAmount,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response, e.g., show a success message
                Snackbar.show({
                    pos: 'bottom-center',
                    text: data.message,
                    backgroundColor: '#556d33',
                    actionTextColor: '#fff',
                    duration: 100000,
                });
                window.location.reload();
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    }

    function addSecurityDeposit() {
        const amountSecurityFund = document.getElementById('kid_security_deposit').value;
        const apiUrl = '{{ route("add.security.deposit", ["invoiceNumber" => ":invoiceNumber"]) }}'.replace(':invoiceNumber', invoiceNumber);
        // Make an API call to add Ministry Fund to the invoice
        fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    security_fund: kid_security_deposit,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response, e.g., show a success message
                Snackbar.show({
                    pos: 'bottom-center',
                    text: data.message,
                    backgroundColor: '#556d33',
                    actionTextColor: '#fff',
                    duration: 100000,
                });
                window.location.reload();
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add a click event listener to all Pay buttons
        const payButtons = document.querySelectorAll('.btn-pay');

        payButtons.forEach(button => {
            button.addEventListener('click', function() {

                const invoiceDate = '{{ $invoice->created_at->toDateString() }}';
                const kidId = '{{ $invoice->kid_id }}';
                const netAmount = '{{ $invoice->net_amount }}';

                Swal.fire({
                    title: 'Enter Received Amount and Date',
                    html: '<input id="swal-amount" class="swal2-input" placeholder="Received Amount" type="text">' +
                        '<input id="swal-date" class="swal2-input" placeholder="Payment Date" type="date">',
                    showCancelButton: true,
                    confirmButtonText: 'Pay',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const amount = Swal.getPopup().querySelector('#swal-amount').value;
                        const date = Swal.getPopup().querySelector('#swal-date').value;

                        const isValidAmount = /^\d+(\.\d{1,2})?$/.test(amount);
                        const amountValue = parseFloat(amount);

                        if (
                            isNaN(amountValue) ||
                            amountValue == 0 ||
                            amountValue > 100000 ||
                            !date
                        ) {
                            Swal.showValidationMessage('Invalid amount or date. Please enter valid values.');
                            return false;
                        }

                        // Perform AJAX request to update payment
                        return fetch(`{{ route('pay.invoice') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    invoiceDate: invoiceDate,
                                    kid_id: kidId,
                                    amount: amount,
                                    net_amount: netAmount,
                                    payment_date: date,
                                }),
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText);
                                }
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error}`);
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading(),
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Payment Successful',
                            text: `Amount Received: $${result.value.paidAmount}`,
                            icon: 'success',
                        }).then(() => {
                            // Reload the page
                            location.reload();
                        });
                    }
                });
            });
        });
    });
</script>
@endsection