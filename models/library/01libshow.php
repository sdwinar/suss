<?php

include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";
if (isset($_SESSION['zoool'])) {

    if (isset($_GET['table']) && $_GET['order'] == "show") {

        $perper = $_GET['type'];

        if($perper=='lecfile'){
            $typear ='محاضرات مادة';
            $typeen ='Course lectures';
            $arshow = 'تحميل';
            $enshow = 'Download';
            $enicon = 'download';
        }elseif($perper=='perer'){
            $typear ='اوراق عمل مادة';
            $typeen ='Course worksheets';
            $arshow = 'تحميل';
            $enshow = 'Download';
            $enicon = 'download';
        }elseif($perper=='video'){
            $typear ='مقاطع فديو مادة';
            $typeen ='Course video clips';
            $arshow = 'مشاهدة';
            $enshow = 'Watch';
            $enicon = 'eye';

        }


        if($_GET['sub'] == "lastlec"){
            $stmtday3 = $con->prepare("SELECT DISTINCT  `_subject` FROM `library`  WHERE `_mybatch` = '$batch_of_me' && `_type` = '$perper'  ORDER BY `_id` DESC LIMIT 1");
            $stmtday3->execute(array());
            $lecinfo1 = $stmtday3->fetch();
    
            $sub = $lecinfo1['_subject'];
        }else{
            $sub = $_GET['sub'];

        }

            $sql = "WHERE `_mybatch` = '$batch_of_me' && `_type` = '$perper' && `_subject`= '$sub'";
       

        $stmtday4 = $con->prepare("SELECT * FROM `library`  $sql ");
        $stmtday4->execute(array());
        $lecinfo2 = $stmtday4->fetchAll();
        $usercont1 = $stmtday4->rowCount();
        ?>
<span class="badge badge-primary btn-lg"
    style="font-size: 15px;font-weight: 500;padding: 8px;margin: 5px 0px; width: 100%;"><?php echo lang($typear, $typeen) .' '.$sub. "  " . "(" . " " . $usercont1 . " " . ")" ?></span>
<?php
                    if ($usercont1 != 0) { ?>

<div class="table-responsive" id="userresvdata" style="text-align:center">
    <table dir="<?php echo lang('rtl', 'ltr') ?>" id="sailorTable" class="table table-striped table-bordered"
        width="100%" style="text-align: center;color: aliceblue;font-size: 12px;font-weight: 600;">
        <thead style="font-weight:bold;color: #dea35c;font-size: 11px;;margin: 0% 0%;">
            <tr>
                <th><i class="fa fa-file"></i><?php echo ' ' . lang('الملف', 'File') ?></th>
                <th><i class="fa fa-inbox"></i><?php echo ' ' . lang('المادة', 'Subject') ?></th>
                <th><i class="fa fa-briefcase"></i><?php echo ' ' . lang('السمستر', 'Semester') ?></th>
                <th><i class="fa fa-road"></i><?php echo ' ' . lang('الدفعة', 'Batch') ?></th>
                <th><i class="fa fa-puzzle-piece"></i><?php echo ' ' . lang('التخصصص', 'Seience') ?></th>
                <th><i class="fas fa-building"></i><?php echo  ' ' . lang('الـجامـعــة', 'University') ?> </th>
                <th><i class="fas fa-upload"></i><?php echo  ' ' . lang('رفع', 'upload') ?> </th>
                <th><i class="fa fa-<?php echo $enicon?>"></i><?php echo ' ' . lang($arshow, $enshow) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                                    foreach ($lecinfo2 as $row) {
                                    ?>
            <tr>

                <td><?php echo $row['_name'] ?></td>
                <td><?php echo $row['_subject'] ?></td>
                <td><?php echo $row['_semester'] ?></td>
                <td><?php echo $row['_batch'] ?></td>
                <td><?php echo lang($row['_arsec'], $row['_ensec']) ?></td>
                <td><?php echo lang($row['_arun'], $row['_enun']) ?></td>
                <td><?php
                                $stmtday5 = $con->prepare("SELECT * FROM `users`  WHERE `_id` = '$row[_monid]'");
                                $stmtday5->execute(array());
                                $lecinfo3 = $stmtday5->fetch();

                         echo $lecinfo3['_username'] ?></td>

                <td>
                    <?php 
                            if($row['_type']=='lecfile' || $row['_type']=='perer'){?>

                    <a style="font-size: 150%" href="media/file/library/<?php echo $row['_path'] ?>"><i
                            class="fa fa-arrow-circle-down"></i></a>
                    <?php }else{?>
                    <span style="cursor: pointer" class="showvideoclass" data-name="<?php echo $row['_name'] ?>"
                        data-id="<?php echo $row['_path'] ?>"><i class="fa fa-eye"></i></span>
                    <?php }?>
                </td>
            </tr>
            <?php   } ?>
        </tbody>
    </table>
</div>

<?php
                    } else { ?>
<span class="badge badge-warning btn-lg"
    style="width: 100%;font-size: 15px;font-weight:500;padding:8px;margin-bottom: 5px;">
    <?php echo lang('لا تـوجـد نـتـائـجـ', 'No Resault') ?></span>
<?php
                    }
             



    } //isset $_GET['table' && $_GET'order' == "show"
    ///لجزء الخاص بابحث وملفاتك/////////////////////////////////////////////////////////////////////////////////////
    elseif (isset($_GET['table']) && $_GET['order'] == "serch") {

        $sql = $_GET['sql'];
        $stmtday4 = $con->prepare("SELECT * FROM `library`  $sql ");
        $stmtday4->execute(array());
        $lecinfo2 = $stmtday4->fetchAll();
        $usercont1 = $stmtday4->rowCount();
        ?>


<span class="badge badge-primary btn-lg"
    style="font-size: 15px;font-weight: 500;padding: 8px;margin: 5px 0px; width: 100%;">
    <?php echo lang("نتائج البحث", "research results"). "  " . "(" . " " . $usercont1 . " " . ")" ?></span>


<div class="table-responsive" id="userresvdata" style="text-align:center">
    <table dir="<?php echo lang('rtl', 'ltr') ?>" id="sailorTable" class="table table-striped table-bordered"
        width="100%" style="text-align: center;color: aliceblue;font-size: 12px;font-weight: 600;">
        <thead style="font-weight:bold;color: #dea35c;font-size: 11px;;margin: 0% 0%;">
            <tr>
                <th><i class="fa fa-file"></i><?php echo ' ' . lang('الملف', 'File') ?></th>
                <th><i class="fa fa-inbox"></i><?php echo ' ' . lang('المادة', 'Subject') ?></th>
                <th><i class="fa fa-briefcase"></i><?php echo ' ' . lang('السمستر', 'Semester') ?></th>
                <th><i class="fa fa-road"></i><?php echo ' ' . lang('الدفعة', 'Batch') ?></th>
                <th><i class="fa fa-puzzle-piece"></i><?php echo ' ' . lang('التخصصص', 'Seience') ?></th>
                <th><i class="fas fa-building"></i><?php echo  ' ' . lang('الـجامـعــة', 'University') ?> </th>
                <?php
                if($_GET['titleen']=='myfile'){?>

                <th><i class="fa fa-trash"></i><?php echo  ' ' . lang('حذف', 'Delete') ?> </th>
                <th><i class="fa fa-ring"></i><?php echo  ' ' . lang('إستخدام', 'Use') ?></th>

                <?php
                }else{?>

                <th><i class="fas fa-upload"></i><?php echo  ' ' . lang('رفع', 'upload') ?> </th>
                <th><i class="fa fa-ring"></i><?php echo  ' ' . lang('إستخدام', 'Use') ?></th>


                <?php
                }
                ?>

            </tr>
        </thead>
        <tbody>
            <?php
                                    foreach ($lecinfo2 as $row) {
                                    ?>
            <tr>

                <td><?php echo $row['_name'] ?></td>
                <td><?php echo $row['_subject'] ?></td>
                <td><?php echo $row['_semester'] ?></td>
                <td><?php echo $row['_batch'] ?></td>
                <td><?php echo lang($row['_arsec'], $row['_ensec']) ?></td>
                <td><?php echo lang($row['_arun'], $row['_enun']) ?></td>
                <?php
                if($_GET['titleen']=='myfile'){?>

                <td class="deleteicon" data-id="<?php echo $row['_id'] ?>" style="cursor: pointer"><i class="fa fa-trash"></i> </td>
                <td>
                    <?php 
                            if($row['_type']=='lecfile' || $row['_type']=='perer'){?>

                    <a style="font-size: 150%" href="media/file/library/<?php echo $row['_path'] ?>"><i
                            class="fa fa-arrow-circle-down"></i></a>
                    <?php }else{?>
                    <span style="cursor: pointer" class="showvideoclass" data-name="<?php echo $row['_name'] ?>"
                        data-id="<?php echo $row['_path'] ?>"><i class="fa fa-eye"></i></span>
                    <?php }?>
                </td>

                <?php
                }else{?>
                
                <td>
                                        <?php
                                $stmtday5 = $con->prepare("SELECT * FROM `users`  WHERE `_id` = '$row[_monid]'");
                                $stmtday5->execute(array());
                                $lecinfo3 = $stmtday5->fetch();

                         echo $lecinfo3['_username'] ?></td>

                <td>
                    <?php 
                            if($row['_type']=='lecfile' || $row['_type']=='perer'){?>

                    <a style="font-size: 150%" href="media/file/library/<?php echo $row['_path'] ?>"><i
                            class="fa fa-arrow-circle-down"></i></a>
                    <?php }else{?>
                    <span style="cursor: pointer" class="showvideoclass" data-name="<?php echo $row['_name'] ?>"
                        data-id="<?php echo $row['_path'] ?>"><i class="fa fa-eye"></i></span>
                    <?php }?>
                </td>
            </tr>
            <?php   } ?>


                <?php
                }
                ?>

        </tbody>
    </table>
</div>
<?php
    }    /// النهاية الجزء الخاص بابحث/////////////////////////////////////////////////////////////////////////////////////

    elseif (isset($_GET['table']) && $_GET['order'] == "sideleft") {

        $perper = $_GET['type'];


        $stmtday2 = $con->prepare("SELECT DISTINCT  `_subject` FROM `library`  WHERE `_mybatch` = '$batch_of_me' && `_type` = '$perper' ORDER BY `_id` DESC");
        $stmtday2->execute(array());
        $lecinfo = $stmtday2->fetchAll();
        foreach($lecinfo as $row){?>
<div class="input-group mb-2 getlec" data-type="<?php echo $perper ?>" data-sub="<?php echo $row['_subject'] ;?>">
    <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan"><i
                class="fa fa-book"></i><?php echo ' ' .$row['_subject'] ?></span></a>
</div>

<?php    } 


    }//isset $_GET['table' && $_GET'order' == "sideleft"
    elseif (isset($_GET['table']) && $_GET['order'] == "search") {?>
<style>
.in {
    width: 100%;
    margin: 3px -2px;
    padding: -1px !important;
    border: none;
    background: #343a4085;
    border-bottom: 1.5px solid red;
    border-radius: 15%;
    color: wheat;
    font-weight: bold;
}
</style>
<!-- <span class="badge badge-info"><i class="fa fa-search"></i><?php echo ' '. lang("بــحــث","Search") ?></span> -->
<input autofocus class="in" type="text" name="" id="name12" placeholder="<?php echo lang("الاسـم","Name") ?>">
<input autofocus class="in" type="text" name="" id="course12" placeholder="<?php echo lang("المادة","course") ?>">
<input autofocus class="in" type="text" name="" id="semester12" placeholder="<?php echo lang("السمستر","Semester") ?>">
<input autofocus class="in" type="text" name="" id="university12"
    placeholder="<?php echo lang("الجامعة","University") ?>">
<input autofocus class="in" type="text" name="" id="section12" placeholder="<?php echo lang("التخصص","Section") ?>">
<input autofocus class="in" type="text" name="" id="batch12" placeholder="<?php echo lang("الدفعة","batch") ?>">
<select class="in" name="" id="type12">
    <option value=""><?php echo lang("النوع","Type") ?></option>
    <option value="lecfile"><?php echo lang("محاضرة","Lecture") ?></option>
    <option value="perer"><?php echo lang("ورقة عمل","Worksheet") ?></option>
    <option value="video"><?php echo lang("فديو","Video") ?></option>
</select>
<button id="btnlibserch" class="btn btn-light" style="margin-top: 5px;    font-weight: bold;"><i
        class="fa fa-search"></i><?php echo ' '. lang("بــحــث","Search") ?></button>

<?php
    }//isset $_GET['table' && $_GET'order' == "search"
        ///لجزء الخاص بالحذف /////////////////////////////////////////////////////////////////////////////////////
        elseif (isset($_GET['table']) && $_GET['order'] == "delete") {

            $id = $_GET['sub'];
            $stmtlog1 = $con->prepare("SELECT * FROM `library` WHERE `_id` = '$id'");
            $stmtlog1->execute();
            $file1 = $stmtlog1->fetch();

            if($file1['_type']!='video'){
                $file = stripslashes($file1['_path']);
                $folder_path = "../../media/file/library/$file";
                unlink($folder_path) or die("Failed to <strong class='highlight'>delete</strong> file");
   
                $stmtlog1 = $con->prepare("DELETE FROM `library` WHERE `_id` = '$id'");
                $stmtlog1->execute();

                echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong> تم!</strong> ...     حذف الملف بنجاح", "<strong>Done !!</strong> ...The file has been successfully Delete"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                exit();
            }else{
                $stmtlog1 = $con->prepare("DELETE FROM `library` WHERE `_id` = '$id'");
                $stmtlog1->execute();

                echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong> تم!</strong> ...     حذف الفديو بنجاح", "<strong>Done !!</strong> ...The Video has been successfully Delete"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                exit();

            }
    }//isset $_GET['table' && $_GET'order' == "delete"
    ?>
<script src="js/from01libshow.js"></script>
<script src="js/theam.js"></script>
<?php
} //isset$_SESSION'zoool'