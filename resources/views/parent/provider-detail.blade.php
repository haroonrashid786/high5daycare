@extends('layouts.app')
@section('title', 'Provider Details | Parent | High5 Daycare')
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
                            <span>
                                &nbsp; {{ucfirst($provider->name)}}</span>
                            <!--begin::Description-->
                            <span class="page-desc text-white fs-base fw-semibold">

                            </span>
                            <!--end::Description-->
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
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
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->
                <div class="col-md-12 mb-xl-10">
                    <!--begin::Card widget 28-->
                    <div class="card card-flush">
                        <!--begin::Header-->






                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Provider Details</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div id="kt_account_settings_profile_details" class="collapse show">
                                <!--begin::Form-->
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">
                                        <!--begin::Input group-->
<!-- 
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Logo</label>
                                            <div class="col-lg-8">
                                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                <img @if(!empty($provider->logo)) src="{{url($provider->logo)}}" @else src="" @endif alt="" style="width:14rem;height:14rem;object-fit: cover;" class="rounded cursor-pointer">
                                                </div>
                                            </div>
                                        </div> -->

                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Name</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" readonly value="{{$provider->name}}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Col-->
                                                   
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->


                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Address</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Enter address"value="{{$provider->address}}" readonly>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="">Contact Phone</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                                <input type="tel" name="phone_number" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{$provider->phone_number}}" readonly>
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->


                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Email ID</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="{{$provider->email}}" readonly>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Location Link</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <input type="text" name="location_link" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Enter location link" value="{{$provider->location_link}}" readonly>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">About Provider</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                        <a href="{{route('provider.aboutMe',['providerId' => $provider->id])}}">View About Provider</a>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Card body-->


                                    <div class="card-body border-top p-9">
                                        <div class="content">
                                            <h1 class="mb-10">Documents</h1>
                                        </div>
                                        <div class="row row-cols-lg-2 g-10">


                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2">CPR:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    @if(isset($provider->cpr) && (!empty($provider->cpr)))
                                                    <a href="{{url($provider->cpr)}}" target="_blank">View File</a>
                                                    @else
                                                    <a href="#">Not Submitted</a>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2">Police Check:</label>
                                                    <!--end::Label-->
                                                    @if(isset($provider->police_clearance) && (!empty($provider->police_clearance)))
                                                    <a href="{{url($provider->police_clearance)}}" target="_blank">View File</a>
                                                    @else
                                                    <a href="#">Not Submitted</a>
                                                    @endif
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body border-top p-9">
                                        <div class="content">
                                            <h1 class="mb-10">Provider Profile</h1>
                                        </div>
                                        <div class="row g-10">
                                            <div class="col">
                                                @if(isset($provider->images) && (!empty($provider->images)) && count($provider->images) > 0)
                                                <div>
                                                    <h1 class="text-[1.25rem] mb-1 font-semibold">Profile</h1>
                                                    <div class="flex items-center gap-2.5 flex-wrap">

                                                        <div class="card-body pt-5">
                                                            <div class="d-flex align-items-center gap-4 flex-wrap viewer">
                                                                @foreach($provider->images as $image)
                                                                <div class="image" data-image-id="{{$image->id}}">
                                                                    <img src="{{$image->image ? url($image->image) : ''}}" alt="" style="width:14rem;height:14rem;object-fit: cover;" class="rounded cursor-pointer">
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                            @include('layouts.partials.no-result')
                                        @endif
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <!--end::Content-->
                        </div>


                        <!--end::Card title-->
                        <!--begin::Card body-->

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