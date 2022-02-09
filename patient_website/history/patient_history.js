$(document).ready(function () {

    //switching records

    $(".record_type").on('change', function () {
        var type = $(this).val();
        var id = $(this).attr('id');
        console.log(type);
        $.ajax({
            url: "select_history.php",
            method: "post",
            data: {
                type: type,
                id: id
            },
            dataType: "text",
            success: function (data) {
                $('.history_div').html(data);

            }
        });

    });

    //sorting

    $('.wrapper').on('change', '#sort_by', function () {
        var type = $(this).data('type');
        var id = $(this).data('id');
        var sort = $(this).val();

        if (type == "lab_result") {
            $.ajax({
                url: "sort_history.php",
                method: "post",
                data: {
                    type: type,
                    id: id,
                    sort: sort
                },
                dataType: "text",
                success: function (data) {
                    $('.lab_tbody').html(data);

                }
            });
        } else if (type == "med_cert") {
            $.ajax({
                url: "sort_history.php",
                method: "post",
                data: {
                    type: type,
                    id: id,
                    sort: sort
                },
                dataType: "text",
                success: function (data) {
                    $('.med_tbody').html(data);
                }
            });
        }
    });

    $('.wrapper').on('change', '#search_record_date', function () {
        var type = $(this).data('type');
        var id = $(this).data('id');
        var date = $(this).val();

        if (type == "lab_result") {
            $.ajax({
                url: "search_record_date.php",
                method: "post",
                data: {
                    type: type,
                    id: id,
                    date: date
                },
                dataType: "text",
                success: function (data) {
                    $('.lab_tbody').html(data);

                }
            });
        } else if (type == "med_cert") {
            $.ajax({
                url: "search_record_date.php",
                method: "post",
                data: {
                    type: type,
                    id: id,
                    date: date
                },
                dataType: "text",
                success: function (data) {
                    $('.med_tbody').html(data);

                }
            });
        }
    });


    $('.wrapper').on('keyup', '#search_patient', function () {

        var type = $(this).data('type');
        var id = $(this).data('id');
        var txt = $(this).val();
        if (type == "med_cert") {
            $.ajax({
                url: "search_history.php",
                method: "post",
                data: {
                    type: type,
                    id: id,
                    search: txt
                },
                dataType: "text",
                success: function (data) {
                    $('.med_tbody').html(data);
                }
            });
        }


    });

    $('.wrapper').on('change', '#select_by_type', function () {
        var type = $(this).data('type');
        var id = $(this).data('id');
        var res_type = $(this).val();

        if (type == "lab_result") {
            $.ajax({
                url: "search_record_type.php",
                method: "post",
                data: {
                    type: type,
                    id: id,
                    res_type: res_type
                },
                dataType: "text",
                success: function (data) {
                    $('.lab_tbody').html(data);

                }
            });
        }
    });


    $('.wrapper').on('click', '.show_mods', function () {
        var record_type = $(this).data('record_type');

        if (record_type == 'lab_result') {
            var date = $(this).data('date_uploaded');
            var result_type = $(this).data('result_type');
            var uploader = $(this).data('uploaded_by');
            var release_by = $(this).data('release_by');
            $(".modal-title").text('Laboratory Result');
            $(".date_uploaded").text(date);
            $(".result_type").text(result_type);
            $(".release_by").text(release_by)
            $(".uploaded_by").text(uploader)
        } else if (record_type == 'consultation') {
            var date = $(this).data('date_admitted');
            var time = $(this).data('time_consulted');
            var physician = $(this).data('physician');
            var complaint = $(this).data('complaint');
            $(".modal-title").text('Consultation');
            $(".date_consulted").text(date);
            $(".time_consulted").text(time);
            $(".physician").text(physician);
            $(".complaint").text(complaint);
        } else if (record_type == 'admission') {
            var date_admitted = $(this).data('date_admitted');
            var time_admitted = $(this).data('time_admitted');
            var physician = $(this).data('attending_physician');
            var admitting_diagnosis = $(this).data('diagnosis');
            var date_discharged = $(this).data('date_discharged');
            var time_discharged = $(this).data('time_discharged');
            var final_diagnosis = $(this).data('final_diagnosis');
            var disposition = $(this).data('disposition');
            $(".modal-title").text('Admission');
            $(".physician").text(physician);
            $(".date_admitted").text(date_admitted);
            $(".time_admitted").text(time_admitted);
            $(".date_discharged").text(date_discharged);
            $(".time_discharged").text(time_discharged);
            $(".admitting_diagnosis").text(admitting_diagnosis);
            $(".final_diagnosis").text(final_diagnosis);
            $(".disposition").text(disposition);
        } else if (record_type == 'med_cert') {
            var date = $(this).data('date');
            var time = $(this).data('time');
            var physician = $(this).data('physician');
            var recommendation = $(this).data('recommendation');
            var diagnosis = $(this).data('diagnosis');
            $(".modal-title").text('Medical Certification');
            $(".physician").text(physician);
            $(".date").text(date);
            $(".time").text(time);
            $(".diagnosis").text(diagnosis);
            $(".recommendation").text(recommendation);
        }
    });




});