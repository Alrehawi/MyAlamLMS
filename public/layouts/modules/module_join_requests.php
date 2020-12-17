<?php global $session, $page_title, $hide_title;

/*if (isset($_POST['submit'])) {
  echo "here";
  echo include_action_file('join_requests.php');
}*/
?>
 <!-- <form name="joining_request_1543960319"  class="form-horizontal" action="" method="POST" enctype="multipart/form-data"   id="joining_request_1543960319"> -->

<form method="POST"
  action="actions/join_requests.php"
  id="joining_request_1543960319"
  style="background-color: #ffffff; ">
  <?php echo setToken() ?>

  <input type="hidden" name="form_name" value="joining_request">
  <span id="msg"></span>
  <div class="form-group ">
    <h4 >ﺑﻴﺎﻧﺎﺕ اﻟﻄﺎﻟﺐ</h4>
  </div>
  <div class="form-group ">
    <label for="full_name1543960319">اﻹﺳﻢ ﺭﺑﺎﻋﻲ <span class="required-field_joining_request_1543960319"></span></label>
    <input type="text" class="form-control"
      id="full_name1543960319"
      name="fields[full_name]"
      placeholder="اﺳﻢ اﻟﻄﺎﻟﺐ ﺭﺑﺎﻋﻴﺎ"
      data-rule-required="true"
      data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"  style="">
  </div>
  <div class="form-group ">
      <label for="gender1543960319">اﻟﻨﻮﻉ <span class="required-field_joining_request_1543960319"></span></label>

        <div class="radio"><label class="radio-inline">
          <input class="" type="radio"
          name="fields[gender]"
          value="1"
          data-rule-required="true"
          data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"> ﺫﻛﺮ
        </label><label class="radio-inline">
          <input class="" type="radio"
          name="fields[gender]"
          value="2"
          data-rule-required="true"
          data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"> ﺃﻧﺜﻲ
        </label>
      </div>
    </div>
    <div class="form-group ">
      <label for="birth_date1543960319">ﺗﺎﺭﻳﺦ اﻟﻤﻴﻼﺩ <span class="required-field_joining_request_1543960319"></span></label>
      <div class="input-group">
        <span class='input-group-addon'><i class='fa fa-calendar' aria-hidden='true'></i></span>
        <input type="text" class="form-control"
        id="birth_date1543960319"
        name="fields[birth_date]"
        placeholder="ﺗﺎﺭﻳﺦ اﻟﻤﻴﻼﺩ"
        data-rule-required="true"
        data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"  ></div>
      </div>
      <div class="form-group ">
        <label for="nationality1543960319">اﻟﺠﻨﺴﻴﺔ <span class="required-field_joining_request_1543960319"></span></label>
          <select class="form-control" id="nationality1543960319"
          name="fields[nationality]"
          data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"
          style=""><option value="1"  selected> اﻟﺴﻌﻮﺩﻳﺔ</option>
          <option value="2"  > ﻣﺼﺮ</option>
          <option value="3"  > ﺳﻮﺭﻳﺎ</option>
          <option value="4"  > ﻟﺒﻨﺎﻥ</option>
          <option value="5"  > اﻷﺭﺩﻥ</option>
          <option value="6"  > ﺗﻮﻧﺲ</option>
          <option value="7"  > اﻟﻤﻐﺮﺏ</option>
          <option value="8"  > اﻟﺠﺰاﺋﺮ</option>
          <option value="9"  > اﻟﺒﺤﺮﻳﻦ</option>
          <option value="10"  > ﻗﻄﺮ</option>
          <option value="11"  > اﻹﻣﺎﺭاﺕ</option>
          <option value="12"  > اﻟﻴﻤﻦ</option>
          <option value="13"  > اﻟﻌﺮاﻕ</option>
          <option value="14"  > اﻟﻜﻮﻳﺖ</option>
          <option value="15"  > اﻟﺴﻮﺩاﻥ</option>
          <option value="16"  > ﻓﻠﺴﻄﻴﻦ</option>
          <option value="17"  > ﺑﻨﺠﻼﺩﻳﺶ</option>
          <option value="18"  > ﺑﺎﻛﺴﺘﺎﻥ</option>
          <option value="19"  > ﺃﻓﻐﺎﻧﺴﺘﺎﻥ</option>
          <option value="20"  > اﻟﻔﻠﺒﻴﻦ</option>
          <option value="21"  > ﺃﻧﺪﻭﻧﻴﺴﻴﺎ</option>
          <option value="22"  > اﻟﻬﻨﺪ</option>
          <option value="23"  > ﺃﺧﺮﻱ</option>
          </select>
      </div>
      <div class="form-group ">
        <label for="id_no1543960319">ﺭﻗﻢ اﻟﻬﻮﻳﺔ <span class="required-field_joining_request_1543960319"></span></label>
          <input type="text" class="form-control"
          id="id_no1543960319"
          name="fields[id_no]"
          placeholder="ﺭﻗﻢ اﻟﻬﻮﻳﺔ اﻟﻄﺎﻟﺐ"
          data-rule-required="true"
          data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-number="true" data-msg-number="ﺭﻗﻢ ﻏﻴﺮ ﺻﺤﻴﺢ"style="">
        </div>
        <div class="form-group ">
          <label for="mobile1543960319">اﻟﺠﻮاﻝ <span class="required-field_joining_request_1543960319"></span></label>
            <input type="text" class="form-control"
            id="mobile1543960319"
            name="fields[mobile]"
            placeholder="ﺟﻮاﻝ اﻟﻄﺎﻟﺐ"
            data-rule-required="true"
            data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-minlength="10" data-rule-maxlength="10" data-rule-digits="true" data-msg-minlength="ﺭﻗﻢ اﻟﺠﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" data-msg-maxlength="ﺭﻗﻢ اﻟﺠﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" data-msg-digits="ﺭﻗﻢ اﻟﺠﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" style="">
          </div>
          <div class="form-group ">
            <label for="Email1543960319">اﻟﺒﺮﻳﺪ اﻹﻟﻜﺘﺮﻭﻧﻲ <span class="required-field_joining_request_1543960319"></span></label>
              <input type="text" class="form-control"
              id="Email1543960319"
              name="fields[Email]"
              placeholder="اﻟﺒﺮﻳﺪ اﻹﻟﻜﺘﺮﻭﻧﻲ"
              data-rule-required="true"
              data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-email="true" data-msg-email="ﺑﺮﻳﺪ اﻟﻜﺘﺮﻭﻧﻲ ﻏﻴﺮ ﺻﺤﻴﺢ"style="">
            </div>
            <div class="form-group ">

              <label for="address1543960319">اﻟﻌﻨﻮاﻥ <span class="required-field_joining_request_1543960319"></span></label>
                <textarea class="form-control" id="address1543960319" name="fields[address]"
                placeholder="اﻟﻌﻨﻮاﻥ"
                data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"></textarea>
            </div>
            <div class="form-group ">

              <label for="photo1543960319">اﻟﺼﻮﺭﺓ اﻟﺸﺨﺼﻴﺔ <span class="required-field_joining_request_1543960319">*</span></label>

                <div id="photo1543960319" class="dropzone">
                  <input type="hidden" name="fields[photo]" value="" class="dropzone_input"
                  >
                  <!-- data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"  -->
                  <div class="dz-message" data-dz-message>
                    <span class="text-center"><i class="fa fa-upload fa-3x" aria-hidden="true"></i></span><br/>
                    <span class="upload_text">اﺧﺘﺮ اﻟﺼﻮﺭﺓ</span>
                  </div>
              </div>

            </div>
            <div class="form-group ">
              <h4 >اﻟﺒﻴﺎﻧﺎﺕ اﻟﺘﻌﻠﻴﻤﻴﺔ</h4>
            </div>
            <div class="form-group ">
              <label for="stage_no1543960319">اﻟﻤﺮﺣﻠﺔ اﻟﺘﻌﻠﻴﻤﻴﺔ <span class="required-field_joining_request_1543960319">*</span></label>
                <select class="form-control" id="stage_no1543960319"
                name="fields[stage_no]"
                data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"
                style=""><option value="1"  > اﻟﺮﻭﺿﺔ</option>
                <option value="2"  > اﻹﺑﺘﺪاﺋﻲ</option>
                <option value="3"  > اﻟﻤﺘﻮﺳﻂ</option>
                <option value="4"  > اﻟﺜﺎﻧﻮﻱ</option>
                </select>
            </div>
            <div class="form-group ">
              <label for="level_no1543960319">اﻟﺼﻒ اﻟﺪﺭاﺳﻲ <span class="required-field_joining_request_1543960319"></span></label>
                <select class="form-control" id="level_no1543960319"
                name="fields[level_no]"
                data-rule-required="true" data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"
                style=""><option value="1"  > اﻷﻭﻝ</option>
