var QuestionCategory = function () {
    
    var initDatatable = function (ajaxListRoute) {
        $('#questionCat_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'course', name: 'course'},
                {data: 'description', name: 'description'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }
    
    var questionCatValidation = function () {
        $("#my_category").validate({
            rules   : {
                name       : {
                    required   : true,
                    maxlength: 30,
                },
                course_id       : {
                    required   : true,
                },
                description       : {
                    required   : true,
                    maxlength: 255,
                },

            },
            messages: {
                name       : {
                    required   : "Please enter name",
                },
                course_id       : {
                    required   : "Please pick a course",
                },
                description       : {
                    required   : "Please enter description",
                },
            },

        });
    }
    
    return {
        list: function (ajaxListRoute) {
            initDatatable(ajaxListRoute);
        },
        manage: function () {
            questionCatValidation();
        }
    }
    
}();
