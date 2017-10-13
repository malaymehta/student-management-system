var Course = function(){
    
    var initDatatable = function (ajaxListRoute) {
        $('#course_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'alias', name: 'alias'},
                {data: 'code', name: 'code'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }

    var courseValidation = function(){
        $("#my_course").validate({
            rules   : {
                name       : {
                    required   : true,
                },
                alias       : {
                    required   : true,
                },
                code       : {
                    required   : true,
                },

            },
            messages: {
                name       : {
                    required   : "Please enter name",
                },
                alias       : {
                    required   : "Please enter alias",
                },
                code       : {
                    required   : "Please enter code",
                },
            },

        });
    }
    
    return {
        list: function(){
            initDatatable(ajaxListRoute);
        },
        manage: function(){
            courseValidation();
        }
    }

}();
