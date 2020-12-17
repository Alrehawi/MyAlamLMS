
   </div>
</div>
</div>
<script>
	 $.fn.dataTable.ext.classes.sPageButton = 'pagination-buttons';
	$(document).ready(function() {
        //sidebar
        //page-wrapper
        //alert($( window ).height());
        //alert($('#sidebar').height());
      //  alert($('#page-wrapper').height());

        if( $(window).width() > 500){
          //$('#side-menu').height($('#wrapper').height() );
        }

        $('#dataTables-example').DataTable({
             responsive: true,
             "info":     false,
              "columnDefs": [ {
                "targets": 'no-sort',
                "orderable": false,
              } ],
              "order": false,
              "sort": false,
               "pageLength": 20,
             "language": {
                "lengthMenu": '<span><?php echo read_xmls('/site/jobrequest/lables/show') ?></span><select  class="select-manyItmes">'+
                  '<option value="10">10</option>'+
                  '<option value="20">20</option>'+
                  '<option value="30">30</option>'+
                  '<option value="40">40</option>'+
                  '<option value="50">50</option>'+
                  '<option value="-1"><?php echo read_xmls('/site/adminactions/selectall') ?></option>'+
                  '</select>',
                       /* search icon */
                  "sSearch": '<i class="fa fa-search"></i>',
                  paginate: {
                    next: "<?php echo read_xmls('/site/paging/next') ?>",
                    previous: "<?php echo read_xmls('/site/paging/prev') ?>"
                  }

              },


        })

        $('.select').selectpicker();
        <?php

        if(strpos(getcwd(), 'menus') !== FALSE || strpos(getcwd(), 'permissions') !== FALSE ){?>
        $( ".select-manyItmes" ).val(-1).change();
        <?php }?>

        $('.navbar-toggle').click(function(){
           $('.sidebar').fadeToggle()
        })

    });
            $('select').addClass('select');
            $('select').attr('data-live-search', true);
</script>


<?php

  echo get_js('new_admin/vendor/metisMenu/metisMenu.min.js');

?>
</body>
</html>
<?php if (isset($database)) {
    $database->close_connection();
} ?>
<?php ob_flush(); ?>
