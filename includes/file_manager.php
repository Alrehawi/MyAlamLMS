<?php

class FileManager {

    public $separator;
    private $aPlainText = array('as', 'asp', 'aspx', 'atom', 'bat', 'cfm', 'cmd', 'hta', 'htm', 'html', 'js', 'jsp', 'java', 'mht', 'php', 'pl', 'py', 'rb', 'rss', 'sh', 'txt', 'xhtml', 'xml', 'log', 'out', 'ini', 'shtml', 'xsl', 'xslt', 'backup');
    private $aImageType = array('bm', 'bmp', 'ras', 'rast', 'fif', 'flo', 'turbot', 'g3', 'gif', 'ief', 'iefs', 'jfif', 'jfif-tbnl', 'jpe', 'jpeg', 'jpg', 'jut', 'nap', 'naplps', 'pic', 'pict', 'jfif', 'jpe', 'jpeg', 'jpg', 'png', 'x-png', 'tif', 'tiff', 'mcf', 'dwg', 'dxf', 'svf', 'fpx', 'fpx', 'rf', 'rp', 'wbmp', 'xif', 'xbm', 'ras', 'dwg', 'dxf', 'svf', 'ico', 'art', 'jps', 'nif', 'niff', 'pcx', 'pct', 'xpm', 'pnm', 'pbm', 'pgm', 'pgm', 'ppm', 'qif', 'qti', 'qtif', 'rgb', 'tif', 'tiff', 'bmp', 'xbm', 'xbm', 'pm', 'xpm', 'xwd', 'xwd', 'mov');

    public function __construct() {
        $this->separator = DSO;
    }

    public function downloadFile($file) {
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Type: application/octet-stream');
        readfile($file);
    }

    public function fileName($file, $dir) {
        global $session;
        if (filetype($dir . $file) != "dir") {
            $sLink = "<a href=\"./?view=" . encoding($dir . $file) . "&dir=" . encoding($dir) . "\">" . $file . "</a>";
        } else {
            $aCurrentPath = explode($this->separator, $dir);
            $iCount = (count($aCurrentPath) - 2);
            $sFullPath = "";
            for ($i = 0; $i < $iCount; ++$i) {
                $sFullPath .= $aCurrentPath[$i] . $this->separator;
            }

            if ($file == '.') {
                $sLink = "<a href=\"./?dir=" . $this->separator . "\">[ " . $this->separator . " ]</a>";
            } elseif ($file == '..') {
                $sLink = "<a href=\"./?dir=" . encoding($sFullPath) . "\">[ " . $this->separator . " " . $this->separator . " ]</a>";
            } else {
                $sLink = "<a href=\"./?dir=" . encoding($dir . $file) . "\">" . $file . "</a>";
            }
        }
        return @$sLink;
    }

    public function showDownload($file, $dir = "") {
        global $session;
        if (filetype($dir . $file) != "dir" && $session->has_permission('FileManagerDownload')) {
            return "<a href=\"./?dwl=" . encoding($dir . $file) . "&dir=" . encoding($dir) . "\">" . read_xmls('/site/filemanager/labels/download') . "</a>";
        } else {
            return '';
        }
    }

    public function showEdit($file, $dir) {
        global $session;
        $sLink = "";
        if (filetype($dir . $file) != "dir") {
            $sExt = strtolower(substr(strrchr($file, '.'), 1));
            if ($sExt == 'zip') {
                $sLink = "<a href='./?extract=" . encoding($dir . $file) . "&dir=" . encoding($dir) . "'>" . read_xmls('/site/filemanager/labels/extract') . "</a>";
            } else {
                $sLink = "<a href='./?edit=" . encoding($dir . $file) . "&dir=" . encoding($dir) . "' target=\"_new\">" . read_xmls('/site/filemanager/titles/edit') . "</a>";
            }
        }
        return $sLink;
    }

    public function showFileSize($file, $dir, $precision = 2) {
        if (@filetype($dir . $file) != "dir") {
            return $this->formatSize(@filesize($dir . $file));
        } else {
            return "Dir";
        }
    }

