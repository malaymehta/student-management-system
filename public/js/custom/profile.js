$(document).ready(function(){
    profileValidation();
});

function profileValidation()
{
    $("#my_profile").validate({
        rules   : {
            name       : {
                required   : true,
            },
            country       : {
                required   : true,
            },
            state       : {
                required   : true,
            },
            city       : {
                required   : true,
            },

        },
        messages: {
            name       : {
                required   : "Please enter name",
            },
            country       : {
                required   : "Please enter country",
            },
            state       : {
                required   : "Please enter state",
            },
            city       : {
                required   : "Please enter city",
            },
        },

    });
}



$(function () {
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
});