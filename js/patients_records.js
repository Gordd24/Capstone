$(document).ready(function () {
    $('#search_patient').on('keypress', function (e) {
        return e.which !== 13;
    });
    $("#search_patient").keyup(function () {
        var txt = $(this).val();
        //???? what 
        $('tbody').html('');
        $.ajax({
            url: "searched_patients_records.php",
            method: "post",
            data: { search: txt },
            dataType: "text",
            success: function (data) {
                $('tbody').html(data);
                $(".btn.create_record").click(function () {
                    if ($(this).hasClass("discharge")) {
                        $('.option_modal_div2').show();
                        $('.option_modal_div2').focus();
                        $('.option_modal_div2').attr('id', this.id);
                    } else {
                        $('.option_modal_div').show();
                        $('.option_modal_div').focus();
                        $('.option_modal_div').attr('id', this.id);
                    }
                });
                $(".btn.view_records").click(function () {

                    location.href = "patient_records.php?id=" + $(this).attr('id');
                });
                $(".btn.archive").click(function () {

                    Swal.fire({
                        title: 'Confirmation',
                        text: "Do you want to archive this record?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "archive_folder.php?id=" + $(this).attr('id');
                        }
                    })
                });
            }
        });
        //somehow return false stops keyup functioning twice
        return false;
    });


    // view folder / view record
    $(".btn.view_records").click(function () {
        location.href = "patient_records.php?id=" + $(this).attr('id');
    });

    // archive record
    $(".btn.archive").click(function () {
        Swal.fire({
            title: 'Confirmation',
            text: "Do you want to archive this record?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "archive_folder.php?id=" + $(this).attr('id');
            }
        })
    });

    $(".btn.create_record").click(function () {
        if ($(this).hasClass("discharge")) {
            $('.option_modal_div2').show();
            $('.option_modal_div2').focus();
            $('.option_modal_div2').attr('id', this.id);
        } else {
            $('.option_modal_div').show();
            $('.option_modal_div').focus();
            $('.option_modal_div').attr('id', this.id);
        }
    });

    $('.option_modal_div').focusout(function () {
        $(this).hide();
        $('.option_modal_div').attr('id', "");
    });

    $('.option_modal_exit_div').click(function () {
        $('.option_modal_div').hide();
        $('.option_modal_div').attr('id', "");
    });

    $('.modal_options_div .option_buttons').click(function () {
        var patient_id = $('.option_modal_div').attr('id');
        $('.option_modal_div').hide();
        $('.option_modal_div').attr('id', "");
        var url_path = "";
        if ($(this).attr('id') == "consultation") {
            url_path = "consultation.php?id=" + patient_id;

        }
        else if ($(this).attr('id') == "admission") {
            url_path = "admission.php?id=" + patient_id;
        }
        else if ($(this).attr('id') == "med_cert") {
            url_path = "medical_certificate.php?id=" + patient_id;
        }
        else if ($(this).attr('id') == "lab_res") {
            url_path = "laboratory.php?id=" + patient_id;
        }
        location.href = url_path;

    });

    $('.option_modal_div2').focusout(function () {
        $(this).hide();
        $('.option_modal_div2').attr('id', "");
    });

    $('.option_modal_exit_div2').click(function () {
        $('.option_modal_div2').hide();
        $('.option_modal_div2').attr('id', "");
    });

    $('.modal_options_div2 .option_buttons2').click(function () {
        var patient_id = $('.option_modal_div2').attr('id');
        $('.option_modal_div2').hide();
        $('.option_modal_div2').attr('id', "");
        var url_path = "";
        if ($(this).attr('id') == "consultation") {
            url_path = "consultation.php?id=" + patient_id;

        }
        else if ($(this).attr('id') == "discharge") {
            url_path = "discharge.php?id=" + patient_id;
        }
        else if ($(this).attr('id') == "med_cert") {
            url_path = "medical_certificate.php?id=" + patient_id;
        }
        else if ($(this).attr('id') == "lab_res") {
            url_path = "laboratory.php?id=" + patient_id;
        }
        location.href = url_path;

    });

    $("#ob_patient").change(function () {
        $(".ob_patient").toggleClass("yes_ob");
        $('.ob').val("");

    });


    //consultation personal group
    $("#consultation_personal_next_btn").click(function () {
        address = $('#address').val()
        contact = $('#contact_no').val()
        age = $('#age').val();
        if (address != '' && contact != '' && age != '') {
            $("#consultation_personal_group").removeClass("active_group");
            $("#vital_group").addClass("active_group");
            $(".progress-bar").css('width', '70%');
            $('#address_error').html('')
            $('#contact_error').html('')
            $('age#_error').html('')
        } else {
            if (address == '') $('#address_error').html('Please enter address')
            if (contact == '') $('#contact_error').html('Please enter contact')
            if (age == '') $('#age_error').html('Please enter age')
        }
    });


    //vital group
    $("#vital_next_btn").click(function () {
        weight = $('#weight').val()
        bp = $('#bp').val()
        temp = $('#temp').val()
        rr = $('#rr').val()
        pr = $('#pr').val()
        if ($('#ob_patient').is(':checked')) {
            lmp = $('#lmp').val()
            aog = $('#aog').val()
            edc = $('#edc').val()
            if (weight != '' && bp != '' && temp != '' && rr != '' && pr != '' && lmp != '' && aog != '' && edc != '') {
                $("#vital_group").removeClass("active_group");
                $("#complaint_group").addClass("active_group");
                $(".progress-bar").css('width', '100%');
                $('#weight_error').html('')
                $('#bp_error').html('')
                $('#temp_error').html('')
                $('#rr_error').html('')
                $('#pr_error').html('')
                $('#lmp_error').html('')
                $('#aog_error').html('')
                $('#edc_error').html('')

            } else {
                if (weight == '') $('#weight_error').html('Please enter weight')
                if (bp == '') $('#bp_error').html('Please enter bp')
                if (temp == '') $('#temp_error').html('Please enter temp')
                if (rr == '') $('#rr_error').html('Please enter rr')
                if (pr == '') $('#pr_error').html('Please enter pr')
                if (lmp == '') $('#lmp_error').html('Please enter lmp')
                if (aog == '') $('#aog_error').html('Please enter aog')
                if (edc == '') $('#edc_error').html('Please enter edc')
            }
        }
        else {
            if (weight != '' && bp != '' && temp != '' && rr != '' && pr != '') {
                $("#vital_group").removeClass("active_group");
                $("#complaint_group").addClass("active_group");
                $(".progress-bar").css('width', '100%');
                $('#weight_error').html('')
                $('#bp_error').html('')
                $('#temp_error').html('')
                $('#rr_error').html('')
                $('#pr_error').html('')
            } else {
                if (weight == '') $('#weight_error').html('Please enter weight')
                if (bp == '') $('#bp_error').html('Please enter bp')
                if (temp == '') $('#temp_error').html('Please enter temp')
                if (rr == '') $('#rr_error').html('Please enter rr')
                if (pr == '') $('#pr_error').html('Please enter pr')
            }
        }
    });

    $("#vital_prev_btn").click(function () {
        $("#vital_group").removeClass("active_group");
        $("#consultation_personal_group").addClass("active_group");
        $(".progress-bar").css('width', '30%');
    });

    //consult submit
    $('#consultation_form').on('submit', function (e) {
        complaint = $('#complaint').val()
        var data = $('#consultation_form').serialize()
        if (complaint == '') {
            $('#complaint_error').html('Please enter complaint')
            e.preventDefault();
        } else {
            e.preventDefault()
            $.ajax({
                type: 'POST',
                url: 'patient_records_process.php',
                data: data,
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Consultation Successful',
                        icon: 'success',
                    }).then((result) => {
                        // Reload the Page
                        location.href = 'patients_records.php';
                    });
                }
            })
            return false;
        }
    })
    // account group
    $("#complaint_prev_btn").click(function () {
        $("#complaint_group").removeClass("active_group");
        $("#vital_group").addClass("active_group");
        $(".progress-bar").css('width', '70%');
    });



    // ADMISSION

    //admission personal group
    $("#admission_personal_next_btn").click(function () {
        address = $('#address').val()
        contact = $('#contact_no').val()
        age = $('#age').val();
        if (address != '' && contact != '' && age != '') {
            $("#admission_personal_group").removeClass("active_group");
            $("#admission_personal2_group").addClass("active_group");
            $(".progress-bar").css('width', '50%');
            $('#address_error').html('')
            $('#contact_error').html('')
            $('#age_error').html('')
        } else {
            if (address == '') $('#address_error').html('Please enter address')
            if (contact == '') $('#contact_error').html('Please enter contact number')
            if (age == '') $('#age_error').html('Please enter age')
        }
    });

    //admission personal2 group
    $("#admission_personal2_next_btn").click(function () {
        $("#admission_personal2_group").removeClass("active_group");
        $("#admitting_group").addClass("active_group");
        $(".progress-bar").css('width', '70%');
    });

    $("#admission_personal2_prev_btn").click(function () {
        $("#admission_personal2_group").removeClass("active_group");
        $("#admission_personal_group").addClass("active_group");
        $(".progress-bar").css('width', '30%');
    });

    //admitting group
    $("#admitting_next_btn").click(function () {
        room_no = $('#room_no').val()
        case_no = $('#case_no').val()
        cs = $('#cs').val()
        date_admit = $('#date_admitted').val()
        time_admit = $('#time_admitted').val()
        admit_by = $('#admitted_by').val()

        if (room_no != '' && case_no != '' && cs != '' && Date.parse(date_admit) && time_admit != '' && admit_by != '') {
            $("#admitting_group").removeClass("active_group");
            $("#diagnosis_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
            $('#room_error').html('')
            $('#case_error').html('')
            $('#cs_error').html('')
            $('#date_admit_error').html('')
            $('#time_admit_error').html('')
            $('#admitby_error').html('')
        } else {
            if (room_no == '') $('#room_error').html('Please enter room number')
            if (case_no == '') $('#case_error').html('Please enter case number')
            if (cs == '') $('#cs_error').html('Please enter cs')
            if (date_admit == '') $('#date_admit_error').html('Please enter the date of admission')
            if (time_admit == '') $('#time_admit_error').html('Please enter the time of admission')
            if (admit_by == '') $('#admitby_error').html('Please enter who admitted the patient')
        }
    });

    $("#admitting_prev_btn").click(function () {
        $("#admitting_group").removeClass("active_group");
        $("#admission_personal2_group").addClass("active_group");
        $(".progress-bar").css('width', '50%');
    });

    //admitting group
    $('#admission_form').on('submit', function (e) {
        var data = $('#admission_form').serialize();
        physician = $('#physician').val()
        diagnosis = $('#diagnosis').val()
        if (physician == '' || diagnosis == '') {
            if (physician == '') $('#phys_error').html('Please enter physician name')
            if (diagnosis == '') $('#diag_error').html('Please enter diagnosis')
            e.preventDefault()
        } else {

            e.preventDefault()
            $.ajax({
                type: 'POST',
                url: 'patient_records_process.php',
                data: data,
                success: function (response){
                        Swal.fire({
                        title: 'Success',
                        text: 'Admission Successful',
                        icon: 'success',
                    }).then((result) => {
                        // Reload the Page
                        location.href = 'patients_records.php';
                    });

                }
            })
            return false;
        }
    })


    $("#diagnosis_prev_btn").click(function () {
        $("#diagnosis_group").removeClass("active_group");
        $("#admitting_group").addClass("active_group");
        $(".progress-bar").css('width', '70%');
    });

    //medical certificate
    //medical personal group
    $("#medical_personal_next_btn").click(function () {
        address = $('#address').val()
        age = $('#age').val();
        if (address != '' && age != '') {
            $("#medical_personal_group").removeClass("active_group");
            $("#medical_diagnosis_group").addClass("active_group");
            $(".progress-bar").css('width', '50%');
            $('#address_error').html('')
            $('#age_error').html('')
        } else {
            if (address == '') $('#address_error').html('Please enter address')
            if (age == '') $('#age_error').html('Please enter age')
        }
    });


    //medical diagnosis group
    $("#medical_diagnosis_prev_btn").click(function () {
        $("#medical_diagnosis_group").removeClass("active_group");
        $("#medical_personal_group").addClass("active_group");
        $(".progress-bar").css('width', '25%');
    });

    $("#medical_diagnosis_next_btn").click(function () {

        diagnosis = $('#diagnosis').val()
        if (diagnosis != '') {
            $("#medical_diagnosis_group").removeClass("active_group");
            $("#recommendation_group").addClass("active_group");
            $(".progress-bar").css('width', '75%');
            $('#diag_error').html('')
        } else {
            if (diagnosis == '') $('#diag_error').html('Please enter diagnosis')
        }
    });

    //recommendation group
    $("#recommendation_prev_btn").click(function () {
        $("#recommendation_group").removeClass("active_group");
        $("#medical_diagnosis_group").addClass("active_group");
        $(".progress-bar").css('width', '50%');
    });

    $("#recommendation_next_btn").click(function () {

        recommendation = $('#recommendation').val()
        if (recommendation != '') {
            $("#recommendation_group").removeClass("active_group");
            $("#physician_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
            $('#recom_error').html('')
        } else {
            if (recommendation == '') $('#recom_error').html('Please enter recommendation')
        }
    });

    //physician group
    $("#physician_prev_btn").click(function () {
        $("#physician_group").removeClass("active_group");
        $("#recommendation_group").addClass("active_group");
        $(".progress-bar").css('width', '75%');
    });

   $('#medcert_form').on('submit', function (e) {
        e.preventDefault()
        physician = $('#physician').val()
        license = $('#license').val()
        // var data = $('#medcert_form').serialize()
        if (physician == '' || license == '' || $('#signature').get(0).files.length === 0) {
            if (physician == '') $('#phys_error').html('Please enter physician name')
            if (physician == '') $('#phys_license_error').html('Please enter physician license')
            if ($('#signature').get(0).files.length === 0) $('#sign_error').html('Please upload signature')
            
        } else {
            $.ajax({
                type: 'POST',
                url: 'patient_records_process.php',

                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response == '1'){
                        Swal.fire({
                            title: 'Success',
                            text: 'Medical certificate created successfully',
                            icon: 'success',
                        }).then((result) => {
                            // Reload the Page
                            location.href = 'patients_records.php';
                        });
                    }else{
                        Swal.fire('Error','Please upload a png or jpg file. ','error')
                        $('#sign_error').html('Please upload signature file in png or jpg format')
                        $('#phys_license_error').html('')
                        $('#phys_error').html('')
                    }
                }
            })
            return false;
        }
    })

    //laboratory validation
    $('#lab_form').on('submit', function (e) {
        e.preventDefault()
        if ($('#patient_lab_res').get(0).files.length === 0 || $('input[name="result"]:checked').length === 0) {
            if ($('#patient_lab_res').get(0).files.length === 0) $('#lab_res_error').html('Please upload laboratory result')
            if ($('input[name="result"]:checked').length === 0) $('#radio_error').html('Please select laboratory result type')
            
        } else {
            

            $.ajax({
                type: 'POST',
                url: 'patient_records_process.php',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    console.log(data)
                    if (data == '1'){
                        Swal.fire({
                            title: 'Success',
                            text: 'Laboratory result uploaded successfully',
                            icon: 'success',
                        }).then((result) => {
                            // Reload the Page
                            if (data == 0) {
                                location.href = '../patients_follow_ups/patients_follow_ups.php';
                            } else {
                                location.href = 'patients_records.php';
                            }
    
                        });
                    }
                    else{
                        Swal.fire('Error',data,'error')
                        $('#lab_res_error').html('Please upload laboratory result in pdf format')
                        $('#radio_error').html('')
                    }
                    
                }
            })
            return false;
        }
    })


    // patient records . php
    $("#admission_select_search").on('change', function () {
        if ($(this).val() == "year") {
            $(".row.admission.select_year").css("display", "flex");
            $(".row.admission.select_month").hide();
            $(".row.admission.select_date").hide();
        } else if ($(this).val() == "month") {
            $(".row.admission.select_month").css("display", "flex");
            $(".row.admission.select_year").hide();
            $(".row.admission.select_date").hide();
        } else if ($(this).val() == "date") {
            $(".row.admission.select_date").css("display", "flex");
            $(".row.admission.select_year").hide();
            $(".row.admission.select_month").hide();
        }
    });

    $("#consultation_select_search").on('change', function () {
        if ($(this).val() == "year") {
            $(".row.consultation.select_year").css("display", "flex");
            $(".row.consultation.select_month").hide();
            $(".row.consultation.select_date").hide();
        } else if ($(this).val() == "month") {
            $(".row.consultation.select_month").css("display", "flex");
            $(".row.consultation.select_year").hide();
            $(".row.consultation.select_date").hide();
        } else if ($(this).val() == "date") {
            $(".row.consultation.select_date").css("display", "flex");
            $(".row.consultation.select_year").hide();
            $(".row.consultation.select_month").hide();
        }
    });

    $("#medical_select_search").on('change', function () {
        if ($(this).val() == "year") {
            $(".row.medical.select_year").css("display", "flex");
            $(".row.medical.select_month").hide();
            $(".row.medical.select_date").hide();
        } else if ($(this).val() == "month") {
            $(".row.medical.select_month").css("display", "flex");
            $(".row.medical.select_year").hide();
            $(".row.medical.select_date").hide();
        } else if ($(this).val() == "date") {
            $(".row.medical.select_date").css("display", "flex");
            $(".row.medical.select_year").hide();
            $(".row.medical.select_month").hide();
        }
    });

    $("#laboratory_select_search").on('change', function () {
        if ($(this).val() == "year") {
            $(".row.laboratory.select_year").css("display", "flex");
            $(".row.laboratory.select_month").hide();
            $(".row.laboratory.select_date").hide();
        } else if ($(this).val() == "month") {
            $(".row.laboratory.select_month").css("display", "flex");
            $(".row.laboratory.select_year").hide();
            $(".row.laboratory.select_date").hide();
        } else if ($(this).val() == "date") {
            $(".row.laboratory.select_date").css("display", "flex");
            $(".row.laboratory.select_year").hide();
            $(".row.laboratory.select_month").hide();
        }
    });

    $(".btn.select_year").click(function () {
        var id = $(this).attr('id');
        var year = "";
        var type = "";
        if ($(this).hasClass('medical')) {
            type = "medical";
            year = $("#medical_select_year").val();
        } else if ($(this).hasClass('consultation')) {
            type = "consultation"
            year = $("#consultation_select_year").val();
        } else if ($(this).hasClass('admission')) {
            type = "admission";
            year = $("#admission_select_year").val();
        } else if ($(this).hasClass('laboratory')) {
            type = "laboratory";
            year = $("#laboratory_select_year").val();
        }
        $.ajax({
            url: "search_file.php",
            method: "post",
            data: { patient: id, year: year, type: type },
            dataType: "text",
            success: function (data) {
                if (type == "medical") {
                    $('tbody#medical').html(data);

                } else if (type == "consultation") {
                    $('tbody#consultation').html(data);
                } else if (type == "admission") {
                    $('tbody#admission').html(data);
                } else if (type == "laboratory") {
                    $('tbody#laboratory').html(data);
                }

                $(".btn.open_file").click(function () {

                    if ($(this).hasClass("admission")) {
                        var link = "open_file.php?type=admission&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("consultation")) {
                        var link = "open_file.php?type=consultation&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("medical")) {
                        var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("laboratory")) {
                        var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    }

                });

            }
        });
    });


    $(".btn.select_month").click(function () {
        var id = $(this).attr('id');
        var month = "";
        var type = "";
        if ($(this).hasClass('medical')) {
            type = "medical";
            month = $("#medical_select_month").val();
        } else if ($(this).hasClass('consultation')) {
            type = "consultation"
            month = $("#consultation_select_month").val();
        } else if ($(this).hasClass('admission')) {
            type = "admission";
            month = $("#admission_select_month").val();
        } else if ($(this).hasClass('laboratory')) {
            type = "laboratory";
            month = $("#laboratory_select_month").val();
        }
        $.ajax({
            url: "search_file.php",
            method: "post",
            data: { patient: id, month: month, type: type },
            dataType: "text",
            success: function (data) {
                if (type == "medical") {
                    $('tbody#medical').html(data);
                } else if (type == "consultation") {
                    $('tbody#consultation').html(data);
                } else if (type == "admission") {
                    $('tbody#admission').html(data);
                } else if (type == "laboratory") {
                    $('tbody#laboratory').html(data);
                }

                $(".btn.open_file").click(function () {

                    if ($(this).hasClass("admission")) {
                        var link = "open_file.php?type=admission&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("consultation")) {
                        var link = "open_file.php?type=consultation&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("medical")) {
                        var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("laboratory")) {
                        var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    }

                });
            }
        });
    });

    $(".btn.select_date").click(function () {
        var id = $(this).attr('id');
        var date = "";
        var type = "";
        if ($(this).hasClass('medical')) {
            type = "medical";
            date = $("#medical_select_date").val();
        } else if ($(this).hasClass('consultation')) {
            type = "consultation"
            date = $("#consultation_select_date").val();
        } else if ($(this).hasClass('admission')) {
            type = "admission";
            date = $("#admission_select_date").val();
        } else if ($(this).hasClass('laboratory')) {
            type = "laboratory";
            date = $("#laboratory_select_date").val();
        }
        $.ajax({
            url: "search_file.php",
            method: "post",
            data: { patient: id, date: date, type: type },
            dataType: "text",
            success: function (data) {
                if (type == "medical") {
                    $('tbody#medical').html(data);
                } else if (type == "consultation") {
                    $('tbody#consultation').html(data);
                } else if (type == "admission") {
                    $('tbody#admission').html(data);
                } else if (type == "laboratory") {
                    $('tbody#laboratory').html(data);
                }

                $(".btn.open_file").click(function () {

                    if ($(this).hasClass("admission")) {
                        var link = "open_file.php?type=admission&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("consultation")) {
                        var link = "open_file.php?type=consultation&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("medical")) {
                        var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("laboratory")) {
                        var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    }

                });
            }
        });
    });


    $(".btn.select_all").click(function () {
        var id = $(this).attr('id');
        var type = "";
        if ($(this).hasClass('medical')) {
            type = "medical";
        } else if ($(this).hasClass('consultation')) {
            type = "consultation"
        } else if ($(this).hasClass('admission')) {
            type = "admission";
        } else if ($(this).hasClass('laboratory')) {
            type = "laboratory";
        }

        $.ajax({
            url: "search_file.php",
            method: "post",
            data: { patient: id, type: type },
            dataType: "text",
            success: function (data) {
                if (type == "medical") {
                    $('tbody#medical').html(data);
                    console.log(type);
                } else if (type == "consultation") {
                    $('tbody#consultation').html(data);
                } else if (type == "admission") {
                    $('tbody#admission').html(data);
                } else if (type == "laboratory") {
                    $('tbody#laboratory').html(data);
                }
                $(".btn.open_file").click(function () {

                    if ($(this).hasClass("admission")) {
                        var link = "open_file.php?type=admission&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("consultation")) {
                        var link = "open_file.php?type=consultation&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("medical")) {
                        var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    } else if ($(this).hasClass("laboratory")) {
                        var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
                        window.open(link, '_blank');
                    }

                });
            }
        });
    });






    //DISCHARGEEE

    // discharge

    //discharge personal group
    $("#discharge_personal_next_btn").click(function () {
        $("#discharge_personal_group").removeClass("active_group");
        $("#discharging_group").addClass("active_group");
        $(".progress-bar").css('width', '32%');
    });


    // discharging group
    $("#discharging_prev_btn").click(function () {
        $("#discharging_group").removeClass("active_group");
        $("#discharge_personal_group").addClass("active_group");
        $(".progress-bar").css('width', '16%');
    });

    $("#discharging_next_btn").click(function () {
        date_disch = $('#date_discharged').val()
        time_disch = $('#time_discharged').val()
        disch_by = $('#discharged_by')

        if (Date.parse(date_disch) && time_disch != '' && disch_by != '') {
            $("#discharging_group").removeClass("active_group");
            $("#transfer_group").addClass("active_group");
            $(".progress-bar").css('width', '48%');
            $('#date_error').html('')
            $('#time_error').html('')
            $('#dischargeby_error').html('')
        } else {
            if (date_disch == '') $('#date_error').html('Please enter date discharged')
            if (time_disch == '') $('#time_error').html('Please enter time discharged')
            if (disch_by == '') $('#dischargeby_error').html('Please enter who discharge the patient')
        }

    });


    // transfer group
    $("#transfer_prev_btn").click(function () {
        $("#transfer_group").removeClass("active_group");
        $("#discharging_group").addClass("active_group");
        $(".progress-bar").css('width', '32%');
    });

    $("#transfer_next_btn").click(function () {
        $("#transfer_group").removeClass("active_group");
        $("#diagnosis_group").addClass("active_group");
        $(".progress-bar").css('width', '64%');
    });

    // diagnosis group
    $("#diagnosis_prev_btn").click(function () {
        $("#diagnosis_group").removeClass("active_group");
        $("#transfer_group").addClass("active_group");
        $(".progress-bar").css('width', '48%');
    });

    $("#diagnosis_next_btn").click(function () {
        diagnosis = $('#diagnosis').val();
        if (diagnosis != '') {
            $("#diagnosis_group").removeClass("active_group");
            $("#code_group").addClass("active_group");
            $(".progress-bar").css('width', '80%');
            $('#diag_error').html('')
        }
        else { $('#diag_error').html('Please enter final diagnosis') }
    });

    // code group
    $("#code_prev_btn").click(function () {
        $("#code_group").removeClass("active_group");
        $("#diagnosis_group").addClass("active_group");
        $(".progress-bar").css('width', '64%');
    });

    $("#code_next_btn").click(function () {
        icd = $('#icd').val()
        rvs = $('#rvs').val()
        if (icd != '' && rvs != '') {
            $("#code_group").removeClass("active_group");
            $("#operation_group").addClass("active_group");
            $(".progress-bar").css('width', '100%');
            $('#icd_error').html('')
            $('#rvs_error').html('')
        } else {
            if (icd == '') $('#icd_error').html('Please enter icd code')
            if (rvs == '') $('#rvs_error').html('Please enter rvs code')
        }

    });

    // operation group
    $("#operation_prev_btn").click(function () {
        $("#operation_group").removeClass("active_group");
        $("#code_group").addClass("active_group");
        $(".progress-bar").css('width', '80%');
    });

    $('#discharge_form').on('submit', function (e) {
        operation = $('#operation').val()
        data = $('#discharge_form').serialize()
        if (operation != '') {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'patient_records_process.php',
                data: data,
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Discharge Successful',
                        icon: 'success',
                    }).then((result) => {
                        // Reload the Page
                        location.href = 'patients_records.php';
                    });
                }
            })
            return false;
        }
        else {
            $('#operation_error').html('Please enter operation/s')
            e.preventDefault()
        }
    })

    $(".btn.open_file").click(function () {

        if ($(this).hasClass("admission")) {
            var link = "open_file.php?type=admission&file_name=" + $(this).attr('id');
            window.open(link, '_blank');
        } else if ($(this).hasClass("consultation")) {
            var link = "open_file.php?type=consultation&file_name=" + $(this).attr('id');
            window.open(link, '_blank');
        } else if ($(this).hasClass("medical")) {
            var link = "open_file.php?type=medical&file_name=" + $(this).attr('id');
            window.open(link, '_blank');
        } else if ($(this).hasClass("laboratory")) {
            var link = "open_file.php?type=laboratory&file_name=" + $(this).attr('id');
            window.open(link, '_blank');
        }

    });

});