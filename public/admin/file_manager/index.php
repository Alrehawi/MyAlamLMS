<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
//$session->check_permission('FileManagerView' , '../');
ob_start();
?>
<?php
//New Object
$oBrowser = new FileManager();

$sEdit = decoding(@$_REQUEST['edit']);
$sExtract = decoding(@$_REQUEST['extract']);
$sViewFile = decoding(@$_REQUEST['view']);
$sDownloadFile = decoding(@$_REQUEST['dwl']);

if (@$_POST['dir'] || @$_GET['cmd']) {
    @$dir = $_POST['dir'];
} else {
    //directory url manage
    $dir = decoding(@$_REQUEST['dir']);
    if (!$dir) {
        //$dir = getcwd().$oBrowser->separator;
        //$dir=FILE_PATHDSO.DSO;
        redirect_to('./?dir=' . encoding(FILE_PATHDSO . DSO));
    } else {
        $dir = decoding($_REQUEST['dir']) . $oBrowser->separator;
    }
}
$dir = str_replace($oBrowser->separator . $oBrowser->separator, $oBrowser->separator, $dir);
//file pathes manage
@$sFiles = scandir($dir);
//edit file

if ($sDownloadFile && $session->check_permission('FileManagerDownload', '../')) {
    $oBrowser->downloadFile($sDownloadFile);
    exit;
}
//extract file
if (@$sExtract != "" && $session->check_permission('FileManagerExtract', '../')) {
    $oBrowser->extract($sExtract);
}

//check permission and do actions


if (@$_POST['button'] == read_xmls('/site/filemanager/labels/delete') && $session->check_permission('FileManagerDelete', '../')) {
    $aFiles = @$_POST['chkfiles'];
    $oBrowser->deleteFiles($aFiles);
}

if (@$_POST['button'] == read_xmls('/site/filemanager/labels/createfile') && $session->check_permission('FileManagerCreateFile', '../')) {
    $sCreatefile = trim(@$_POST['createfile']);
    $oBrowser->createFile($dir, $sCreatefile);
}

if (@$_POST['button'] == read_xmls('/site/filemanager/labels/createdir') && $session->check_permission('FileManagerCreateDir', '../')) {

    $oBrowser->createDirectory($dir, trim(@$_POST['createfile']));
}

if (@$_POST['button'] == 'SAVEFILE' && $session->check_permission('FileManagerEdit', '../')) {
    $bBackup = trim(@$_POST['Write_backup']);
    $sFileData = trim(@$_POST['editfile']);
    $oBrowser->fileWriter($sEdit, $sFileData, $bBackup);
}

$sFileName = @$_FILES['myfile']['name'];
if ($sFileName && $session->check_permission('FileManagerUpload', '../')) {
    $oBrowser->uploadFile($dir, $sFileName);
}

//exec command shell
$sSsh_command = trim(@$_POST['ssh_command']);
if ($sSsh_command && $session->check_permission('FileManagerLaunchShell', '../')) {
    $aResult = array();
    exec($sSsh_command, $aResult);
}
?>

<?php
include_layout_template('admin_header.php');
echo get_js('texterea_liner' . DS . 'jquery-linedtextarea.js');
echo get_css('texterea_liner' . DS . 'jquery-linedtextarea.css');
?>

<?php echo output_message($message); ?>


