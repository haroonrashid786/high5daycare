@extends('layouts.app')
@section('title', 'Payments To Kids | High5 Daycare')
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
                            <span>Payments To Kid</span>
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
                        <li class="breadcrumb-item text-white">Payments To Kid</li>
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
                    <h3 class="card-title">Payments To Kids @if($currentMonth != 'all') for {{ $currentMonth->format('F,Y') }} @endif</h3>

                    <button id="exportBtn" class="export-button">Export to Excel</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary text-white heading">
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Doc number</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Net No. Of Days</th>
                                    <th>Parent Share Rate</th>
                                    <th>Parent Total Amount</th>
                                    <th>Amount Received From Parent</th>
                                    <th>Balance With Parent</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($invoiceData) && !empty($invoiceData))
                                @foreach ($invoiceData as $entry)
                                <tr>
                                    <td>{{ $entry->created_at->format('Y') }}</td>
                                    <td>{{ $entry->created_at->format('M') }}</td>
                                    <td>{{ optional($entry->invoice)->invoice_number }}</td>
                                    <td>{{ $entry->created_at->firstOfMonth()->format('Y-M-d') }}</td>
                                    <td>{{ $entry->created_at->lastOfMonth()->format('Y-M-d') }}</td>
                                    <td>{{ $entry->presence_count }}</td>
                                    <td>{{ $entry->kid_rate }}</td>
                                    <td>{{ $entry->kid_rate * $entry->presence_count }}</td>
                                    <td >{{ $entry->already_paid }}</td>
                                    <td>@if(!empty($entry->already_paid)) {{ $entry->already_paid - ($entry->kid_rate * $entry->presence_count) }} @else {{ $entry->invoice_balance - ($entry->kid_rate * $entry->presence_count) }} @endif</td>

                                </tr>
                                @endforeach
                                @else
                                @include('layouts.partials.no-result')
                                @endif

                                <!-- pagination -->

                            </tbody>
                        </table>
                    </div>
                    @include('layouts.partials.custom_pagination', ['paginator' => $invoiceData])

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
