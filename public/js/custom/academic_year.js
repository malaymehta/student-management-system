var AcademicYear = function () {
    var initDatatable = function (ajaxListRoute) {
        $('#year_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},
                {data: 'status', name: 'status'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    };
    var yearValidation = function () {
        $("#my_year").validate({
            rules   : {
                name       : {
                    required   : true,
                },
                start_date       : {
                    required   : true,
                },
                end_date       : {
                    required   : true,
                },

            },
            messages: {
                name       : {
                    required   : "Please enter name",
                },
                start_date       : {
                    required   : "Please enter start date",
                },
                end_date       : {
                    required   : "Please enter end date",
                },
            },

        });
    };

    var initDatePicker = function (){
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
    };

    var dateChange = function () {
        $("#start_date").keypress(function(event) {event.preventDefault();});
        $("#end_date").keypress(function(event) {event.preventDefault();});
    };

    return {
        list: function (ajaxListRoute) {
            initDatatable(ajaxListRoute);
        },
        manage: function () {
            yearValidation();
            initDatePicker();
            dateChange();
        }
    }
}();