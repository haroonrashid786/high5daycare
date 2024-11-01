@extends('layouts.app')
@role('Admin')
@section('title', 'Create Ticket | Admin | High5 Daycare')
@elserole('Franchise')
@section('title', 'Create Ticket | Provider | High5 Daycare')
@else
@section('title', 'Create Ticket | Parent | High5 Daycare')
@endrole
@section('content')


<style>
   .app-content{
    margin-bottom: 10px;
    background: transparent;
   }
   
    .card{
        box-shadow: none;
    }
   
</style>
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">
        <div class="myFormDiv">
            <form id="kt_modal_new_ticket_form" class="form bg-white py-8 py-lg-10 rounded-3 px-6" action="{{route('start.ticket')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3 text-black">Create Ticket</h1>
                    <!--end::Title-->
                    <!--begin::Description-->

                    <!--end::Description-->
                </div>
                <!--end::Heading-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Recipient</span>
                        <span class="ms-2" data-bs-toggle="tooltip" title="Specify a subject for your issue">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid custom_search" data-control="select2" data-hide-search="false" data-placeholder="Select a recipient" name="receiver_id" required="required">
                        <option value="">Select a Recipient...</option>
                        @if(isset($dropdownOptions) && !empty($dropdownOptions))
                        @foreach ($dropdownOptions as $label => $options)
                        <optgroup label="{{ $label }}">
                            @foreach ($options as $option)
                            @php
                            $optionValue = ($label === 'Providers' || $label === 'Parents') ? $option->user_id : $option->id;
                            @endphp
                            <option value="{{ $optionValue }}">@role('Admin') @if(isset($label) && $label === 'Parents') {{ ucfirst($option->name) }} - {{ ucfirst(optional($option->provider)->name) }} @else {{ ucfirst($option->name) }} @endif
                                @else {{ ucfirst($option->name) }} @endrole</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                        @endif
                    </select>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Subject</span>
                        <span class="ms-2" data-bs-toggle="tooltip" title="Specify a subject for your issue">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Enter your ticket subject" name="subject" value="{{old('subject')}}" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class="required fs-6 fw-semibold mb-2">Reason</label>
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a product" name="reason_id" required="required">
                            <option value="">Select a reason...</option>
                            @if(isset($reasons) && !empty($reasons))
                            @foreach($reasons as $r)
                            <option value="{{$r->id}}">{{ $r->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 fv-row">

                        <label class="fs-6 fw-semibold mb-2">Attachments</label>
                        <!--begin::Dropzone-->
                        <div>
                            <label for="ata" class="dropzone d-block" id="kt_modal_create_ticket_attachments">
                                <input hidden type="file" id="ata" name="attachment[]">
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
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->

                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->

                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Description</label>
                    <textarea class="form-control form-control-solid" rows="4" name="description" placeholder="Type your ticket description" required></textarea>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">

                    <!--end::Dropzone-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->

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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>



<script>
    $(document).ready(function() {
        function modelMatcher(params, data) {
            data.parentText = data.parentText || "";

            // Always return the object if there is nothing to compare
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do a recursive check for options with children
            if (data.children && data.children.length > 0) {
                // Clone the data object if there are children
                // This is required as we modify the object to remove any non-matches
                var match = $.extend(true, {}, data);

                // Check each child of the option
                for (var c = data.children.length - 1; c >= 0; c--) {
                    var child = data.children[c];
                    child.parentText += data.parentText + " " + data.text;

                    var matches = modelMatcher(params, child);

                    // If there wasn't a match, remove the object in the array
                    if (matches == null) {
                        match.children.splice(c, 1);
                    }
                }

                // If any children matched, return the new object
                if (match.children.length > 0) {
                    return match;
                }

                // If there were no matching children, check just the plain object
                return modelMatcher(params, match);
            }

            // If the typed-in term matches the text of this term, or the text from any
            // parent term, then it's a match.
            var original = (data.parentText + ' ' + data.text).toUpperCase();
            var term = params.term.toUpperCase();


            // Check if the text contains the term
            if (original.indexOf(term) > -1) {
                return data;
            }

            // If it doesn't contain the term, don't return anything
            return null;
        }
        $(".custom_search").select2({
            matcher: modelMatcher
        });

    });
</script>