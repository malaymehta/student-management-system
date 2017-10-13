$(document).ready(function(){
    /*$(".dz-remove").click(function(){
        $con =  confirm('Are you sure, You want to delete this image from the record ?');
        if(!$con){
            return false;
        }
    });*/
    //imageRemove();
});

function imageRemove(){
    $(".dz-remove").click(function(){
        alert('function');
        /*$con =  confirm('Are you sure, You want to delete this image from the record ?');
        if(!$con){
            return false;
        }*/
    });
}

//For dropzone files
var occupied          = 0;
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("div#dropzoneFileUpload", {
    url           : routeUrl,
    params        : {
        _token: token
    },
    paramName     : "file",
    maxFilesize   : 5,
    //maxFiles      : 3,
    addRemoveLinks: true,
    acceptedFiles : "image/*",
    init          : function () {

        //At the edit student form if we have already submitted this profile pic
        if (imageEdit != '') {
            var imageCnt = 0;
            var data     = [];
            var dataID   = [];
            $(".image_name").each(function () {
                var imageName = $(this).val();
                data.push(imageName);
            });

            $(".image_id").each(function () {
                var imageID = $(this).val();
                dataID.push(imageID);
            });

            for (i in data) {
                imageCnt++;
                var mockFile = {name: data[i], id: dataID[i], size: (1024 * 50)};
                this.options.addedfile.call(this, mockFile);
                this.options.thumbnail.call(this, mockFile, imageStoragePath + "/" + data[i]);
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete');
            }
            this.options.maxFiles = allowNoFiles - imageCnt;
            occupied              = imageCnt;

        } else {
            this.options.maxFiles = allowNoFiles;
            occupied              = 0;
        }

        //Event Fired On when number of files exceed limit
        this.on("maxfilesexceeded", function (file) {
            //this.removeAllFiles();
            //this.addFile(file);
            occupied++;
        });

        //Event fired when uploading successfull
        var txtBoxCnt = 0;
        this.on("success", function (file, response) {
            occupied++;
            txtBoxCnt++;
            var obj = $.parseJSON(JSON.stringify(response));
            if(obj.code == 200) {
                $(".dynamicImagesArray").append("<input type='hidden' name='image_name[]' class='image_name' id='image_name_" + txtBoxCnt + "' value='" + obj.success + "'> <input type='hidden' name='image_id[]' class='image_id' id='image_id_" + txtBoxCnt + "' value=''>");
            } else if(obj.code == 420){
                var node, _i, _len, _ref, _results;
                var message = obj.error // modify it to your error message
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        });

        /*this.on('error', function (file, response) {
            alert('error');
            var obj = $.parseJSON(JSON.stringify(response));
            console.log(obj);
            $(file.previewElement).find('.dz-error-message').text("Something went wrong!!");
        });*/
        //Event fired when file removed from the DropZone
        this.on("removedfile", function (file) {
            //return confirm('Are you sure ?', function(){

                $(".image_name").each(function () {
                    if ($(this).val() == file.name) {
                        $(this).remove();
                    }
                });

                $(".image_id").each(function () {
                    if ($(this).val() == file.id) {
                        $(this).remove();
                    }
                });

                //Check, if numner of files exceeds into the dropzone
                if (imageEdit != '') {
                    if (occupied <= allowNoFiles) {
                        if (this.options.maxFiles <= allowNoFiles) {
                            this.options.maxFiles++;
                        }
                    }
                    if (occupied != 0) {
                        occupied--;
                    }
                }

                //Delete file from the server
                $.ajax({
                    url    : routeImgDelete,
                    type   : "POST",
                    data   : {imageVal: file.name, imageID: file.id, entityID: entityID},
                    success: function (result) {
                        var resultObj = $.parseJSON(JSON.stringify(result));
                        if(resultObj.success == false)
                        {
                            alert("Something went wrong!");
                        }
                    }
                });

            //});


        });
    }
});