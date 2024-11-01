@extends('layouts.app')
@section('title', 'Payments To Kids | High5 Daycare')
@section('content')
<style>
    .heading th {
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
                            <span>Gross Profit Ledger</span>
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
                        <li class="breadcrumb-item text-white">Gross Profit Ledger</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->

                <div class="d-flex align-self-center flex-center">

                    <div class="d-flex align-items-center">
                        <form class="m-0" action="{{route('gp.ledger')}}" method="GET" id="monthForm">
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


                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gross Profit Ledger @if($currentMonth != 'all') for {{ $currentMonth->format('F,Y') }} @else Overall @endif</h3>
                    <button id="exportBtn" class="export-button">Export to Excel</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>

                                <tr class="bg-primary text-white heading">
                                    <th> </th>

                                    @foreach($providers as $provider)
                                    <th>{{ $provider->name }}</th>
                                    @endforeach
                                    <th>Amount In CAD total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Rvenue</td>
                                </tr>
                                @php
                                $parentPay = 0;
                                @endphp
                                <tr>
                                    <td>- from parents</td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->parent_pay))
                                    <td>{{ $provider->parent_pay }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    @php
                                    $parentPay +=$provider->parent_pay;
                                    @endphp
                                    @endforeach
                                    <td>{{ $parentPay }}</td>
                                </tr>
                                @php
                                $ministry_pay = 0;
                                @endphp
                                <tr>
                                    <td style="border-bottom: 1px solid black;">- from ministry</td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->ministry_pay))
                                    <td style="border-bottom: 1px solid black;">{{ $provider->ministry_pay }}</td>
                                    @else
                                    <td style="border-bottom: 1px solid black;">-</td>
                                    @endif
                                    @php
                                    $ministry_pay += $provider->ministry_pay;
                                    @endphp
                                    @endforeach
                                    <td style="border-bottom: 1px solid black;">{{ $ministry_pay }}</td>
                                </tr>
                                @php
                                $total = 0;
                                @endphp
                                <tr>
                                    <td></td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->ministry_pay) && !empty($provider->parent_pay))
                                    <td class="fw-bold">{{ $provider->ministry_pay + $provider->parent_pay }}</td>
                                    @else
                                    <td>-</td>
                                    @endif

                                    @php
                                    $total += $provider->ministry_pay + $provider->parent_pay;
                                    @endphp
                                    @endforeach
                                    <td>{{ $total }}</td>
                                </tr>
                                @php
                                $Services = 0;
                                @endphp
                                <tr>
                                    <td style="border-bottom: 1px solid black;">Less :Payment to Services providers</td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->payment))
                                    <td style="border-bottom: 1px solid black;">{{ $provider->payment }}</td>
                                    @else
                                    <td style="border-bottom: 1px solid black;">-</td>
                                    @endif

                                    @php
                                    $Services += $provider->payment;
                                    @endphp
                                    @endforeach
                                    <td style="border-bottom: 1px solid black;">{{ $Services }}</td>
                                </tr>
                                @php
                                $gp = 0;
                                @endphp
                                <tr>
                                    <td>Gross Profit </td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->ministry_pay) && !empty($provider->parent_pay) && !empty($provider->payment))
                                    @php
                                    $income = 0;
                                    $income = ($provider->ministry_pay + $provider->parent_pay) - $provider->payment ;
                                    $formattedIncome = ($income < 0) ? "(" .abs($income).")" : $income; @endphp <td class="fw-bold">{{ $formattedIncome }}</td>
                                        @else
                                        <td>-</td>
                                        @endif

                                        @php
                                        $gp += ($provider->ministry_pay + $provider->parent_pay) - $provider->payment;
                                        @endphp
                                        @endforeach
                                        <td>{{ $formattedIncome = ($gp < 0) ? "(" .abs($gp).")" : $gp }}</td>
                                </tr>
                                <tr>
                                    <td>Adjustment </td>
                                </tr>
                                @php
                                $Fee = 0;
                                @endphp
                                <tr>
                                    <td style="border-bottom: 1px solid black;">Registration Fee</td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->registration))
                                    <td style="border-bottom: 1px solid black;">{{ $provider->registration }}</td>
                                    @else
                                    <td style="border-bottom: 1px solid black;">-</td>
                                    @endif

                                    @php
                                    $Fee += $provider->registration ;
                                    @endphp
                                    @endforeach
                                    <td style="border-bottom: 1px solid black;">{{ $Fee }}</td>
                                </tr>
                                @php
                                $net_total = 0;
                                @endphp
                                <tr>
                                    <td></td>
                                    @foreach($providers as $provider)
                                    @if(!empty($provider->ministry_pay) && !empty($provider->parent_pay) && !empty($provider->payment) && !empty($provider->registration))
                                    @php
                                    $income = ($provider->ministry_pay + $provider->parent_pay) - $provider->payment ;
                                    $value = $income + $provider->registration;
                                    $net_total += $income + $provider->registration;
                                    @endphp

                                    <td>{{ $format = ($value < 0) ? "(" .abs($value).")" : $value }}</td>
                                    @else
                                    <td>-</td>
                                    @endif

                                    @endforeach
                                    <td>{{ $format = ($net_total < 0) ? "(" .abs($net_total).")" : $net_total }}</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>

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
