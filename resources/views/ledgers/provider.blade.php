@extends('layouts.app')
@section('title', 'Payments To Provider | High5 Daycare')
@section('content')
<style>
    .heading th{
        color: white !important;
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
                            <span>Payments To Provider</span>
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
                        <li class="breadcrumb-item text-white">Payments To Provider</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->

                <!-- <div class="d-flex align-self-center flex-center">

                    <div class="d-flex align-items-center">
                        <form class="m-0" action="{{route('subsidary.ledger')}}" method="GET" id="monthForm">
                            <select class="form-select" name="month" id="monthDropdown">
                                @php
                                $currentYear = date('Y');
                                $currentMonthNumber = date('n');
                                $selectedMonth = request()->input('month', $currentMonthNumber);
                                @endphp
                                <option value="all" {{ Request('month') == 'all' ? 'selected' : '' }}>All</option>
                                @for ($month = 1; $month <= $currentMonthNumber; $month++) <option value="{{ $month }}" {{ $month==$selectedMonth ? 'selected' : '' }}>
                                    {{ date("F", strtotime("$currentYear-$month-01")) }}
                                    </option>
                                    @endfor
                            </select>
                            <input type="submit" style="display: none;">
                        </form>
                    </div>
                </div> -->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payments To Provider</h3>
                    <button id="exportBtn" class="export-button">Export to Excel</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(isset($entries) && !empty($entries) && count($entries) > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary text-white heading">
                                    <th>Year</th>
                                    <th>Date</th>
                                    <th>Doc No.</th>
                                    <th>Description</th>
                                    <th>Dr./ Bill Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $e)

                                @php
                                $amount = 0;
                                $ffAmount = $e->paymentItems->where('first_fortnight',1)->sum('amount');
                                $sfAmount = $e->paymentItems->where('second_fortnight',1)->sum('amount');
                                $hceg = $e->hceg_fund;
                                $gog = $e->gog_fund;
                                $ma = $e->modified_amount;
                                $md = $e->modified_description;


                                @endphp

                                @if(isset($ffAmount) && !empty($ffAmount))
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('d-M-y') }}</td>
                                    <td>{{ $e->payment_number }}</td>
                                    <td>FN-1</td>
                                    <td>{{ $ffAmount }}</td>
                                    <td></td>
                                    <td>{{ $amount +=  $ffAmount  }}</td>
                                </tr>
                                @endif

                                @if(isset($sfAmount) && !empty($sfAmount))
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('d-M-y') }}</td>
                                    <td>{{ $e->payment_number }}</td>
                                    <td>FN-2</td>
                                    <td>{{ $sfAmount }}</td>
                                    <td></td>
                                    <td>{{ $amount += $sfAmount }}</td>
                                </tr>
                                @endif


                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('d-M-y') }}</td>
                                    <td>{{ $e->payment_number }}</td>
                                    <td>HCEG</td>
                                    <td>{{ $hceg }}</td>
                                    <td></td>
                                    <td>{{ $amount += $hceg }}</td>
                                </tr>


                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('d-M-y') }}</td>
                                    <td>{{ $e->payment_number }}</td>
                                    <td>GOG</td>
                                    <td>{{ $gog }}</td>
                                    <td></td>
                                    <td>{{ $amount += $gog }}</td>
                                </tr>

                                @if(isset($ma) && !empty($ma) && isset($md) && !empty($md))
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('d-M-y') }}</td>
                                    <td>{{ $e->payment_number }}</td>
                                    <td>{{ ucfirst($md) }}</td>
                                    <td>{{ $ma }}</td>
                                    <td></td>
                                    <td>{{ $amount += $ma }}</td>
                                </tr>
                                @endif

                                @if(isset($e->paid_amount) && isset($e->payment_date) && !empty($e->paid_amount) && !empty($e->payment_date))
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($e->created_at)->format('Y') }}</td>
                                    <td>{{ $e->payment_date}}</td>
                                    <td>{{ $e->payment_number }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $e->paid_amount }}</td>
                                    <td>{{ $amount -= $e->paid_amount }}</td>
                                </tr>
                                @endif

                                @endforeach
                            </tbody>
                        </table>
                        @else
                        @include('layouts.partials.no-result')
                        @endif
                    </div>

                    @if(isset($entries) && !empty($entries))
                    @include('layouts.partials.custom_pagination', ['paginator' => $entries])
                    @endif

                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
            <!--begin::Footer-->

            <!--end::Footer-->
        </div>



        <script>
            document.getElementById('monthDropdown').addEventListener('change', function() {
                // Get the selected value from the dropdown
                var selectedMonth = document.getElementById('monthDropdown').value;

                // Get the current URL
                var currentURL = window.location.href;

                // Create a URL object to work with the URL
                var url = new URL(currentURL);

                // Check if the "month" parameter already exists in the URL
                if (url.searchParams.has('month')) {
                    // If "month" parameter exists, update its value
                    url.searchParams.set('month', selectedMonth);
                } else {
                    // If "month" parameter doesn't exist, add it
                    url.searchParams.append('month', selectedMonth);
                }

                // Get the updated URL
                var updatedURL = url.toString();

                // Update the current URL with the new URL
                window.history.replaceState({}, '', updatedURL);

                // Optionally, you can submit the form
                setTimeout(() => {
                    location.reload();
                }, 300);
            });
        </script>
        @endsection
