<?php

include "../../main/connect.php";
include "../../main/lang.php";
include "../../main/function.php";
error_reporting(0);

if ((isset($_SESSION['zoool'])) && ($userinfo['_admin'] == 'manager' || $userinfo['_admin'] == 'admin')) {
    if (isset($_GET['userid'])) { //جلب بيانات اليوزر لعرضها في المودل
        $userid = $_GET['userid'];
        $stmtshow = $con->prepare("SELECT * FROM `users`  WHERE `_id` = $userid");
        $stmtshow->execute(array());
        $userinfo = $stmtshow->fetch();
        $usercont = $stmtshow->rowCount();

        $name = $userinfo['_name'];
?>
<button style="color: red" type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
<form id="adminuseredit" style="background: none" action="models/cpanel/users/02editusers" method="POST">
<input type="hidden" name="userid" value="<?php echo $userinfo['_id']  ?>">
    <span class="badge badge-success btn-lg"
        style="font-size: 15px;font-weight: 500;padding: 8px;margin-bottom: 5px;"><?php echo $name ?></span>
    <div class="container">
        <div class="row">
            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الـجـامـعـة', 'University') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang($userinfo['_aruniversity'], $userinfo['_enuniversity']) ?></span>

            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الـكـلــية', 'College') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang($userinfo['_arcollege'], $userinfo['_encollege']) ?></span>


            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الـقـســم', 'Section') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang($userinfo['_arsection'], $userinfo['_ensection']) ?></span>

            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('تـاريـخ الـتـسـجـيـل', 'Registration Date') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo $userinfo['_regdate'] ?> </span>

            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('نوع التسجيل', 'Registration Type') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php $type = $userinfo['_adjective'];
                        if ($type == "student") {
                            echo lang('طـالـبـ', 'Student');
                        } else {
                            echo lang('اسـتـاذ', 'Teacher');
                        }
                        ?></span>
            <?php
                    if ($type == "student") { ?>
            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الـدفـعـة', 'The Batch') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo $userinfo['_batch'] ?></span>

            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الرقم الجامعي', 'Un. Number') ?></span>
            <span class="col-7 badge badge-info btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo $userinfo['_unnum'] ?></span>

                <?php if(!isset($_GET['type'])){//لاتظهر حساب مفعل  في طلب تحقق ?>
            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('مـنـســق', 'Coordinator') ?></span>
            <select class="col-7 badge badge-info btn-lg text-center" name="Coordinator"
                style="font-size: 15px;padding: 8px;margin: 4px;">
                <option value="<?php
                                            echo  $userinfo['_monasig'] == 'no' ?
                                                lang('no', 'no') :  lang('yes', 'yes') ?>">
                    <?php
                                echo  $userinfo['_monasig'] == 'no' ?
                                    lang('لا', 'no') :  lang('نعم', 'yes') ?></option>
                <option value="<?php
                                            echo  $userinfo['_monasig'] == 'no' ?
                                                lang('yes', 'yes') :  lang('no', 'no') ?>">
                    <?php echo $userinfo['_monasig'] == 'no' ?   lang('نعم', 'yes') :  lang('لا', 'no')  ?></option>
            </select>
            <?php                }   }             ?>


            <?php if(!isset($_GET['type'])){//لاتظهر حساب مفعل  في طلب تحقق ?>

            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('حـسـابـ مـفـعـل', 'Active account') ?></span>
            <select  class="col-7 badge badge-info btn-lg text-center" name="active"
                style="font-size: 15px;padding: 8px;margin: 4px;">
                <option value="<?php
                                        echo  $userinfo['_active'] != 'yes' ?
                                            lang('no', 'no') :  lang('yes', 'yes') ?>">
                    <?php
                            echo  $userinfo['_active'] != 'yes' ?
                                lang('لا', 'no') :  lang('نعم', 'yes') ?></option>
                <option value="<?php
                                        echo  $userinfo['_active'] != 'yes' ?
                                            lang('yes', 'yes') :  lang('no', 'no') ?>">
                    <?php echo $userinfo['_active'] != 'yes' ?   lang('نعم', 'yes') :  lang('لا', 'no')  ?></option>
            </select>
            <?php                } 
            
            if(isset($_GET['type']) && $_GET['type']=="rev" ){//إظهار الصور عند عرض طلبات التحقق

                $stmtshowrev = $con->prepare("SELECT * FROM `req_ver`  WHERE `_userid` = $userid");
                $stmtshowrev->execute(array());
                $userinforev = $stmtshowrev->fetch();
                ?>
                 <span class="col-12 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الواجهة الامامية', 'front imge') ?><hr>
                <img src="media/img/users/reqver/<?php echo $userinforev['_frontimg'] ?>" alt="<?php echo lang('لم يتم الارسال','donte send')?>"
                style="    width: 100%;    height: 45vh;" >
                </span>
                <span class="col-12 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الواجهة الخلفية', 'back imge') ?><hr>
                <img src="media/img/users/reqver/<?php echo $userinforev['_backimg'] ?>" alt="<?php echo lang('لم يتم الارسال','donte send')?>"
                style="    width: 100%;    height: 45vh;" >
                </span>
                <span class="col-12 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('رسالة للمستخدم', 'back imge') ?><hr>
          <input type="text" name="adminmsg" id="adminmsg" value="<?php echo $userinforev['_adminmasage']; ?>"   style="
              width: 100%;    background: none;  font-weight: 500;  border: none;    border-bottom: 2px solid;border-radius: 15%;">
            <?php

                  if ($userinforev['_numofsend'] != '') { ?>
                    <hr />
                    <span class="col-12 badge badge-danger"><?php echo lang(
                                                        'عدد المحاولات' . ' ' . $userinforev['_numofsend'] . '/5',
                                                        'عدد المحاولات المتبقية' . $userinforev['_numofsend'] . '/5'
                                                      ) ?></span>
                    <hr />
                 <?php
                  }
  

                  
                
                ?>
            
            <input autofocus autocomplete="off" type="hidden" name="adminid" value="<?php echo $_SESSION['zoool']?>">
                </span>
                <?php
            }//إظهار الصور عند عرض طلبات التحقق

            ?>
                


            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('حـسـابـ مـوثـق', 'Verified account') ?></span>
            <select class="col-7 badge badge-info btn-lg text-center" name="verified"
                style="font-size: 15px;padding: 8px;margin: 4px;">
                <option value="<?php
                                        echo  $userinfo['_verified'] != 'yes' ?
                                            lang('no', 'no') :  lang('yes', 'yes') ?>">
                    <?php
                            echo  $userinfo['_verified'] != 'yes' ?
                                lang('لا', 'no') :  lang('نعم', 'yes') ?></option>
                <option value="<?php
                                        echo  $userinfo['_verified'] != 'yes' ?
                                            lang('yes', 'yes') :  lang('no', 'no') ?>">
                    <?php echo $userinfo['_verified'] != 'yes' ?   lang('نعم', 'yes') :  lang('لا', 'no')  ?></option>
            </select>


            <?php if ($_SESSION['_admin'] == 'manager') { ?>
                <?php if(!isset($_GET['type'])){//لاتظهر حساب مفعل  في طلب تحقق ?>

            <span class="col-4 badge badge-primary btn-lg" style="font-size: 14px;padding: 8px;margin: 4px;">
                <?php echo lang('الادمـــن', 'Admin') ?></span>
            <select class="col-7 badge badge-info btn-lg text-center" name="admin"
                style="font-size: 15px;padding: 8px;margin: 4px;">
                <option value="<?php echo  $userinfo['_admin'] == 'no' ? lang('no', 'no') :  lang('admin', 'admin') ?>">
                    <?php echo  $userinfo['_admin'] == 'no' ? lang('لا', 'no') :  lang('نعم', 'yes') ?></option>
                <option value="<?php echo  $userinfo['_admin'] == 'no' ? lang('admin', 'admin') :  lang('no', 'no') ?>">
                    <?php echo $userinfo['_admin'] == 'no' ?   lang('نعم', 'yes') :  lang('لا', 'no')  ?></option>
            </select>

            <?php }} ?>

            <span id="adminusereditresult" class="col-12 badge" style="font-size: 14px;padding: 8px;margin: 4px;"></span>

            <input style="font-weight: bold;" name="btnadminedituser"
            class="btn btn-light btn-block" type="submit" value="<?php echo lang('تـعــديــل', 'Edit') ?>">


        </div>

    </div>

</form>
<script src="js/fromcpusersshow.js"></script>

<?php
    }elseif(isset($_POST['btnadminedituser'])){

        $Coordinator = isset($_POST['Coordinator'])? $_POST['Coordinator'] :'no';
        $admin = isset($_POST['admin'])? $_POST['admin'] :'no';
        $active = $_POST['active'];
        $verified = $_POST['verified'];
        $userid = $_POST['userid'];
        $adminmsg = $_POST['adminmsg'];
        $adminid = $_POST['adminid'];

        if($active != ''){
            $setuser = $con->prepare("UPDATE `users` SET `_monasig` = '$Coordinator',`_active` ='$active',
            `_verified` = '$verified',`_admin` = '$admin' WHERE `users`.`_id` = '$userid' ");
            $setuser->execute(array());
        }else{

            $setuser = $con->prepare("UPDATE `users` SET `_verified` = '$verified' WHERE `users`.`_id` = '$userid' ");
            $setuser->execute(array());

            $setuseradmin = $con->prepare("UPDATE `req_ver` SET `_adminid` = '$adminid',`_adminmasage` ='$adminmsg',`_verified` = '$verified'
            WHERE `req_ver`.`_userid` = '$userid' ");
           $setuseradmin->execute(array());

        }
            



    

            echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> تم!</strong> ...   تعديل بيانات المستخدم", "<strong> Done!</strong> ...Your Rgested succsessful Plase chek your Email for Active your Acaaunt"); ?>
            <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();        


        
    }
}