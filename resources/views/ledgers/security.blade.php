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
                            <span>Security Deposit Ledger</span>
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
                        <li class="breadcrumb-item text-white">Security Deposit Ledger</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Security Deposit Ledger</h3>
                    <button id="exportBtn" class="export-button">Export to Excel</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary text-white heading">
                                    <!-- <th >S.No</th> -->
                                    <th>Date</th>
                                    <th>Kid Code</th>
                                    <th>Kid Name </th>
                                    <th>Rec.</th>
                                    <th>Adjust</th>
                                    <th>Advance</th>



                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($kids) && !empty($kids) && count($kids) > 0)
                                @php
                                $income = 0;

                                @endphp

                                @foreach($kids as $item)

                                <tr>
                                    <td>{{ isset($item->created_at) ? $item->created_at->format('Y-M-d') : '' }}</td>
                                    <td>{{ optional($item->kid)->code }}</td>
                                    <td>{{ optional($item->kid)->full_name }}</td>
                                    <td>{{ $item->advance_payment }}</td>
                                    <td></td>
                                    <td>
                                    @php
                                        $income += $item->advance_payment;
                                        $formattedIncome = ($income < 0) ? "(" .abs($income).")" : $income; @endphp {{ $formattedIncome }}
                                    </td>
                                </tr>
                                @if($item->paymentPaid )
                                <tr>
                                    <td>{{ isset($item->payment_date) ? $item->payment_date->format('Y-M-d') : '' }} </td>
                                    <td>{{ optional($item->kid)->code }}</td>
                                    <td>{{ optional($item->kid)->full_name }} - Adjust</td>
                                    <td></td>
                                    <td>{{ $item->advance_payment }}</td>
                                    <td>
                                    @php
                                        $income -= $item->advance_payment;
                                        $formattedIncome = ($income < 0) ? "(" .abs($income).")" : $income; @endphp {{ $formattedIncome }}

                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @else
                                @include('layouts.partials.no-result')
                                @endif


                                <!-- pagination -->

                            </tbody>
                        </table>
                    </div>
                    @include('layouts.partials.custom_pagination', ['paginator' => $kids])
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
            <!--begin::Footer-->

            <!--end::Footer-->
        </div>
        @endsection
