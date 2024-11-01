@extends('layouts.app')
@section('title', 'Add Incident | Provider | High5 Daycare')
@section('content')

<style>
    .daycare_form_logo {
        width: 9.375rem;
    }

    .incident_form_img {
        width: 25rem;
        height: 25rem;
    }

    .form_input {
        outline: none;
        border: none;
        border-bottom: 1px solid black;
        width: 100%;
    }

    textarea {
        height: 200px;
        resize: none;
    }

    .input_size_fit {
        width: fit-content;
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
                        <h1
                            class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Accident Info Form</span>
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
                        <li class="breadcrumb-item text-white">Accident Form </li>
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
        <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">


            <div class="">
            <form @isset($report) action="{{route('add.update.incident', ['reportId' => $report->id])}}" @else action="{{route('add.update.incident')}}" @endisset class="px-5" method="POST">
                    @csrf
                    <h3 class="fs-2 py-3">Accident Information</h3>
                    <div class="d-flex flex-column gap-5">
                        <div class="">
                            <label for="" class="d-block">Child’s Full Name:</label>
                            <select id="" class="form_input" name="kid_id" data-control="select2" data-hide-search="false" required @role('Parent') readonly @endrole>
                                @if(isset($kids) && !empty($kids) && count($kids) > 0)
                                @foreach($kids as $kid)
                                <option value="{{$kid->id}}" @if(isset($report) && $report->kid_id == $kid->id || old('kid_id') == $kid->id) selected @endif>{{$kid->full_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('kid_id')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="">
                            <label for="" class="d-block">Date of Accident:</label>
                            <input type="date" class="form_input" name="accident_date" id="" value="{{old('accident_date', isset($report->accident_date) ? date('Y-m-d', strtotime($report->accident_date)) : ''  )}}" @role('Parent') readonly @endrole>
                            @error('accident_date')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="">
                            <label for="" class="d-block">Time of Accident:</label>
                            <input type="time" class="form_input" name="accident_time" id="" value="{{ old('accident_time', isset($report->accident_time) ? $report->accident_time : ''  )}}" @role('Parent') readonly @endrole>
                            @error('accident_time')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="">
                            <label for="" class="d-block">Location where the accident occurred:</label>
                            <input type="text" class="form_input" name="location" id="" value="{{ old('location', isset($report->location) ? $report->location : ''  )}}" @role('Parent') readonly @endrole>
                            @error('location')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="">
                            <label for="" class="d-block">Name(s) of individual(s) who observed the
                                accident:</label>
                            <input type="text" class="form_input" name="observer" id="" value="{{ old('observer', isset($report->observer) ? $report->observer : ''  )}}" @role('Parent') readonly @endrole>
                            @error('observer')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="">
                            <p class="">Please circle the area(s) of the child’s body where the injury occurred:</p>
                            <div class="d-flex gap-5 align-items-start ">
                                <img src="{{asset('assets/media/incident_form.png')}}" class="incident_form_img" alt="img">
                                <div class="p-5 mt-5" style="border: 1px solid black;">
                                    <h3 class="">Nature of the Injury:</h3>
                                    <div class="d-flex gap-3">
                                        <input type="checkbox" class="form_input input_size_fit" name="nature_of_injury[]" value="Bruise" id=""  {{ in_array('Bruise', old('nature_of_injury', json_decode($report->nature_of_injury ?? '[]'))) ? 'checked' : '' }} @role('Parent') readonly @endrole>
                                        <label for="" class="d-block">Bruise</label>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <input type="checkbox" class="form_input input_size_fit" name="nature_of_injury[]" value="Scrape" id="" {{ in_array('Scrape', old('nature_of_injury', json_decode($report->nature_of_injury ?? '[]'))) ? 'checked' : '' }} @role('Parent') readonly @endrole>
                                        <label for="" class="d-block">Scrape</label>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <input type="checkbox" class="form_input input_size_fit" name="nature_of_injury[]" value="Cut" id="" {{ in_array('Cut', old('nature_of_injury', json_decode($report->nature_of_injury ?? '[]'))) ? 'checked' : '' }} @role('Parent') readonly @endrole>
                                        <label for="" class="d-block">Cut</label>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <input type="checkbox" class="form_input input_size_fit" name="nature_of_injury[]" value="Bump" id="" {{ in_array('Bump', old('nature_of_injury', json_decode($report->nature_of_injury ?? '[]'))) ? 'checked' : '' }} @role('Parent') readonly @endrole>
                                        <label for="" class="d-block">Bump</label>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <input type="checkbox" class="form_input input_size_fit" name="nature_of_injury[]" id="" value="Other" {{ in_array('Other', old('nature_of_injury', json_decode($report->nature_of_injury ?? '[]'))) ? 'checked' : '' }} @role('Parent') readonly @endrole>
                                        <label for="" class="d-block">Other: <input type="text" class="form_input input_size_fit" name="other_injury" id="" value="{{ old('other_injury', isset($report->other_injury) ? $report->other_injury : ''  )}}" @role('Parent') readonly @endrole></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label for="" class="d-block">Description of what Caused the Accident/Injury:</label>
                            <textarea name="description" id="" class="w-100" class="form_textarea" @role('Parent') readonly @endrole>{{ old('description', isset($report->description) ? $report->description : ''  )}}</textarea>
                            @error('description')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="">
                            <label for="" class="d-block">First Aid Administered and by Whom:</label>
                            <textarea name="first_aid" id="" class="w-100" class="form_textarea" @role('Parent') readonly @endrole>{{ old('first_aid', isset($report->first_aid) ? $report->first_aid : ''  )}}</textarea>
                            @error('first_aid')
                            <div style="color: red;">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex align-items-start justify-content-center gap-5 flex-column">
                            <h3 class="">How and when the parent/guardian was notified:</h3>
                            <div class="d-flex gap-5 justify-content-between align-items-end">
                                <div class="d-flex gap-3">
                                    <input type="checkbox" class="form_input input_size_fit" name="phone_notified" id="" @if(isset($report) && $report->phone_notified == 1 || old('phone_notified') == 1) checked @endif  @role('Parent') disabled @endrole>
                                    <label for="" class="d-block">Phone</label>
                                </div>

                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">Time notified:</label>
                                    <input type="time" class="form_input input_size_fit" name="phone_notified_time" id="" value="{{ old('phone_notified_time', isset($report->phone_notified_time) ? $report->phone_notified_time : ''  )}}" @role('Parent') readonly @endrole>
                                </div>
                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">By Whom:</label>
                                    <input type="text" class="form_input input_size_fit" name="phone_notified_by" id="" value="{{ old('phone_notified_by', isset($report->phone_notified_by) ? $report->phone_notified_by : ''  )}}" @role('Parent') readonly @endrole>
                                </div>

                            </div>
                            <div class="d-flex gap-3 justify-content-between align-items-end">
                                <div class="d-flex gap-3">
                                    <input type="checkbox" class="form_input input_size_fit" name="voicemail_notified" id="" @if(isset($report) && $report->voicemail_notified == 1 || old('voicemail_notified') == 1) checked @endif @role('Parent') disabled @endrole>
                                    <label for="" class="d-block">Voicemail was left</label>
                                </div>

                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">Time notified:</label>
                                    <input type="time" class="form_input input_size_fit" name="voicemail_notified_time" id="" value="{{ old('voicemail_notified_time', isset($report->voicemail_notified_time) ? $report->voicemail_notified_time : ''  )}}" @role('Parent') readonly @endrole>
                                </div>
                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">By Whom:</label>
                                    <input type="text" class="form_input input_size_fit" name="voicemail_notified_by" id="" value="{{ old('voicemail_notified_by', isset($report->voicemail_notified_by) ? $report->voicemail_notified_by : ''  )}}" @role('Parent') readonly @endrole>
                                </div>

                            </div>
                            <div class="d-flex gap-3 justify-content-between align-items-end">
                                <div class="d-flex gap-3">
                                    <input type="checkbox" class="form_input input_size_fit" name="email_notified" id="" @if(isset($report) && $report->email_notified == 1 || old('email_notified') == 1) checked @endif @role('Parent') disabled @endrole>
                                    <label for="" class="d-block">Email</label>
                                </div>

                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">Time notified:</label>
                                    <input type="time" class="form_input input_size_fit" name="email_notified_time" id="" value="{{ old('email_notified_time', isset($report->email_notified_time) ? $report->email_notified_time : ''  )}}" @role('Parent') readonly @endrole>
                                </div>
                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">By Whom:</label>
                                    <input type="text" class="form_input input_size_fit" name="email_notified_by" id="" value="{{ old('email_notified_by', isset($report->email_notified_by) ? $report->email_notified_by : ''  )}}" @role('Parent') readonly @endrole>
                                </div>

                            </div>
                            <div class="d-flex gap-3 justify-content-between align-items-end">
                                <div class="d-flex gap-3">
                                    <input type="checkbox" class="form_input input_size_fit" name="in_person_notified" id="" @if(isset($report) && $report->in_person_notified == 1 || old('in_person_notified') == 1) checked @endif @role('Parent') readonly @endrole>
                                    <label for="" class="d-block">In-person at pick-up</label>
                                </div>

                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">Time notified:</label>
                                    <input type="time" class="form_input input_size_fit" name="in_person_notified_time" id="" value="{{ old('in_person_notified_time', isset($report->in_person_notified_time) ? $report->in_person_notified_time : ''  )}}" @role('Parent') readonly @endrole>
                                </div>
                                <div class="d-flex gap-3">
                                    <label for="" class="d-block">By Whom:</label>
                                    <input type="text" class="form_input input_size_fit" name="in_person_notified_by" id="" value="{{ old('in_person_notified_by', isset($report->in_person_notified_by) ? $report->in_person_notified_by : ''  )}}" @role('Parent') readonly @endrole>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex flex-column gap-5">
                            <h3 class="">Administrative Information</h3>
                            <p class="">
                                A copy (email/photocopy) of this report has been provided to a parent/guardian of the
                                child by <input type="text" class="form_input input_size_fit " name="report_provided_by" id="" value="{{ old('report_provided_by', isset($report->report_provided_by) ? $report->report_provided_by : ''  )}}" @role('Parent') readonly @endrole>
                                (name). </p>
                                            @error('report_provided_by')
                                            <div style="color: red;">
                                            {{ $message }}
                                            </div>
                                            @enderror
                            <div class="">
                                <label for="" class="d-block">Parent/Guardian Name:</label>
                                <input type="text" class="form_input" name="guardian_name" id="" value="{{ old('guardian_name', isset($report->guardian_name) ? $report->guardian_name : ''  )}}" @role('Admin','Franchise') readonly @endrole>
                                @error('guardian_name')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="">
                                <label for="" class="d-block">Parent/Guardian Signature: </label>
                                <input type="text" class="form_input" name="guardian_signature" id="" value="{{ old('guardian_signature', isset($report->guardian_signature) ? $report->guardian_signature : ''  )}}" @role('Admin','Franchise') readonly @endrole>
                                @error('guardian_signature')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="">
                                <label for="" class="d-block">Provider/Agency Representative Signature:</label>
                                <input type="text" class="form_input" name="provider_signature" id="" value="{{ old('provider_signature', isset($report->provider_signature) ? $report->provider_signature : ''  )}}" @role('Parent') readonly @endrole>
                                @error('provider_signature')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <p class=""> <span class="fs-5 fw-bold"> Note to Parents: </span> Please consider providing
                                us with a status update the next day that your child participates in the childcare
                                program, so that any additional health or safety needs can be met.</p>
                        </div>
                        <div class="d-flex flex-column gap-5">
                            <div class="">
                                <label for="" class="d-block">Name of home childcare provider:</label>
                                <input type="text" class="form_input" name="childcare_provider_name" id="" value="{{ old('childcare_provider_name', isset($report->childcare_provider_name) ? $report->childcare_provider_name : ''  )}}" @role('Parent') readonly @endrole>
                                @error('childcare_provider_name')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="">
                                <label for="" class="d-block">Address: </label>
                                <input type="text" class="form_input" name="childcare_provider_address" id=""  value="{{ old('childcare_provider_address', isset($report->childcare_provider_address) ? $report->childcare_provider_address : ''  )}}" @role('Parent') readonly @endrole>
                                @error('childcare_provider_address')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="d-flex gap-3">
                                <label for="" class="d-block">Name and position of the individual completing this form:
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="checkbox" class="" name="same_as_provider" id="" @if(isset($report) && $report->same_as_provider == 1 || old('same_as_provider') == 1) checked @endif @role('Parent') readonly @endrole>
                                    <span>same as above (provider)</span>
                                @error('same_as_provider')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                                </div>
                            </div>
                            <div class="">
                                <h4 class="fs-4">OR</h4>
                                <input type="text" class="form_input" name="filled_by" id="" value="{{ old('filled_by', isset($report->filled_by) ? $report->filled_by : ''  )}}" @role('Parent') readonly @endrole>
                                @error('filled_by')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="">
                                <label for="" class="d-block">Signature (if any other individual is completing this form):</label>
                                <input type="text" class="form_input" name="signature_filled_by" id=""  value="{{ old('signature_filled_by', isset($report->signature_filled_by) ? $report->signature_filled_by : ''  )}}" @role('Parent') readonly @endrole>
                                @error('signature_filled_by')
                                <div style="color: red;">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @role('Admin', 'Franchise','Parent')
                    <div class="d-flex justify-content-end">    
                        <button class="btn btn-primary mt-6" type="submit">Submit</button>
                    </div>
                    @endrole
                </form>
            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>



@endsection