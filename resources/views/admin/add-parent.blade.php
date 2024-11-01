@extends('layouts.app')
@isset($parent)
@section('title', 'Edit Parent | High5 Daycare')
@else
@section('title', 'Add Parent | High5 Daycare')
@endisset
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
                            <span>Parents</span>
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
                        <li class="breadcrumb-item text-white">>@isset($parent) Edit @else Add @endisset Parent</li>
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
        <form method="POST" @isset($parent) action="{{ route('admin.update.parent',['id' => $parent->id]) }}" @else action="{{ route('admin.insert.parent') }}" @endisset enctype="multipart/form-data" id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->
            @csrf



            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <h1 class="mb-3 text-dark">@isset($parent) Edit @else Add @endisset Parent Details</h1>
                                    <!--end::Title-->
                                    <!--begin::Description-->

                                    <!--end::Description-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                @role('Admin')
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Select Provider</label>
                                        <select type="text" class="form-control form-control-solid" name="daycare_provider_id" value="{{ old('name') }}">
                                            @if(isset($providers) && !empty($providers))
                                            @foreach($providers as $provider)
                                            <option value="{{$provider->id}}" @if(isset($parent) && (!empty($parent->daycare_provider_id)) && $parent->daycare_provider_id == $provider->id) selected @endif @if(old('daycare_provider_id') == $provider->id) selected @endif>{{$provider->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('daycare_provider_id')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @else
                                <input type="hidden" name="daycare_provider_id" value="{{Auth::user()->provider->id}}">
                                @endrole

                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                                        <input type="text" class="form-control form-control-solid" name="name" value="{{ isset($parent) ? $parent->name : old('name') }}" @role('Franchise') readonly @endrole>
                                        @error('name')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Phone Number</label>
                                        <div class="bg-gray-100 rounded d-flex align-items-center">
                                            <div class="px-5 fw-bold">+1</div>
                                            <input type="number" class="form-control form-control-solid" name="phone_number" value="{{ isset($parent) ? $parent->phone_number : old('phone_number') }}" @role('Franchise') readonly @endrole>
                                        </div>
                                        @error('phone_number')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                                        <input type="email" class="form-control form-control-solid" name="email" value="{{ isset($parent) ? $parent->email : old('email') }}" @role('Franchise') readonly @endrole>
                                        @error('email')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Address</label>
                                        <input type="text" class="form-control form-control-solid" name="address" value="{{ isset($parent) ? $parent->address : old('address') }}" @role('Franchise') readonly @endrole>
                                        @error('address')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Country</label>
                                        <input type="text" class="form-control form-control-solid" name="country" value="{{ isset($parent) ? $parent->country : (old('country', 'Canada')) }}" @role('Franchise') readonly @endrole>
                                        @error('country')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">State</label>
                                        <input type="text" class="form-control form-control-solid" name="state" value="{{ isset($parent) ? $parent->state : old('state') }}" @role('Franchise') readonly @endrole>
                                        @error('state')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>

                                @role('Admin')
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Photo ID (Front Side)</label>
                                        <input type="file" class="form-control form-control-solid" name="photo_id_front">
                                        @if(isset($parent) && (!empty($parent->photo_id_front)))
                                        <a href="{{url($parent->photo_id_front)}}" target="_blank">View File</a>
                                        @endif
                                        @error('photo_id_front')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Photo ID (Back Side)</label>
                                        <input type="file" class="form-control form-control-solid" name="photo_id_back">
                                        @if(isset($parent) && (!empty($parent->photo_id_back)))
                                        <a href="{{url($parent->photo_id_back)}}" target="_blank">View File</a>
                                        @endif
                                        @error('photo_id_back')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                @endrole

                                @role('Admin')
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Display Picture</label>
                                        <input type="file" class="form-control form-control-solid" name="display_picture" @role('Franchise') disabled @endrole>
                                        @if(isset($parent) && (!empty($parent->display_picture)))
                                        <a href="{{url($parent->display_picture)}}" target="_blank">View File</a>
                                        @endif
                                        @error('display_picture')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @endrole

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                @role('Admin')
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Password</label>
                                        <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                            <input type="password" id="password" class="form-control form-control-solid" name="password">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="passwordEye" onclick="togglePasswordVisibility('password', 'passwordEye')" height="16" width="18" viewBox="0 0 576 512">
                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                            </svg>
                                        </div>
                                        @error('password')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Confirm Password</label>
                                        <div class="d-flex justify-content-between align-items-center form__parent__div gap-5">
                                            <input type="password" id="confirm_password" class="form-control form-control-solid" name="password_confirmation">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="passwordEye" onclick="togglePasswordVisibility('confirm_password', 'passwordEye')" height="16" width="18" viewBox="0 0 576 512">
                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                            </svg>
                                        </div>
                                        @error('password_confirmation')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @endrole
                                <!--end::Input group-->
                                <!--begin::Input group-->

                                <!-- <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-semibold mb-2">Bank Details</label>
                        <textarea class="form-control form-control-solid" rows="3" name="bank_details" placeholder="Add bank details" value="{{ old('bank_details') }}"></textarea>
                    </div> -->

                                <!--end::Input group-->
                                <!--begin::Input group-->

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-stack mb-8">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <label class="fs-6 fw-semibold">Status</label>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" name="status" @if(isset($parent) && $parent->status == 1) checked="checked" @elseif(isset($parent) && $parent->status == 0) @else checked="checked" @endif @role('Franchise') disabled @endrole>
                                        <span class="form-check-label fw-semibold text-muted">Active</span>
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->

                                <!--end::Input group-->
                                @role('Admin')
                                <!--begin::Actions-->
                                <div class="text-right " style="text-align: right">
                                    <!-- <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button> -->
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                @endrole
                                <!--end::Actions-->
                            </div>
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
        </form>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>
<script>
    function togglePasswordVisibility(inputId, eyeIconId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);
        console.log(passwordInput, 'passwordInput');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
@endsection