    private function formatSize($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function dateFormat($iTimestamp) {
        //return date("F j, Y, g:i a", $iTimestamp);
        return strftime("%d\%m\%Y -  %H:%M:%S", $iTimestamp);
    }

    public function delete_directory($dirname) {
        global $session, $dir;
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . DS . $file))
                    if (@unlink($dirname . DS . $file)) {
                        $session->message(read_xmls('/site/filemanager/msg/delsuc') . " " . $dirname . "\" .");
                    } else {
                        $session->message(read_xmls('/site/filemanager/msg/cantdel') . " " . $dirname . "\" .");
                    } else
                    $this->delete_directory($dirname . DS . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    public function viewFile($file) {
        global $dir, $session;
        //echo $file;exit;
        $sBaseName = basename($file);

        $sExt = strtolower(substr(strrchr($sBaseName, '.'), 1));
        if ($sExt == "zip") {
            $oZip = new ZipArchive;
            if ($oZip->open($file) === TRUE) {
                echo "<a href='./'><< " . read_xmls('/site/filemanager/labels/back') . "</a><br /><br /><table cellspacing=\"1px\" cellpadding=\"0px\">";
                echo "<tr><th>" . read_xmls('/site/filemanager/labels/name') . "</th><th>" . read_xmls('/site/filemanager/labels/uncomsize') . "</th><th>" . read_xmls('/site/filemanager/labels/comsize') . "</th><th>" . read_xmls('/site/filemanager/labels/comratio') . "</th><th>" . read_xmls('/site/filemanager/labels/date') . "</th></tr>";
                $iTotalPercent = 0;
                for ($i = 0; $i < $oZip->numFiles; $i++) {
                    $aZipDtls = $oZip->statIndex($i);
                    $iPercent = round($aZipDtls['comp_size'] * 100 / $aZipDtls['size']);
                    $iUncompressedSize = $aZipDtls['size'];
                    $iCompressedSize = $aZipDtls['comp_size'];
                    $iTotalPercent += $iPercent;
                    echo "<tr><td>" . $aZipDtls['name'] . "</td><td>" . $this->formatSize($iUncompressedSize) . "</td><td>" . $this->formatSize($iCompressedSize) . "</td><td>" . $iPercent . "%</td><td>" . $this->dateFormat($aZipDtls['mtime']) . "</td></tr>";
                }
                echo "</table>";
                echo "<p align=\"center\"><b>" . $this->showFileSize($file, @$dir) . " " . read_xmls('/site/filemanager/labels/comratio') . " " . $oZip->numFiles . " " . read_xmls('/site/filemanager/labels/filein') . " " . basename($oZip->filename) . ". " . read_xmls('/site/filemanager/labels/comratio') . ": " . round($iTotalPercent / $oZip->numFiles) . "%</b></p>";
                $oZip->close();
            } else {
                $session->message(read_xmls('/site/filemanager/msg/failed'));
                redirect_to('./?dir=' . encoding($dir));
            }
        } elseif (in_array(strtolower($sExt), $this->aPlainText)) {
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File View');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: inline; filename=' . basename($file));
            header('Content-Type: text/plain');
            ob_clean();
            flush();
            readfile($file);
        } elseif (in_array(strtolower($sExt), $this->aImageType)) {
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File View');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: inline; filename=' . basename($file));
            header('Content-Type: image/jpg');
            ob_clean();
            flush();
            readfile($file);
        } else {
            $this->downloadFile($file);
        }
    }

    public function deleteFiles($aFiles) {
        global $dir, $session;
        if (is_array($aFiles)) {
            foreach ($aFiles as $aFilesNames) {
                if (is_dir($dir . $aFilesNames)) {
                    $this->delete_directory($dir . $aFilesNames);
                    $session->message(read_xmls('/site/filemanager/msg/delsuc') . " " . $dir . $aFilesNames . "\" .");
                } else {
                    if (@unlink($dir . $aFilesNames)) {
                        $session->message(read_xmls('/site/filemanager/msg/delsuc') . " " . $dir . $aFilesNames . "\" .");
                    } else {
                        $session->message(read_xmls('/site/filemanager/msg/cantdel') . " " . $dir . $aFilesNames . "\" .");
                    }
                }
            }
            redirect_to('./?dir=' . encoding($dir));
        }
    }

    public function createFile($dir, $sCreatefile) {
        global $session;
        if (!file_exists($dir . $sCreatefile)) {
            if (is_writable($dir)) {
                $handle = fopen($dir . $sCreatefile, "w");
                fclose($handle);
                $session->message(read_xmls('/site/filemanager/msg/createsuc') . " " . $sCreatefile . " .");
                redirect_to('./?dir=' . encoding($dir));
            } else {
                $session->message(read_xmls('/site/filemanager/msg/cantcreate') . " " . read_xmls('/site/filemanager/msg/dirnotwritable') . ".");
                redirect_to('./?dir=' . encoding($dir));
            }
        } else {
            $session->message($sCreatefile . " " . read_xmls('/site/filemanager/msg/fileexists') . ".");
            redirect_to('./?dir=' . encoding($dir));
        }
    }

    private function writeBackup($sFileName) {
        if (!copy($sFileName, $sFileName . ".backup")) {
            return false;
        }
        return true;
    }

    public function fileWriter($sFile, $string, $backup = false) {
        if ($backup) {
            $this->writeBackup($sFile);
        }
        $fp = fopen($sFile, "w");
        //Writing to a network stream may end before the whole string is written. Return value of fwrite() is checked
        for ($written = 0; $written < strlen($string); $written += $fwrite) {
            $fwrite = fwrite($fp, substr($string, $written));
            if (!$fwrite) {
                return $fwrite;
            }
        }
        fclose($fp);
        return $written;
    }

    public function createDirectory($dir, $sCreatefile) {
        global $session;
        if (!is_dir($dir . $sCreatefile)) {
            mkdir($dir . $sCreatefile, 0755);
            $session->message(read_xmls('/site/filemanager/msg/createsuc') . " " . $dir . " .");
            redirect_to('./?dir=' . encoding($dir));
        } else {
            $session->message($sCreatefile . " " . read_xmls('/site/filemanager/msg/direxist') . ".");
            redirect_to('./?dir=' . encoding($dir));
        }
    }

    public function extract($sExtract) {
        global $dir, $session;
        $session->check_permission('FileManagerExtract', './');
        $path_parts = pathinfo($sExtract);
        if (is_writable($path_parts['dirname'])) {
            $zip = new ZipArchive;
            if ($zip->open($sExtract) === TRUE) {
                $zip->extractTo($path_parts['dirname']);
                $zip->close();
                $session->message(read_xmls('/site/filemanager/msg/ok'));
                redirect_to('./?dir=' . encoding($dir));
            } else {
                $session->message(read_xmls('/site/filemanager/msg/failed'));
                redirect_to('./?dir=' . encoding($dir));
            }
        } else {
            $session->message("\"" . $path_parts['dirname'] . " " . read_xmls('/site/filemanager/msg/dirnotwritable') . ".");
            redirect_to('./?dir=' . encoding($dir));
        }
    }

    public function uploadFile($dir, $sFileName) {
        global $session;
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $dir . $sFileName)) {
            $session->message($sFileName . " " . read_xmls('/site/filemanager/msg/uploaded'));
            redirect_to('./?dir=' . encoding($dir));
        } else {
            $session->message($sFileName . " " . read_xmls('/site/filemanager/msg/uploaderror'));
            redirect_to('./?dir=' . encoding($dir));
        }
    }

    public function getCurrentDir($dir) {
        $aCurrentPath = explode($this->separator, $dir);
        $iCount = (count($aCurrentPath) - 1);
        $sFullPath = "";
        for ($i = 0; $i < $iCount; ++$i) {
            $sFullPath .= $aCurrentPath[$i] . $this->separator;
            echo "<a href=\"./?dir=" . encoding($sFullPath) . "\"><strong>" . $aCurrentPath[$i] . "<strong></a>" . $this->separator;
        }
    }

    public function readContent($sEdit, &$contents = null) {
        if (file_exists($sEdit)) {
            $handle = fopen($sEdit, "r");
            if ($handle) {
                while (!feof($handle)) {
                    $contents .= fgets($handle, 4096);
                }
                fclose($handle);
            }
        }
    }

}

?>