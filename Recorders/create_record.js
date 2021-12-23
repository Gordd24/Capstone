$(document).ready(function () {

    $("#ob_patient").change(function () {
        $(".ob_patient").toggleClass("yes_ob");
        $('.ob').val("");

    });






    //consultation personal group
    $("#consultation_personal_next_btn").click(function () {
        $("#consultation_personal_group").removeClass("active_group");
        $("#vital_group").addClass("active_group");
        $(".progress-bar").css('width', '70%');
    });


    //vital group    
    $("#vital_next_btn").click(function () {
        $("#vital_group").removeClass("active_group");
        $("#complaint_group").addClass("active_group");
        $(".progress-bar").css('width', '100%');
    });

    $("#vital_prev_btn").click(function () {
        $("#vital_group").removeClass("active_group");
        $("#consultation_personal_group").addClass("active_group");
        $(".progress-bar").css('width', '30%');
    });


    // account group
    $("#complaint_prev_btn").click(function () {
        $("#complaint_group").removeClass("active_group");
        $("#vital_group").addClass("active_group");
        $(".progress-bar").css('width', '70%');
    });






    // ADMISSION

    //admission personal group
    $("#admission_personal_next_btn").click(function () {
        $("#admission_personal_group").removeClass("active_group");
        $("#admission_personal2_group").addClass("active_group");
        $(".progress-bar").css('width', '50%');
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
        $("#admitting_group").removeClass("active_group");
        $("#diagnosis_group").addClass("active_group");
        $(".progress-bar").css('width', '100%');
    });

    $("#admitting_prev_btn").click(function () {
        $("#admitting_group").removeClass("active_group");
        $("#admission_personal2_group").addClass("active_group");
        $(".progress-bar").css('width', '50%');
    });

    //admitting group
    $("#diagnosis_prev_btn").click(function () {
        $("#diagnosis_group").removeClass("active_group");
        $("#admitting_group").addClass("active_group");
        $(".progress-bar").css('width', '70%');
    });



    //medical certificate
    //medical personal group
    $("#medical_personal_next_btn").click(function () {
        $("#medical_personal_group").removeClass("active_group");
        $("#medical_diagnosis_group").addClass("active_group");
        $(".progress-bar").css('width', '50%');
    });

    //medical diagnosis group
    $("#medical_diagnosis_prev_btn").click(function () {
        $("#medical_diagnosis_group").removeClass("active_group");
        $("#medical_personal_group").addClass("active_group");
        $(".progress-bar").css('width', '25%');
    });

    $("#medical_diagnosis_next_btn").click(function () {
        $("#medical_diagnosis_group").removeClass("active_group");
        $("#recommendation_group").addClass("active_group");
        $(".progress-bar").css('width', '75%');
    });

    //recommendation group
    $("#recommendation_prev_btn").click(function () {
        $("#recommendation_group").removeClass("active_group");
        $("#medical_diagnosis_group").addClass("active_group");
        $(".progress-bar").css('width', '50%');
    });

    $("#recommendation_next_btn").click(function () {
        $("#recommendation_group").removeClass("active_group");
        $("#physician_group").addClass("active_group");
        $(".progress-bar").css('width', '100%');
    });

    //physician group
    $("#physician_prev_btn").click(function () {
        $("#physician_group").removeClass("active_group");
        $("#recommendation_group").addClass("active_group");
        $(".progress-bar").css('width', '75%');
    });



});