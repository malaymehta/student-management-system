var Employee = function(){

    var initDatatable = function (ajaxListRoute) {
        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'mob_no', name: 'mob_no'},
                {data: 'role', name: 'role'},
                {data: 'doj', name: 'doj'},
                {data: 'options', 'orderable': false, 'searchable': false }
            ]

        });
    }
    
    
    var employeeValidation = function () {
        $("#my_employee").validate({
            rules   : {
                name       : {
                    required   : true,
                },
                role_id       : {
                    required   : true,
                },
                title       : {
                    required   : true,
                },
                email       : {
                    required   : true,
                    email: true
                },
                mob_no       : {
                    required   : true,
                    minlength: 10,
                    maxlength: 10,
                },
                gender       : {
                    required   : true,
                },
                dob       : {
                    required   : true,
                },
                doj       : {
                    required   : true,
                },
                total_exp_year       : {
                    required   : true,
                },
                total_exp_month       : {
                    required   : true,
                },
                department_id       : {
                    required   : true,
                },
                designation_id       : {
                    required   : true,
                },
                password       : {
                    required   : true,
                    minlength: 6,
                    maxlength: 10,
                },
                con_password       : {
                    required   : true,
                    equalTo: "#password",
                },

            },
            messages: {
                name       : {
                    required   : "Please enter name",
                },
                role_id       : {
                    required   : "Please pick a role",
                },
                title       : {
                    required   : "Please pick a title",
                },
                email       : {
                    required   : "Please enter email",
                },
                mob_no       : {
                    required   : "Please enter mobile number",
                },
                gender       : {
                    required   : "Please pick a gender",
                },
                dob       : {
                    required   : "Please enter DOB",
                },
                doj :{
                    required   : "Please enter DOJ",
                },
                total_exp_year :{
                    required   : "Please pick year",
                },
                total_exp_month :{
                    required   : "Please pick month",
                },
                department_id :{
                    required   : "Please pick a department",
                },
                designation_id :{
                    required   : "Please pick a designation",
                },
                password :{
                    required   : "Please enter password",
                },
                con_password :{
                    required   : "Please enter confirm password",
                }
            },

        });
    }

    var initDatepicker = function(){
        $("#dob").keypress(function(event) {event.preventDefault();});
        $("#doj").keypress(function(event) {event.preventDefault();});

        $('#dob').datepicker({
            dateFormat: 'd-m-yy',
            autoclose: true,
        });

        $('#doj').datepicker({
            dateFormat: 'd-m-yy',
            autoclose: true
        });
    }
    
    return {
        list: function (ajaxListRoute) {
            initDatatable(ajaxListRoute);
        },
        manage: function(){
            initDatepicker();
            employeeValidation();
        }

    }

}();
