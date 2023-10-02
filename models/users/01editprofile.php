<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";
error_reporting(0);

if (isset($_POST['sendavatar'])) {
    if (isset($_FILES['profileavatar'])) {

        $imgname = $_FILES['profileavatar']['name'];
        $imgtype = $_FILES['profileavatar']['type'];
        $imgtemp = $_FILES['profileavatar']['tmp_name'];
        $imgsize = $_FILES['profileavatar']['size'];
        $imgerorr = $_FILES['profileavatar']['error'];
        // $new_name = uniqid('articals',false) .  '.' . $imgname;
        $img_array = array('jpg', 'gif', 'jpeg', 'png');
        $img_extenstion = strtolower(end(explode('.', $imgname)));

        if ($imgerorr == 4) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار صورة", "<strong>Sorry !!</strong> ...You have not selected an image"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif (!in_array($img_extenstion, $img_array)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    الرجاء تحديد صورة بإمتداد صحيح", "<strong>Sorry !!</strong> ...Please select an image with a valid extension"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif ($imgsize > 2500000) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    حجم الصور يذيد عن 2 ميغابايت", "<strong>Sorry !!</strong> ...The size of the images is over 2 MB"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else {

            $target_path = "../../media/img/users/profile/";
            $datenow = date("dmy");
            $horsnow = date("his");
            $target_path = $target_path . basename($_SESSION['zoool'] . $datenow . $horsnow . $imgname);
            move_uploaded_file($imgtemp, $target_path);


            $stmtlog = $con->prepare("SELECT * FROM `profile` WHERE	`_userid` = $_SESSION[zoool]");
            $stmtlog->execute();
            $conts = $stmtlog->rowCount();
            $userinfoprofileinfo = $stmtlog->fetch();

            $picuser = $_SESSION['zoool'] .  $datenow . $horsnow . $imgname;

            if ($conts > 0) {
                if ($userinfoprofileinfo['_img'] != '') {
                    $file = stripslashes($userinfoprofileinfo['_img']);
                    $folder_path = "../../media/img/users/profile/$file";
                    unlink($folder_path) or die("Failed to <strong class='highlight'>delete</strong> file");

                    $stmteditimgpro = $con->prepare("UPDATE `profile`  SET `_img` = '$picuser' WHERE `_userid` = '$_SESSION[zoool]'");
                    $stmteditimgpro->execute();
                    echo 'edit';
                } else {

                    $stmteditimgpro = $con->prepare("UPDATE `profile`  SET `_img` = '$picuser' WHERE `_userid` = '$_SESSION[zoool]'");
                    $stmteditimgpro->execute();
                    echo 'edit';
                }
            } else {
                $stmteditimgpro = $con->prepare("INSERT INTO `profile` (`_id`, `_userid`, `_img`, `_cover`, `_About`) VALUES (NULL, '$_SESSION[zoool]', '$picuser', '', '');");
                $stmteditimgpro->execute();
                echo 'edit';
            }
        }
    } else {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
    <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار صورة", "<strong>Sorry !!</strong> ...Your Rgested succsessful Plase chek your Email for Active your Acaaunt"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }
}
if (isset($_POST['sendcover'])) { // تعديل صورة الغلاف******************************************************************

    if (isset($_FILES['profilecover'])) {

        $imgname = $_FILES['profilecover']['name'];
        $imgtype = $_FILES['profilecover']['type'];
        $imgtemp = $_FILES['profilecover']['tmp_name'];
        $imgsize = $_FILES['profilecover']['size'];
        $imgerorr = $_FILES['profilecover']['error'];
        // $new_name = uniqid('articals',false) .  '.' . $imgname;
        $img_array = array('jpg', 'gif', 'jpeg', 'png');
        $img_extenstion = strtolower(end(explode('.', $imgname)));

        if ($imgerorr == 4) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار صورة", "<strong>Sorry !!</strong> ...You have not selected an image"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif (!in_array($img_extenstion, $img_array)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    الرجاء تحديد صورة بإمتداد صحيح", "<strong>Sorry !!</strong> ...Please select an image with a valid extension"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif ($imgsize > 2500000) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    حجم الصور يذيد عن 2 ميغابايت", "<strong>Sorry !!</strong> ...The size of the images is over 2 MB"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else {

            $target_path = "../../media/img/users/profile/";
            $datenow = date("dmy");
            $horsnow = date("his");
            $target_path = $target_path . basename($_SESSION['zoool'] . $datenow . $horsnow . $imgname);
            move_uploaded_file($imgtemp, $target_path);


            $stmtlog = $con->prepare("SELECT * FROM `profile` WHERE	`_userid` = '$_SESSION[zoool]'");
            $stmtlog->execute();
            $conts = $stmtlog->rowCount();
            $userinfoprofileinfo = $stmtlog->fetch();

            $picuser = $_SESSION['zoool'] .  $datenow . $horsnow . $imgname;

            if ($conts > 0) {
                if ($userinfoprofileinfo['_cover'] != '') {
                    $file = stripslashes($userinfoprofileinfo['_cover']);
                    $folder_path = "../../media/img/users/profile/$file";
                    unlink($folder_path) or die("Failed to <strong class='highlight'>delete</strong> file");

                    $stmteditimgpro = $con->prepare("UPDATE `profile`  SET `_cover` = '$picuser' WHERE `_userid` = '$_SESSION[zoool]'");
                    $stmteditimgpro->execute();
                    echo 'edit';
                } else {

                    $stmteditimgpro = $con->prepare("UPDATE `profile`  SET `_cover` = '$picuser' WHERE `_userid` = '$_SESSION[zoool]'");
                    $stmteditimgpro->execute();
                    echo 'edit';
                }
            } else {
                $stmteditimgpro = $con->prepare("INSERT INTO `profile` (`_id`, `_userid`, `_img`, `_cover`, `_About`) VALUES (NULL, '$_SESSION[zoool]', '', '$picuser', '');");
                $stmteditimgpro->execute();
                echo 'edit';
            }
        }
    } else {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
    <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار صورة", "<strong>Sorry !!</strong> ...Your Rgested succsessful Plase chek your Email for Active your Acaaunt"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }
}
if (isset($_POST['info'])) { // تعديل البيانات ******************************************************************
    $oldpass = mksave($_POST['oldpass']);
    $oldpass = sha1($oldpass . '@%00&#$%@@@@$*');
    if ($oldpass != $userinfo['_password']) {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
    <?php echo lang("<strong> عفوا!</strong> ...    كلمة المرور الحالية غير صحيحة", "<strong>Sorry !!</strong> ...The current password is incorrect"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    } else {
        $name = mksave($_POST['name']);
        $address = mksave($_POST['address']);
        $about = mksave($_POST['about']);
        $newpass = mksave($_POST['newpass']);

        if (empty($name) || empty($address) || empty($about)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> عفوا!</strong> ...    ادخل الاسم مع العنوان والنبذة التعريفية", "<strong>Sorry !!</strong> ...Enter the name with the title and information about you"); ?>
            <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else {
            $stmtlog = $con->prepare("SELECT * FROM `profile` WHERE	`_userid` = '$_SESSION[zoool]'");
            $stmtlog->execute();
            $conts = $stmtlog->rowCount();
            if($conts>0){
                $stmteditimgpro = $con->prepare("UPDATE `profile`  SET `_About` = '$about' WHERE `_userid` = '$_SESSION[zoool]'");
                $stmteditimgpro->execute();
            }else{
                $stmteditimgpro = $con->prepare("INSERT INTO `profile` (`_id`, `_userid`, `_About`) VALUES (NULL, '$_SESSION[zoool]', '$about');");
                $stmteditimgpro->execute();
            }

            if (empty($newpass)) {
                $stmteditimgpr = $con->prepare("UPDATE `users`  SET `_name` = '$name', `_address` = '$address'
                 WHERE `_id` = '$_SESSION[zoool]'");
                $stmteditimgpr->execute();
                echo 'edit';
            } else {
                if (strlen($newpass) < 4) {
                    echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                    <?php echo lang("<strong> عفوا!</strong> ...   كلمة المرور الجديدة يجب ان لا تقل عن 4 خانات", "<strong>Sorry !!</strong> ...Enter the name with the title and information about you"); ?>
                    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                    exit();
                }else{
                    $newpass = sha1($newpass . '@%00&#$%@@@@$*');
                    $stmteditimgpr = $con->prepare("UPDATE `users`  SET `_name` = '$name', `_address` = '$address', `_password` = '$newpass'
                    WHERE `_id` = '$_SESSION[zoool]'");
                   $stmteditimgpr->execute();
                   echo 'edit';

                }
            }
        }
    }
}
            ?>
