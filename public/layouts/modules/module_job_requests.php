<?php global $session, $page_title, $hide_title;?>

  <form method="POST" action="actions/job_requests.php" id="job_requests_1544384702">
    <?php echo setToken() ?>
      <input type="hidden" name="form_name" value="job_requests">
      <span id="msg"></span>
      <h4>اﺳﺘﻤﺎﺭﺓ اﻟﺘﻘﺪﻳﻢ ﻋﻠﻰ ﻭﻇﻴﻔﺔ</h4>
      <div class="form-group ">
          <label for="full_name1544384702">اﻹﺳﻢ ﺑﺎﻟﻜﺎﻣﻞ </label>
          <div class="input-group">
            <span class='input-group-addon'><i class='fa fa-user' aria-hidden='true'></i></span>
            <input type="text" class="form-control"
            id="full_name1544384702"
            name="fields[full_name]"
            placeholder="اﻹﺳﻢ ﺑﺎﻟﻜﺎﻣﻞ"
            data-rule-required="true"
            data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"  style="">
          </div>
      </div>
      <div class="form-group ">
      <label for="gender1544384702">اﻟﻨﻮﻉ <span class="required-field_joining_request_1543960319"></span></label>

        <div class="radio">
          <label for='male' class="radio-inline"><input id="male" type="radio" name="fields[gender]" value="1" data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"> ﺫﻛﺮ  </label>

           <label for='female' class="radio-inline"><input id="female" type="radio" name="fields[gender]" value="2"data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"> ا ﻧﺜﻲ  </label>
        </div>
      </div>
      <div class="form-group ">
          <label for="mobile1544384702">اﻟﺠﻮاﻝ <span class="required-field_joining_request_1543960319"></span>
          </label>
          <div class="input-group">
            <span class='input-group-addon'><i class='fa fa-mobile' aria-hidden='true'></i></span>
            <input type="text" class="form-control"
            id="mobile1544384702"
            name="fields[mobile]"
            placeholder="اﻟﺠﻮاﻝ"
            data-rule-required="true"
            data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-minlength="10" data-rule-maxlength="10" data-rule-digits="true" data-msg-minlength="ﺭﻗﻢ اﻟﺠﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" data-msg-maxlength="ﺭﻗﻢ اﻟﺠﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" data-msg-digits="ﺭﻗﻢ اﻟﺠﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" style="">
         </div>
      </div>

      <div class="form-group ">
          <label for="email1544384702">اﻟﺒﺮﻳﺪ اﻹﻟﻜﺘﺮﻭﻧﻲ <span class="required-field_joining_request_1543960319"></span>
          </label>
          <div class="input-group">
            <span class='input-group-addon'><i class='fa fa-envelope-o' aria-hidden='true'></i></span>
            <input type="text" class="form-control"
            id="email1544384702"
            name="fields[email]"
            placeholder="اﻟﺒﺮﻳﺪ اﻹﻟﻜﺘﺮﻭﻧﻲ"
            data-rule-required="true"
            data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-email="true" data-msg-email="ﺑﺮﻳﺪ اﻟﻜﺘﺮﻭﻧﻲ ﻏﻴﺮ ﺻﺤﻴﺢ"style="">
          </div>
      </div>
      <div class="form-group ">
        <label for="file_id1544384702">اﻟﺴﻴﺮﺓ اﻟﺬاﺗﻴﺔ
          <span class="required-field_joining_request_1543960319"></span>
        </label>
        <div id="file_id1544384702" class="dropzone">
          <input type="hidden" name="fields[file_id]" value="" class="dropzone_input"
          data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" >
          <div class="dz-message" data-dz-message>
            <span class="text-center"><i class="fa fa-upload fa-3x" aria-hidden="true"></i></span><br/>
            <span class="upload_text">ﺣﻤﻞ اﻟﻤﻠﻒ</span>
          </div>
        </div>
      </div>
      <div class="form-group ">
        <label for="notes1544384702">ﻣﻼﺣﻈﺎﺕ ﺃﺧﺮﻱ</label>
        <textarea class="form-control" id="notes1544384702" name="fields[notes]" style="height:150px;"
        placeholder="ﻣﻼﺣﻈﺎﺕ ﺃﺧﺮﻱ"
        data-rule-required="false" ></textarea>

      </div>
      <div class="form-group">
          <label><?php echo read_xmls('/site/subscription/lables/captcha') ?></label>
          <input type="text" class="form-control" name="captcha" id="scaptcha" value="<?php echo @$_POST['captcha'] ?>"/>
          <label><img src="aids/captcha.php" class="captch"></label>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="<?php echo read_xmls('/site/subscription/lables/subscribe') ?>" class="button small color round">
      </div>

</form>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"> </script>
<style>
.dropzone{overflow:hidden !important;}
</style>
<?php echo get_js('job_request_upload.js');?>
