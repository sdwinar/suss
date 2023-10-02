<?php
error_reporting(0);
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

$myid = $userinfo['_id'];

?>
<span id="thismonabage"></span>
<?php
function loadcom (){
    global $con;
    $comid = $_GET['comid'];
    $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_coments` WHERE `_comid` = '$comid' ORDER BY `_id` DESC LIMIT 10");
    $stmtremon_choose_ver->execute();
    $cominfo = $stmtremon_choose_ver->fetchAll();
    $coments = $stmtremon_choose_ver->rowCount();


    ?>
        <span class="badge badge-warning" style="width: 100%"> <?php echo lang("الـتـــعــليـقات","Coments").' '.'('.$coments.')' ?></span>

        <div dir="<?php echo lang("rtl","ltr") ?>" class="alert alert-success alert-dismissible fade show text-center" role="alert" style="font-size: 1rem !important;font-weight: bold !important;">
        <?php
            foreach ($cominfo as $row) {
                //تحديد اسم ناشر التعليق
                $stmtremon_choose_ver = $con->prepare("SELECT * FROM `users` WHERE `_id` = $row[_userid] ");
                $stmtremon_choose_ver->execute();
                $cominfo = $stmtremon_choose_ver->fetch();
        ?>
        <span style="    color: blue;"><?php echo $cominfo['_name'] ?>   </span>  
        <br> 
        <span style="    color: black;"><?php echo $row['_coment'] ?>  </span>
        <br> 
        <span style="color: gray;font-size: 11px;"><?php echo $row['_time'] ?>  </span>
        <br>    
        <?php
        $myid = $_SESSION['zoool'];
        if ($row['_userid'] == $myid) { ?>

<span data-id="<?php echo $row['_id'] ?>" style="margin:0px 5px;    cursor: pointer;"
    class="badge badge-danger float-left monadeletehispost" style="margin:0px 5px"><i
        class="fa fa-trash"></i></span>
        <br> <!-- *********************************حذف البوست*************** -->
                    <div class="monaeditpostreusalt123<?php echo $row['_id'] ?>"></div>
                    <span id="arushor<?php echo $row['_id'] ?>" class="badge badge-warning"
                        style="cursor: pointer;display: none "><?php echo lang("هل تريد حذف هذا المنشور", "Do you want to delete this post?") ?></span>
                    <span id="yesamshor<?php echo $row['_id'] ?>" class="badge badge-danger yesamshor"
                        data-id="<?php echo $row['_id'] ?>"
                        style="cursor: pointer;display: none"><?php echo lang("نعم", "Yes") ?></span>
                    <span id="noamshor<?php echo $row['_id'] ?>" class="badge badge-info noamshor"
                        data-id="<?php echo $row['_id'] ?>"
                        style="cursor: pointer;display: none"><?php echo lang("لآ", "No") ?></span>
                        <hr>
        <?php
        }
        ?> 
        
<?php
    }
    ?>
            </div>
    <?php

}
if (isset($_GET['order']) && $_GET['order'] == 'add') {

    $comid = $_GET['comid'];
    $newcom = mksave($_GET['newcom']);
    $user = $userinfo['_id'];

    if (empty($newcom)) {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
    <?php echo lang("<strong> عفوا!</strong> ...   التعليق فارغ", "<strong>Sorry !!</strong> ...comment Empty");
        exit();
    } else {
        $stmtnewpost = $con->prepare("INSERT INTO `mon_coments` (`_id`, `_coment`, `_comid`, `_userid`, `_time`) 
        VALUES (NULL, '$newcom', '$comid', '$user', CURRENT_TIMESTAMP);");
        $stmtnewpost->execute();
   loadcom ();
}

    ?>
    <?php


} elseif (isset($_GET['order']) && $_GET['order'] == 'show') {
    loadcom ();
}elseif (isset($_GET['order']) && $_GET['order'] == 'deletpost') {
    $postid = $_GET['postid'];

    $stmtdelpost = $con->prepare("DELETE FROM `mon_coments`  WHERE `mon_coments`.`_id` = '$postid'  ");
    $stmtdelpost->execute();

    echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> تم!</strong> ...حذف المنشور", "<strong>Your !!</strong> ... Post Deleted"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    position: relative;
        top: -43px;"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        loadcom ();
    }
?>
<script src="js/jquery-3.4.0.min.js"></script>
<script>

function importfun(url, div, order = '', monaeditposttext = '', postid = '') { //دالة جلب ملفات الماين ديف
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                monaeditposttext: monaeditposttext,
                postid: postid
            },
            beforeSend: function() {
                $(div).html(
                    "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>")
            },
            success: function(data) {
                $(div).html(data)
            },
            error: function() {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    } //دالة جلب ملفات الماين ديف

$(".monadeletehispost").on("click", function() { //فتح تكست الحذف
        var postid = $(this).data("id");
        $("#arushor" + postid).slideDown(
            function() {
                $("#yesamshor" + postid).slideDown(
                    function() {
                        $("#noamshor" + postid).slideDown()
                    }
                )
            }
        );
    });

    $(".noamshor").on("click", function() { //لا اريد الحذف 
        var postid = $(this).data("id");
        $("#arushor" + postid).slideUp(
            function() {
                $("#yesamshor" + postid).slideUp(
                    function() {
                        $("#noamshor" + postid).slideUp()
                    }
                )
            }
        );
    });

    $(".yesamshor").on("click", function() { //نعم اريد الحذف 
        var postid = $(this).data("id");
        importfun("models/monasig/04comment", ".monaeditpostreusalt123" + postid, "deletpost", 'dswdswd', postid); //عرض المنشورات
        var cont = 0,
            time = setInterval(function() {
                cont++;
                if (cont == 2) {
                   window.location = '';
                }

            }, 1000)
    });
</script>