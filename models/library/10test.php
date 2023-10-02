<?php

include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

if (isset($_SESSION['zoool'])) {
    if (isset($_GET['table'])) {

        if ($_GET['order'] == "show") {

            $table = $_GET['table'];
            $sql = $_GET['sql'];
            $titlear = $_GET['titlear'];
            $titleen = $_GET['titleen'];
            $stmtshow = $con->prepare("SELECT * FROM $table  $sql ");
            $stmtshow->execute(array());
            $userinfo = $stmtshow->fetchAll();
            $usercont = $stmtshow->rowCount();
?>
<span class="badge badge-primary btn-lg"
    style="font-size: 15px;font-weight: 500;padding: 8px;margin: 5px 0px; width: 100%;"><?php echo lang($titlear, $titleen) . "  " . "(" . " " . $usercont . " " . ")" ?></span>
<?php
            if ($usercont != 0) { ?>

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
                <th><i class="fa fa-download"></i><?php echo ' ' . lang('تحميل', 'Download') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                            foreach ($userinfo as $row) {
                            ?>
            <tr>
              
                <td><?php echo $row['_name'] ?></td>
                <td><?php echo $row['_subject'] ?></td>
                <td><?php echo $row['_semester'] ?></td>
                <td><?php echo $row['_batch'] ?></td>
                <td><?php echo lang($row['_arsec'], $row['_ensec']) ?></td>
                <td><?php echo lang($row['_arun'], $row['_enun']) ?></td>
                <td>
                    <button class="userdetalsemodal" data-id="<?php echo $row['_id'] ?>" data-toggle="modal"
                        data-target="#exampleModal" style="cursor: pointer; color:green">
                        <i class="fa fa-arrow-circle-down"></i>
                    </button>
                </td>
            </tr>
            <?php   } ?>
        </tbody>
    </table>
</div>

<?php
            } else { ?>
<span class="badge badge-warning btn-lg" style="font-size: 15px;font-weight:500;padding:8px;margin-bottom: 5px;">
    <?php echo lang('لا تـوجـد نـتـائـجـ', 'No Resault') ?></span>
<?php
            }
        } //show user
        elseif ($_GET['order'] == "detalse") {
            $table = $_GET['table'];
            $sql = $_GET['sql'];
            $stmtshow = $con->prepare("SELECT * FROM $table WHERE `_admin` = 'no'  $sql");
            $stmtshow->execute(array());
            $usercont = $stmtshow->rowCount();
            ?>
<div class="myspan ">
    <span id="alluserss" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="width: 100%;cursor: pointer;">
        <?php echo lang("العـدد الكلي => ", "All   Users => ") . " " . $usercont ?></span>
    <?php
                $stmtshow = $con->prepare("SELECT * FROM $table WHERE `_admin` = 'no'  $sql ORDER BY `_id` DESC LIMIT 10");
                $stmtshow->execute(array());
                $usercont = $stmtshow->rowCount();
                ?>
    <span id="Lastregstred" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="width: 100%;cursor: pointer;">
        <?php echo lang("اخر المسجلين => ", "Last Regstred => ") . " " . $usercont ?></span>

    <?php
                $stmtshow = $con->prepare("SELECT * FROM $table WHERE `_admin` = 'admin'");
                $stmtshow->execute(array());
                $usercont = $stmtshow->rowCount();
                ?>
    <span id="alladmain" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="margin-top: 5px;width: 100%;cursor: pointer;">
        <?php echo lang("عـدد الادمــن => ", "ALL Admain => ") . " " . $usercont ?></span>
    <?php
                $stmtshow = $con->prepare("SELECT * FROM $table WHERE `_admin` = 'no' AND `_active` = 'no'");
                $stmtshow->execute(array());
                $usercont = $stmtshow->rowCount();
                ?>
    <span id="userunactive" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="margin-top: 5px;width: 100%;cursor: pointer;">
        <?php echo lang("غـير مـنـشـط => ", "UN Active => ") . " " . $usercont ?></span>
    <?php
                $stmtshow = $con->prepare("SELECT * FROM $table WHERE `_admin` = 'no' AND `_adjective` != 'professor'");
                $stmtshow->execute(array());
                $usercont = $stmtshow->rowCount();
                ?>
    <span id="Allstudants" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="margin-top: 5px;width: 100%;cursor: pointer;">
        <?php echo lang("عــدد الـطـــلابـــ => ", "All Studants =>") . " " . $usercont ?></span>
    <?php
                $stmtshow = $con->prepare("SELECT * FROM $table WHERE `_admin` = 'no' AND `_adjective` = 'professor'");
                $stmtshow->execute(array());
                $usercont = $stmtshow->rowCount();
                ?>
    <span id="AllMisster" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="margin-top: 5px;width: 100%;cursor: pointer;">
        <?php echo lang("عــدد ألأســاتـــذة  => ", "All Misster =>") . " " . $usercont ?></span>
</div>
<?php
        }   //$_POST['order']=="detalse"     
        elseif ($_GET['order'] == "searsh") { ?>
<form style="background: none">
    <input autofocus id="inputnamesarshcp" type="text" class="cpinput form-input"
        placeholder="<?php echo lang(' بحث بواسطة إسم المعرف او الايميل', 'By username Or Email') ?>">
    <input id="namesarshcp" type="submit" value="" style="display: none">
</form>

<?php
        } //$_POST['order']=="searsh" 
    } //isset($_GET['table'])
    else {
        ?>

<?php
    }
} //is admin
else {
    die("admin page");
}
?>
<!-- ********************************************edit user modal****************************************************************************** -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content cpdiv">
            <div class="modal-body">
                <div id="resultuserdata"></div>
            </div>
        </div>
    </div>
</div>
<script src="js/fromcpusersshow.js"></script>
<script src="js/theam.js"></script>