<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

if ((isset($_SESSION['zoool'])) && isset($_POST['btnlecedit'])) {

    $mybatch = $batch_of_me;

    $stmtsat1 = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = '$_POST[day]' ");
    $stmtsat1->execute(array());
    $daycont1 = $stmtsat1->rowCount();

    if ($daycont1 == 0) {
        $stmtaddlec = $con->prepare("INSERT INTO `lectures`
         (`_id`, `_mybatch`, `_day`, `_lec1`, `_lec1hall`, `_lec1star`, `_lec1end`, `_lec2`, `_lec2hall`, `_lec2star`, `_lec2end`, `_lec3`, `_lec3hall`, `_lec3star`, `_lec3end`, `_lec4`, `_lec4hall`, `_lec4star`, `_lec4end`, `_monasig`) 
         VALUES (NULL, '$mybatch', '$_POST[day]', '$_POST[lec1name]', '$_POST[lec1hall]', '$_POST[lec1star]', '$_POST[lec1end]', '$_POST[lec2name]', '$_POST[lec2hall]', '$_POST[lec2star]', '$_POST[lec2end]', '$_POST[lec3name]', '$_POST[lec3hall]', '$_POST[lec3star]', '$_POST[lec3end]', '$_POST[lec4name]', '$_POST[lec4hall]', '$_POST[lec4star]', '$_POST[lec4end]', '$_SESSION[zoool]');");
        $stmtaddlec->execute();

                    //ارسال الاشعار
                    $stmtremon_choose_ver = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch'  ORDER BY `_id` DESC LIMIT 1");
                    $stmtremon_choose_ver->execute();
                    $me_verinfo = $stmtremon_choose_ver->fetch();
                    $postid = $me_verinfo['_id'];
        
                    $stmtnewpost = $con->prepare("INSERT INTO `mon_notices` (`_id`, `_un`, `_col`, `_sec`, `_batch`, `_bclar`, `_not_type`,`_not_type_en`, `_postid`, `_monid`, `_myid`, `_link`) 
                    VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', 'اضاف محاضرات','Add Lectures', '$postid', '$myid', '','lectures');");
                   $stmtnewpost->execute();

        echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
             <?php echo lang("<strong> تمت!</strong> ...إضافة المحاضرات الي اليوم", "<strong>Done !!</strong> ... Lectures have been added to today"); ?>
             <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    position: relative;
                        top: -43px;"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                exit();
            } else {
                $stmtnewposted1 = $con->prepare("UPDATE `lectures` SET `_lec1` = '$_POST[lec1name]', `_lec1hall` = '$_POST[lec1hall]' , 
        `_lec1star` = '$_POST[lec1star]',`_lec1end` = '$_POST[lec1end]',`_lec2` = '$_POST[lec2name]',`_lec2hall` = '$_POST[lec2hall]',`_lec2star` = '$_POST[lec2star]',`_lec2end` = '$_POST[lec2end]'
        ,`_lec3` = '$_POST[lec3name]',`_lec3hall` = '$_POST[lec3hall]',`_lec3star` = '$_POST[lec3star]',`_lec3end` = '$_POST[lec3end]'
        ,`_lec4` = '$_POST[lec4name]',`_lec4hall` = '$_POST[lec4hall]',`_lec4star` = '$_POST[lec4star]',`_lec4end` = '$_POST[lec4end]', `_monasig`= '$_SESSION[zoool]'
        WHERE `_mybatch` = '$mybatch' && `_day` = '$_POST[day]' ");
                $stmtnewposted1->execute();

                
                    //ارسال الاشعار
                    $stmtremon_choose_ver = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch'  ORDER BY `_id` DESC LIMIT 1");
                    $stmtremon_choose_ver->execute();
                    $me_verinfo = $stmtremon_choose_ver->fetch();
                    $postid = $me_verinfo['_id'];
        
                    $stmtnewpost = $con->prepare("INSERT INTO `mon_notices` (`_id`, `_un`, `_col`, `_sec`, `_batch`, `_bclar`, `_not_type`,`_not_type_en`, `_postid`, `_monid`, `_myid`, `_link`) 
                    VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', 'تعديل محاضرات','Edite Lectures', '$postid', '$myid', '','lectures');");
                   $stmtnewpost->execute();
                echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong>تم!</strong> ... تـعـديل مـحـاضـرات الـيـوم  ", "<strong>Done !!</strong> ... Today’s lectures have been edited"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    position: relative;
                           top: -43px;"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                   exit();
            }


                ?>


<?php
} //isset$_SESSION['zoool']



?>