var Shift = function(){
    var initDatatable = function (ajaxListRoute) {
        $('#shift_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }
    
    var shiftValidation = function () {
        $("#my_shift").validate({
            rules   : {
                name       : {
                    required   : true,
                },
                start_time       : {
                    required   : true,
                },
                end_time       : {
                    required   : true,
                },

            },
            messages: {
                name       : {
                    required   : "Please enter name",
                },
                start_time       : {
                    required   : "Please enter start time",
                },
                end_time       : {
                    required   : "Please enter end time",
                },
            },

        });
    }

    var dateValidate = function(){
        $("#start_time").keypress(function(event) {event.preventDefault();});
        $("#end_time").keypress(function(event) {event.preventDefault();});
    }
    
    var initDatepicker = function () {
        $('#start_time').timepicker({
            'timeFormat': 'h:i A',
        });

        $('#end_time').timepicker({
            'timeFormat': 'h:i A',
        });


        $('#start_time').on('changeTime', function() {
            var start_from = $('#start_time').timepicker('getTime');
            start_from.setTime(start_from.getTime());
            start_from.setHours(start_from.getHours()+1);
            $('#end_time').timepicker('setTime', null);
            $('#end_time').timepicker('option', 'minTime', start_from);

        });
    }

    return {
        list: function(ajaxListRoute){
            initDatatable(ajaxListRoute);
        },
        manage: function(){
            dateValidate();
            shiftValidation();
            initDatepicker();
        }
    }
    
}();