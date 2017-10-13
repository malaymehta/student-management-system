var Batch = function(){
    var initDatatable = function(ajaxListRoute){
        $('#batch_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'alias', name: 'alias'},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }

    var batchValidation = function(){
        $("#my_batch").validate({
            rules   : {
                name       : {
                    required   : true,
                },
                alias       : {
                    required   : true,
                },
                start_date       : {
                    required   : true,
                },
                end_date       : {
                    required   : true,
                },
                academic_year_id       : {
                    required   : true,
                },
                course_id       : {
                    required   : true,
                },
                status       : {
                    required   : true,
                },
                'image_name[]'       : {
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
                start_date       : {
                    required   : "Please enter start date",
                },
                end_date       : {
                    required   : "Please enter end date",
                },
                academic_year_id       : {
                    required   : "Please pick a year",
                },
                course_id       : {
                    required   : "Please pick a course",
                },
                status       : {
                    required   : "Please pick a status",
                },
                'image_name[]' :{
                    required   : "Please pick at least an image",
                }
            },

        });
    }
    
    var dateValidate = function () {
        $("#start_date").keypress(function(event) {event.preventDefault();});
        $("#end_date").keypress(function(event) {event.preventDefault();});
    }

    var initDatepicker = function(){
        $('#start_date').datepicker({
            dateFormat: 'd-m-yy',
            autoclose: true,
            onSelect: function(selectedDate){
                var endDate = $(this).datepicker('getDate', '+1d');
                endDate.setDate(endDate.getDate()+1);
                $("#end_date").datepicker("option", "minDate", endDate);
            }
        });

        $('#end_date').datepicker({
            dateFormat: 'd-m-yy',
            autoclose: true
        });
    }


    return {
        list: function(){
            initDatatable(ajaxListRoute)
         },
        manage: function(){
            batchValidation();
            initDatepicker();
            dateValidate();
        }
    }

}();
