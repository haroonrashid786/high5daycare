@extends('layouts.app')
@section('title', 'Generate Vendor Payment | Admin | High5 Daycare')
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
        min-width: 900px;
    }

    @media (max-width: 540px) {
        .invoice-header-row2 {
            flex-wrap: wrap;
            gap: 20px;
            padding-bottom: 20px;

        }

        .invoice-header-row2>.right {
            text-align: left;
            gap: 5px;
        }
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
                            <span>Vendor Payment</span>
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
                        <li class="breadcrumb-item text-white">Vendor Payment</li>
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
                        <h2 class="">Vendor Payment Detail</h2>
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
                                <p class="">Service Provider ID:</p>
                            </div>
                            <div class="">
                                <p class="">{{ isset($payment->date) ? \Carbon\Carbon::parse($payment->date)->format('F j, Y') : \Carbon\Carbon::parse($payment->created_at)->format('F j, Y')  }}</p>
                                <p class="">{{ $payment->payment_number }}</p>
                                <p class="">{{ optional($payment->provider)->code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h4 class="">{{ ucfirst(optional($payment->provider)->name) }}</h4>
                    <p class="">{{ ucfirst(optional($payment->provider)->address) }}</p>
                </div>
                <div class="invoic-table-container">
                    <h4 class="invoic-table-heading">Vendor Payment detail for {{ \Carbon\Carbon::parse($payment->created_at)->format('F,Y') }}</h4>

                    <div class="table-wrap">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-row">
                                    <th class="table-heading" style="width: 250px;" scope="col">Description</th>
                                    <th class="table-heading" scope="col">No of day</th>
                                    <th class="table-heading" scope="col">Rate</th>
                                    <th class="table-heading" scope="col">AMOUNT CAD</th>
                                </tr>
                            </thead>
                            <tbody id="mainDiv">

                                @if(isset($payment) && !empty($payment) && isset($payment->paymentItems) && !empty($payment->paymentItems))
                                @foreach ($payment->paymentItems as $item)
                                @if(isset($item->kid) && !empty($item->kid))
                                <tr class="table-row">
                                    <th scope="row"><input type="text" style="width: 250px;" name="" id="" class="table-input" readonly value="{{ ucfirst(optional($item->kid)->full_name) }} @if($item->first_fortnight == 1) (First Fortnight) @elseif($item->second_fortnight == 1) (Second Fortnight) @endif"></th>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $item->no_of_days }}"></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $item->rate }}"></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $item->amount }}"></td>
                                </tr>
                                @endif
                                @endforeach
                                @endif

                                @if(isset($payment) && !empty($payment->hceg_fund))
                                <tr class="table-row">
                                    <th scope="row"><input type="text" style="width: 250px;" name="" id="" class="table-input" readonly value="HCEG Fund"></th>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $payment->provider_presence }}"></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ optional($payment->provider)->hceg_funding }}"></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $payment->hceg_fund }}"></td>
                                </tr>
                                @endif

                                @if(isset($payment) && !empty($payment->gog_fund))
                                <tr class="table-row">
                                    <th scope="row"><input type="text" style="width: 250px;" name="" id="" class="table-input" readonly value="GOG Fund"></th>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $payment->provider_presence }}"></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ optional($payment->provider)->ministry_funding }}"></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $payment->gog_fund }}"></td>
                                </tr>
                                @endif

                                @if(isset($payment->funds) && !empty($payment->funds) && count($payment->funds) > 0)
                                @foreach($payment->funds as $fund)
                                <tr class="table-row">
                                    <th scope="row"><input type="text" style="width: 250px;" name="" id="" class="table-input" readonly value="{{ $fund->name }}"></th>
                                    <td><input type="number" name="" id="" class="table-input" readonly value=""></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value=""></td>
                                    <td><input type="number" name="" id="" class="table-input" readonly value="{{ $fund->amount }}"></td>
                                </tr>
                                @endforeach
                                @endif

                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Sub Total</th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{ $payment->total }}" readonly></td>
                                </tr>

                                @if(isset($payment->previous_balance) && !empty($payment->previous_balance))
                                <!-- <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Previous Balance (Carry Forward)</th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{ $payment->previous_balance }}" readonly></td>
                                </tr> -->
                                @endif

                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3"><input type="text" name="modified_description" id="modified_description" class="table-input" value="{{ $payment->modified_description }}" placeholder="Enter description for adding or subtracting any amount"></th>
                                    <td><input style="width: 60px;" type="number" name="modified_amount" id="modified_amount" class="table-input" value="{{ $payment->modified_amount }}" placeholder="123"> <input type="button" class="btn btn-primary btn-sm" onclick="modifyPayment()" value="Modify" /></td>
                                </tr>

                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">
                                        <select name="ministry_fund" id="ministry_fund" class="table-input">
                                            <!-- Populate the dropdown with Ministry Fund options from your table -->
                                            @php
                                            $ministryFunds = App\Models\FundingCategory::where('type','providers')->whereNotIn('name',['gog','hceg'])->get();
                                            @endphp
                                            @if(isset($ministryFunds) && !empty($ministryFunds))
                                            <option value="">Select Fund</option>
                                            @foreach($ministryFunds as $fund)
                                            <option value="{{ $fund->name }}" @if(isset($payment) && $payment->added_ministry_fund_type == $fund->name) selected @endif>{{ $fund->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </th>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <input style="width: 60px;" type="number" name="ministry_fund_amount" id="ministry_fund_amount" class="table-input" value="{{ !empty($payment->added_ministry_fund_amount) ? $payment->added_ministry_fund_amount : '' }}" placeholder="Enter Amount">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="addMinistryFund()">Add Fund</button>
                                            <!-- <button type="button" class="btn btn-primary btn-sm" onclick="createNew()">+</button> -->
                                        </div>
                                    </td>
                                </tr>

                                @if(isset($payment->previous_balance) && !empty($payment->previous_balance))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Previous Balance</th>
                                    <td><input type="text" name="" id="" class="table-input" value="-{{ $payment->previous_balance }}" readonly></td>
                                </tr>
                                @endif


                                @if(isset($alreadyPaid) && !empty($alreadyPaid))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Already Paid</th>
                                    <td><input type="text" name="" id="" readonly class="table-input" value="{{ $alreadyPaid }}"></td>
                                </tr>
                                @endif

                                @if(isset($payment->balance) && !empty($payment->balance))
                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Excess Paid</th>
                                    <td><input type="text" name="" id="" class="table-input" value="- {{ $payment->balance }}" readonly></td>
                                </tr>
                                @endif

                                @php
                                if(isset($alreadyPaid) && $alreadyPaid > 0){
                                if($alreadyPaid >= $payment->net_amount)
                                {
                                $netAmount = 0;
                                }else{
                                $netAmount = round($payment->net_amount - $alreadyPaid,2);
                                }
                                }else{
                                $netAmount = round($payment->net_amount,2);
                                }
                                @endphp

                                <tr class="table-row">
                                    <th scope="row" colspan="3" class="colSpan3">Net Payment</th>
                                    <td><input type="text" name="" id="" class="table-input" value="{{ $netAmount }}" readonly></td>
                                </tr>

                                <tr class="table-row">
                                @if(isset($netAmount) && $netAmount > 0)
                                    <th scope="row" colspan="4" class="colSpan3">
                                        @php
                                        $paymentTotal = App\Helper\GlobalHelper::convertNumberToWords($netAmount, 'en', 'Dollars', 'Cents');
                                        @endphp
                                        <p class="">{{ $paymentTotal }}</p>
                                    </th>
                                @endif
                                </tr>
                                <tr class="table-row">
                                    <th scope="row" colspan="4" class="colSpan3 text-end">
                                        <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('send-email').submit();">
                                            <button class="btn btn-primary btn-sm ">Send as Email</button>
                                        </a>
                                        <a href="{{ route('view.payment',['paymentId' => $payment->payment_number, 'view_pdf' => 1]) }}" target="_blank">
                                            <button class="btn btn-primary btn-sm">View as PDF</button>
                                        </a>
                                        <button class="btn-pay btn btn-sm btn-secondary text-white">Pay</button>
                                        <form id="send-email" action="{{ route('send.payment.email') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" value="payment" name="type">
                                            <input type="hidden" value="{{ $payment->payment_number }}" name="number">
                                        </form>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



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

    var tableBody = document.getElementById("mainDiv");

    var indexo = 2;

    function createNew() {
        indexo++


        // Get the reference row
        var referenceRow = tableBody.rows[indexo];

        // Create a new row HTML
        var newRowHTML = `<tr class="table-row">
                        <th scope="row" colspan="3" class="colSpan3">
                            <select name="ministry_fund" id="ministry_fund" class="table-input">
                                <!-- Populate the dropdown with Ministry Fund options from your table -->
                                @php
                                $ministryFunds = App\Models\FundingCategory::where('type','providers')->whereNotIn('name',['gog','hceg'])->get();
                                @endphp
                                @if(isset($ministryFunds) && !empty($ministryFunds))
                                <option value="">Select Fund</option>
                                @foreach($ministryFunds as $fund)
                                <option value="{{ $fund->name }}" @if(isset($payment) && $payment->added_ministry_fund_type == $fund->name) selected @endif>{{ $fund->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </th>
                        <td >
                                <div classs='d-flex gap-2'>
                                     <input style="width: 60px;" type="number" name="ministry_fund_amount" id="ministry_fund_amount" class="table-input" value="{{ !empty($payment->added_ministry_fund_amount) ? $payment->added_ministry_fund_amount : '' }}" placeholder="Enter Amount">
                                    <button style="text-wrap: wrap;" type="button" class="btn btn-primary btn-sm" onclick="addMinistryFund()">Add Fund</button>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="deleteRow(this)">-</button>
                                </div>
                        </td>
                    </tr>`;

        // Insert the new row HTML after the reference row
        referenceRow.insertAdjacentHTML('afterend', newRowHTML);
    }

    function deleteRow(button) {
        indexo--
        var rowToDelete = button.closest('tr');

        // Remove the row from the table
        rowToDelete.remove();

    }


    const paymentNumber = '{{ $payment->payment_number }}';

    function modifyPayment() {
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

        const apiUrl = '{{ route("api.update-payment", ["paymentNumber" => ":paymentNumber"]) }}'.replace(':paymentNumber', paymentNumber);

        // Make an API call to update the payment
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

        const apiUrl = '{{ route("api.add-paymnet-fund", ["paymentNumber" => ":paymentNumber"]) }}'.replace(':paymentNumber', paymentNumber);

        // Make an API call to update the payment
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
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add a click event listener to all Pay buttons
        const payButtons = document.querySelectorAll('.btn-pay');

        payButtons.forEach(button => {
            button.addEventListener('click', function() {

                const paymentDate = '{{ $payment->created_at->toDateString() }}';
                const providerId = '{{ $payment->provider_id }}';
                const netAmount = '{{ $payment->net_amount }}';

                Swal.fire({
                    title: 'Enter Amount and Date',
                    html: '<input id="swal-amount" class="swal2-input" placeholder="Amount" type="text">' +
                        '<input id="swal-date" class="swal2-input" placeholder="Payment Date" type="date">',
                    showCancelButton: true,
                    confirmButtonText: 'Pay',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const amount = Swal.getPopup().querySelector('#swal-amount').value;
                        const date = Swal.getPopup().querySelector('#swal-date').value;

                        const isValidAmount = /^\d+(\.\d{1,2})?$/.test(amount);
                        const amountValue = parseFloat(amount);

                        if (isNaN(amountValue) || amountValue == 0 || amountValue > 100000 || !date) {
                            Swal.showValidationMessage('Invalid amount or date. Please enter valid values.');
                            return false;
                        }
                        // Perform AJAX request to update payment
                        return fetch(`{{ route('pay.payment') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    paymentDate: paymentDate,
                                    provider_id: providerId,
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
                            text: `Amount Paid: $${result.value.paidAmount}`,
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