@extends('layouts.app')
@section('title', 'Providers | Admin | High5 Daycare')
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
                            <span>Providers</span>
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
                        <li class="breadcrumb-item text-white">Providers</li>
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
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->
                <div class="col-md-12 mb-xl-12">
                    <!--begin::Card widget 28-->
                    <div class="card card-flush">
                        <!--begin::Header-->

                        <!--end::Card title-->
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" method="GET" action="{{ route('get.providers') }}" id="kt_modal_add_event_form">
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Search Provider</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <!--begin::Input group-->

                                    <!--end::Input group-->

                                    <div class="row row-cols-lg-1 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Search Provider</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="search_text" placeholder="Search any provider with name" id="" type="search" value="{{Request('search_text')}}" required />
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                    </div>

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-right">
                                    <!--begin::Button-->
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Search</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 28-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->

                <!--end::Col-->
                <!--begin::Col-->

                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">All Providers</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="">
                                <!--begin::Item-->

                                <div class="provider__container">
                                    <div class="provider__scroll__container">
                                        @if(isset($providers) && count($providers) < 1) @include('layouts.partials.no-result') @else @foreach($providers as $provider) <div class="d-grid flex-stack" style="grid-template-columns: repeat(2,1fr);">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center me-5">
                                                <!--begin::Flag-->
                                                <img src="{{ asset('assets/media/logos/favicon.png') }}" class="me-4 w-30px" style="border-radius: 4px" alt="">
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <a href="{{route('admin.providers',['search_text' => $provider->code])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Provider:
                                                        {{ucfirst($provider->name)}}</a>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Code:
                                                        {{$provider->code}}</span>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <!--begin::Number-->
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="monthDropdown-{{ $provider->id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Generate Pay
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="monthDropdown-{{ $provider->id }}">
                                                        <!-- <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'current')">{{ now()->format('F Y') }}</a>
                                                        <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'previous')">{{ now()->subMonth()->format('F Y') }}</a> -->

                                                        <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'current_complete')">{{ now()->format('F Y') }} - Complete</a>
                                                        <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'current_first_fortnight')">{{ now()->format('F Y') }} - First Fortnight</a>
                                                        <!-- <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'current_second_fortnight')">{{ now()->format('F Y') }} - Second Fortnight</a> -->
                                                        <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'previous_complete')">{{ now()->subMonth()->format('F Y') }} - Complete</a>
                                                        <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'previous_first_fortnight')">{{ now()->subMonth()->format('F Y') }} - First Fortnight</a>
                                                        <!-- <a class="dropdown-item" href="#" onclick="setSelectedMonth('{{ $provider->id }}', 'previous_second_fortnight')">{{ now()->subMonth()->format('F Y') }} - Second Fortnight</a> -->
                                                    </div>
                                                </div>
                                                <!--end::Info-->
                                                <form id="generate-pay-{{ $provider->id }}" action="{{ route('pay.generate',['code' => $provider->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <!-- Hidden input field to store the selected month -->
                                                    <input type="hidden" name="selected_month" id="selectedMonthInput-{{ $provider->id }}" value="">
                                                </form>
                                            </div>

                                    </div>

                                    <div class="separator separator-dashed my-3"></div>
                                    <!--end::Separator-->
                                    @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!--end::Items-->
                        @include('layouts.partials.custom_pagination', ['paginator' => $providers])

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

<script>
    function setSelectedMonth(providerCode, month) {
        document.getElementById('selectedMonthInput-' + providerCode).value = month;
        document.getElementById('generate-pay-' + providerCode).submit();
    }
</script>
@endsection