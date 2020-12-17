$(document).ready(function(){
    $('#image_file').on('change',function(){
      var fileCount = document.getElementById('image_file').files.length;
      if(fileCount > 10) {
         alert("Can not upload more than 10 files !!");
         return false;
      }

        $('#photos').ajaxForm({
            target:'#uploaded_images_preview',
            beforeSubmit:function(e){
                $('.file_uploading').show();
            },
            success:function(e){
                $('.file_uploading').hide();
            },
            error:function(e){
            }
        }).submit();
    });
});

function change_action(formaName,formAction) {
  return document.getElementById(formaName).action = formAction;
}
