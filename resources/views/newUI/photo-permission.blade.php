@extends('layouts.app')
@section('title', 'Photo Permission | High5 Daycare')
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
                            <span>Photo Permission</span>
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
                        <li class="breadcrumb-item text-white">Photo Permission</li>
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
                            <form class="form" action="{{route('add.kid.photo.permission',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Photo Permission Plan</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    
                                    <div class="mb-12">
                                        <div class="row row-cols-2 mt-8 vehicle">
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Parent's Name
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="parent_name" placeholder="" value="{{ old('parent_name', optional($kid->photoPermission)->parent_name) ?: optional(auth()->user()->parent)->name }}">
                                                @error('parent_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror

                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Child's Full Legal Name: 
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="child_name" placeholder="" value="{{ old('child_name', optional($kid->photoPermission)->child_name) ?: $kid->full_name }}">
                                                @error('child_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Date of Birth
                                                </label>
                                                <!--end::Label-->
                                                <input type="date" class="form-control form-control-solid" name="date_of_birth" placeholder="" value="{{ old('date_of_birth', optional($kid->photoPermission)->date_of_birth ? date('Y-m-d', strtotime(optional($kid->photoPermission)->date_of_birth)) : date('Y-m-d', strtotime($kid->dob))  ) }}">
                                                @error('date_of_birth')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>

                                        <p>It is great for parents to get a glimpse into their child’s day when daycare provider takes pictures of the children participating in activities. Pictures may be taken during day care hours, outdoor play, play groups and special events.  </p>
                                        <p>It is important that we get your input as to whether your child can be included in these pictures.  These pictures may be used for a variety of reasons: </p>
                                        <ul>
                                            <li>
                                                Email to parents to give updates.
                                            </li>
                                            <li>
                                                Use in bulletin board displays or advertisements to promote daycare. 
                                            </li>
                                        </ul>

                                        <p>This consent is voluntary.  Please complete this form so we have a record in your file.</p>


                                        <div class="d-flex align-items-center gap-3">
                                            <p>I,</p>
                                            <input type="text" class="d-inline-block form-control form-control-solid" name="guardian_name" placeholder="" value="{{ old('guardian_name', optional($kid->photoPermission)->guardian_name) }}">
                                            @error('guardian_name')
                                                    <div style="color: red;">
                                                    {{ $message }}
                                                    </div>
                                                    @enderror
                                        </div>
                                        <p>give permission for my Provider to take pictures of my child while in attendance during day care hours.</p>

                                        <div class="d-flex align-items-center gap-5">
                                            <div>
                                                <input type="radio" name="consent_given" value="1" class="form-check-input h-20px w-20px" @if (old('consent_given', optional($kid->photoPermission)->consent_given) == 1) checked @endif>
                                                <span class="form-check-label fw-semibold">Yes</span>
                                            </div>
                                            <div>
                                                <input type="radio" name="consent_given" value="0" class="form-check-input h-20px w-20px" @if (old('consent_given', optional($kid->photoPermission)->consent_given) == 0) checked @endif>
                                                <span class="form-check-label fw-semibold">No</span>
                                            </div>
                                        </div>

                                    </div>
                                    @role('Parent','Franchise')
                                    <div class="modal-footer flex-right">
                                        <!--begin::Button-->
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    @endrole

                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                              
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
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>


@endsection