<?php
// error_reporting(0);
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";
if (isset($_SESSION['zoool']) ){
    $myun = $userinfo['_enuniversity'];
    $mycol = $userinfo['_encollege'];
    $mysec = $userinfo['_ensection'];
    $mybach = $userinfo['_batch'];
    $mycer = $userinfo['Certificate_type'];
    $myid = $userinfo['_id'];
}


if (isset($_SESSION['zoool']) && isset($_GET['order'])) {
    if ($_GET['order'] == 'show') {

        $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_notices`
         WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_batch` = '$mybach' && `_bclar` = '$mycer' && `_monid` != '$myid' &&`_myid` != '$myid'");
        $stmtremon_choose_ver->execute();
        $me_verinfo = $stmtremon_choose_ver->fetch();
        $cont = $stmtremon_choose_ver->rowCount();

        if ($cont > 0) {

?>
            <span class="badge badge-warning"><?php echo $cont ?></span>
        <?php

        }
    } elseif ($_GET['order'] == 'load') {

        $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_notices`
        WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_batch` = '$mybach' && `_bclar` = '$mycer' && `_monid` != '$myid' &&`_myid` != '$myid'
        ORDER BY `_id` DESC LIMIT 20");
        $stmtremon_choose_ver->execute();
        $me_verinfo = $stmtremon_choose_ver->fetchAll();
        $cont = $stmtremon_choose_ver->rowCount();
        if ($cont == 0) {
            $stmtnewpost = $con->prepare("INSERT INTO `mon_notices` (`_id`, `_un`, `_col`, `_sec`, `_batch`, `_bclar`, `_not_type`,`_not_type_en`, `_postid`, `_monid`, `_myid`, `_link`) 
            VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', 'منشور منسق','coordinator Post', '$row[_postid]', '$row[_monid]', '$myid','monasig');");
            $stmtnewpost->execute();
        }

        foreach ($me_verinfo as $row) {

            $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_notices`
            WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_batch` = '$mybach' && `_bclar` = '$mycer'
            && `_postid` = '$row[_postid]' && `_monid` != '$row[_monid]' && `_myid` = '$myid' ");
            $stmtremon_choose_ver->execute();
            $cont = $stmtremon_choose_ver->rowCount();





            $stmtremon_choose = $con->prepare("SELECT * FROM `users` WHERE `_id` = '$row[_monid]'");
            $stmtremon_choose->execute();
            $me_verinfo = $stmtremon_choose->fetch();
        ?>
            <a class="dropdown-item" href="<?php echo $row['_link'] ?>">
                <?php echo lang("أضاف", "") . ' ' . substr($me_verinfo['_name'], 20) . ' ';
                echo lang($row['_not_type'], $row['_not_type_en']) ?>
            </a>

<?php

        }
    }
}
?>