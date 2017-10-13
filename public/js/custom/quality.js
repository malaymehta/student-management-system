/**
 * Created by preeti.bendal on 6/13/2017.
 */
$(document).ready(function(){

    $("#my_quality").validate({
        rules   : {
            quality       : {
                required   : true,
            },

        },
        messages: {
            quality       : {
                required   : "Please enter quality name",
            },
        },

    });

});