<style>
    .notification_icon {
        color: #556d33;
        /* padding: 0 10px; */
        font-size: 25px;
        fill: #556d33;
        /* margin-bottom: 10px; */
        cursor: pointer;
    }
    .menu-sub-dropdown {
        z-index: 100 !important;
    }

    .notification_dropdown {
        position: absolute;
        right: 10px;
        top: 40px;
        background-color: white;
        padding: 10px;
        border-radius: 20px;
        z-index: 99;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        min-height: 200px;
        display: none;
        padding-top: 15px;

    }

    .close_notifications {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
        background-color: #eb6f4550;
        padding: 5;
        /* padding-left: 2px; */
        border-radius: 50%;
        width: 20px;
        height: 20px;
        z-index: 999;
    }

    .close_notifications:hover {
        background-color: #eb6f458f;
    }

    .notification_list {
        max-width: 250px;
        width: 250px;
        max-height: 300px;
        overflow-y: scroll;
        border: none;
        list-style: none;
        padding: 0;
        padding-left: 0;
    }

    .notification_bage {
        width: 20px;
        height: 20px;
        background-color: #eb6f45c0;
        color: white;
        font-size: 10px;
        margin-left: -10px;
    }

    .notification_list_item {
        border-bottom: 1px solid #eb6f45c0;
        padding: 8px 0;
    }

    .notification_list_heading {
        font-size: 14px;
        font-weight: bold;
    }

    .notification_list_date {
        font-size: 9px;
        font-weight: 500;
        color: #292b27;
    }

    .notification_list_item_icon {
        fill: white;
        font-size: 14px;
    }

    .notification_list_item_icon_box {
        background-color: #eb6f45;
        padding: 5px;
        border-radius: 50%;
        height: fit-content;
        margin-right: 10px;
    }

    .notification_list_item_link {
        text-decoration: none;
        color: black;
    }

    @media (max-width: 450px) {
        .notification_dropdown {
            right: 00px;

        }

    }

    @media (max-width: 500px) {
        .user_name {
            display: none;
        }

    }

    #kt_app_header_menu_wrapper,.app-navbar{
        border-bottom: 1px solid rgba(255,255,255,0.4);
    }

