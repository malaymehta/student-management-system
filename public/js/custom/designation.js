var Designation = function(){
    var initDatatable = function(ajaxListRoute){
        $('#designation_table').DataTable({
            processing: true,
            serverSide: true,
            //ordering: false,
            ajax: ajaxListRoute,
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'alias', name: 'alias'},
                {data: 'actions', name: 'actions', searchable: false, orderable: false}
            ]
        });
    }
    
    var designationValidation = function () {
        $('#designation-form').validate({
            ignore: 'hidden',
            errorElement: 'label',
            rules: {
                name: 'required'
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    }


    return {
        list: function(){
            initDatatable(ajaxListRoute);
        },
        manage: function () {
            designationValidation();
        }
    }
}();
