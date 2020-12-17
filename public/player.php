<div style="width:800px;text-align: center;">

    <?php
    require_once("../includes/initialize.php");
    $path = $_GET['path'];
    $type = $_GET['type'];

    if ($type == 'video') {
        echo '
        <video autoplay="autoplay" controls="controls" autoplay width="600"  ><source src="' . $path . '"></video>
        ';
    } else if ($type == 'audio') {
        echo '
        <audio autoplay="autoplay" controls="controls" autoplay width="600"><source src="' . $path . '"></audio>
        ';
    }
    ?>
</div>
<BR><BR>