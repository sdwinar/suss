<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

if ((isset($_SESSION['zoool']))) {

    $myun = $userinfo['_enuniversity'];
    $mycol = $userinfo['_encollege'];
    $mysec = $userinfo['_ensection'];
    $mybach = $userinfo['_batch'];
    $mycer = $userinfo['Certificate_type'];
    $myid = $userinfo['_id'];

    if (isset($_GET['order']) && $_GET['order'] == 'showbatch') {




        $stmtshowmon = $con->prepare("SELECT * FROM `users` 
    WHERE `_enuniversity` = '$myun' AND `_encollege` = '$mycol' AND `_ensection` = '$mysec'
     AND`_batch` = '$mybach'  AND`Certificate_type` = '$mycer' AND `_verified` = 'yes' ORDER BY `_id`");

        $stmtshowmon->execute(array());
        $moninfo = $stmtshowmon->fetchAll();
        $moncont = $stmtshowmon->rowCount();
?>

        <?php
        // **************************************************عدد الموثقين*******************************************************
        if ($userinfo['_verified'] == 'no') { ?>
<span style="margin-top: 5px" class="btn btn-success col-lg-12 col-md-12 col-sm-12"><?php echo ' '. lang('قم بتوثيق حسابك لتتمكن من التصويت للمنسق','Verify your account to be able to vote for the moderator')?></span>
        <?php
        }

        // **************************************************جدول طلاب الدفعة*******************************************************
        ?>
        <span class="badge badge-primary btn-lg" style="font-size: 15px;font-weight: 500;padding: 8px;    width: 100%;    margin-bottom: 5px;"><?php echo lang('طــلاب الــدفـعــة', 'Total ') . "  " . "(" . " " . $moncont . " " . ")" ?></span>

        <div class="table-responsive" id="userresvdata" style="text-align:center">
            <table dir="<?php echo lang('rtl', 'ltr') ?>" id="sailorTable" class="table table-striped table-bordered" width="100%" style="text-align: center;color: aliceblue;font-size: 12px;font-weight: 600;">
                <thead style="font-weight:bold;color: #dea35c;font-size: 11px;;margin: 0% 0%;">
                    <tr>
                        <th><i class="fa fa-book"></i><?php echo lang('الاســم', 'Name') ?> </th>
                        <th><i class="fa fa-upload"></i><?php echo lang('المعرف', 'UserName') ?></th>
                        <th><i class="fa fa-upload"></i><?php echo lang('الرقم الجامعي', 'Seience') ?></th>
                        <th><i class="fa fa-upload"></i><?php echo lang('تاريخ التسجيل', 'Regester Date') ?></th>
                        <th><i class="fa fa-upload"></i><?php echo lang('إختيار كمنسق', 'Deatals') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($moninfo as $row) {
                    ?>
                        <tr style="color: #000000;    font-size: 14px;    font-weight: 500;">
                            <td><?php echo $row['_name'] ?></td>
                            <td><?php echo $row['_username'];
                                if ($row['_verified'] == 'yes') { ?>

                                    <i class="fa fa-check" aria-hidden="true" style="color: #9a3bff" title="<?php echo lang('حـسـاب مـوثـق', 'Certified account') ?>"></i>
                                <?php                 }                 ?>
                            </td>
                            <td><?php echo  $row['_unnum'] ?></td>
                            <td><?php echo $row['_regdate'] ?></td>
                            <?php
                                   if ($userinfo['_verified'] == 'yes') { ?>

                            ?>
                            <td>
                                <button class="userchoosemon" data-id="<?php echo $row['_id'] ?>" style="cursor: pointer; color:green"><i title="" class="fa fa-ring"></i></button>
                            </td>
                                   <?php } ?>
                        </tr>
                    <?php   } ?>
                </tbody>
            </table>
        </div>
        <?php
    } //isset($_GET['order'])&& $_GET['order']=='showbatch'
    elseif (isset($_GET['order']) && $_GET['order'] == 'addmonseg') { //إضافة منسق

        $voitedid = $_GET['votedid'];





        $stmtshowmon = $con->prepare("SELECT * FROM `mon_choose`
           WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'
           && `_voiter` = '$myid' ");
        $stmtshowmon->execute(array());
        $moninfo = $stmtshowmon->fetchAll();
        $moncont = $stmtshowmon->rowCount();

        if ($moncont > 0) { // التاكد من التصويت من قبل

            $stmteditimgpr = $con->prepare("UPDATE `mon_choose`  SET `_voited` = '$voitedid' WHERE `_voiter` = '$myid'");
            $stmteditimgpr->execute();


            //كود تغير المنسق في جدول اليوزر في قاعدة البيانات

            $stmtshowmo = $con->prepare("SELECT `_voited`,  COUNT(`_voited`) AS `_id` FROM `mon_choose`
           WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'
           GROUP BY `_voited` ORDER BY `_id` DESC LIMIT 1;");
            $stmtshowmo->execute(array());
            $moninfo123 = $stmtshowmo->fetch();

            $newmonid = $moninfo123['_voited'];
            //حذف منسق من الاخرين
            $stmteditimgpr11 = $con->prepare("UPDATE `mon_choose`  SET `_ismonsig` = 'no'  WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'");
            $stmteditimgpr11->execute();
            //إضافة المنسق
            $stmteditimgpr11 = $con->prepare("UPDATE `mon_choose`  SET `_ismonsig` = 'yes'  WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer' && `_voited` = '$newmonid'");
            $stmteditimgpr11->execute();

            echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> تم!</strong> ...تعديل تصويتك", "<strong>Your !!</strong> ... vote has been modified"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else { //اضافة الصوت
            $stmtaddnewmona = $con->prepare("INSERT INTO `mon_choose` (`_id`, `_un`, `_col`, `_sec`, `_bach`, `_cer`, `_voiter`, `_voited`) 
       VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', '$myid', '$voitedid');");
            $stmtaddnewmona->execute();

            //كود تغير المنسق في جدول اليوزر في قاعدة البيانات

            $stmtshowmo = $con->prepare("SELECT `_voited`,  COUNT(`_voited`) AS `_id` FROM `mon_choose`
                  WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'
                  GROUP BY `_voited` ORDER BY `_id` DESC LIMIT 1;");
            $stmtshowmo->execute(array());
            $moninfo123 = $stmtshowmo->fetch();

            $newmonid = $moninfo123['_voited'];
            //حذف منسق من الاخرين
            $stmteditimgpr11 = $con->prepare("UPDATE `mon_choose`  SET `_ismonsig` = 'no'  WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'");
            $stmteditimgpr11->execute();
            //إضافة المنسق
            $stmteditimgpr11 = $con->prepare("UPDATE `mon_choose`  SET `_ismonsig` = 'yes'  WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer' && `_voited` = '$newmonid'");
            $stmteditimgpr11->execute();

            echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> تم!</strong> ...إضافة صوتك", "<strong>Your !!</strong> ... vote has been added"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }
    } //isset($_GET['order'])&& $_GET['order']=='addmonseg'

    ?>

    <script src="js/frommonchoose.js"></script>





<?php
} //isset$_SESSION['zoool']



?>