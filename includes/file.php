<?php

class File extends DatabaseObject {

    public static $table_name = 'files';
    protected static $db_fields = array('id', 'title', 'filename', 'type', 'size', 'site_id', 'publish', 'created', 'updated');
    public $id;
    public $title;
    public $filename;
    public $type;
    public $size;
    public $site_id;
    public $publish;
    public $created;
    public $updated;
    private $temp_path;
    protected $upload_dir = "files";
    public static $trans_key = 'file';
    public $errors = array();
    protected $upload_errors = array(
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
    );

    // pass $_FILES['form_uploaded_file'] arrgument to this method // NOT IN USE!!!!!!!!!
    public function attatch_file($file) {

        // check errors
        if (!$file || empty($file) || !is_array($file)) {
            $this->errors[] = read_xmls('/site/msg/nofile');
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } elseif (
          strstr($file['type'], '/', false) != '/x-shockwave-flash'
          && strstr($file['type'], '/', false) != '/pdf'
          && strstr($file['type'], '/', true) != 'video'
          && strstr($file['type'], '/', true) != 'audio'
          && strstr($file['type'], '/', false) != '/msword'
          && substr(strstr($file['type'], '/', false),0,5) != '/vnd.'
        ) {

          $this->errors[] = read_xmls('/site/file/msg/notfile');
            return false;
        } else {
            // set object attributs to the form parameters
            $basName = str_replace(" ", "_", basename($file['name']));
            $ext = strstr($basName, '.');
            $this->temp_path = $file['tmp_name'];
            $this->filename = rand(100000,100000000) . $ext;
            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }
    }

    public static function show_flash($id) {
        $path = self::get_file_sys_path($id);
        $path_url = self::get_file($id);
        $size = getimagesize($path);
        $flash = "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' " . $size[3] . " id='movie_name' align='middle'><param name='movie' value='" . $path_url . "'/><!--[if !IE]>--><object type='application/x-shockwave-flash' data='" . $path_url . "' " . $size[3] . "><param name='movie' value='" . $path_url . "'/><!--<![endif]--><a href='http://www.adobe.com/go/getflash'><img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player'/></a><!--[if !IE]>--></object><!--<![endif]--></object>";
        return $flash;
    }

    //upload main file
    private function upload_file($target_path) {
        if (move_uploaded_file($this->temp_path, $target_path)) {
            return true;
        } else {
            return false;
        }
    }

    // do saving (Moving file to spesific location , insert the path to the DB)
    public function save_File() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // title is not longer than 255 chars For DB
            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer255');
                return false;
            } else {
                // to update just title
                return $this->update();
            }
        } else {
            // check required feilds
            if (empty($this->title)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check errors
            if (!empty($this->errors)) {
                return false;
            }
            // title is not longer than 255 chars For DB

            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer255');
                return false;
            }
            // check for filename and tmp location
            if (empty($this->filename) || empty($this->temp_path)) {
                $this->errors[] = read_xmls('/site/file/msg/cantfind');
                return false;
            }
            $target_path = FILE_PATH . DS . $this->upload_dir . DS . $this->filename;
            if (file_exists($target_path)) {
                $this->errors[] = "{$this->filename} " . read_xmls('/site/msg/exists');
                return false;
            }
            // move the file
            if ($this->upload_file($target_path)) {
                //succed and save in DB
                if ($this->create()) {
                    unset($target_path);
                    return true;
                }
            } else {
                // failure
                $this->errors[] = read_xmls('/site/msg/dirper');
                return false;
            }
        }
    }

    // to view the image
    public function file_path() {
        return $this->upload_dir . DS . $this->filename;
    }

    // find just publish id
    public static function find_published_id($id = 0) {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id=" . $database->escape_value($id) . " AND publish='1' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
        echo $result_array;
    }

    //get image path by image id accourding to its type (larg or small)
    public static function get_file($id, $nopic = "no_pic.jpg") {
        if (isset($id)) {
            // if record exists
            if (self::find_published_id($id)) {
                $file = self::find_published_id($id);
                return get_relative_link() . $file->file_path();
            } else {
                return get_relative_link() . 'images' . DS . $nopic;
            }
        } else {
            return get_relative_link() . 'images' . DS . $nopic;
        }
    }

    // determine the file size in bytes, kb or mb
    public function size_as_text() {
        if ($this->size < 1024) {
            return "{$this->size} bytes";
        } else if ($this->size < 1048576) {
            $kb_size = round($this->size / 1024);
            return "{$kb_size} kb";
        } else {
            $mb_size = round($this->size / 1048576);
            return "{$mb_size} mb";
        }
    }

    public function remove_files() {
        $target_path = FILE_PATH . DS . $this->file_path();
        // Delete the file
        if (unlink($target_path)) {
            return true;
        } else {
            return false;
        }
    }

    public function destroy() {
        // Remove the database entry
        if ($this->delete() && $this->remove_files()) {
            return true;
        } else {
            return false;
        }
    }

}

?>