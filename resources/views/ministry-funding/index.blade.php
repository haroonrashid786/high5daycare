@extends('layouts.app')
@section('title', 'Ministry Fundings | High5 Daycare')
@section('content')

<style>
    .me-5{
        width: 150px !important;
    }
    @media screen and (max-width: 770px) {
        .me-5{
            width: auto !important;
        }
    }
    .w-auto{
        width: auto !important;
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
                            <span>Ministry Fundings</span>
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
                        <li class="breadcrumb-item text-white">Ministry Fundings</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->
                <div class="d-flex align-self-center flex-center flex-shrink-0">
                    <a href="{{route('funding.categories')}}" class="btn btn-sm btn-dark ms-3 px-4 py-3">Funding
                        <span class="d-none d-sm-inline">Categories</span></a>
                </div>
                <!--end::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            @role('Admin')
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
                            <form class="form" action="{{route('add.funding')}}" method="POST" enctype="multipart/form-data" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Add Ministry Fundings</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <!--begin::Input group-->

                                    <!--end::Input group-->

                                    <div class="row row-cols-lg-3 g-10">

                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-4 fw-semibold mb-2 required">Funding Category</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-select" name="funding_category_id" value="" data-control="select2" data-hide-search="false">
                                                    @php
                                                    $categories = App\Models\FundingCategory::all();
                                                    @endphp
                                                    <option value="">Select Funding Category</option>
                                                    @if(isset($categories) && !empty($categories))
                                                    @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                @error('funding_category_id')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <label class="fs-4 fw-semibold mb-2 required">Funding Amount</label>
                                                <input class="form-control form-control-solid" name="amount" placeholder="Enter amount for the funding" id="kt_calendar_datepicker_start_date" type="number" step="0.01" value="" required />
                                                @error('amount')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <label class="fs-4 fw-semibold mb-2 required">Date</label>
                                                <input class="form-control form-control-solid" name="date" id="kt_calendar_datepicker_start_date" type="date" value="" required />
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Input group-->

                                    <!--end::Modal body-->
                                    <!--begin::Modal footer-->
                                    <div class="modal-footer flex-right">
                                        <!--begin::Button-->
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                            <span class="indicator-label">Add Funding</span>
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
            @endrole

            <!--begin::Row-->


            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class=" p-7 pb-0  d-block">

                            <form action="{{ route('fundings') }}" class="w-100" method="GET">
                                <div class="d-flex align-items-center w-100 ">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <label for="search_text" class="form-label">Search:</label>
                                            <input type="text" id="search_text" name="search_text" class="form-control" value="{{ Request('search_text') }}">
                                        </div>

                                    </div>
                                    <!-- Apply Filter Button -->
                                    <div class="align-self-end">
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </form>

                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Ministry Fundings</span>
                            </h3>
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Items-->
                            <div class="">
                                @if(isset($fundings) && !empty($fundings) && count($fundings) > 0)
                                @foreach($fundings as $fund)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->

                                        <!--end::Flag-->
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="{{route('edit.funding', ['id' => $fund->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{ ucFirst(optional($fund->fundingCategory)->name) }}</a>
                                            <!--begin::Desc-->
                                            <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0" style="white-space: nowrap;">
                                            {{$fund->date->format('d-m-Y')}} 
                                                </span>
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Content-->
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <!--end::Number-->
                                        <!--begin::Info-->
                                        <a href="{{route('edit.funding', ['id' => $fund->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Amount: {{ $fund->amount }}
                                            <!-- @if(!empty($fund->balance))  @endif -->
                                        </a>
                                        <!--end::Info-->
                                    </div>

                                    <div class="d-flex align-items-center me-5">
                                        <div class="me-5">
                                            <a href="{{route('edit.funding', ['id' => $fund->id])}}" class="text-gray-800 fw-bold text-hover-primary fs-6">Type: {{ ucfirst(optional($fund->fundingCategory)->type) }}</a>
                                        </div>
                                    </div>

                                    @role('Admin')
                                    <div class="d-flex align-items-center gap-1">
                                        <a href="{{route('edit.funding', ['id' => $fund->id])}}" class="btn btn-sm btn-light"> <i class="ki-outline ki-pencil fs-1" style="color:orange !important ;"></i>Edit</a>
                                        <a style="background-color:#eb5c2d" class="btn btn-sm btn-danger" onclick="confirmDelete()"> <i class="ki-outline ki-trash fs-1" style="color:white !important ;"></i>Delete</a>
                                        <form id="delete-funding" action="{{route('delete.funding',['id' => $fund->id])}}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    @endrole
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->
                                @endforeach

                                @else
                                @include('layouts.partials.no-result')
                                @endif
                            </div>
                            @if(isset($fundings))
                            @include('layouts.partials.custom_pagination', ['paginator' => $fundings])
                            @endif
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

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", submit the form
                document.getElementById('delete-funding').submit();
            }
        });
    }
</script>
@endsection