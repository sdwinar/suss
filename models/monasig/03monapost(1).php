<?php
error_reporting(0);
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

$myun = $userinfo['_enuniversity'];
$mycol = $userinfo['_encollege'];
$mysec = $userinfo['_ensection'];
$mybach = $userinfo['_batch'];
$mycer = $userinfo['Certificate_type'];
$myid = $userinfo['_id'];
?>
<span id="thismonabage"></span>
<?php
if (isset($_GET['order']) && $_GET['order'] == 'isadmin') {

    $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_choose` WHERE `_voited`=$_SESSION[zoool] LIMIT 1");
    $stmtremon_choose_ver->execute();
    $me_verinfo = $stmtremon_choose_ver->fetch();

    if ($me_verinfo['_ismonsig'] == 'yes') { //إضافة منشور منسق جديد

        $newpost = mksave($_GET['monapost']);
        $newposttype = !isset($_GET['post_type']) ? 2 : mksave($_GET['post_type']);

        if (empty($newpost)) {
            echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> عفوا!</strong> ...   المنشور فارغ", "<strong>Sorry !!</strong> ...Post Empty");
            exit();
        } else {
            $stmtnewpost = $con->prepare("INSERT INTO `mon_posts` (`_id`, `_un`, `_col`, `_sec`, `_bach`, `_cer`, `_post`, `_type`, `_monaid`, `stu_or_tech`, `_posttime`)
             VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', '$newpost', '$newposttype', '$myid',1, CURRENT_TIMESTAMP);");
            $stmtnewpost->execute();


            //ارسال الاشعار
            $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_posts` ORDER BY `_id` DESC LIMIT 1");
            $stmtremon_choose_ver->execute();
            $me_verinfo = $stmtremon_choose_ver->fetch();
            $postid = $me_verinfo['_id'];

            $stmtnewpost = $con->prepare("INSERT INTO `mon_notices` (`_id`, `_un`, `_col`, `_sec`, `_batch`, `_bclar`, `_not_type`,`_not_type_en`, `_postid`, `_monid`, `_myid`, `_link`) 
            VALUES (NULL, '$myun', '$mycol', '$mysec', '$mybach', '$mycer', 'منشور منسق','coordinator Post', '$postid', '$myid', '','monasig');");
           $stmtnewpost->execute();



            echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> تم!</strong> ...إضافة المنشور", "<strong>Your !!</strong> ... Post added"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    position: relative;
    top: -43px;"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }
    } else {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> عفوا!</strong> ...   انت لست المنسق", "<strong>Sorry !!</strong> ...Post Empty");
        exit();
    }
} elseif (isset($_GET['order']) && $_GET['order'] == 'postsshow') {

    $sersh = $_GET['sersh'] == '' ? '' : $_GET['sersh']; //متغير البحث

    $pageunm = $_GET['pagenumer'] == '' ? 1 : $_GET['pagenumer']; //متغير تعدد الصفحات

    $from = ($pageunm - 1) * 10;
    $stmtshowmon41 = $con->prepare("SELECT * FROM `mon_posts`
    WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'&& `stu_or_tech` = 1 $sersh
    ORDER BY `_posttime` DESC LIMIT $from,10");
    $stmtshowmon41->execute(array());
    $postinfo = $stmtshowmon41->fetchAll();

    ?>
<div class="container">
    <div class="row">
        <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
        <div class="col-12 col-lg-6 col-md-6">
            
            <?php
            $num=0;
            foreach ($postinfo as $row) {
                $num++;
                    $stmtshowmon410 = $con->prepare("SELECT * FROM `users`
                        WHERE `_id` = '$row[_monaid]' ");
                    $stmtshowmon410->execute(array());
                    $monainfo = $stmtshowmon410->fetch();
                ?>
            <div class="card shadow" style="margin-top: 4px ;border: 2px solid <?php
                                                                                        if ($row['_type'] == 1) {
                                                                                            echo 'red';
                                                                                        } elseif ($row['_type'] == 2) {
                                                                                            echo '#e09b73';
                                                                                        } else {
                                                                                            echo '#ddddc6';
                                                                                        }
                                                                                        ?>
                    ;">
                <div class="card-body">
                    <h5 style="color: blue;" class="card-title"><?php echo $monainfo['_name'].' '.'('.$num.')' ?></h5>
                    <hr>
                    <p style="font-weight: bold" class="card-text"><?php echo $row['_post'] ?>
                    </p>
                    <hr>
                    <h6 class="card-title float-right"><?php echo $row['_posttime'] ?></h6>
                    <!-- *********************************تحديد عدد التعليقات*************** -->



                    <span style="cursor: pointer" data-id="com<?php echo $row['_id'] ?>"
                        class="badge badge-primary float-left comspan478"><?php echo lang('الـتـعـلـيـقـات', 'Comments') ?></span>
                      
                        <span style="cursor: pointer;;margin: 0px 4px;" data-id="<?php echo $row['_id'] ?>"
                        class="badge badge-primary float-left comspanlikers"><?php echo lang('المعجبين', 'Likers') ?></span>
                        <!-- //زر الاعجاب -->
                   
                        <img data-id="<?php echo $row['_id'] ?>" class="comspanlike"
                         src="media/img/main/like<?php
                            $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_like` WHERE `_postid` = '$row[_id]' && `_userid` = '$myid' ");
                            $stmtremon_choose_ver->execute();
                            $cominfo = $stmtremon_choose_ver->fetch();
                            echo $cominfo['_like']=='yes'?  '2':  '1';
                        ?>.png" alt="like" width="6.5%" srcset="" style="cursor: pointer;position: relative;top: -6.1px;">
                        <?php  if ($row['_monaid'] == $myid) { ?>

                    <span class="badge badge-primary float-left monaedithispost" style="margin:0px 5px;    cursor: pointer;
" data-id="<?php echo $row['_id'] ?>"><i class="fa fa-edit"></i></span>

                    <span data-id="<?php echo $row['_id'] ?>" style="margin:0px 5px;    cursor: pointer;"
                        class="badge badge-danger float-left monadeletehispost" style="margin:0px 5px"><i
                            class="fa fa-trash"></i></span>
                    <br> <!-- *********************************تعديل البوست*************** -->
                    <form id="monaeditpostform<?php echo $row['_id'] ?>"
                        class="monaeditpostform editthisthpost<?php echo $row['_id'] ?>"
                        action="models/monasig/03monapost" method="POST" style="display: none">

                        <textarea name="monaeditposttext" id="monaeditposttext<?php echo $row['_id'] ?>" cols="30"
                            rows="3" style="width: 100%"><?php echo $row['_post'] ?></textarea>
                        <input type="hidden" name="order" value="editpost">
                        <input type="hidden" name="podtid" value="<?php echo $row['_id'] ?>">

                        <div id="monaeditpostreusalt<?php echo $row['_id'] ?>"></div>

                        <button data-sendid="<?php echo $row['_id'] ?>" id="sendmonapost<?php echo $row['_id'] ?>"
                            name="sendmonapost" style="width:100%;    margin-top: 10px;"
                            class="btn btn-dark sendmonaeditpost"
                            type="submit"><?php echo lang("تـعــديل", "Edit") ?></button>
                        <!-- <input type="submit" value=""> -->
                    </form>
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



                    <?php
                            }
                            ?>
                </div>
                <br> <!-- *********************************المعجبين************** -->
                <span dir="<?php echo lang("rtl","ltr") ?>"  class="col-12" style=" margin: -7% 0% 1% 2%; display: none;height: 100vh"
                  id="like<?php echo $row['_id'] ?>">
                  <span>
                    <span dir="<?php echo lang("rtl","ltr") ?>" id="likere<?php echo $row['_id'] ?>"></span>
                </span>
                </span>
                <br> <!-- *********************************التعليقات************** -->
                <span dir="<?php echo lang("rtl","ltr") ?>"  class="col-12" style=" margin: -7% 0% 1% 2%; display: none;height: 100vh"
                  id="com<?php echo $row['_id'] ?>">
                  <span>
                    <form dir="<?php echo lang("rtl","ltr") ?>" data-id="<?php echo $row['_id'] ?>" class="newmoncomentform" action="models/monasig/04comment"
                        method="post">
                        <input style="margin-bottom: 2%" type="text" class="col-12"
                            id="newcomment<?php echo $row['_id'] ?>"
                            placeholder="<?php echo lang("إضـافة تعليق", "Add comment") ?>">

                        <span dir="<?php echo lang("rtl","ltr") ?>" id="comresult<?php echo $row['_id'] ?>"></span>
                    </form>

                </span>
                </span>

            </div>
            <hr>
            <?php } ?>

        </div>


        <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
    </div>
</div>


<?php
} elseif (isset($_GET['order']) && $_GET['order'] == 'editpost') {

    $postnew = $_GET['monaeditposttext'];
    $postid = $_GET['postid'];

    if (empty($postnew)) {
        echo '<br/><div class="alert alert-danger alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> عفوا!</strong> ...   المنشور فارغ", "<strong>Sorry !!</strong> ...Post Empty");
        exit();
    } else {
        $stmtnewposted = $con->prepare("UPDATE `mon_posts` SET `_post` = '$postnew', `_posttime` = CURRENT_TIMESTAMP WHERE `mon_posts`.`_id` = '$postid'  ");
        $stmtnewposted->execute();

        echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> تم!</strong> ...تـعـديل المنشور", "<strong>Your !!</strong> ... Post edited"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    position: relative;
           top: -43px;"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }
} elseif (isset($_GET['order']) && $_GET['order'] == 'deletpost') {
    $postid = $_GET['postid'];

    $stmtdelpost = $con->prepare("DELETE FROM `mon_posts`  WHERE `mon_posts`.`_id` = '$postid'  ");
    $stmtdelpost->execute();

    echo '<br/><div class="alert alert-info alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> تم!</strong> ...حذف المنشور", "<strong>Your !!</strong> ... Post Deleted"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="    position: relative;
        top: -43px;"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
    exit();
}
?>




<script src="js/jquery-3.4.0.min.js"></script>
<script src="js/ajax.googleapis.js"></script>
<script src="js/malsup.github.js"></script>
<script src="js/frommonpost.js"></script>
<script>

</script>