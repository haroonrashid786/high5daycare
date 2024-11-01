@extends('layouts.app')
@section('title', 'Edit Funding | High5 Daycare')
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
                        <li class="breadcrumb-item text-white"> Edit Ministry Funding</li>
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
                            <form class="form" action="{{route('update.funding', ['id' => $funding->id ])}}" method="POST" enctype="multipart/form-data" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Edit Ministry Funding</h2>
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
                                                    <option value="{{ $cat->id }}" @if(isset($funding) && $funding->funding_category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                @error('category')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <label class="fs-4 fw-semibold mb-2 required">Funding Amount</label>
                                                <input class="form-control form-control-solid" name="amount" placeholder="Enter amount for the funding" id="kt_calendar_datepicker_start_date" type="number" step="0.01" value="{{ old('amount', isset($funding) ? $funding->amount : '')}}" required />
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
                                                <input class="form-control form-control-solid" name="date" id="kt_calendar_datepicker_start_date" type="date" value="{{ old('date', $funding->date ? date('Y-m-d', strtotime($funding->date)) : ''  ) }}" required />
                                                @error('date')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
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
                                        <span class="indicator-label">Update</span>
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
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>
@endsection