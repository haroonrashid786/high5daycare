@extends('layouts.app')
@section('title', 'Payments | High5 Daycare')
@section('content')


<style>

    .symbol-label{
        background: #577D44 !important;
    }

    @media screen and (max-width: 550px){
        .app-toolbar > div{
            display: block !important;
        }
       
    }
    
    /* @media screen and (max-width: 450px){
        .app-toolbar > div > div{
            display: block !important;
        }
        .app-toolbar > div > div > div{
            margin-bottom: 10px;
        }
       
    } */
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
                            <span>Payments</span>
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
                        <li class="breadcrumb-item text-white">Payments</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->

                @role('Admin')
                <!--begin::Actions-->
                <div class="d-flex align-items-center justify-content-lg-center gap-2">
                    
                    <div class="d-flex align-items-center">
                        <a href="{{ route('get.parents') }}">
                            <button class="btn btn-primary" type="submit">Generate Invoices</button>
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                    <a href="{{ route('get.providers') }}">
                            <button class="btn btn-primary">Generate Vendor Payments</button>
                    </a>
                    </div>
                </div>
                <!--end::Actions-->
                @endrole

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->


                @role('Admin','Parent')
                <!--begin::Col-->
                <a href="{{route('invoices')}}" @role('Admin') class="col-md-6 mb-xl-12" @else class="col-md-12 mb-xl-12" @endrole>
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title flex-stack flex-row-fluid">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label">
                                        <i class="ki-outline ki-cheque fs-2x"></i>
                                    </span>
                                    <span class="fw-bolder fs-2x text-dark">Invoices</span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body d-flex align-items-end">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-2x text-dark">{{$totalInvoices}}</span>
                                <span class="fw-bold fs-7 text-gray-500">Total Invoices</span>
                            </div>
                        </div>
                    </div>
                </a>
                <!--end::Col-->
                @endrole


                @role('Admin','Franchise')
                <!--begin::Col-->
                <a href="{{route('pay.stubs')}}" @role('Admin') class="col-md-6 mb-xl-12" @else class="col-md-12 mb-xl-12" @endrole>
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title flex-stack flex-row-fluid">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-outline ki-dollar fs-2x text-gray-800"></i>
                                    </span>
                                    <span class="fw-bolder fs-2x text-dark">Vendor Payments</span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body d-flex align-items-end">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder fs-2x text-dark">{{$totalPayments}}</span>
                                <span class="fw-bold fs-7 text-gray-500">Total Vendor Payments</span>
                            </div>
                        </div>
                    </div>
                </a>
                <!--end::Col-->
                @endrole


                <!--end::Col-->
            </div>

            <!--end::Row-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>
@endsection