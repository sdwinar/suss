<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";
error_reporting(0);

if ((isset($_SESSION['zoool'])) && isset($_POST['sendlecfile'])) {



    if (isset($_FILES['uplodfile'])) {

        $mybatch = $batch_of_me;

        $name = mksave($_POST['file']);
        $subject = mksave($_POST['subject']);
        $semester = mksave($_POST['semester']);
        $filetype = mksave($_POST['filetype']);


        $imgname = $_FILES['uplodfile']['name'];
        $imgtype = $_FILES['uplodfile']['type'];
        $imgtemp = $_FILES['uplodfile']['tmp_name'];
        $imgsize = $_FILES['uplodfile']['size'];
        $imgerorr = $_FILES['uplodfile']['error'];

        $img_array = array('ppt', 'docx', 'doc', 'pdf', 'pptx');
        $img_extenstion = strtolower(end(explode('.', $imgname)));

        if ($imgerorr == 4) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار ملف", "<strong>Sorry !!</strong> ...You have not selected an file"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif (!in_array($img_extenstion, $img_array)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    الرجاء تحديد ملف بإمتداد صحيح", "<strong>Sorry !!</strong> ...Please select an file with a valid extension"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif ($imgsize > 10500000) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    حجم الملف يذيد عن 10 ميغابايت", "<strong>Sorry !!</strong> ...The size of the images is over 2 MB"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif (empty($name) || empty($subject) || empty($semester)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...     الرجاء تحديد إسم الملف والمادة والسمستر", "<strong>Sorry !!</strong> ...Please specify the file name, the material, and the semester"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else {

            $stmtday1 = $con->prepare("SELECT * FROM `library`  WHERE `_name` = '$name' && `_subject` = '$subject' && `_semester` = '$semester' && `_mybatch` = '$batch_of_me'");
            $stmtday1->execute(array());
            $daycont1 = $stmtday1->rowCount();
            if ($daycont1 != 0) {

                echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong> عفوا!</strong> ...     يوجد ملف سابق بنفس معلومات هذا الملف", "<strong>Sorry !!</strong> ...There is a previous file with the same information as this file"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                exit();
            } else {
                $target_path = "../../media/file/library/";
                $datenow = date("dmy");
                $horsnow = date("his");
                $target_path = $target_path . basename($_SESSION['zoool'] . $datenow . $horsnow . $imgname);
                move_uploaded_file($imgtemp, $target_path);
                $newnemm = $_SESSION['zoool'] . $datenow . $horsnow . $imgname;

                $stmteditimgpro1 = $con->prepare("INSERT INTO `library` 
                (`_id`, `_name`, `_subject`, `_semester`, `_type`, `_path`, `_monid`, `_mybatch`, `_arun`, `_enun`, `_arsec`, `_ensec`, `_batch`) VALUES 
                (NULL, '$name', '$subject', '$semester', '$filetype', '$newnemm', '$myid', '$batch_of_me', '$myunar', '$myun', '$mysecar', '$mysec', '$mybach');");
                $stmteditimgpro1->execute();

                //ارسال الاشعار
                $stmtremon_choose_ver = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch'  ORDER BY `_id` DESC LIMIT 1");
                $stmtremon_choose_ver->execute();
                $me_verinfo = $stmtremon_choose_ver->fetch();
                $postid = $me_verinfo['_id'];

                $stmtnewpost = $con->prepare("INSERT INTO `mon_notices` (`_id`, `_un`, `_col`, `_sec`, `_batch`, `_bclar`, `_not_type`,`_not_type_en`, `_postid`, `_monid`, `_myid`, `_link`) 
                                    VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', 'ملف جديد للمكتبة','a new file to the library', '$postid', '$myid', '','library');");
                $stmtnewpost->execute();

                echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong> تم!</strong> ...     رفع الملف بنجاح", "<strong>Done !!</strong> ...The file has been successfully uploaded"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                exit();
            }
        }
    } else { //isset $_FILES'uplodfile'
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> عفوا!</strong> ...    لم تقم بإختيار ملف", "<strong>Sorry !!</strong> ...You have not selected an file"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }


        ?>





<?php
} //isset$_SESSION['zoool']
// <!-- // ******************************تضمين فديو******************************************************** -->
elseif ((isset($_SESSION['zoool'])) && isset($_POST['sendlecvideo'])) {

    $mybatch = $batch_of_me;

    $name = mksave($_POST['film']);
    $subject = mksave($_POST['subject']);
    $semester = mksave($_POST['semester']);
    $videourl = mksave($_POST['url']);

    if (empty($name) || empty($subject) || empty($semester) || empty($videourl)) {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
    <?php echo lang("<strong> عفوا!</strong> ...     الرجاء تحديد إسم الفديو والمادة والسمستر وعنوان URL المقطع", "<strong>Sorry !!</strong> ... Please specify the name of the video, the subject, the semester, and the URL of the clip"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    } else {


        $stmtday1 = $con->prepare("SELECT * FROM `library`  WHERE `_name` = '$name' && `_subject` = '$subject' && `_semester` = '$semester' && `_mybatch` = '$batch_of_me' ");
        $stmtday1->execute(array());
        $daycont1 = $stmtday1->rowCount();
        if ($daycont1 != 0) {

            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> عفوا!</strong> ...     يوجد فديو سابق بنفس معلومات هذا الفديو", "<strong>Sorry !!</strong> ...There is a previous video with the same information as this video"); ?>
            <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else {
            $stmteditimgpro1 = $con->prepare("INSERT INTO `library` 
            (`_id`, `_name`, `_subject`, `_semester`, `_type`, `_path`, `_monid`, `_mybatch`, `_arun`, `_enun`, `_arsec`, `_ensec`, `_batch`) VALUES 
            (NULL, '$name', '$subject', '$semester', 'video', '$videourl', '$myid', '$batch_of_me', '$myunar', '$myun', '$mysecar', '$mysec', '$mybach');");
            $stmteditimgpro1->execute();

            //ارسال الاشعار
            $stmtremon_choose_ver = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch'  ORDER BY `_id` DESC LIMIT 1");
            $stmtremon_choose_ver->execute();
            $me_verinfo = $stmtremon_choose_ver->fetch();
            $postid = $me_verinfo['_id'];

            $stmtnewpost = $con->prepare("INSERT INTO `mon_notices` (`_id`, `_un`, `_col`, `_sec`, `_batch`, `_bclar`, `_not_type`,`_not_type_en`, `_postid`, `_monid`, `_myid`, `_link`) 
                                VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', 'فديو جديد للمكتبة','a new video to the library', '00', '$myid', '','library');");
            $stmtnewpost->execute();

            echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> تم!</strong> ...     تضمين الفديو بنجاح", "<strong>Done !!</strong> ...Video embedded successfully"); ?>
            <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }
    }
}

            ?>