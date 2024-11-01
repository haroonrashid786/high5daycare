@extends('layouts.app')
@section('title', 'Immunization Record | High5 Daycare')
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
                            <span>Immunization Record</span>
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
                        <li class="breadcrumb-item text-white">Immunization Record</li>
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
                            <form class="form" action="{{route('add.kid.immunization',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Immunization Record</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    
                                    <div class="mb-12">

                                        <div class="row row-cols-lg-12 g-10">
                                            <div class="col">
                                                <div class="fv-row">
                                                <label class="fs-4 fw-semibold mb-2 required">Attach Immunization Record</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" type="file"
                                                    required="" name="file"/>
                                                    @if(isset($kid->immunizationRecord) && (!empty($kid->immunizationRecord->file)))
                                                    <a href="{{url($kid->immunizationRecord->file)}}" target="_blank">View File</a>
                                                    @endif

                                                    @error('file')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                                <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer flex-right">
                                    <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>

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
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

@endsection