</style>
<div id="kt_app_header" class="app-header">
    <!--begin::Header container-->
    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <!--begin::Header wrapper-->
        <div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between" id="kt_app_header_wrapper">
            <!--begin::Logo wrapper-->
            <div class="app-header-logo d-flex">
                <!--begin::Logo wrapper-->
            @unless(in_array(Request::route()->getName(), ['login', 'auth.login',  'base', 'password.request', 'password.reset']))
                <button class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none" id="kt_app_sidebar_toggle">
                    <i class="ki-outline ki-abstract-14 fs-2"></i>
                </button>
            @endunless
                <!--end::Logo wrapper-->
                <!--begin::Logo image-->
                <a class="" @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise') href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole>
                    <img alt="Logo" src="{{ asset('assets/media/logos/daycare_logo.png') }}" class="h-40px h-lg-85px h-xl-100px theme-light-show" />
                </a>
                <!--end::Logo image-->
            </div> 
            <!--end::Logo wrapper-->
            <!--begin::Menu wrapper-->
            @unless(in_array(Request::route()->getName(), ['login', 'auth.login',  'base', 'password.request', 'password.reset']))
            <div id="kt_app_header_menu_wrapper" class="d-flex align-items-center w-100">
                <!--begin::Header menu-->
                <div class="app-header-menu app-header-mobile-drawer align-items-start align-items-lg-center w-100" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
                    <!--begin::Menu-->
                    <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-state-primary menu-title-gray-700 menu-arrow-gray-400 menu-bullet-gray-400 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
                        <!--begin:Menu item-->
                        @role('Admin')
                        <!-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start" data-kt-menu-offset="-100,0"
                            class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                            <a href="{{route('admin.home')}}">
                            <span class="menu-link">
                                <span class="menu-title">Home</span>
                            </span>
                            </a>

                        </div> -->
                        @endrole

                        <!--end:Menu item-->
                        <!--begin:Menu item-->

                        <!--end:Menu item-->
                        <!--begin:Menu item-->

                        <!--end:Menu item-->
                        <!--begin:Menu item-->

                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Header menu-->
            </div>
            @endunless
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            @auth
            <div class="app-navbar flex-shrink-0">
                <!--begin::Notifications-->

                <!--end::Notifications-->
                <!--begin::Quick links-->

                <!--end::Quick links-->
                <!--begin::Chat-->

                <!--end::Chat-->
                <!--begin::User menu-->

                <div class="cursor-pointer symbol symbol-35px symbol-md-40px d-flex align-items-center gap-3" data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <h4 class="user_name" style="font-size: 16px;color:white;">{{Auth::user()->name}}</h4>
                    <img class="" style="width: 60px; height: 60px; border-radius: 50%;" @role('admin', 'Franchise','Parent') src="{{ asset('assets/media/logos/favicon.png') }}" @else src="{{ optional(Auth::user()->parent)->display_picture ? url(Auth::user()->parent->display_picture) : asset('assets/admin.jpg') }}" @endrole alt="user" class="" />
                    <button class="border-0 d-flex align-items-center justify-content-center" style="background-color: transparent; width: 30px; height: 30px;">
                        <img class="" src="{{asset('assets/media/show_menu.svg')}}" alt="" />
                    </button>
                </div>
                <div class="app-navbar-item ms-3 ms-lg-5" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="position-relative">
                        
                        <div id='notification_icon' class="position-relative cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7071 8.79633C18.7071 10.0523 19.039 10.7925 19.7695 11.6456C20.3231 12.2741 20.5 13.0808 20.5 13.956C20.5 14.8302 20.2128 15.6601 19.6373 16.3339C18.884 17.1417 17.8215 17.6573 16.7372 17.747C15.1659 17.8809 13.5937 17.9937 12.0005 17.9937C10.4063 17.9937 8.83505 17.9263 7.26375 17.747C6.17846 17.6573 5.11602 17.1417 4.36367 16.3339C3.78822 15.6601 3.5 14.8302 3.5 13.956C3.5 13.0808 3.6779 12.2741 4.23049 11.6456C4.98384 10.7925 5.29392 10.0523 5.29392 8.79633V8.3703C5.29392 6.68834 5.71333 5.58852 6.577 4.51186C7.86106 2.9417 9.91935 2 11.9558 2H12.0452C14.1254 2 16.2502 2.98702 17.5125 4.62466C18.3314 5.67916 18.7071 6.73265 18.7071 8.3703V8.79633ZM9.07367 20.0608C9.07367 19.5573 9.53582 19.3266 9.96318 19.2279C10.4631 19.1222 13.5093 19.1222 14.0092 19.2279C14.4366 19.3266 14.8987 19.5573 14.8987 20.0608C14.8738 20.5402 14.5926 20.9653 14.204 21.2352C13.7001 21.628 13.1088 21.8767 12.4906 21.9664C12.1487 22.0107 11.8128 22.0117 11.4828 21.9664C10.8636 21.8767 10.2723 21.628 9.76938 21.2342C9.37978 20.9653 9.09852 20.5402 9.07367 20.0608Z" fill="white"/>
                            </svg>
                            @if($unreadNotifications > 0)
                            <span class="position-absolute d-flex align-items-center justify-content-center top-0 right-2 start-100 translate-middle badge rounded-circle notification_bage">
                                {{ $unreadNotifications }}
                            </span>
                            @endif
                        </div>
                        <div class="notification_dropdown " id="notification_dropdown">
                            <div class="">
                                <svg class="close_notifications" id="close_notifications" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                </svg>
                            </div>
                            <h3 class="">Notifications</h3>
                            <ul class="notification_list ">
                                @if(isset($notifications) && !empty($notifications) && count($notifications) > 0)
                                @foreach($notifications as $n)
                                <li class="notification_list_item ">
                                    <a href="{{route('notifications.read', ['notification' => $n->id])}}" class="notification_list_item_link d-flex">

                                        <div class="notification_list_item_icon_box">
                                            <svg class="notification_list_item_icon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                                <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                            </svg>
                                        </div>
                                        <div class="">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="notification_list_heading">{{ $n->title }}</h6>
                                                <p class="notification_list_date"><span class="">{{ $n->created_at->diffForHumans() }}</span>
                                                    <!-- <span>{{ $n->created_at->diffForHumans() }}</span> -->
                                                </p>
                                            </div>
                                            <p class="notification_list_item_message">{{ $n->message }}</p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5 w-auto">
                                <img alt="Logo" @role('admin','Franchise','Parent') src="{{ asset('assets/media/logos/favicon.png') }}" @else src="{{ optional(Auth::user()->parent)->display_picture ? url(Auth::user()->parent->display_picture) : asset('assets/media/logos/favicon.png') }}" @endrole />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">{{ucfirst(Auth::user()->name)}}
                                </div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->

                    <!--end::Menu item-->
                    <!--begin::Menu item-->

                    <!--end::Menu item-->
                    <!--begin::Menu item-->

                    <!--end::Menu item-->
                    <!--begin::Menu item-->

                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->

                    <!--end::Menu item-->
                    <!--begin::Menu item-->

                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                        <a href="{{route('settings')}}" class="menu-link px-5">Account
                            Settings</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5">Sign Out</a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User menu-->
            <!--begin::Header menu toggle-->
          
            <!--end::Header menu toggle-->
        </div>
        @endauth
        <!--end::Navbar-->
    </div>
    <!--end::Header wrapper-->
