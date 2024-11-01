@extends('layouts.app')
@section('title', 'Attendance | High5 Daycare')
@section('content')

<style>
    .weekend {
        background-color: orange;
    }

    .marked {
        background-color: lightgreen;
    }

    .non-markable-day {
        color: red;
    }

    .calendar-body {
        overflow-x: scroll;
    }

    .form-check .form-switch .form-check-input {
        --bs-primary: #557b43;
        /* Change "yourColor" to the desired color */
        --bs-secondary: #yourColor;
        /* Change "yourColor" to the desired color */
    }
    .app-content{
        padding-top: 20px !important;
    }
    
    .app-toolbar > div{
        gap: 200px;
    }
    @media screen and (max-width: 1580px) {
        .page-heading{
            width: 60%;
        }
        .app-toolbar > div{
            flex: 1 auto;
        }
    }
    @media screen and (max-width: 1440px) {
        .app-toolbar{
            width: 80% !important;
        }
        .app-toolbar > div{
            width: 100% !important;
        }
        .page-heading{
            width: 100%;
        }
    }

    @media screen and (max-width: 1200px) {
        .page-heading{
            font-size: calc(1rem + 2vw) !important;
        }
        .app-toolbar > div{
        gap: 450px;
     }
    }
    @media screen and (max-width: 1050px) {
        .page-heading{
            width: 600px !important;
        }
    }
    @media screen and (max-width: 750px) {
        .page-heading{
            width: 350px !important;
        }
        .app-toolbar > div{
           gap: 100px;
        }
    }
    @media screen and (max-width: 550px) {
        .page-heading{
            width: 300px !important;
        }
        .app-toolbar  div{
            justify-content: end;
            
        } 
        .app-toolbar .btn-primary{
            margin-top: 30px;
        }
    }
    @media screen and (max-width: 992px) {
        .app-toolbar{
            top: 100px !important;
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
                            <span>Attendance @role('Admin') of {{ ucfirst($provider->name) }} (#{{ ($provider->code) }}) @endrole</span>
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
                        <li class="breadcrumb-item text-white">Attendance</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
                <!--begin::Actions-->
                <div class="d-flex @role('Franchise') justify-content-md-center @elserole('Parent') justify-content-md-center @endrole align-items-center gap-2">

                    <div class="d-flex align-items-center">
                        <a href="{{route('all.attendance.pd',['provider_id' => Request('provider_id')])}}">
                            <button class="btn btn-primary">Export</button>
                        </a>
                    </div>


                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">


            @if(isset($kids) && !empty($kids) && count($kids) > 0)
            <table class="table table-bordered text-center" style="min-width: 500px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Attendance</th>
                        <th>Drop Time</th>
                        <th>Pickup Time</th>
                        <th>Action</th>
                        @role('Admin','Franchise')
                        <th>Status</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @php
                    $today = \Carbon\Carbon::now();
                    $dayNumber = $today->day;
                    $todayDate = $currentMonth->year.'-'.$currentMonth->month.'-'.$dayNumber;
                    @endphp

                    @foreach($kids as $kid)

                   @php
                   $providerId = $provider->id;
                   $isAlreadyMarked = App\Helper\GlobalHelper::isAttendanceMarked($kid->id, $todayDate, $providerId);
                   $attendanceData = App\Models\Attendance::where('kid_id',$kid->id)->where('date',$todayDate)->first();
                   @endphp
                    <tr>
                        <td>{{$kid->code}}</td>
                        <td>{{ucfirst($kid->full_name)}}</td>
                        <td>{{ today()->format('l,F j, Y') }}</td>
                        <td class="d-flex justify-content-center align-items-center mt-2"><input type="checkbox" class="form-check-input mx-auto mark-attendance" name="" id="" data-student-id="{{ $kid->id }}" data-attendance-date="{{ $todayDate }}" @if($isAlreadyMarked) checked @endif @role('Parent') disabled @endrole @if($today < $kid->contract_start || (!empty($kid->contract_end) && $today > $kid->contract_end)) disabled @endif></td>
                        <td style='height: 50px;'>
                            <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                <input style='color:black;font-size: 16px;' type="time" value="{{ !empty($attendanceData->drop_time)? $attendanceData->drop_time : ''  }}" data-student-id="{{ $kid->id }}" data-attendance-date="{{ $todayDate }}" class="form-control timePicker drop_off_time" name="drop_time" id="">
                            </div>
                        </td>
                        <td style='height: 50px;'>
                            <div style='height: 50px;' class="d-flex justify-content-center align-items-center h-full">
                                <input style='color:black;font-size: 16px;' id="pickup_time{{ $kid->id }}_{{ $todayDate }}" value="{{ !empty($attendanceData->pickup_time)? $attendanceData->pickup_time : ''  }}" type="time" data-student-id="{{ $kid->id }}" data-attendance-date="{{ $todayDate }}" class="form-control timePicker pick_up_time" name="pickup_time">
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('view.attendance', ['id' => $kid->id,'provider_id' => $provider->id]) }}">
                            <button class="btn btn-sm btn-primary">View</button>
                            </a>
                        </td>
                        @role('Admin','Franchise')
                        <td class="d-flex align-items-center justify-content-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input update-status" type="checkbox" @if($kid->status == 1) checked @endif data-student-id="{{ $kid->id }}" @role('Franchise') disabled @endrole>
                            </div>
                        </td>
                        @endrole
                    </tr>
                    @endforeach


                </tbody>
            </table>
            @else
            <div class="mt-5">
                @include('layouts.partials.no-result')
            </div>
            @endif




        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<script>
    function markAttendance(studentId, attendanceDate) {
        // Check if drop_time is inserted before marking attendance
        const dropTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].drop_off_time`);
        const dropTimeValue = dropTimeInput ? dropTimeInput.value : null;

        const pickupTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].pick_up_time`);
        const pickupTimeValue = pickupTimeInput ? pickupTimeInput.value : null;

        // Make an AJAX request to mark attendance
        axios.post('{{ route("mark-attendance") }}', {
                student_id: studentId,
                attendance_date: attendanceDate,
                drop_time: dropTimeValue,
                pickup_time: pickupTimeValue,
            })
            .then(function(response) {
                // Handle the response from the server
                if (response.data.success) {
                    let backgroundColor = '#556d33';
                    if (response.data.message == 'Attendance Unmarked Successfully') {
                        backgroundColor = '#ea6f44';
                    }

                    Snackbar.show({
                        pos: 'bottom-center',
                        text: response.data.message,
                        backgroundColor: backgroundColor,
                        actionTextColor: '#fff'
                    });
                    window.location.reload();
                } else {
                    Snackbar.show({
                        pos: 'bottom-center',
                        text: 'Failed to mark attendance',
                        backgroundColor: '#ea6f44',
                        actionTextColor: '#fff'
                    });
                    window.location.reload();
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });
    }

    document.querySelectorAll('.mark-attendance').forEach(function(element) {
        element.addEventListener('click', function(event) {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-attendance-date');
            const dropTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].drop_off_time`);
            const dropTimeValue = dropTimeInput ? dropTimeInput.value : null;

            if (!dropTimeValue && this.checked) {
                // Display a message to insert drop_time first
                Snackbar.show({
                    pos: 'bottom-center',
                    text: 'Please insert drop time first.',
                    backgroundColor: '#ea6f44',
                    actionTextColor: '#fff'
                });
                // Prevent the checkbox from being checked
                event.preventDefault();
            } else {
                // Call markAttendance function only if drop time is inserted or the checkbox is being unchecked
                markAttendance(studentId, attendanceDate);
            }
        });
    });
</script>
<script>
    function markTime(studentId, attendanceDate) {
        const pickupTimeInput = document.querySelector(`#pickup_time${studentId}_${attendanceDate}`);
        const dropTimeInput = document.querySelector(`input[data-student-id="${studentId}"][data-attendance-date="${attendanceDate}"].drop_off_time`);
        const dropTimeValue = dropTimeInput ? dropTimeInput.value : null;

        if (!dropTimeValue) {
            // Display a message to insert drop time first
            Snackbar.show({
                pos: 'bottom-center',
                text: 'Please insert drop time first.',
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff'
            });
            // Reset the pickup time input
            pickupTimeInput.value = '';
            return;
        }

        const pickupTime = pickupTimeInput.value;

        axios.post('{{ route("mark-pickup-time") }}', {
                kid_id: studentId,
                date: attendanceDate,
                pickup_time: pickupTime,
            })
            .then(function(response) {
                console.log(response);
                // Handle the response from the server
                if (response.data.success) {
                    let backgroundColor = '#556d33';
                    if (response.data.message == 'Pickup Time Updated Successfully') {
                        backgroundColor = '#556d33';
                    }
                    
                    Snackbar.show({
                        pos: 'bottom-center',
                        text: response.data.message,
                        backgroundColor: backgroundColor,
                        actionTextColor: '#fff'
                    });
                    window.location.reload();
                } else {
                    Snackbar.show({
                        pos: 'bottom-center',
                        text: 'Please insert drop Time and mark attendance first',
                        backgroundColor: '#ea6f44',
                        actionTextColor: '#fff'
                    });
                    window.location.reload();
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while marking attendance.');
            });
    }

    document.querySelectorAll('.pick_up_time').forEach(function(element) {
        element.addEventListener('change', function() {
            const studentId = this.getAttribute('data-student-id');
            const attendanceDate = this.getAttribute('data-attendance-date');
            markTime(studentId, attendanceDate);
        });
    });
</script>
<script>
    // document.getElementById('monthDropdown').addEventListener('change', function () {
    //     // Get the selected value from the dropdown
    //     var selectedMonth = document.getElementById('monthDropdown').value;

    //     // Get the current URL
    //     var currentURL = window.location.href;

    //     // Create a URL object to work with the URL
    //     var url = new URL(currentURL);

    //     // Check if the "month" parameter already exists in the URL
    //     if (url.searchParams.has('month')) {
    //         // If "month" parameter exists, update its value
    //         url.searchParams.set('month', selectedMonth);
    //     } else {
    //         // If "month" parameter doesn't exist, add it
    //         url.searchParams.append('month', selectedMonth);
    //     }

    //     // Get the updated URL
    //     var updatedURL = url.toString();

    //     // Update the current URL with the new URL
    //     window.history.replaceState({}, '', updatedURL);

    //     // Optionally, you can submit the form
    //     setTimeout(() => {
    //         location.reload();
    //     }, 300);
    // });
</script>

<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     const exportButton = document.getElementById("exportButton");

    //     exportButton.addEventListener("click", function () {

    //         const tableCopy = document.querySelector("table").cloneNode(true);
    //         const checkboxes = tableCopy.querySelectorAll('input[type="checkbox"]');
    //         checkboxes.forEach(checkbox => {
    //             const textNode = document.createTextNode(checkbox.checked ? "P" : "A");
    //             checkbox.parentNode.replaceChild(textNode, checkbox);
    //         });

    //         const providerName = document.getElementById("providerName").value;

    //         const wb = XLSX.utils.book_new();
    //         // Convert the table copy to a worksheet
    //         const ws = XLSX.utils.table_to_sheet(tableCopy);

    //             // Add the modified worksheet to the workbook
    //             XLSX.utils.book_append_sheet(wb, ws, "Attendance Data");
    //             // Generate a unique filename
    //             const filename = providerName + "_" + new Date().toISOString() + ".xlsx";
    //             // Save the file
    //             XLSX.writeFile(wb, filename);
    //     });
    // });


    // document.addEventListener("DOMContentLoaded", function () {
    //     const exportButton = document.getElementById("exportButton");

    //     exportButton.addEventListener("click", function () {
    //         // Clone the table and replace checkboxes with "Present" or "Absent" text
    //         const tableCopy = document.querySelector("table").cloneNode(true);
    //         const checkboxes = tableCopy.querySelectorAll('input[type="checkbox"]');
    //         checkboxes.forEach(checkbox => {
    //             const textNode = document.createTextNode(checkbox.checked ? "P" : "A");
    //             checkbox.parentNode.replaceChild(textNode, checkbox);
    //         });

    //         // Create a new Workbook
    //         const wb = XLSX.utils.book_new();

    //         // Convert the table copy to a worksheet
    //         const ws = XLSX.utils.table_to_sheet(tableCopy);

    //         // Add the modified worksheet to the workbook
    //         XLSX.utils.book_append_sheet(wb, ws, "Attendance Data");

    //         // Generate a unique filename
    //         const filename = "attendance_data_" + new Date().toISOString() + ".xlsx";

    //         // Save the file
    //         XLSX.writeFile(wb, filename);
    //     });
    // });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.checkbox_input');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const th = this.parentElement;
                if (this.checked) {
                    th.style.backgroundColor = '#557b43'; // BgColor when checkbox is checked
                    th.style.color = '#fff'; // TextColor when checkbox is checked
                } else {
                    th.style.backgroundColor = ''; // Reset or default color
                    th.style.color = '#000'; // TextColor when checkbox is checked
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const checkbox = document.querySelectorAll('.update-status');

        checkbox.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checked = this.checked;
                const studentId = this.getAttribute('data-student-id');

                // Send an AJAX request to update the database with the new status.
                fetch('/api/update-kid-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token if necessary
                        },
                        body: JSON.stringify({
                            status: checked,
                            kid_id: studentId
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        Snackbar.show({
                            pos: 'bottom-center',
                            text: data.message,
                            backgroundColor: '#556d33',
                            actionTextColor: '#fff'
                        });
                    });
            });

        });

    });
</script>

@endsection