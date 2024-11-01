@extends('layouts.app')
@section('title', 'HCEG Ledger | High5 Daycare')
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
                            <span>Ministry Ledger HCEG</span>
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
                        <li class="breadcrumb-item text-white">Ministry Ledger HCEG</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->
                <!-- <div class="d-flex align-self-center flex-center">

                    <div class="d-flex align-items-center">
                        <form class="m-0" action="{{route('hceg.ledger')}}" method="GET" id="monthForm">
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
                    <h3 class="card-title">Ministry Ledger HCEG @if($currentMonth != 'all') for {{ $currentMonth->format('F,Y') }} @endif</h3>
                    <button id="exportBtn" class="export-button">Export to Excel</button>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary text-white heading">
                                    <th>Date</th>
                                    <th>Particular</th>
                                    <th>Provider Name</th>
                                    <th>Month</th>
                                    <th>No of days</th>
                                    <th>Rate</th>
                                    <th>Received</th>
                                    <th>Payment</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($fundReceived))
                                <tr>
                                    <td>@if(!empty($fundDate)) {{ $fundDate->format('F j, Y') }} @endif</td>
                                    <td>EDI Payment</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$fundReceived}}</td>
                                    <td></td>
                                    <td>{{$fundReceived}}</td>
                                </tr>
                                @endif

                                @if(isset($entries) && !empty($entries))
                                @php
                                $balance = $fundReceived; // Initialize balance with the fund received
                                @endphp
                                @foreach ($entries as $entry)
                                @php
                                $balance -= ($entry->total_no_of_days ? $entry->total_no_of_days : 0) * ($entry->provider ? $entry->provider->hceg_funding : 0);
                                $rate = $entry->gog_fund ? $entry->hceg_fund / $entry->provider_presence : 0;
                                @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($entry->created_at)->format('F j, Y') }}</td>
                                    <td>HCEG</td>
                                    <td>{{ ucfirst(optional($entry->provider)->name) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($entry->created_at)->format('F') }}</td>
                                    <td>{{ $entry->total_no_of_days }}</td>
                                    <td>{{ $rate }}</td>
                                    <td></td>
                                    <td>{{ (($entry->total_no_of_days ? $entry->total_no_of_days : 0) *  ($entry->provider ? $entry->provider->hceg_funding : 0)) }}</td>
                                    <td>{{ $balance }}</td>
                                </tr>
                                @endforeach
                                @else
                                @include('layouts.partials.no-result')
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @include('layouts.partials.custom_pagination', ['paginator' => $entries])
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