</div>
<!--end::Header container-->
</div>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        -moz-appearance: textfield;
        /* Firefox */

        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }
</style>

<script>
    const notification_icon = document.getElementById("notification_icon");
    const notification_dropdown = document.getElementById("notification_dropdown");
    const close_notifications = document.getElementById("close_notifications");
    const notification_messages = document.querySelectorAll(".notification_list_item_message");

    if (notification_icon && notification_dropdown) {
        notification_icon.addEventListener("click", function() {
            // Toggle the visibility of the notification dropdown
            notification_dropdown.style.display = "block";
        });
    }

    if (close_notifications && notification_dropdown) {
        close_notifications.addEventListener("click", function() {
            // Hide the notification dropdown when the close button is clicked
            notification_dropdown.style.display = "none";
        });
    }

    if (notification_messages) {
        notification_messages.forEach((notification_message) => {
            const originalMessage = notification_message.innerText;
            const truncatedMessage = originalMessage.length > 100 ? originalMessage.slice(0, 100) + "..." : originalMessage;
            notification_message.innerText = truncatedMessage;
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@auth
<script>
    var authUserId = '{{ auth()->user()->id }}';
</script>
@endauth

<script>
    $(document).ready(function() {
        // Attach click event to the notifications icon
        $('#notification_icon').click(function() {
            // Make an AJAX request to update unread count to 0
            if (typeof authUserId !== 'undefined') {
                $.ajax({
                    url: '/api/update-unread-count',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        user_id: authUserId
                    },
                    success: function(data) {
                        // Update the badge in the notification dropdown to 0
                        // $('.notification_bage').hide();
                        $('.notification_bage').text('0');
                        // You may also want to update other parts of the UI or perform additional actions here
                    },
                    error: function(error) {
                        console.error('Error updating unread count:', error);
                    }
                });
            } else {
                // Handle the case where the user is not authenticated
                console.error('User is not authenticated.');
            }
        });
    });
</script>