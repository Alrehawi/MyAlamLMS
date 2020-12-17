<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $('.menu-primary ul li').hover(
                    function () {
                        clearTimeout($.data(this, 'timer'));
                        $('ul', this).stop(true, true).slideDown(500);
                    }, function () {
                $.data(this, 'timer', setTimeout($.proxy(function () {
                    $('ul', this).stop(true, true).slideUp(100);
                }, this), 200));
            });
        });
    });


</script>
<!-- Menu -->

<div class="menu-primary-wrapper"> 
    <!-- BEGIN .menu-primary -->
    <div class="menu-primary">
        <ul>
            <?php echo Menu::get_children("Null", 1); ?>
        </ul>
    </div>
</div>