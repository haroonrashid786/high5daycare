@extends('layouts.app')
@section('title', 'Contract Infant | High5 Daycare')
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
                            <span>Contract Infant</span>
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
                        <li class="breadcrumb-item text-white">Contract Infant</li>
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
                            <form class="form" action="{{route('add.kid.contract',['kid' => $kid->id])}}" method="POST" id="kt_modal_add_event_form">
                                @csrf

                                <input type="hidden" name="contract_type" value="infant">
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">EDUCATIONAL PROGRAM</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <div class="rounded p-4 border mb-6">
                                            <p> <span class="h6">Toddlers</span> learn about their world by exploring
                                                their environment. Your child's language skills will progress through
                                                poems and educational books, stories and encouragement.
                                                This will give your child opportunities to develop their cognitive,
                                                language and fine motor skills.</p>
                                            <p>
                                                <span class="h6">Preschoolers</span>, we encourage your child to
                                                practice tracing/ writing alphabets, numbers, master concepts of size,
                                                color, numbers, shapes, pre-reading and writing skills for school
                                                readiness.
                                            </p>
                                            <p>
                                                <span class="h6">Kinder-age child</span>, we continue with the
                                                educational series, A.B.C’s, 1,2,3’s, continues to complement the school
                                                curriculum. Your child get into addition, subtraction, building three to
                                                four letter words based on his/ her ability.
                                            </p>
                                        </div>

                                        <h1 class="text-center">CONTRACT POLICY</h1>

                                        <div class="rounded p-4 border mb-6">
                                            <h5>HOURS OF SERVICE</h5>
                                            <p>Daycare is open from 7.00 a.m. to 6.00 p.m. The child can be dropped
                                                anytime between these hours for up to 9 hours a day. Please call and
                                                inform us if you are running late after 5pm.</p>
                                            <h5>PAY SCHEDULE</h5>
                                            <p>Daycare charges are $23.55 for maximum of 9 hrs a day. 4 hours or more is
                                                considered a full day. Two weeks payment would be paid in advance. The
                                                payment should be made 2 weeks before month starts. The payment should
                                                be made by providing postdated cheques in the name of Sidra Altaf dated
                                                1st of every month. The payment can also be done by e-transfer every 1s
                                                of the month high5daycareinc@gmail.com The payment is based on number of
                                                working days in every
                                                month. If a statutory holiday falls on a weekday, it would be considered
                                                as paid.
                                                If statutory holiday falls on weekend, then following Monday would be
                                                closed and considered paid.</p>
                                            <h5>TERMINATION</h5>
                                            <p>One month notice or more if you know ahead of time, is required at the
                                                time of termination. By signing a contract agreement, you agree to give
                                                two weeks notice before terminating care or you will have to pay
                                                termination fee of $100 to terminate immediately If due to some personal
                                                reason, daycare provider has the right terminate the child, you will be
                                                notified a month in advance.</p>
                                            <h5>SICK DAY</h5>
                                            <p>If your child has diarrhea, vomiting, 100 degree fever or more, the child
                                                is considered sick and he/ she should stay home until the condition
                                                persists. If your child gets sick in the daycare, parent will be
                                                immediately notified to take the child home. Since the daycare is open,
                                                it will be
                                                charged.</p>

                                            <h5>HOLIDAYS</h5>
                                            <p>Following holidays would be considered as Paid holidays.
                                                New year, Family day, Good Friday, Victoria Day, Canada day, Civic
                                                Holiday, Labor Day, Thanksgiving, Christmas, Boxing Day, Eid-ul-Fitr,
                                                Eid-ul-Azha, and Diwali (Eid and Diwali respectively). If a statutory
                                                holiday falls on a weekday, it would be considered as paid. If statutory
                                                holiday falls on weekend, then following Monday would be closed and
                                                considered paid.</p>
                                            <h5>VACATION</h5>
                                            <p>If you plan for vacation, you need to inform in advance. You would be
                                                charged in full payment in order to hold your spot or you will lose the
                                                spot.
                                                Any other days taken off/ child kept home, dr appointment etc or brought
                                                late, picked early or if child does not come, it would be charged as the
                                                daycare is open and it is your child spot. If daycare provider plans for
                                                vacation, we will let you know in advance and you would need to arrange
                                                backup for your child. It will not be charged if we are closed.</p>
                                            <h5>MEALS</h5>
                                            <p>We provide healthy and nutritious meals. We would provide a breakfast,
                                                lunch and afternoon snack. Children are offered food whenever hungry
                                                and alternates food is also provided as per child request.</p>
                                                <h5>NAP TIME</h5>
                                                <p>Children under the age of four years old are required to lie down in the afternoon. Naptime is between 12.00p.m. – 2:00 p.m. For infants, if the child requires there would be a morning nap.</p>
                                                <h5>PERSONAL ITEMS</h5>
                                                <p>Please provide the provider with the following items:</p>
                                                <ul>
                                                    <li>2 Extra pair of clothing, labeled with the child’s name, to be used in case of an accident. </li>
                                                    <li>Milk bottle, sippy cup,</li>
                                                    <li>Bip, diapers & wipes for those children</li>
                                                </ul>

                                                <h5>ACCIDENT</h5>
                                                <p>Children are kept under best care and protection in safe environment. While we do not anticipate any problems, however sudden accidents, breach of expected conduct on part of a child may result in accident, loss or injury and that the decision to send child in daycare is a personal and family decision and that in a case of accident, loss or injury High5 Daycare Agency will not be held responsible.</p>
                                                <h5>SMOKING/ PETS</h5>
                                                <p>No smoking and no pets allowed at all times.</p>
                                                <p>I have read the above policy and I agree with the above-mentioned policy.</p>
                                                <div class="row row-cols-2">
                                                    
                                                <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            PARENT'S NAME
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid"
                                                        name="parent_name" placeholder="" value="{{ old('parent_name', optional($kid->contract)->parent_name) ?? $kid->parent->name }}">
                                                        @error('parent_name')
                                                        <div style="color: red;">
                                                        {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            DATE
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="date" class="form-control form-control-solid"
                                                        name="date" placeholder="" value="{{ old('date', optional($kid->contract)->date ? date('Y-m-d', strtotime(optional($kid->contract)->date)) : ''  ) }}">
                                                        @error('date')
                                                        <div style="color: red;">
                                                        {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                            PARENT’S SIGNATURE
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid"
                                                        name="parent_signature" placeholder="" value="{{ old('parent_signature', optional($kid->contract)->parent_signature) ?: '' }}">
                                                        @error('parent_signature')
                                                        <div style="color: red;">
                                                        {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                        </div>

                                    </div>
                                    @role('Parent')
                                    <div class="modal-footer flex-right">
                                        <!--begin::Button-->
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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