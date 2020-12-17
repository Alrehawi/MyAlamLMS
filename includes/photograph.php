<?php

class Photographs extends DatabaseObject {

    public static $table_name = "photographs";
    protected static $db_fields = array('id', 'filename', 'type', 'size', 'caption', 'parent_type', 'sort_id', 'publish','site_id');
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
    public $parent_type;
    public $sort_id;
    public $publish;
    public $site_id;
    public $max_width;
    public $max_height;
    public $max_width_thumb;
    public $max_height_thumb;
    private $temp_path;
    protected $upload_dir = "photos";
    protected $upload_dir_thumb = "thumb";
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
            $this->errors[] = read_xmls('/site/photos/msg/nofile');
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } elseif (strstr($file['type'], '/', true) != 'image') {
            $this->errors[] = read_xmls('/site/photos/msg/notphoto');
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

    private function scale_image($file, $max_width, $max_height) {
        if ($file && $max_width && $max_height) {
            list($width, $height, $image_type) = getimagesize($file);

            switch ($image_type) {
                case 1: $src = imagecreatefromgif($file);
                    break;
                case 2: $src = imagecreatefromjpeg($file);
                    break;
                case 3: $src = imagecreatefrompng($file);
                    break;
                default: return '';
                    break;
            }

            $x_ratio = $max_width / $width;
            $y_ratio = $max_height / $height;

            if (($width <= $max_width) && ($height <= $max_height)) {
                $tn_width = $width;
                $tn_height = $height;
            } elseif (($x_ratio * $height) < $max_height) {
                $tn_height = ceil($x_ratio * $height);
                $tn_width = $max_width;
            } else {
                $tn_width = ceil($y_ratio * $width);
                $tn_height = $max_height;
            }

            $tmp = imagecreatetruecolor($tn_width, $tn_height);

            /* Check if this image is PNG or GIF, then set if Transparent */
            if (($image_type == 1) OR ( $image_type == 3)) {
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);
                $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
                imagefilledrectangle($tmp, 0, 0, $tn_width, $tn_height, $transparent);
            }
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
            switch ($image_type) {
                case 1: imagegif($tmp, $file);
                    break;
                case 2: imagejpeg($tmp, $file);
                    break;
                case 3: imagepng($tmp, $file);
                    break;
            }
            ob_start();

            switch ($image_type) {
                case 1: imagegif($tmp);
                    break;
                case 2: imagejpeg($tmp, NULL, 100);
                    break; // best quality
                case 3: imagepng($tmp, NULL, 0);
                    break; // no compression
                default: echo '';
                    break;
            }
            $final_image = ob_get_contents();
            ob_end_clean();
            return $final_image;
        } else {
            return $file;
        }
    }

    //upload main photo
    private function upload_file($target_path) {
        if (move_uploaded_file($this->temp_path, $target_path) &&
                $this->scale_image($target_path, $this->max_width, $this->max_height)) {
            return true;
        } else {
            return false;
        }
    }

    //upload thumb
    private function upload_thumb($target_path, $target_path_thumb) {
        if (copy($target_path, $target_path_thumb) && $this->scale_image($target_path_thumb, $this->max_width_thumb, $this->max_height_thumb)) {
            return true;
        } else {
            return false;
        }
    }

    // do saving (Moving file to spesific location , insert the path to the DB)
    public function save_photo() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->caption)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // caption is not longer than 255 chars For DB
            if (strlen($this->caption) >= 255) {
                $this->errors[] = read_xmls('/site/photos/msg/longer255');
                return false;
            } else {
                // to update just caption
                return $this->update();
            }
        } else {
            // check required feilds
            if (empty($this->caption)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check errors
            if (!empty($this->errors)) {
                return false;
            }
            // caption is not longer than 255 chars For DB

            if (strlen($this->caption) >= 255) {
                $this->errors[] = read_xmls('/site/photos/msg/longer255');
                return false;
            }
            // check for filename and tmp location
            if (empty($this->filename) || empty($this->temp_path)) {
                $this->errors[] = read_xmls('/site/photos/msg/cantfind');
                return false;
            }
            $target_path = FILE_PATH . DS . $this->upload_dir . DS . $this->filename;
            $target_path_thumb = FILE_PATH . DS . $this->upload_dir . DS . $this->upload_dir_thumb . DS . $this->filename;
            if (file_exists($target_path)) {
                $this->errors[] = "{$this->filename} " . read_xmls('/site/photos/msg/exists');
                return false;
            }
            // move the file
            if ($this->upload_file($target_path) && $this->upload_thumb($target_path, $target_path_thumb)) {
                //succed and save in DB
                if ($this->create()) {
                    unset($target_path);
                    unset($target_path_thumb);
                    return true;
                }
            } else {
                // failure
                $this->errors[] = read_xmls('/site/photos/msg/dirper');
                return false;
            }
        }
    }

    // to view the image
    public function image_path() {
        return $this->upload_dir . DS . $this->filename;
    }

    // to view the thumb
    public function image_path_thumb() {
        return $this->upload_dir . DS . $this->upload_dir_thumb . DS . $this->filename;
    }

    //get image path by image id accourding to its type (larg or small)
    public static function get_image($id, $type = "small", $nopic = "no_pic.jpg") {
        if (isset($id)) {
            // if record exists
            if (self::find_published_id($id)) {
                $photo = self::find_published_id($id);
                if ($type == "small") {
                    return get_relative_link() . $photo->image_path_thumb();
                } else {
                    return get_relative_link() . $photo->image_path();
                }
            } else {
                return get_relative_link() . 'images' . DS . $nopic;
            }
        } else {
            return get_relative_link() . 'images' . DS . $nopic;
        }
    }

    // find just publish id
    public static function find_published_id($id = 0) {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id=" . $database->escape_value($id) . " AND publish='1' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
        echo $result_array;
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

    public function comments() {
        return Comment::find_comments_on($this->id);
    }

    public function remove_photos() {
        $target_path = FILE_PATH . DS . $this->image_path();
        $target_path_thumb = FILE_PATH . DS . $this->image_path_thumb();
        // Delete the file
        if (unlink($target_path) && unlink($target_path_thumb)) {
            return true;
        } else {
            return false;
        }
    }

    public function destroy() {
        // Remove the database entry
        if ($this->delete() && $this->remove_photos()) {
            return true;
        } else {
            return false;
        }
    }

}

?>
