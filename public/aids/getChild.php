<?php
require_once("../../includes/initialize.php");
global $session;
global $database;
if (isset($_GET['sec'])) {
    $sec = intval($_GET['sec']);
    if (Section::has_child($sec) || (isset($_GET['cat']) && $_GET['cat'] != 'all')) {

        if (isset($_GET['cat'])) {
            $cat = intval($_GET['cat']);
            $menu_title = Category::find_viewed_language('title', $cat, 'cat');
            $cond = "WHERE sec_parent_id is NULL AND cat_id=" . $database->escape_value($cat);
        } else {
            $menu_title = Section::find_viewed_language('title', $sec, 'sec');
            $cond = "WHERE sec_parent_id = " . $database->escape_value($sec);
        }
        ?>
        <font class="text_normal_bold"><?php echo $menu_title ?> *</font> <br />
        <select  class="form-control" name="child<?php echo $sec ?>" class="dropdown" style="width:270px;" onchange="getData('aids/getChild.php?sec=' + this.value, 'childs<?php echo $sec ?>')">
            <option value=""><?php echo read_xmls('/site/frontendend/layoutheader/select') ?></option>
            <?php
            $sections = Section::find_all('title ASC', $cond); //.$database->escape_value($sec));
            foreach ($sections as $section):
                $section_name = Section::find_viewed_language('title', $section->id, 'sec');
                echo "<option value='" . $section->id . "'>" . $section_name . "</option>";
            endforeach;
            ?>
        </select>
        <br /> 
        <div id="childs<?php echo $sec ?>"></div>
    <?php
    } else if (Section::has_entry($sec)) {

        $properties = Property::find_all('sort_id ASC', "WHERE sec_id =" . $database->escape_value($sec));
        $sec_num = count($properties);
        $id = 0;
        foreach ($properties as $property):
            $property_name = Property::find_viewed_language('title', $property->id, 'property');
            $id++;
            ?>
            <font class="text_normal_bold"><?php echo $property_name ?> *</font> <br />
            <select  class="form-control" name="entry<?php echo $id; ?>" class="dropdown" style="width:270px;">
                    <!--<option value="all"><?php //echo read_xmls('/site/search/labels/all')?></option>-->
                <?php
                $ents = Entry::find_by_field('property_id', $property->id);
                foreach ($ents as $ent):
                    $ent_name = Entry::find_viewed_language('title', $ent->id, 'entry');
                    ?>
                    <option value="<?php echo $ent->id; ?>"><?php echo $ent_name; ?></option>
            <?php endforeach; ?>
            </select><br />
        <?php endforeach; ?>
        <input type="hidden" name="sec_num" value="<?php echo $sec_num; ?>" />
        <input type="hidden" name="sec_id" value="<?php echo $sec; ?>" />
    <?php } ?>
<?php
}?>