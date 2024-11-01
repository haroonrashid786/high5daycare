<style>
    .provider__container {
        overflow: hidden;
        overflow-x: scroll;
    }

    .provider__scroll__container {
        min-width: 1160px;
    }

    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 100px;
        margin: 2.1px;
        font-weight: 100;
    }

    .scroll__table {
        grid-template-columns: repeat(9, minmax(200px, 1fr));
        gap: 10px;
        border-bottom: 2px dashed #ddd;
    }

    .fixed__table {
        grid-template-columns: repeat(2, minmax(200px, 1fr));
        border-bottom: 2px dashed #ddd;
    }

    @media (max-width: 768px) {
        .scroll__table {
            grid-template-columns: repeat(10, minmax(200px, 1fr));
        }

        .fixed__table {
            grid-template-columns: repeat(1, minmax(200px, 1fr));
        }
    }
</style>
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
                        <h1
                            class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Providers</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise')
                                href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole
                                class="text-white text-hover-primary">
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

                <div class="d-flex align-self-center flex-center flex-shrink-0">
                    <a href="{{route('admin.add.provider')}}" class="btn btn-sm btn-dark ms-3 px-4 py-3">Create
                        <span class="d-none d-sm-inline">New Provider</span></a>
                </div>
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->
                <div class="col-md-12 mb-xl-10">
                    <!--begin::Card widget 28-->
                    <div class="card card-flush">
                        <!--begin::Header-->

                        <!--end::Card title-->
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" method="GET" action="{{ route('admin.providers') }}"
                                id="kt_modal_add_event_form">
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

                                    <div class="row row-cols-lg-2 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Provider Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="search_text"
                                                    placeholder="Search any provider with name" id="" type="search"
                                                    value="{{Request('search_text')}}" required />
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!-- <div class="col">
                                            <div class="fv-row mb-9">
                                                <label class="fs-6 fw-semibold mb-2 required">Parent Name</label>
                                                <input class="form-control form-control-solid"
                                                    name="calendar_event_start_date" placeholder="" id="" type="text" />
                                            </div>
                                        </div> -->
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
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                                    <div class="d-flex">
                                        <div class="">
                                            @if(isset($providers) && count($providers) < 1)
                                                @include('layouts.partials.no-result') @else 
                                                @foreach($providers as $provider) <div
                                                class="fixed__table d-inline-grid flex-stack pb-3 mb-3 h-50px">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-5">
                                                    <!--begin::Flag-->
                                                    <img src="{{ asset('assets/media/logos/favicon.png') }}"
                                                        class="me-4 w-30px h-30px object-fit-cover" style="border-radius: 4px" alt="">
                                                    <!--end::Flag-->
                                                    <!--begin::Content-->
                                                    <div class="me-5">
                                                        <!--begin::Title-->
                                                        <a href="{{route('admin.edit.provider',['provider' => $provider->id])}}"
                                                            class="text-gray-800 fw-bold text-hover-primary fs-6">Code:
                                                            {{$provider->code}}</a>
                                                        <!--end::Title-->
                                                        <!--begin::Desc-->
                                                        <span
                                                            class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Joined:
                                                            @if(empty($provider->joining_date))
                                                            {{$provider->created_at->format('d-m-Y')}} @else {{
                                                            date('d-m-Y', strtotime($provider->joining_date)) }}
                                                            @endif</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
    
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-5 d-none d-md-block">
                                                    <!--begin::Flag-->
                                                    <!--end::Flag-->
                                                    <!--begin::Content-->
                                                    <div class="me-5">
                                                        <!--begin::Title-->
                                                        <a href="{{route('admin.edit.provider',['provider' => $provider->id])}}"
                                                            class="text-gray-800 fw-bold text-hover-primary fs-6">Name:
                                                            {{ ucfirst($provider->name)}}</a>
                                                        <!--end::Title-->
                                                        <!--begin::Desc-->
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Section-->
                                                <!--end::Separator-->
                                        </div>
                                        @endforeach
                                        @endif
                                        </div>
                                    <div class="" style="overflow-x: auto;">
                                        @if(isset($providers) && count($providers) < 1)
                                            @include('layouts.partials.no-result') @else
                                            @foreach($providers as $provider) <div
                                            class="scroll__table d-inline-grid flex-stack pb-3 mb-3 h-50px">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex align-items-center me-5 d-md-none d-block">
                                                <!--begin::Flag-->
                                                <!--end::Flag-->
                                                <!--begin::Content-->
                                                <div class="me-5">
                                                    <!--begin::Title-->
                                                    <a href="{{route('admin.edit.provider',['provider' => $provider->id])}}"
                                                        class="text-gray-800 fw-bold text-hover-primary fs-6">Name:
                                                        {{ ucfirst($provider->name)}}</a>
                                                    <!--end::Title-->
                                                    <!--begin::Desc-->
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <!--begin::Number-->
                                                <!--end::Number-->
                                                <!--begin::Info-->
                                                <div class="m-0">
                                                    <!--begin::Label-->
                                                    @if($provider->status == 1)
                                                    <span class="badge badge-light-success fs-base">
                                                        Active</span>
                                                    @else
                                                    <span class="badge badge-light-danger fs-base">
                                                        Inactive</span>
                                                    @endif
                                                    <!--end::Label-->
                                                </div>

                                                <!--end::Info-->
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-5">
                                                <!--begin::Number-->
                                                <!--end::Number-->
                                                <!--begin::Info-->
                                                <a href="{{route('admin.edit.provider',['provider' => $provider->id])}}"
                                                    class="btn btn-sm btn-light">View</a>
                                                <a href="{{route('provider.aboutMe',['providerId' => $provider->id])}}"
                                                    class="btn btn-sm btn-light">About</a>
                                                @if(!empty($provider->contract_signature))
                                                <a href="{{ url($provider->contract_signature) }}"
                                                    class="btn btn-sm btn-light">Contract</a>
                                                @endif
                                                <a href="{{ route('ledger.provider.payments',['provider_id'=> $provider->id]) }}"
                                                    class="btn btn-sm btn-light">Ledger</a>
                                                <!--end::Info-->
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Total Document:</p>
                                                <h6 class="pb-2">
                                                    16
                                                </h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Filled Document:</p>
                                                <h6 class="pb-2">
                                                    {{$provider->filled_documents ?? ''}}
                                                </h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Total Seats:</p>
                                                <h6 class="pb-2">
                                                    {{$provider->totalSeatsAvailable ?? 0}}
                                                </h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Available Seats:</p>
                                                <h6 class="pb-2">
                                                    {{$provider->totalFreeSpaces ?? 0}}
                                                </h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Infants:</p>
                                                <h6 class="pb-2">
                                                    {{$provider->totalInfants ?? 0}}
                                                </h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Toddlers:</p>
                                                <h6 class="pb-2">
                                                    {{$provider->totalToddlers ?? 0}}
                                                </h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <p class="">Pre Schoolers:</p>
                                                <h6 class="pb-2">
                                                    {{$provider->totalPreschoolers ?? 0}}
                                                </h6>
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--end::Separator-->
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
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
@endsection