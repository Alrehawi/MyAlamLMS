<?php

class Gallery extends DatabaseObject {

    public static $table_name = "galleries";
    protected static $db_fields = array('id', 'title', 'url_alias', 'folder', 'lang_id', 'module_id', 'paging', 'thumb_height',
        'thumb_width', 'image_height', 'image_width', 'publish', 'counter', 'site_id', 'created', 'updated');
    public $id;
    public $title;
    public $url_alias;
    public $folder;
    public $lang_id;
    public $module_id;
    public $paging;
    public $thumb_height;
    public $thumb_width;
    public $image_height;
    public $image_width;
    public $publish;
    public $counter;
    public $site_id;
    public $created;
    public $updated;
    public static $trans_key = 'gallery';
    public $errors = array();

    //create directory
    public function createGalleryDir() {
        $path = FILE_PATHDSO . DSO . 'photos' . DSO . $this->folder;
        if (!is_dir($path)) {
            mkdir($path, 0755);
            create_index($path);
            mkdir($path . '_thumb', 0755);
            create_index($path . '_thumb');
            return true;
        } else {
            return false;
        }
    }

    //delete directory
    public static function deleteGalleryDir($folder) {
        $dirname = $path = FILE_PATHDSO . DSO . 'photos' . DSO . $folder;
        if (is_dir($dirname))
            @$dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . DS . $file)) {
                    @unlink($dirname . DS . $file);
                } else {
                    $this->delete_directory($dirname . DS . $file);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    public function save_gallery() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->url_alias) || empty($this->folder) || empty($this->paging) || empty($this->thumb_height) || empty($this->thumb_width) || empty($this->image_height) || empty($this->image_width)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            $current_alias = self::find_by_id($this->id);
            if ($this->url_alias != $current_alias->url_alias && $this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
                return false;
            }
            // check limit chars		 
            else if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->title) || empty($this->url_alias) || empty($this->folder) || empty($this->paging) || empty($this->thumb_height) || empty($this->thumb_width) || empty($this->image_height) || empty($this->image_width)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }

            if ($this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
                return false;
            } else
            // check limit chars
            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                if (self::createGalleryDir()) {
                    return $this->create();
                } else {
                    $this->errors[] = $this->folder . " " . read_xmls('/site/filemanager/msg/direxist') . ".";
                    return false;
                }
            }
        }
    }

}

?>