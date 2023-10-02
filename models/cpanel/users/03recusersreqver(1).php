<?php

include "../../main/connect.php";
include "../../main/lang.php";
include "../../main/function.php";

if ((isset($_SESSION['zoool'])) && ($userinfo['_admin'] == 'manager' || $userinfo['_admin'] == 'admin')) {

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
    style="font-size: 15px;font-weight: 500;padding: 8px;    margin-bottom: 5px;"><?php echo lang($titlear, $titleen) . "  " . "(" . " " . $usercont . " " . ")" ?></span>
<?php
if($usercont!=0){?>

<div class="table-responsive" id="userresvdata" style="text-align:center">
    <table dir="<?php echo lang('rtl', 'ltr') ?>" id="sailorTable" class="table table-striped table-bordered"
        width="100%" style="text-align: center;color: aliceblue;font-size: 12px;font-weight: 600;">
        <thead style="font-weight:bold;color: #dea35c;font-size: 11px;;margin: 0% 0%;">
            <tr>
                <th>#<?php echo lang('إسـم المعرف', 'Username') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('الـجامـعــة', 'University') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('التخصصص', 'Seience') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('تاريخ الطلب', 'Request Date') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('التفاصيل', 'Deatals') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                        foreach ($userinfo as $row) {
                            $stmtshowsss = $con->prepare("SELECT * FROM `users` WHERE `_id` = $row[_userid]");
                            $stmtshowsss->execute();
                            $rowver = $stmtshowsss->fetch();
                        ?>
            <tr>
                <td><?php echo $rowver['_username']?></td>
                
                <td><?php echo lang($rowver['_aruniversity'], $rowver['_enuniversity']) ?></td>
                <td><?php echo lang($rowver['_arsection'], $rowver['_ensection']) ?></td>
                <td><?php echo $row['_reqdate'] ?></td>
                <td>
                       <button class="userdetalsemodalrev" data-id="<?php echo $row['_userid']?>" data-toggle="modal" data-target="#admineditrev" style="cursor: pointer; color:green"><i title=""
                                class="fa fa-ring"></i></button>
                </td>
            </tr>
            <?php   } ?>
        </tbody>
    </table>
</div>

<?php
}else{?>
<span class="badge badge-warning btn-lg" style="font-size: 15px;font-weight:500;padding:8px;margin-bottom: 5px;">
    <?php echo lang('لا تـوجـد نـتـائـجـ', 'No Resault')?></span>
<?php
}
        } //show user
        elseif ($_GET['order'] == "detalse") {
            $table = $_GET['table'];
            $sql = $_GET['sql'];
            $stmtshow = $con->prepare("SELECT * FROM $table   ORDER BY `_id` DESC");
            $stmtshow->execute();
            $usercont = $stmtshow->rowCount();
        ?>
<div class="myspan ">
    <!--****************************** كل طلبات التوثيق*************************** -->
    <span id="allreqrev" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="width: 100%;cursor: pointer;">
        <?php echo lang("العـدد الكلي => ", "All    => ") . " " . $usercont ?></span>
<?php
        $stmtshow = $con->prepare("SELECT * FROM $table  WHERE `_verified` = 'no' ORDER BY `_id` DESC");
            $stmtshow->execute();
            $usercont = $stmtshow->rowCount();
            ?>

        <span id="reqnoverified" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="width: 100%;cursor: pointer;">
        <?php echo lang("غير موثق => ", "No verified    => ") . " " . $usercont ?></span>
        <?php
        $stmtshow = $con->prepare("SELECT * FROM $table  WHERE `_verified` = 'yes' ORDER BY `_id` DESC");
            $stmtshow->execute();
            $usercont = $stmtshow->rowCount();
            ?>

        <span id="reqverified" class="badge badge-danger <?php echo lang("text-left", "text-left") ?>"
        style="width: 100%;cursor: pointer;">
        <?php echo lang(" موثق => ", "verified    => ") . " " . $usercont ?></span>

</div>
<?php
        }   //$_POST['order']=="detalse"  
        elseif ($_GET['order'] == "searsh") { ?>
   <div class=" cpdiv">

<form id="usersearchform" action="" method="post" >
  
    <input id="req_rev_byusername" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang(' بحث بواسطة إسم المعرف', 'Search By username') ?>">

  
            <button class="btn btn-success" id="btn_req_revsearch" style="width: 100%"  type="submit">
             <?php echo lang('بـحـث','Search')  ?>   <i class="fa fa-search"></i>         </button>
</form>

</div>
            
            <?php
                    } //$_POST['order']=="searsh" 
                    elseif ($_GET['order'] == "req_searsh") { ?>
                        <div class=" cpdiv">
              <?php
              
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
    style="font-size: 15px;font-weight: 500;padding: 8px;    margin-bottom: 5px;"><?php echo lang($titlear, $titleen) . "  " . "(" . " " . $usercont . " " . ")" ?></span>
<?php
if($usercont!=0){?>

    <div class="table-responsive" id="userresvdata" style="text-align:center">
    <table dir="<?php echo lang('rtl', 'ltr') ?>" id="sailorTable" class="table table-striped table-bordered"
        width="100%" style="text-align: center;color: aliceblue;font-size: 12px;font-weight: 600;">
        <thead style="font-weight:bold;color: #dea35c;font-size: 11px;;margin: 0% 0%;">
            <tr>
                <th>#<?php echo lang('إسـم المعرف', 'Username') ?></th>
                <th><i class="fa fa-book"></i><?php echo lang('الاســم', 'Name') ?> </th>
                <th><i class="fa fa-upload"></i><?php echo lang('الـجامـعــة', 'University') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('التخصصص', 'Seience') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('تاريخ التسجيل', 'Regester Date') ?></th>
                <th><i class="fa fa-upload"></i><?php echo lang('التفاصيل', 'Deatals') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                        foreach ($userinfo as $row) {
                        ?>
            <tr <?php if ($row['_adjective'] == "mis") { ?> style="color:red" <?php } ?>>
                <td><?php echo $row['_username'];
                if ($row['_verified'] == 'yes') { ?>

<i class="fa fa-check" aria-hidden="true" style="color: #9a3bff" title="<?php echo lang('حـسـاب مـوثـق', 'Certified account') ?>"></i>
<?php                 }                 ?>
            </td>
                <td><?php echo $row['_name'] ?></td>
                <td><?php echo lang($row['_aruniversity'], $row['_enuniversity']) ?></td>
                <td><?php echo lang($row['_arsection'], $row['_ensection']) ?></td>
                <td><?php echo $row['_regdate'] ?></td>
                <td>
                       <button class="userdetalsemodalrev" data-id="<?php echo $row['_id']?>" data-toggle="modal" data-target="#admineditrev" style="cursor: pointer; color:green"><i title=""
                                class="fa fa-ring"></i></button>
                </td>
            </tr>
            <?php   } ?>
        </tbody>
    </table>
</div>

<?php
}else{?>
<span class="badge badge-warning btn-lg"
    style="font-size: 15px;font-weight:500;padding:8px;margin-bottom: 5px;">
    <?php echo lang('لا تـوجـد نـتـائـجـ', 'No Resault')?></span>
<?php
}
              ?>
                     
                     </div>
                                 
                                 <?php
                                         } //$_POST['order']=="req_searsh" 
    }
}
 //is admin
else {
    die("admin page");
}
?>
<!-- ********************************************edit user modal****************************************************************************** -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="admineditrev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content cpdiv">
       <div class="modal-body">
        <div id="resultuserdatarev"></div>
      </div>
    </div>
  </div>
</div>
<script src="js/fromcpusersreqver.js"></script>
<script src="js/theam.js"></script>