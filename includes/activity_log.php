<?php

class ActivityLog extends DatabaseObject {

    public static $table_name = 'activity_log';
    protected static $db_fields = array('id', 'path',  'action', 'msg','created','ip_address','site_id');
    public $id;
    public $path;
    public $action;
    public $msg;
    public $created;
    public $ip_address;
    public $site_id;

    public static $trans_key = 'activity_log';
    public $errors = array();

}

?>
