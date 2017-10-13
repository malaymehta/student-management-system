var Section = function(){
    var initDatatable = function(ajaxListRoute){
        $('#section_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'academic_year', name: 'academic_year'},
                {data: 'batch', name: 'batch'},
                {data: 'status', name: 'status'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }

    var sectionValidation = function(){
        $("#my_section").validate({
            rules   : {
                name            : {
                    required: true,
                },
                academic_year_id: {
                    required: true,
                },
                batch_id        : {
                    required: true,
                },
                status          : {
                    required: true,
                },

            },
            messages: {
                name            : {
                    required: "Please enter name",
                },
                academic_year_id: {
                    required: "Please pick a year",
                },
                batch_id        : {
                    required: "Please pick a batch",
                },
                status          : {
                    required: "Please pick a status",
                },
            },

        });
    }

    var academicYearChange = function (routeUrl) {
        $("#academic_year_id").bind("change", function () {

            $("#batch_id").html('');

            $.ajax({
                type   : "POST",
                url    : routeUrl,
                data   : {year_id: $(this).val()},
                success: function (html) {
                    //alert(html);
                    $("#batch_id").html(html);
                }
            });

        });
    }

    return {
        list: function (ajaxListRoute) {
            initDatatable(ajaxListRoute);
        },
        manage: function (routeUrl) {
            academicYearChange(routeUrl);
            sectionValidation();
        }
    }

}();