<?php
if ($sViewFile && $session->check_permission('FileManagerView', '../')) {
    $oBrowser->viewFile($sViewFile);
} else if (@$_GET['cmd'] == 'ssh') {
    ?>
    <?php if ($session->check_permission('FileManagerLaunchShell', '../')) { ?>
        <div>
                <!--<a href="<?php //echo get_relative_link(ADMIN.DS.'file_manager') ?>"><< <?php //echo read_xmls('/site/filemanager/labels/back') ?></a><br /><br />-->
            <div>
                <form name="frmSsh" action="?cmd=ssh" method="post">
                    <label><?php echo read_xmls('/site/filemanager/labels/command') ?></label>
                    <input class="form-control" type="text" value="<?php echo stripslashes(@$_POST['ssh']) ?>" name="ssh_command"  size="70"><br>
                    <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/filemanager/labels/go') ?>" class="button"/>
                </form>
            </div>

            <div>
        <?php
        if (is_array(@$aResult)) {
            foreach ($aResult as $resultVal) {
                echo $resultVal . "<br/>";
            }
        }
        ?>
            </div>
        </div>
    <?php } ?>
    <?php
} elseif (@$sEdit != "" && $session->check_permission('FileManagerEdit', '../')) {
    $oBrowser->readContent($sEdit, $contents);
    ?>
    <div>
         <!--<a href="<?php //echo get_relative_link(ADMIN.DS.'file_manager')?>"><< <?php //echo read_xmls('/site/filemanager/labels/back')?></a><br /><br />-->
        <div>
            <form name="frmedit" method="POST" action="">
                <p>
                    <strong><?php echo read_xmls('/site/filemanager/labels/name') ?>: <?php echo basename($sEdit) ?></strong>
                </p>
                <textarea name="editfile" style="height:450px;width:100%" class="lined" dir="ltr"><?php echo ($contents) ?></textarea>
                <p>
                    <input type="text" name="button" value="SAVEFILE" style="display:none"/>
                    <input type="checkbox" name="Write_backup" value="1" id="Write_backup" title="Write backup"/>
                    <label for="Write_backup">
                        <strong><?php echo read_xmls('/site/filemanager/labels/makebackup') ?></strong>
                    </label>
                    <br/>
                </p>
                <p>
                    <input type="submit" name="submit" value="<?php echo read_xmls('/site/filemanager/labels/save') ?>" class="button"/>
                </p>
            </form>
            <script>

                $(function () {

                    $(".lined").linedtextarea(
                            {selectedLine: 1}

                    );

                });

            </script>

        </div>
    </div>
<?php } else { ?>

 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                         <div class="panel-heading">
                           <h2><?php echo read_xmls('/site/filemanager/titles/manage') ?> <?php echo @$site_config->title; ?></h2>

                           <?php if ($session->has_permission('FileManagerLaunchShell')) { ?>
                                <a class="btn btn-primary pull-left" href="?cmd=ssh"><?php echo read_xmls('/site/filemanager/labels/shell') ?></a>
                            <?php } ?>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form action="" method="POST" name="filelist">
                                <input placeholder="Search..." style="width: 40%" name="filt" onKeypress="event.cancelBubble = true;" onkeyup="filter(this)" type="text"><br><br>
                                <table  id="filetable" class="table table-striped table-bordered table-hover filelisting">
                                    <thead>
                                        <tr >
                                            <th></th>
                                            <th><?php echo read_xmls('/site/filemanager/labels/name') ?></th>
                                            <th><?php echo read_xmls('/site/filemanager/labels/size') ?></th>
                                            <th><?php echo read_xmls('/site/filemanager/labels/type') ?></th>
                                            <th><?php echo read_xmls('/site/filemanager/labels/date') ?></th>
                                            <th><?php echo read_xmls('/site/filemanager/labels/download') ?></th>
                                            <th><?php echo read_xmls('/site/filemanager/titles/edit') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                        if (is_array(@$sFiles)) {
                                            foreach ($sFiles as $file) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php if ($file != "." && $file != "..") { ?>
                                                              <input type="checkbox" id="chkfiles[]" name="chkfiles[]" value="<?php echo $file ?>"/>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $oBrowser->fileName($file, $dir); ?></td>
                                                    <td align="center"><?php echo $oBrowser->showFileSize($file, $dir); ?></td>
                                                    <td align="center"><?php echo substr(strrchr($dir . $file, '.'), 1); ?></td>
                                                    <td align="center"><?php $aFileInfo = stat($dir . $file);
                                                     echo $oBrowser->dateFormat($aFileInfo['atime']) ?></td>
                                                    <td align="center"><?php echo $oBrowser->showDownload($file, $dir); ?></td>
                                                    <td align="center"><?php echo $oBrowser->showEdit($file, $dir); ?></td>
                                                </tr>
                                            <?php } } ?>
                                          <tr >
                                            <td colspan="7">
                                                <input type="checkbox" id="selall" name="selall" onClick="selectAll(this.form)">
                                                <label for="selall">
                                                 <?php echo read_xmls('/site/filemanager/labels/selectall') ?>
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                  <p>
                                            <input type="text" name="dir" value="<?php echo $dir; ?>" style="display:none"/>
                                            <?php if ($session->has_permission('FileManagerDelete')) { ?>
                                            <input title="<?php echo read_xmls('/site/filemanager/labels/delete') ?>"  type="submit"onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" name="button" value="<?php echo read_xmls('/site/filemanager/labels/delete') ?>" class="btn btn-danger">
                                            <?php } ?>
                                        </p>
                                            <?php if ($session->has_permission('FileManagerViewCurrentLocation')) { ?>
                                        <p>
                                            <?php echo read_xmls('/site/filemanager/titles/current') ?>: <?php echo $oBrowser->getCurrentDir($dir); ?>
                                        </p>
                                            <?php } ?>
                                        <p>
                                             <?php if ($session->has_permission('FileManagerCreateDir') || $session->has_permission('FileManagerCreateFile')) { ?>
                                                <input class="form-control" type="text" name="createfile"><br>
                                            <?php } ?>
                                            <?php if ($session->has_permission('FileManagerCreateDir')) { ?>
                                                <input title="<?php echo read_xmls('/site/filemanager/labels/createdir') ?>."  type="submit" name="button" value="<?php echo read_xmls('/site/filemanager/labels/createdir') ?>" class="btn btn-success">
                                            <?php } ?>
                                            &nbsp;
                                            <?php if ($session->has_permission('FileManagerCreateFile')) { ?>
                                                <input title="<?php echo read_xmls('/site/filemanager/labels/createfile') ?>."  type="submit" name="button" value="<?php echo read_xmls('/site/filemanager/labels/createfile') ?>" class="btn btn-success">
                                            <?php } ?>
                                        </p>
                                 </form>
                                <?php if ($session->has_permission('FileManagerUpload')) { ?>
                                    <form action="./" method="POST" enctype="multipart/form-data">
                                        <div class="form=group">
                                            <input class="form-control" type="text" name="dir" value="<?php echo $dir; ?>" style="display:none"/>
                                            <input class="form-control" type="file" onKeypress="event.cancelBubble = true;" name="myfile"><br>
                                            <input title="<?php echo read_xmls('/site/filemanager/labels/upload') ?>" type="submit"  name="submit" value="<?php echo read_xmls('/site/filemanager/labels/upload') ?>" class="btn btn-primary"/>
                                        </div>>
                                    </form>
                            <?php } ?>
                        </div>
                   <?php } ?>
                </div>
            </div>
        </div>
    </div>
          
<?php include_layout_template('admin_footer.php'); ?>

