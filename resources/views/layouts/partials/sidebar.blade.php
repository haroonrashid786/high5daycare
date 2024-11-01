<style>
.unread-card {
    background-color: #557239!important; 
    color: white;
}
@keyframes blink {
    0% { background-color: white;color:red; }
    50% { background-color: red;color:white; }
    100% { background-color: white;color:red;}
}
.blink {
    /* color: orange; */
    animation: blink 1s infinite; 
}
.divyy{
    margin-bottom: 0rem !important;
}
@media screen and (min-width:992px) {
    .divyy{
        margin-bottom: 15rem !important;
    }
    #kt_app_sidebar{
        margin-bottom: 10px !important;
        border-radius: 20px !important;
    }
}

.divyy a{
    justify-content: space-evenly !important;
}

</style>
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Wrapper container-->
                <div class="app-container container-xxl d-flex flex-row-fluid">
                    <!--begin::Sidebar-->
                    <div style="position:fixed !important;" id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
                        <!--begin::Sidebar nav-->
                        <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
                            <!--begin::Nav wrapper-->
                            <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column pb-8 px-8 px-lg-10 hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}" data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper" data-kt-scroll-offset="{default: '10px', lg: '40px'}">
                                <!--begin::Progress-->
                            
                                <!--end::Progress-->
                                <!--begin::Stats-->
                                
                                <!--end::Stats-->
                                <!--begin::Links-->
                                <div class="divyy" >
                                    <!--begin::Title-->
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <h3 class="text-black fs-1 fw-bold mb-4">Menu</h3>
                                        <button class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none mb-8" id="kt_app_sidebar_toggle">
                                            <!-- <i class="ki-outline ki-abstract-14 fs-2"></i> -->
                                            <i class="fa-solid fa-xmark fs-2"></i>   
                                        </button>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Row-->
                                    <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                        <!--begin::Col-->


                            <!-- Attendance -->
                            <div class="col-6">
                                <a @role('Admin') href="{{route('admin.attendance')}}" @elserole('Franchise','Parent') href="{{route('attendance')}}" @endrole class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <!-- <i class="ki-outline ki-calendar fs-1"></i> -->
                                        <img src="{{asset('assets/media/attendence.svg')}}" class="" alt="" />
                                    </span>

                                    <span class="fs-7 fw-bold">Attendance</span>
                                </a>
                            </div>
                            <!-- Attendance -->

                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('activity-sheets')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-between w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/activity_sheet.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 text-black fw-bold">Activity Sheets</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Col-->

                            @role('Admin','Franchise','Parent')
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Link-->
                                <a @role('Admin') href="{{route('admin.kids')}}" @elserole('Franchise') href="{{route('provider.kids')}}" @else href="{{route('parent.kids')}}" @endrole class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/kids2.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Kids</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Col-->
                            @endrole

                            @role('Parent')
                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('parent.provider')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/Vector.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Provider</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Col-->
                            @endrole

                            <!--begin::Col-->

                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('communication')}}" class="position-relative btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    @if ($unreadMessages > 0)
                                    <div style="line-height:2px;height: 18px;width: 18px;display: flex;align-items: center;justify-content: center;transform: translate(50%, -50%);" class="blink position-absolute top-0 end-0 p-2 rounded fs-8 border border-danger">{{$unreadMessages}}</div>
                                    @endif
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/communication.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Communication</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>

                            <!-- Invoices -->
                            <div class="col-6">
                                <a href="{{route('payments')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/payments.svg')}}" class="" alt="" />
                                    </span>

                                    <span class="fs-7 fw-bold">Payments</span>
                                </a>
                            </div>
                            <!-- Invoices -->


                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('daily-updates')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/daily_updates.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Daily Updates</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>

                            <!-- Meals Actions -->
                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('meals.index')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/meals.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Meals</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>
                            <!-- Meals Actions -->


                            @role('Admin')
                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('admin.providers')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/providers2.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Providers</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>
                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('admin.parents')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/parents2.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Parents</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>

                            <div class="col-6">
                                <!--begin::Link-->
                                <a href="{{route('fundings')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <!--begin::Icon-->
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/ministry_funding.svg')}}" class="" alt="" />
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <span class="fs-7 fw-bold">Ministry Fundings</span>
                                    <!--end::Label-->
                                </a>
                                <!--end::Link-->
                            </div>

                            @elserole('Franchise')
                            <div class="col-6">
                                <a href="{{route('provider.parents')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/Vector-6.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Parents</span>
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="{{route('provider.aboutMe')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/Vector-6.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">About Me</span>
                                </a>
                            </div>
                            @endrole


                            <div class="col-6">
                                <a href="{{route('incidents')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/incident_reports.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Incident Reports</span>
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="{{route('survey.index')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/survey2.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Survey</span>
                                </a>
                            </div>

                            @role('Admin')
                            <div class="col-6">
                                <a href="{{route('ledger.index')}}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/ledgers.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Ledgers</span>
                                </a>
                            </div>
                            @elserole('Franchise')
                            <!-- <div class="col-6">
                                <a href="{{ route('ledger.provider.payments',['provider_id'=> Auth::user()->provider->id ]) }}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/ledgers.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Ledger</span>
                                </a>
                            </div> -->
                            @endrole

                            <!-- Nap Timings -->
                            <div class="col-6">
                                <a @role('Admin') href="{{route('admin.nap.time')}}" @elserole('Franchise','Parent') href="{{route('all.nap.pd')}}" @endrole class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <!-- <i class="ki-outline ki-calendar fs-1"></i> -->
                                        <img src="{{asset('assets/media/nap_log.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Nap Log</span>
                                </a>
                            </div>
                            <!-- Nap Timings -->

                            @role('Admin')
                            <!-- blogs Timings -->
                            <div class="col-6">
                                <a @role('Admin') href="{{route('all.blogs')}}" @elserole('Franchise','Parent') href="{{route('all.nap.pd')}}" @endrole class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                    <span class="mb-2">
                                        <img src="{{asset('assets/media/blogs.svg')}}" class="" alt="" />
                                    </span>
                                    <span class="fs-7 fw-bold">Blogs</span>
                                </a>
                            </div> 
                            <!-- blogs Timings -->
                            @endrole
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Nav wrapper-->
            </div>
            <!--end::Sidebar nav-->
        </div>
        <!-- end::Sidebar -->