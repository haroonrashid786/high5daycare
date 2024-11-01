@extends('layouts.app')
@section('title', 'Ledgers | High5 Daycare')
@section('content')

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
                            <span>Ledgers</span>
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
                        <li class="breadcrumb-item text-white">Ledgers</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class=" p-7 pb-0  d-block">

                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Ledgers</span>
                            </h3>
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Items-->

                            @role('Admin')
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('hceg.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Ministry Funding (Provider HCEG)</a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->

                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('gog.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Ministry Funding (Provider GOG)</a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->

                            <div class="separator separator-dashed my-3"></div>

                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('subsidary.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Ministry Subsidary (Kids)</a>
                                    </div>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-3"></div>

                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('ministry.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Ministry Payment Received & Utilization (Kids)</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>

                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('general.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">General Ledger</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('registration.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Registration Fee Ledger</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('security.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Security Deposit Ledger</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('bank.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Bank Details Ledger</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('gp.ledger') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Gross Profit Ledger</a>
                                    </div>
                                </div>
                            </div>

                            @endrole

                            <!-- <div class="separator separator-dashed my-3"></div>

                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="{{ route('ledger.provider.payments') }}" class="text-gray-800 fw-bold text-hover-primary fs-6">Payments Ledger</a>
                                    </div>
                                </div>
                            </div> -->


                            <!--end::Items-->
                        </div>

                        <!--end: Card Body-->
                    </div>
                    <!--end::List widget 23-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <!--end::Col-->
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
@endsection
