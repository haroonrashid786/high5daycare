@extends('layouts.app')
@section('title', 'Authorization of Topical | High5 Daycare')
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
                            <span>Authorization of Topical</span>
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
                        <li class="breadcrumb-item text-white">Authorization of Topical</li>
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
                            <form class="form" action="{{route('add.kid.drugs',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Authorization of Topical Application</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">
                                    <div class="mb-12">

                                        <div class="row row-cols-1 row-cols-md-2 g-10">

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Parent's Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ (isset($eDrugs) && !empty($eDrugs) && !empty($eDrugs[0]->parent_name)) ? $eDrugs[0]->parent_name : old('parent_name') }}" name="parent_name" />
                                                    @error('parent_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Child's Full Legal Name:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" value="{{ (isset($eDrugs) && !empty($eDrugs) && !empty($eDrugs[0]->child_name)) ? $eDrugs[0]->child_name : old('child_name') }}" name="child_name" />
                                                    @error('child_name')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">DOB</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="date" value="{{ (isset($eDrugs) && !empty($eDrugs) && !empty($eDrugs[0]->dob)) ? $eDrugs[0]->dob : old('dob') }}" name="dob" />
                                                    @error('dob')
                                                    <div style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-12">
                                        <div class="my-5">
                                            <h3>Parent's Signature</h3>
                                        </div>

                                        <div>
                                            <p class="fs-6 fw-semibold mb-4">
                                                I, the above listed child’s parent/guardian, me,
                                                <input class="form-control form-control-solid my-4" placeholder="Parent Signature" type="text" name="parent_signature" value="{{ (isset($eDrugs) && !empty($eDrugs) && !empty($eDrugs[0]->parent_signature)) ? $eDrugs[0]->parent_signature : old('parent_signature') }}">
                                                @error('parent_signature')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            to use the following products on my child according to the manufacturer, or parent/guardian or physician's written instructions. All items will be stored and administered from the original container and labelled with my child’s name. I understand that a record of use of the following items will not be maintained. Please circle YES or NO and add brand name.
                                            </p>
                                        </div>

                                        @if(isset($kid->drugInformation) && count($kid->drugInformation) > 0)
                                        @if(isset($eDrugs) && !empty($eDrugs))
                                        @foreach($eDrugs as $index => $drug)
                                        <div class="row row-cols-lg-2 border rounded px-3 py-4 my-4">

                                            <div class="col-lg-12 mb-4">
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <div class="me-5">
                                                        <label class="fs-6 fw-semibold">{{$drug->drug_name}}</label>
                                                        <input type="hidden" name="drug_id[{{ $index }}]" value="{{ $drug->drug_id }}">
                                                        <input type="hidden" name="drug_name[{{ $index }}]" value="{{ $drug->drug_name }}">
                                                    </div>
                                                    <!--end::Label-->
                                                    <!--begin::Switch-->
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="allowed[{{ $index }}]" value="1" @if($drug->allowed == 1) checked @endif>
                                                        <span class="form-check-label fw-semibold text-muted">Allowed</span>
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Brand</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" name="brand[{{ $index }}]" value="{{$drug->brand}}" />
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Comments</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" name="comments[{{ $index }}]" value="{{$drug->comments}}" />
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                        @endif
                                        @elseif(isset($drugs) && !empty($drugs))
                                        @foreach($drugs as $index => $drug)
                                        <div class="row row-cols-lg-2 border rounded px-3 py-4 my-4">

                                            <div class="col-lg-12 mb-4">
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <div class="me-5">
                                                        <label class="fs-6 fw-semibold">{{$drug->name}}</label>
                                                        <input type="hidden" name="drug_id[{{ $index }}]" value="{{ $drug->id }}">
                                                        <input type="hidden" name="drug_name[{{ $index }}]" value="{{ $drug->name }}">
                                                    </div>
                                                    <!--end::Label-->
                                                    <!--begin::Switch-->
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="allowed[{{ $index }}]" value="1">
                                                        <span class="form-check-label fw-semibold text-muted">Allowed</span>
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Brand</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" name="brand[{{ $index }}]" />
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row ">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Comments</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" id="" type="text" name="comments[{{ $index }}]" />
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="row  border rounded px-3 py-4 my-4">
                                        <div class="col">
                                            <div class="fv-row ">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Parent’s signature</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid my-4" placeholder="Parent Signature" type="text" name="parent_signature" value="{{ (isset($eDrugs) && !empty($eDrugs) && !empty($eDrugs[0]->parent_signature)) ? $eDrugs[0]->parent_signature : old('parent_signature') }}">
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--end::Modal body-->
                                @role('Parent','Franchise')
                                <!--begin::Modal footer-->
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