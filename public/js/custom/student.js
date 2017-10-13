var Student = function(){

    var initDatatable = function(ajaxListRoute){
        $('#student_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'course', name: 'course'},
                {data: 'class_name', name: 'class_name'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }
    
    
    var studValidation = function () {
        $("#student-form").validate({
            rules   : {
                name            : {
                    required: true,
                },
                course          : {
                    required: true,
                },
                batch_id        : {
                    required: true,
                },
                academic_year_id: {
                    required: true,
                },
                course_id       : {
                    required: true,
                },
                section_id      : {
                    required: true,
                },
                email :{
                    required: true,
                    email: true
                },
                gr_no :{
                    required: true,
                },

            },
            messages: {
                name            : {
                    required: "Please enter name",
                },
                course          : {
                    required: "Please enter course",
                },
                batch_id        : {
                    required: "Please pick a batch",
                },
                academic_year_id: {
                    required: "Please pick a year",
                },
                course_id       : {
                    required: "Please pick a course",
                },
                section_id      : {
                    required: "Please pick a section",
                },
                email :{
                    required: "Please enter mail",
                },
                gr_no :{
                    required: "Please enter GR no",
                },
            },

        });
    }

    var dropdownChange = function(){
        $("#academic_year_id").change();
        $("#batch_id").change();
    }

    //For academic year change
    var ajaxAcademicYearChange = function(){
        $("#academic_year_id").bind("change", function () {

            $("#batch_id").html('');

            $.ajax({
                type   : "POST",
                url    : routeBatchUrl,
                data   : {year_id: $(this).val()},
                success: function (html) {
                    //alert(html);
                    $("#batch_id").html(html);
                }
            });

        });
    }

    //For batch change
    var ajaxBatchChange = function(){
        $("#batch_id").bind("change", function () {

            $("#section_id").html('');

            $.ajax({
                type   : "POST",
                url    : routeSectionUrl,
                data   : {batch_id: $(this).val()},
                success: function (html) {
                    //alert(html);
                    $("#section_id").html(html);
                }
            });

        });
    }


    return {
        list: function(){
          initDatatable(ajaxListRoute);
        },
        manage: function(){
            ajaxAcademicYearChange();
            ajaxBatchChange();
            dropdownChange();
            studValidation();
        }
    }

}();


