<!--Start Box-->
<div class="box1 top_header">
    <a name="top" id="top"></a>

    <!--Main Bar-->
    <div class="container_12 navbar">
        <!--Logo-->
        <div class="grid_3_no_margin"><a href="./"><img src="images/img/logo.png" alt="" class="logo"/></a></div>
        <!--End Logo-->
        <!--Main Nav--> 
        <div class="grid_9_no_margin">

            <div id="menu">
                <ul>
                    <?php echo Menu::get_children("Null", 1, NULL); ?>
                </ul>
            </div>  
        </div>
        <!--End Main Nav--> 
    </div>
    <!--End Main Bar-->
</div>
<!--End Box-->
<div class="clearnospcaing"></div>