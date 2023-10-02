<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";
error_reporting(0);
if (isset($_POST['reqsend'])) {
    if (isset($_FILES['frontimg'])&&isset($_FILES['backimg'])) {//صورة الواجهة الامامية

        $imgname = $_FILES['frontimg']['name'];
        $imgtype = $_FILES['frontimg']['type'];
        $imgtemp = $_FILES['frontimg']['tmp_name'];
        $imgsize = $_FILES['frontimg']['size'];
        $imgerorr = $_FILES['frontimg']['error'];

        $imgname2 = $_FILES['backimg']['name'];
        $imgtype2 = $_FILES['backimg']['type'];
        $imgtemp2 = $_FILES['backimg']['tmp_name'];
        $imgsize2 = $_FILES['backimg']['size'];
        $imgerorr2 = $_FILES['backimg']['error'];

        $img_array = array('jpg', 'gif', 'jpeg', 'png');
        $img_extenstion = strtolower(end(explode('.', $imgname)));
        $img_extenstion2 = strtolower(end(explode('.', $imgname2)));

        if ($imgerorr == 4 || $imgerorr2 == 4) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار صورة", "<strong>Sorry !!</strong> ...You have not selected an image"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif (!in_array($img_extenstion, $img_array) || !in_array($img_extenstion2, $img_array)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    الرجاء تحديد صورة بإمتداد صحيح", "<strong>Sorry !!</strong> ...Please select an image with a valid extension"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif ($imgsize > 2500000||$imgsize2 > 2500000) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    حجم الصور يذيد عن 2 ميغابايت", "<strong>Sorry !!</strong> ...The size of the images is over 2 MB"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }else{
            $target_path = "../../media/img/users/reqver/";
            $datenow = date("dmy");
            $horsnow = date("his");
            $target_path1 = $target_path . basename($_SESSION['zoool'] . $datenow . $horsnow . $imgname);
            move_uploaded_file($imgtemp, $target_path1);
            $target_path2 = $target_path . basename($_SESSION['zoool'] . $datenow . $horsnow . $imgname2);
            move_uploaded_file($imgtemp2, $target_path2);

            $stmtlog = $con->prepare("SELECT * FROM `req_ver` WHERE	`_userid` = $_SESSION[zoool]");
            $stmtlog->execute();
            $conts = $stmtlog->rowCount();
            $userinfoprofileinfo = $stmtlog->fetch();

            $picuser = $_SESSION['zoool'] .  $datenow . $horsnow . $imgname;
            $picuser2 = $_SESSION['zoool'] .  $datenow . $horsnow . $imgname2;

            
            if ($conts > 0) {

                $req_num = $userinfoprofileinfo['_numofsend'];
                $req_num = $req_num+1;
                if($req_num>=6){
                    echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                    <?php echo lang("<strong> عفوا!</strong> ...    لقد اكملت كل طلبات التفعيل المتاحة ، الرجاء الانتظار للرد عليك", "<strong>Sorry !!</strong> ...You have completed all available activation requests, please wait for our response"); ?>
                    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                        exit();
                }else{
                    $file1 = stripslashes($userinfoprofileinfo['_frontimg']);
                    $file2 = stripslashes($userinfoprofileinfo['_backimg']);
                    $folder_path1 = "../../media/img/users/reqver/$file1";
                    $folder_path2 = "../../media/img/users/reqver/$file2";
                    unlink($folder_path1) or die("Failed to <strong class='highlight'>delete</strong> file");
                    unlink($folder_path2) or die("Failed to <strong class='highlight'>delete</strong> file");

                    $stmteditimgpro = $con->prepare("UPDATE `req_ver`  SET `_frontimg` = '$picuser',
                     `_backimg` = '$picuser2', `_numofsend` = '$req_num',`_reqdate` = CURRENT_TIMESTAMP
                     WHERE `_userid` = '$_SESSION[zoool]'");
                    $stmteditimgpro->execute();
                    echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                    <?php echo lang("<strong> تم!</strong> ...    إرسال طلبك بنجاح الرجاء الانتظار للرد عليك قريبا", "<strong>Done !!</strong> ...Your request has been sent successfully. Please wait for a response to you soon"); ?>
                    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                        exit();

                }


        
            } else {
                $stmteditimgpro = $con->prepare("INSERT INTO `req_ver` (`_id`, `_userid`, `_frontimg`, `_backimg`, `_adminid`, `_adminmasage`, `_numofsend`, `_reqdate`)
                 VALUES (NULL, '$_SESSION[zoool]', '$picuser', '$picuser2', '', '', '1', CURRENT_TIMESTAMP);");
                $stmteditimgpro->execute();
                echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong> تم!</strong> ...    إرسال طلبك بنجاح الرجاء الانتظار للرد عليك قريبا", "<strong>Done !!</strong> ...Your request has been sent successfully. Please wait for a response to you soon"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                    exit();
            }
        }

    } else {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
    <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار صورة", "<strong>Sorry !!</strong> ...Your Rgested succsessful Plase chek your Email for Active your Acaaunt"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }
}
?>