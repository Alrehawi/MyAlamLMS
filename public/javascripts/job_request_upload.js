var form_submitted = "0";
$(document).ready(function(){$.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-z]+$/i.test(value);
});
$('#job_requests_1544384702').validate({ ignore: "",
errorPlacement: function(error, element) {
    if (element.attr("type") == "checkbox") {
        error.insertAfter(element.closest(".checkbox"));
    } else if (element.attr("type") == "radio") {
        error.insertAfter(element.closest(".radio"));
    } else if (element.attr("input_type") == "rating") {
        error.insertAfter(element.closest(".error_place"));
    } else if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
    }else if ( element.hasClass("dropzone_input") ) {
        error.insertAfter(element.closest(".dropzone"));
    }else if ( element.hasClass("select2-hidden-accessible") ) {
        error.insertAfter(element.parent().find("span.select2-container"));
    } else {
        error.insertAfter(element);
    }
},
highlight: function(element) {
$(element).closest(".form-group").addClass("has-error_job_requests_1544384702");
},
unhighlight: function(element) {
$(element).closest(".form-group").removeClass("has-error_job_requests_1544384702");
},
errorClass: "error-class_job_requests_1544384702",
submitHandler: function (form) {
var form_data = $(form).serialize();
if( typeof uploadedFiles !== "undefined" && uploadedFiles.length){
    form_data += "&attachments="  + uploadedFiles.join(",") ;
}
var $btn = $(form).find(".send_email").button("loading");
$.ajax({
    type: $('#job_requests_1544384702').attr('method'),
    url: $('#job_requests_1544384702').attr('action'),
    data: form_data,
    dataType: "json",
    success: function (result) {
        $btn.button("reset");if(result.success == 1){
            if (typeof job_requests_success_true === "function") {
                job_requests_success_true(result);
            }
            if( result.redirect == 1 ){
                window.location = result.url;
            } else {
                var html = '<div class="alert alert-dismissable alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + result.msg + '</div>';
                $(form).find( "#msg" ).html(html);
                form_submitted = "1"
                $(form)[0].reset();
                if(typeof uploadedFiles !== "undefined"){
                    $(".dropzone").each( function(){
                         Dropzone.forElement(this).removeAllFiles();
                    });
                    form_submitted = "0"
                }
            }
        } else {
            if (typeof job_requests_success_false === "function") {
                job_requests_success_false(result);
            }
            var html = '<div class="alert alert-dismissable alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + result.msg + '</div>';
            $(form).find( "#msg" ).html(html);
        }}
});
return false;
}
});
});
if(!uploadedFiles){
    var uploadedFiles = [];
    Dropzone.autoDiscover = false;
}
$("#file_id1544384702").dropzone({
    url: "actions/job_request_upload_file.php",
    addRemoveLinks: true,
    acceptedFiles: ".pdf,.doc,.docx",
    maxFilesize: 5,
    maxFiles: 1,
    parallelUploads: 1,
    init: function() {
        this.on("removedfile", function(file) {
            if( form_submitted === "0" ){
                $.ajax({
                    url: "actions/job_request_delete_file.php",
                    data: { "file_name": file.uploaded_as },
                    type: "POST",
                });

                var index = uploadedFiles.indexOf(file.uploaded_as);
                if(index!=-1){
                   uploadedFiles.splice(index, 1);
                }

                var elementVal = $(this.element).find(".dropzone_input").val();
                var oldVal = elementVal.split(",");
                index = oldVal.indexOf(file.uploaded_as);
                if(index!=-1){
                   oldVal.splice(index, 1);
                }
                var newVal = oldVal.join(",");
                $(this.element).find(".dropzone_input").val(newVal);
            }
        });
    },
    success: function( file, response ){
        obj = JSON.parse(response);
        if( obj.success === 1 ){

            file.uploaded_as = obj.uploaded_file_name;

            var elementVal = $(this.element).find(".dropzone_input").val();
            if( elementVal === ""){
                var oldVal = [];
            } else {
                var oldVal = elementVal.split(",");
            }
            oldVal.push(obj.uploaded_file_name);
            var newVal = oldVal.join(",");
            $(this.element).find(".dropzone_input").val(newVal);
            return file.previewElement.classList.add("dz-success");
        } else {
            var node, _i, _len, _ref, _results;
            var message = obj.msg
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              node = _ref[_i];
              _results.push(node.textContent = message);
            }
            return _results;
        }
    },
});
