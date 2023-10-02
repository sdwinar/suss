<?php
error_reporting(0);
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

if (isset($_GET['order']) &&$_GET['order'] == 'add' ) {
    $myid = $userinfo['_id'];
    $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_like` WHERE `_postid` = '$_GET[likeid]' && `_userid` = '$myid' ");
    $stmtremon_choose_ver->execute();
    $cominfo = $stmtremon_choose_ver->fetch();
    $islike = $stmtremon_choose_ver->rowCount();

    if($islike==0){//لم يتم الاعجاب من قبل
        $stmtnewpost = $con->prepare("INSERT INTO `mon_like` (`_id`, `_like`, `_postid`, `_userid`) 
        VALUES (NULL, 'yes', '$_GET[likeid]', '$myid');");
        $stmtnewpost->execute();
        echo lang('تم إضافة إعجاب','like added');    

    }else{
        if($cominfo['_like']=='yes'){//تغيير الي لم يعجبني
            $stmtremon_choose_ver = $con->prepare("UPDATE `mon_like` SET `_like`= 'no' WHERE `_postid` = '$_GET[likeid]'  && `_userid` = '$myid' ");
            $stmtremon_choose_ver->execute();
             echo lang('تم إلغاء إعجاب','like Canslet');    
        }else{
            $stmtremon_choose_ver = $con->prepare("UPDATE `mon_like` SET `_like`= 'yes' WHERE `_postid` = '$_GET[likeid]'  && `_userid` = '$myid' ");
            $stmtremon_choose_ver->execute();
            echo lang('تم إضافة إعجاب','like added');    
}
    }

}elseif (isset($_GET['order']) &&$_GET['order'] == 'show' ) {

    $comid = $_GET['comid'];
    $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_like` WHERE `_postid` = '$comid' && `_like`= 'yes'  ORDER BY `_id` DESC");
    $stmtremon_choose_ver->execute();
    $cominfo = $stmtremon_choose_ver->fetchAll();
    $ikars = $stmtremon_choose_ver->rowCount();
    ?>
    <span class="badge badge-warning" style="width: 100%"> <?php echo lang("المــــعـــجــبــيــن","Likers").' '.'('.$ikars.')' ?></span>

<div dir="<?php echo lang("rtl","ltr") ?>" class="alert alert-danger alert-dismissible fade show text-center"
    role="alert" style="font-size: 1rem !important;font-weight: bold !important;">
    <?php

foreach ($cominfo as $row) {
            //تحديد اسم ناشر التعليق
            $stmtremon_choose_ver = $con->prepare("SELECT * FROM `users` WHERE `_id` = $row[_userid] ");
            $stmtremon_choose_ver->execute();
            $likerinfo = $stmtremon_choose_ver->fetch();
            ?>
    <span style="    color: blue;"><?php echo $likerinfo['_name'] ?> </span>
    <hr>
    <?php
    }
?>


</div>
<?php
}
