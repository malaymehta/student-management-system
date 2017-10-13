var ShiftAllocation = function(){
    var initDatatable = function(ajaxListRoute){
        $('#user_table').DataTable({
            processing: true,
            bFilter: false,
            serverSide: true,
            ajax: {
                url: ajaxListRoute,
                //data: "departmentSearch="+$("#department_id").val(),
                data: function (d) {
                    d.departmentId = $("#department_id").val();
                    d.designationId = $("#designation_id").val();
                    d.empName = $("#name").val();
                }
            },
            "columns": [
                {data: 'checkbox', name: 'checkbox', 'orderable': false, 'searchable': false},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'department', name: 'department'},
                {data: 'designation', name: 'designation'},
                {data: 'shift', name: 'shift'},
            ]

        });
    }
    
    var initDatepicker = function () {
        $("#effective_date").keypress(function (event) {
            event.preventDefault();
        });

        $('#effective_date').datepicker({
            dateFormat: 'd-m-yy',
            autoclose : true
        });
    }
    
    var shiftAllocationValidation = function () {
        $("#my_allocation").validate({
            rules   : {
                shift_id       : {
                    required   : true,
                },
                effective_date       : {
                    required   : true,
                },
                'emp_check[]'       : {
                    required   : true,
                },

            },
            messages: {
                shift_id       : {
                    required   : "Please pick a shift",
                },
                effective_date       : {
                    required   : "Please enter effective date",
                },
                'emp_check[]'       : {
                    required   : "Please pick one or more employees",
                },
            },

        });
    }
    
    
    
    var allCheckboxClick = function () {
        $("#all").click(function(){
            if($(this).prop('checked')==true) {
                $(".emp_check").each(function () {
                    $(this).attr('checked', true);
                });
            }else{
                $(".emp_check").each(function () {
                    $(this).attr('checked', false);
                });
            }
        });
    }
    
    var resetClick = function () {
        $("#reset").click(function(){
            $("#department_id").val("");
            $("#designation_id").val("");
            $("#name").val('');
        });

    }
    
    return {
        list: function (ajaxListRoute) {
            initDatatable(ajaxListRoute);
        },
        manage: function(){
            initDatepicker();
            shiftAllocationValidation();
        },
        clickEvent: function () {
            allCheckboxClick();
            resetClick();
        }
    }
    
}();





