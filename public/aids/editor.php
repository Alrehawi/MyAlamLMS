<?php
require_once("../../../includes/initialize.php");
$initialValue = $getValue;
$feild=$getField;
?>

<script src="//cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>

  <textarea name="<?php echo $feild?>"><?php echo $initialValue?></textarea>
  <script>

    CKEDITOR.replace( '<?php echo $feild?>', {

      language: '<?php echo read_xmls('/site/adminheader/lang')?>',
      allowedContent : true,
      height: 350,
      extraPlugins: 'embed,autoembed,image2',
       embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
      toolbar: [
        {
          name: 'document',
          items: [ 'Source', 'Templates']
        },
        {
          name: 'various',
          items: ['ExportPdf', '-', 'Undo', 'Redo']
        },
        {
          name: 'styles',
          items: ['Format']
        },
        {
          name: 'colors',
          items: ['TextColor', 'BGColor']
        },
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat','CopyFormatting']
        },
        {
          name: 'paragraph',
          items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote','-','BidiRtl', 'BidiLtr']
        },
        {
          name: 'align',
          items: ['JustifyBlock','JustifyRight', 'JustifyCenter', 'JustifyLeft']
        },
        {
          name: 'links',
          items: ['Link', 'Unlink']
        },
        {
          name: 'insert',
          items: ['Image','Embed', 'Table','Iframe', 'Smiley']
        },
        { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
      ],
      contentsCss: [
        'http://cdn.ckeditor.com/4.14.0/full-all/contents.css',
        'https://ckeditor.com/docs/vendors/4.14.0/ckeditor/assets/css/widgetstyles.css'
      ],
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
      image2_disableResizer: true
    });
    CKEDITOR.dtd.$removeEmpty['i'] = false;

  </script>
