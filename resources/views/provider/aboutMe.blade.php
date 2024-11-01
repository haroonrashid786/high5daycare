@extends('layouts.app')
@role('Admin')
@section('title', 'About Provider | Admin | High5 Daycare')
@elserole('Franchise')
@section('title', 'About Me | Provider | High5 Daycare')
@endrole
@section('content')

<style>
    .app-content{
        background: transparent;
    }
    .card{
        box-shadow: none;
    }
</style>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    
    <div id="kt_app_content" class="app-content flex-column-fluid overflow-auto card px-8 pt-5">

     
        <form id="kt_modal_new_ticket_form" class="form bg-white py-8 py-lg-10 rounded-3 px-6" action="{{route('provider.aboutMe.add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--begin::Heading-->
            <div class="mb-13 text-center">
                <!--begin::Title-->
                <h1 class="mb-3 text-black">@role('Franchise') About Me @elserole('Admin') About Provider @endrole</h1>
                <!--end::Title-->
                <!--begin::Description-->

                <!--end::Description-->
            </div>
            <!--end::Heading-->

            <div class="row">
                <!-- First set of label and input -->
                <div class="col-md-12">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">About Me</span>
                            <span class="ms-2" data-bs-toggle="tooltip" title="Please tell us about yourself">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control" placeholder="Enter about yourself" name="about_me" required="required" value="{{ $aboutMe->about_me ?? '' }}" @role('Admin', 'Parent' ) readonly @endrole />
                    </div>
                </div>

            </div>

            @role('Admin', 'Franchise')
            <!--begin::Input group-->
            <div class="row">
                <!-- First set of label and input -->
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Family Members</span>
                            <span class="ms-2" data-bs-toggle="tooltip" title="Please enter the total number of your family members">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="number" class="form-control" placeholder="Enter total family members you have" name="family_members" required="required" value="{{ $aboutMe->family_members ?? '' }}" @role('Admin', 'Parent' ) readonly @endrole />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Family Members (Below 18)</span>
                            <span class="ms-2" data-bs-toggle="tooltip" title="Please enter the total number of your family members below 18">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="number" class="form-control" placeholder="Enter total family members below 18" name="family_members_below_18" required="required" value="{{ $aboutMe->family_members_below_18 ?? '' }}" @role('Admin', 'Parent' ) readonly @endrole />
                    </div>
                </div>

                <!-- Second set of label and input -->
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Family Members (18+)</span>
                            <span class="ms-2" data-bs-toggle="tooltip" title="Please enter the total number of your family members above 18">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="number" class="form-control" placeholder="Enter total family members above 18" name="family_members_above_18" required="required" value="{{ $aboutMe->family_members_above_18 ?? '' }}" @role('Admin', 'Parent' ) readonly @endrole />
                    </div>
                </div>
            </div>
            <!--end::Input group-->
            <!-- Family Members Section -->
            <div class="row" id="certificate-input-container">
            </div>
            @endrole


            <!-- Courses Section -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-4">Courses</h3>

                    <div id="courses-container">
                        <!-- Initial Row for Courses -->
                        <div class="row mb-3" id="course-row-template">
                            <div class="col-md-3">
                                <label class="form-label">Course Name</label>
                                <input class="form-control" placeholder="Enter course name" name="courses[0][name]" @role('Admin', 'Parent' ) readonly @endrole />
                                @error('courses.0.name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" placeholder="Enter start date" name="courses[0][start_date]" @role('Admin', 'Parent' ) readonly @endrole />
                                @error('courses.0.start_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" placeholder="Enter end date" name="courses[0][end_date]" @role('Admin', 'Parent' ) readonly @endrole />
                                @error('courses.0.end_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Organization</label>
                                <input class="form-control" placeholder="Enter organization" name="courses[0][organization]" @role('Admin', 'Parent' ) readonly @endrole />
                                @error('courses.0.organization')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- <div class="col-md-1">
                            <label class="form-label">Remove</label>
                            <button type="button" class="btn btn-danger" onclick="removeCourseRow(this)">X</button>
                        </div> -->
                        </div>
                    </div>
                    @role('Franchise')
                    <!-- Add More Button -->
                    <button type="button" class="btn btn-success" onclick="addCourseRow()">Add More</button>
                    @endrole
                </div>
            </div>

            <!--end::Input group-->
            @role('Franchise')
            <!--begin::Actions-->
            <div class="text-center pt-5">
                <button type="submit" id="kt_modal_new_ticket_submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
            @endrole
        </form>
    
    </div>
</div>


<script>
    const isFranchise = <?php echo $isFranchise ?>;
    let courseIndex = 1;
    const container = document.getElementById('courses-container');

    // Function to add a course row
    function addCourseRow() {
        const newRow = document.getElementById('course-row-template').cloneNode(true);

        // Remove the template ID
        newRow.removeAttribute('id');

        // Update input names to include the current index
        updateInputNames(newRow, courseIndex);

        clearInputValues(newRow);

        // Add a cross button to the new row
        const crossButton = document.createElement('div');
        crossButton.className = 'col-md-1';
        crossButton.innerHTML = '<label class="form-label" @role("Admin","Parent") style="display:none;" @endrole>Remove</label><div><button type="button" class="btn btn-danger remove-btn" onclick="removeCourseRow(this)" @role("Admin","Parent") style="display:none;" @endrole>X</button></div>';
        newRow.appendChild(crossButton);

        // Set readonly attribute based on the user's role
        setReadonlyAttribute(newRow, isFranchise);

        container.appendChild(newRow);

        // Increment the course index
        courseIndex++;
    }

    function clearInputValues(row) {
        row.querySelectorAll('[name^="courses"]').forEach(function(input) {
            input.value = '';
        });
    }

    // Function to remove a course row
    function removeCourseRow(button) {
        const row = button.closest('.row');
        row.remove();
        updateInputNamesAfterRemoval();
    }

    // Function to update input names based on the index
    function updateInputNames(row, index) {
        row.querySelectorAll('[name^="courses"]').forEach(function(input) {
            const nameParts = input.name.split('[');
            input.name = 'courses[' + index + '][' + nameParts[2];
        });
    }

    // Function to update input names after removing a row
    function updateInputNamesAfterRemoval() {
        const container = document.getElementById('courses-container');
        const rows = container.querySelectorAll('.row');

        rows.forEach(function(row, index) {
            updateInputNames(row, index);
        });
    }

    // Function to set readonly attribute based on the user's role
    function setReadonlyAttribute(row, isFranchise) {
        row.querySelectorAll('[name^="courses"]').forEach(function(input) {
            input.readOnly = !isFranchise;
        });
    }

    // Function to populate existing courses when the page loads
    function populateExistingCourses() {
        const existingCourses = <?php echo isset($aboutMe->courses) ? $aboutMe->courses : '[]' ?>;
        if (existingCourses) {
            existingCourses.forEach(function(course, index) {
                if (index === 0) {
                    updateExistingCourse(container.firstElementChild, course, index);
                } else {
                    addCourseRow();
                    const newRow = container.lastElementChild;
                    updateExistingCourse(newRow, course, index);
                }
            });
        }
    }

    // Function to update an existing course row
    function updateExistingCourse(row, course, index) {
        row.querySelector('[name^="courses[' + index + '][name]"]').value = course.name;
        row.querySelector('[name^="courses[' + index + '][start_date]"]').value = course.start_date;
        row.querySelector('[name^="courses[' + index + '][end_date]"]').value = course.end_date;
        row.querySelector('[name^="courses[' + index + '][organization]"]').value = course.organization;

        // Set readonly attribute based on the user's role
        setReadonlyAttribute(row, isFranchise);
    }
    // Populate existing courses when the page loads
    populateExistingCourses();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = '{{ url('/') }}';
        const submitButton = document.getElementById("kt_modal_new_ticket_submit");
        const form = document.getElementById("kt_modal_new_ticket_form");

        if (submitButton) {
            submitButton.addEventListener("click", function(event) {
                if (!validateInputs()) {
                    event.preventDefault();
                } else {
                    if (form.checkValidity()) {
                        form.submit();
                    }
                }
            });
        }

        const familyMembersAbove18Input = document.querySelector('[name="family_members"]');
        const certificateInputContainer = document.getElementById('certificate-input-container');

        // Function to update certificate input visibility and count
        function updateCertificateInputs() {
            let familyMembersAbove18 = parseInt(familyMembersAbove18Input.value, 10) || 0;
            familyMembersAbove18 = Math.min(Math.max(familyMembersAbove18, 0), 10);
            familyMembersAbove18Input.value = familyMembersAbove18;

            const existingCertificateInputs = certificateInputContainer.querySelectorAll('.certificate-input-row');
            const initialCertificatesCount = existingCertificateInputs.length;
            const countDifference = familyMembersAbove18 - initialCertificatesCount;

            if (countDifference > 0) {
                for (let i = 1; i <= countDifference; i++) {
                    addCertificateRow(initialCertificatesCount + i);
                }
            } else if (countDifference < 0) {
                for (let i = 1; i <= Math.abs(countDifference); i++) {
                    removeCertificateRow();
                }
            }

            populateExistingCertificateData();
        }

        function validateInputs() {
            const certificateRows = certificateInputContainer.querySelectorAll('.certificate-input-row');


            for (let i = 0; i < certificateRows.length; i++) {
                const nameInput = certificateRows[i].querySelector(`input[name^="family_members_data[${i}][family_member_name]"]`);
                const certificateInput = certificateRows[i].querySelector(`input[name^="family_members_data[${i}][health_certificate]"]`);
                const viewFileButton = certificateRows[i].querySelector('a');

                if (viewFileButton) {
                    continue;
                }

                const isNameEmpty = nameInput.value.trim() === '';
                const isCertificateEmpty = certificateInput.value.trim() === '';

                if ((isNameEmpty && !isCertificateEmpty) || (!isNameEmpty && isCertificateEmpty)) {
                    Snackbar.show({
                        pos: 'bottom-center',
                        text: 'Please enter both name and health certificate for each family member.',
                        backgroundColor: '#ea6f44',
                        actionTextColor: '#fff',
                        duration: 100000,
                    });
                    return false;
                }
            }
            return true;
        }

        function addCertificateRow(index) {
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-4 certificate-input-row';

            const certificateInputDiv = document.createElement('div');
            certificateInputDiv.className = 'd-flex flex-column mb-2 gap-3 fv-row';

            const healthInputDiv = document.createElement('div');
            healthInputDiv.className = 'd-flex flex-column mb-2 gap-3 fv-row';

            const nameLabel = document.createElement('label');
            nameLabel.className = 'd-flex align-items-center fs-6 fw-semibold mb-2';
            nameLabel.innerHTML = `Family Member ${index} Name`;

            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.className = 'form-control';
            nameInput.name = `family_members_data[${index - 1}][family_member_name]`;
            nameInput.placeholder = `Enter name for Family Member ${index}`;
            nameInput.value = '';

            const certificateLabel = document.createElement('label');
            certificateLabel.className = 'd-flex align-items-center fs-6 fw-semibold mb-2';
            certificateLabel.innerHTML = `Family Member ${index} Police Certificate`;

            const certificateInput = document.createElement('input');
            certificateInput.type = 'file';
            certificateInput.className = 'form-control';
            certificateInput.name = `family_members_data[${index - 1}][police_certificate]`;
            certificateInput.accept = '.pdf, .doc, .docx';

            // Health certificate input
            const healthCertificateLabel = document.createElement('label');
            healthCertificateLabel.className = 'd-flex align-items-center fs-6 fw-semibold mb-2';
            healthCertificateLabel.innerHTML = `Family Member ${index} Health Certificate`;

            const healthCertificateInput = document.createElement('input');
            healthCertificateInput.type = 'file';
            healthCertificateInput.className = 'form-control';
            healthCertificateInput.name = `family_members_data[${index - 1}][health_certificate]`;
            healthCertificateInput.accept = '.pdf, .doc, .docx';

            nameInput.readOnly = !isFranchise;
            certificateInput.disabled = !isFranchise;
            healthCertificateInput.disabled = !isFranchise;


            certificateInputDiv.appendChild(nameLabel);
            certificateInputDiv.appendChild(nameInput);
            certificateInputDiv.appendChild(certificateLabel);
            certificateInputDiv.appendChild(certificateInput);
            colDiv.appendChild(certificateInputDiv);

            healthInputDiv.appendChild(healthCertificateLabel);
            healthInputDiv.appendChild(healthCertificateInput);
            colDiv.appendChild(healthInputDiv);

            certificateInputContainer.appendChild(colDiv);
        }

        function removeCertificateRow() {
            const row = certificateInputContainer.lastElementChild;
            if (row) {
                row.remove();
            }
        }

        function populateExistingCertificateData() {
            const familyMembers = <?php
                                    if (isset($aboutMe->familyMembers) && !empty($aboutMe->familyMembers)) {
                                        echo json_encode($aboutMe->familyMembers);
                                    } else {
                                        [];
                                    }
                                    ?>;

            for (let i = 0; i < familyMembers.length; i++) {
                const nameInput = document.querySelector(`[name="family_members_data[${i}][family_member_name]"]`);
                const certificateInput = document.querySelector(`[name="family_members_data[${i}][police_certificate]"]`);
                const healthCertificateInput = document.querySelector(`[name="family_members_data[${i}][health_certificate]"]`);

                nameInput.readOnly = !isFranchise;
                certificateInput.disabled = !isFranchise;
                healthCertificateInput.disabled = !isFranchise;


                const existingViewFileLink = certificateInput.parentNode.querySelector('a');
                const existingHealthCertificateLink = healthCertificateInput.parentNode.querySelector('a');

                if (nameInput) {
                    nameInput.value = familyMembers[i].family_member_name || '';
                    if (familyMembers[i].police_certificate) {

                        if (!existingViewFileLink && familyMembers[i].police_certificate) {
                            const viewFileLink = document.createElement('a');
                            viewFileLink.href = baseUrl + '/' + familyMembers[i].police_certificate;
                            viewFileLink.target = '_blank';
                            viewFileLink.innerHTML = 'View File';
                            certificateInput.parentNode.appendChild(viewFileLink);
                        }
                    }

                    if (familyMembers[i].health_certificate) {
                    if (!existingHealthCertificateLink && familyMembers[i].health_certificate) {
                                const healthViewFileLink = document.createElement('a');
                                
                                healthViewFileLink.href = baseUrl + '/' + familyMembers[i].health_certificate;
                                healthViewFileLink.target = '_blank';
                                healthViewFileLink.innerHTML = 'View Health Certificate';
                                healthCertificateInput.parentNode.appendChild(healthViewFileLink);
                            }
                        }

                }
            }
        }

        familyMembersAbove18Input.addEventListener('input', updateCertificateInputs);
        updateCertificateInputs();
    });
</script>

@endsection