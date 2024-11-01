@extends('layouts.app')
@section('title', 'Provider Contract | High5 Daycare')
@section('content')
<style>
    .input__signature{
        outline: none;
        border-bottom: 1px solid black !important;
        padding: 5px;
    }
    ol > li{
        margin: 10px 0;
    }
        @media (max-width: 1200px) {
    .wrap__container{
        flex-direction: column;
    }
    .wrap__container p  {
        text-wrap: nowrap;
        }
    }
    @media (max-width: 500px) {
        .wrap__signature__container {
            flex-direction: column;
            align-items: start !important;
        }

        .wrap__container p {
            text-wrap: wrap;
        }
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
                            <span>Provider Contract</span>
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
                        <li class="breadcrumb-item text-white">Provider Contract</li>
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
                            <form class="form" method="POST" id="kt_modal_add_event_form" action="{{ route('add.provider.guide',['provider'=> $provider->id]) }}">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <h1 class="text-center">High Five Day Care Agency </h1>
                                        <p class="text-center">1434 Orr Terrace , Milton , Ontario, L9E0B4     Phone no. 9054628120</p>
                                        <div class="d-flex align-item-center justify-content-center border border-dark p-2 fw-bold my-5"><h3 class="fw-bold">PURCHASE OF SERVICE</h3></div>
                                        <div class="rounded p-4 border mb-6">
                                        <h5>INTRODUCTION</h5>
                                        <ol>
  <li>In consideration of Home Childcare, we are appointing you as a Child Care Provider to render private home childcare services from time to time when called upon to do so for up to six children; three children under the age of 2 years, which includes the Provider’s children under 4 years is included.</li>
  
  <li>High Five Day Care requires the child care provider to complete all required background checks prior to performing any work, or upon signing the “Waiver for Incomplete Pre-requisites” form. If the provider uses services from a student, volunteer, or assistant, it is the responsibility of the childcare provider to ensure that sufficient background checks are provided, according to the Child Care Manual for Home Providers.</li>
  
  <li>Although the manner and hours of operation remain the responsibility of the Child Care Provider, all rules, regulations, policies, and procedures of the High Five Day Care Agency must be strictly adhered to, as required by the licensing body, the Ministry of Education. The Child Care Provider must also agree and adhere to all applicable provincial and regional legislation governing the operation of a home childcare business. The Child Care Provider agrees that this contract may be terminated immediately without notice if there is any failure to comply with any of the above.</li>
  
  <li>High Five Day Care will accept the “Daily Attendance” form as an invoice for payment at the stated rate per child, along with available grants from the Government of Ontario. High Five Day Care agrees to pay for all regularly scheduled days and statutory holidays.</li>
  
  <li>High Five Day Care may verify compliance with all above, without notice at any time during regular child care hours (Monday-Friday, 7 am-6 pm). Verification is done by visits to the home by a High Five Day Care and/or Ministry representative. At least 4 visits will be made annually.</li>
  
  <li>This contract is current and valid so long as least one (1) High Five Day Care-enrolled child is actively registered and currently attending the High Five Day Care home. The contract is no longer current or valid if the child care provider does not have at least one High Five Day Care-enrolled child registered and currently attending.</li>
  
  <li>All payments will be made to the Home Child Care Provider without any source deductions, via direct deposit. Payments are made on 20th of the month for the servicing period of 1-15th and on 5th of the next month for the servicing period of 16th – 31st of the month and for the previous two weeks of service (including the day of the payment). Payment will not be made for personal or vacation days requested by the provider.</li>
  
  <li>All home child care premises licensed through High Five Day Care must have liability coverage for their home for a minimum of $2 million. Insurance is inspected upon each home visit.</li>
  
  <li>The Home Child Care Provider is an independent contractor, and not an agent, officer, or employee of High Five Day Care. The Home Child Care Provider will agree to indemnify and hold harmless High Five Day Care from any claims, liabilities or proceedings by third parties arising out of the operation of the home childcare business.</li>
  
  <li>Home Child Care Provider is supposed to maintain their own equipment in terms of purchasing or repair for cots, cribs, high chair, staircase gate, playpens. They should be maintained in safe condition. During the repair period, the Agency will support the provider in order to provide quality care to the children attending the home child care premises.</li>
  <li>Home Child Care Provider has to fulfill the adequate numbers of toys and equipment to keep them in rotation and should be enough to fulfill the learning and development for all kids attending the childcare program.</li>
  
  <li>Home Child Care Provider is responsible to have sleeping equipment for the age of younger than 18 months old, 18 months till 7 years old.</li>
  
  <li>The Provider should hereby absolve the Agency of all liability due to any accident or injury which may occur during the course of rendering private home child care.</li>
  
  <li>Provider shall keep regular and accurate records of the time during which private home child care is provided for each child, the fees collected if any, for such services, that she shall remit her records and accounts whenever requested to do so, and keep records on file for a minimum of three years.</li>
  
  <li>Provider is supposed to authorize the Agency to request and obtain reference information pertaining to my application to provide child care services.</li>
  
  <li>That the Agency may terminate this Agreement with the Provider for any reason and without notice where the Provider fails to comply with the terms and conditions, the provisions of the Child Care and Early Years Act, 2014, or fails to provide a level of care or environment for the child(ren) acceptable to the agency. In the event that a parent/guardian withdraws any child(ren) from the Provider’s care without giving two weeks’ advance notice to the Agency, the Provider will be paid an amount equivalent to one week's compensation for each child withdrawn.</li>
  
  <li>Provider will ensure that an adult supervises children at all times.</li>
  
  <li>Renewal of CPR training practices annually and renewal of First Aid practices every three years is required.</li>
  
  <li>Communicate regularly with a Home Visitor and seek advice if problems arise involving the children and their families. Your home must be accessible to the Home Visitor for monthly visits.</li>
  
  <li>Give written notice of agreement termination or vacation plans to the Agency within a time specified in the agreement (2 weeks’ notice required).</li>
  
  <li>Comply with the provisions of High 5 Day Care reporting any suspected cases of child abuse to the appropriate authorities (as per the Child Abuse and Neglect policy).</li>
  
  <li>Provider is supposed to tell High Five Day Care Agency or Home visitor about the enrollment of any kid (private), within 1 business day.</li>
  
  <li>Provider should have current General Liability and Personal Injury Insurance.</li>
  
  <li>If transporting children, Provider should be aware to maintain a current Ontario Driver’s License as well as current Vehicle Insurance.</li>
</ol>
<div class="d-flex align-items-center gap-5 w-100 wrap__container mb-5">
    <div class="d-flex align-items-center gap-3 w-100 wrap__signature__container ">
        <p class="">High5 Representative Signature:</p>
        <input type="text" class="w-100 bg-transparent border-bottom border-0 input__signature" placeholder="signature" name="admin_signature" value="{{ old('admin_signature', $provider->admin_signature ?? '' )}}">
    </div>
    <div class="d-flex align-items-center gap-3 w-100 ">
        <p class="Date">Date:</p>
        <input type="date" class="form-control" name="admin_signature_date" value="{{ old('admin_signature_date', $provider->admin_signature_date ? date('Y-m-d', strtotime($provider->admin_signature_date)) : ''  ) }}">
    </div>
</div>
<div class="d-flex align-items-center gap-3 w-100 wrap__container">
    <div class="d-flex align-items-center gap-3 w-100 wrap__signature__container ">
        <p class="">Provider Signature:</p>
        <input type="text" class="w-100 bg-transparent border-bottom border-0 input__signature"  placeholder="signature" name="contract_signature" value="{{ old('contract_signature', $provider->contract_signature ?? '' )}}">
    </div>
    <div class="d-flex align-items-center gap-3 w-100 ">
        <p class="Date">Date:</p>
        <input type="date" class="form-control"  name="contract_signature_date" value="{{ old('contract_signature_date', $provider->contract_signature_date ? date('Y-m-d', strtotime($provider->contract_signature_date)) : ''  ) }}">
    </div>
</div>
                             </div>

                                    </div>

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