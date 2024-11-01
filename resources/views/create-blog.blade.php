@extends('layouts.app')
@section('title', 'Create Blog | Admin | High5 Daycare')
@section('content')
 
<style>
    /* .myFormDiv {
        height: 100vh;
        overflow-y: auto;
        width: 100%;
    } */

    .form{
        width: 100%;
    }

    .myFormDiv::-webkit-scrollbar {
        width: 0;
    }

    .ki-outline{
        color: #4B8F64 !important;
    }

</style>
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">
        <div class="myFormDiv">
            <form id="kt_modal_new_ticket_form" class="form bg-white py-8 py-lg-10 rounded-3 px-6" @isset($blog) action="{{route('blog.store',['id'=> $blog->id])}}" @else action="{{route('blog.store')}}" @endisset method="POST" enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                <div class="mb-13 ">
                    <!--begin::Title-->
                    <h1 class="mb-3 text-center text-black">Create New Blog</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->


                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Title</span>
                        <span class="ms-2" data-bs-toggle="tooltip" title="Specify a subject for your issue">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Enter your ticket subject" name="title" value="{{ old('title', isset($blog) ? $blog->title : '') }}" />
                    @error('title')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->

                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Description</label>
                    <textarea  class="form-control form-control-solid" rows="4" name="content" placeholder="Type your ticket description" required>{{ old('content', isset($blog) ? $blog->content : '') }}</textarea>
                    @error('content')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-12 fv-row">

                        <label class="fs-6 fw-semibold mb-2">Attachments</label>
                        <!--begin::Dropzone-->
                        <div>
                            <label for="ata" class="dropzone d-block" id="kt_modal_create_ticket_attachments">
                                <input hidden type="file" id="ata" name="image">
                                <!--begin::Message-->
                                <div class="dz-message needsclick align-items-center">
                                    <!--begin::Icon-->
                                    <i class="ki-outline ki-file-up fs-3hx text-primary"></i>
                                    <!--end::Icon-->
                                    <!--begin::Info-->
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Upto 5mb maximum size.</h3>
                                    </div>
                                    <!--end::Info-->
                                </div>
                            </label>
                            @error('image')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_ticket_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>

        </div>
    </div>

</div>
@endsection

