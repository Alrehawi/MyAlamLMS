<?php
require_once("../../../includes/initialize.php");
$initialValue = $getValue;
$feild=$getField;
?>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

  <textarea name="<?php echo $feild?>"><?php echo $initialValue?></textarea>
  <!-- <script>

    CKEDITOR.replace( '<?php //echo $feild?>', {
        language: 'en',
    //    allowedContent: 'p b i; a[!href]',

    });
  </script> -->
  <script>
      (function() {
        var mathElements = [
          'math',
          'maction',
          'maligngroup',
          'malignmark',
          'menclose',
          'merror',
          'mfenced',
          'mfrac',
          'mglyph',
          'mi',
          'mlabeledtr',
          'mlongdiv',
          'mmultiscripts',
          'mn',
          'mo',
          'mover',
          'mpadded',
          'mphantom',
          'mroot',
          'mrow',
          'ms',
          'mscarries',
          'mscarry',
          'msgroup',
          'msline',
          'mspace',
          'msqrt',
          'msrow',
          'mstack',
          'mstyle',
          'msub',
          'msup',
          'msubsup',
          'mtable',
          'mtd',
          'mtext',
          'mtr',
          'munder',
          'munderover',
          'semantics',
          'annotation',
          'annotation-xml'
        ];

        CKEDITOR.plugins.addExternal('ckeditor_wiris', 'https://ckeditor.com/docs/ckeditor4/4.14.0/examples/assets/plugins/ckeditor_wiris/', 'plugin.js');

        CKEDITOR.replace('<?php echo $feild?>', {
          extraPlugins: 'ckeditor_wiris',
          // For now, MathType is incompatible with CKEditor file upload plugins.
          removePlugins: 'uploadimage,uploadwidget,uploadfile,filetools,filebrowser',
          height: 320,
          // Update the ACF configuration with MathML syntax.
          extraAllowedContent: mathElements.join(' ') + '(*)[*]{*};img[data-mathml,data-custom-editor,role](Wirisformula)'
        });
      }());
    </script>