<option value="2"  > اﻟﺜﺎﻧﻲ</option>
<option value="3"  > اﻟﺜﺎﻟﺚ</option>
<option value="4"  > اﻟﺮاﺑﻊ</option>
<option value="5"  > اﻟﺨﺎﻣﺲ</option>
<option value="6"  > اﻟﺴﺎﺩﺱ</option>
</select>
            </div>
            <div class="form-group ">

              <label for="category_id1543960319">اﻟﻘﺴﻢ <span class="required-field_joining_request_1543960319">*</span></label>

                <div class="radio"><label class="radio-inline">
                  <input class="" type="radio"
                  name="fields[category_id]"
                  value="1"
                  data-rule-required="true"
                  data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"> اﻟﻌﺮﺑﻲ
                </label><label class="radio-inline">
                  <input class="" type="radio"
                  name="fields[category_id]"
                  value="2"
                  data-rule-required="true"
                  data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"> اﻟﺪﻭﻟﻲ
                </label>
              </div>
            </div>
            <div class="form-group ">
              <h4 >ﺑﻴﺎﻧﺎﺕ ﻭﻟﻲ اﻷﻣﺮ</h4>
            </div>
            <div class="form-group ">
              <label for="parent_full_name1543960319">اﻻﺳﻢ ﺭﺑﺎﻋﻴﺎ <span class="required-field_joining_request_1543960319"></span></label>
                <input type="text" class="form-control"
                id="parent_full_name1543960319"
                name="fields[parent_full_name]"
                placeholder="اﺳﻢ ﻭﻟﻰ اﻻﻣﺮ ﺭﺑﺎﻋﻴﺎ"
                data-rule-required="true"
                data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ"  style="">
              </div>
              <div class="form-group ">
                <label for="parent_id_no1543960319">ﺭﻗﻢ اﻟﻬﻮﻳﺔ <span class="required-field_joining_request_1543960319"></span></label>
                  <input type="text" class="form-control"
                  id="parent_id_no1543960319"
                  name="fields[parent_id_no]"
                  placeholder="ﺭﻗﻢ ﻫﻮﻳﺔ ﻭﻟﻲ اﻷﻣﺮ"
                  data-rule-required="true"
                  data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-number="true" data-msg-number="ﺭﻗﻢ ﻏﻴﺮ ﺻﺤﻴﺢ"style="">
                </div>
                <div class="form-group ">
                  <label for="parent_mobile1543960319">اﻟﺠﻮاﻝ <span class="required-field_joining_request_1543960319"></span></label>
                    <input type="text" class="form-control"
                    id="parent_mobile1543960319"
                    name="fields[parent_mobile]"
                    placeholder="اﻟﺠﻮاﻝ"
                    data-rule-required="true"
                    data-msg-required="ﻫﺬا اﻟﺤﻖ ﻣﻄﻠﻮﺏ" data-rule-minlength="10" data-rule-maxlength="10" data-rule-digits="true" data-msg-minlength="ﺭﻗﻢ ﺟﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" data-msg-maxlength="ﺭﻗﻢ ﺟﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" data-msg-digits="ﺭﻗﻢ ﺟﻮاﻝ ﻏﻴﺮ ﺻﺤﻴﺢ" style="">
                  </div>
                  <div class="form-group ">
                    <label for="parent_email1543960319">اﻟﺒﺮﻳﺪ اﻹﻟﻜﺘﺮﻭﻧﻲ <span class="required-field_joining_request_1543960319"></span></label>
                      <input type="text" class="form-control"
                      id="parent_email1543960319"
                      name="fields[parent_email]"
                      placeholder="اﻟﺒﺮﻳﺪ اﻹﻟﻜﺘﺮﻭﻧﻲ"
                      data-rule-required="true"
                      data-msg-required="ﻫﺬا اﻟﺤﻘﻞ ﻣﻄﻠﻮﺏ" data-rule-email="true" data-msg-email="ﺑﺮﻳﺪ ﺇﻟﻜﺘﺮﻭﻧﻲ ﻏﻴﺮ ﺻﺤﻴﺢ"style="">
                    </div>
                    <div class="form-group">
                        <label><?php echo read_xmls('/site/subscription/lables/captcha') ?></label>
                        <input type="text" class="form-control" name="captcha" id="scaptcha" value="<?php echo @$_POST['captcha'] ?>"/><br>
                            <label><img src="aids/captcha.php" class="captch"></label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="<?php echo read_xmls('/site/subscription/lables/subscribe') ?>" class="button small color round">
                    </div>
                  </form>
              <div class="clear"></div>
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
  <?php echo get_css('theme_ar/select2.rtl.css');?>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"> </script>
<style>
.dropzone{overflow:hidden !important;}
</style>
  <?php echo get_js('join_request_upload.js');?>
