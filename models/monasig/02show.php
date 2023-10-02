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
?>
    <link rel="stylesheet" href="css/mon02show.css">

    <div class="container">
        <div class="row">

            <!--team-1-->
            <?php
            //الاستعلام التالي لتحديد المنسق وهو الرقم المكرر للمصوت لهم
            $stmtshowmon = $con->prepare("SELECT `_voited`,  COUNT(`_voited`) AS `_id` FROM `mon_choose`
            WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'
            GROUP BY `_voited` ORDER BY `_id` DESC LIMIT 1;");
            $stmtshowmon->execute(array());
            $moninfo = $stmtshowmon->fetch();

            $newmonid = $moninfo['_voited'];

            $stmtshowmon = $con->prepare("SELECT * FROM `users` WHERE `_id` = '$newmonid'");
           $stmtshowmon->execute(array());
           $newmoninfo = $stmtshowmon->fetch();
            
            ?>
            <div class="col-12">
                    <div class="our-team-main">
                        <div class="team-front">
                            <h3>Dilip Kevat</h3>
                            <p>Web Designer</p>
                        </div>
                        <div class="team-back">
                            <span>
                                <center>
                                    <span class="badge badge-warning"><?php echo lang('مـنـسـق الـدفـعـة','Batch Coordinator') ?></span><hr>
                                    <span style="color: black;font-weight: 500;position: relative;bottom: 13px;"><?php echo $newmoninfo['_name'] ?></span>
                                    <hr><br>
                                   </center>
                                <hr>
                                <center>
                                    <span class="badge badge-success" style="color: black;"></span>
                                </center>

                            </span>
                        </div>

                    </div>
                </div>
                <hr>
                <hr>
            <?php
                $stmtshowmon = $con->prepare("SELECT DISTINCT  `_voited`  FROM `mon_choose`
                WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'");
                $stmtshowmon->execute(array());
                $moninfo = $stmtshowmon->fetchAll();
                $moncont = $stmtshowmon->rowCount();
            foreach ($moninfo as $row) {
                $id = $row['_voited'];

                $stmtshowmon = $con->prepare("SELECT * FROM `users` 
            WHERE `_id` = '$id' ");
                $stmtshowmon->execute(array());
                $moninfo = $stmtshowmon->fetch();
                $moncont = $stmtshowmon->rowCount();
                //عدد الاصوات
                $stmts = $con->prepare("SELECT `_voited`  FROM `mon_choose`
            WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'
            && `_voited` = '$id' ");
                $stmts->execute(array());
                $cont123 = $stmts->rowCount();

            ?>
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="our-team-main">
                        <div class="team-front">
                            <h3>Dilip Kevat</h3>
                            <p>Web Designer</p>
                        </div>
                        <div class="team-back">
                            <span>
                                <center>
                                    <span style="color: black;"><?php echo $moninfo['_name'] ?></span>
                         
                                </center>
                                <hr>
                                <center>
                                    <span class="badge badge-success" style="color: black;"><?php echo lang('عدد الاصوات' . ' ' . $cont123, 'Total votes' . ' ' . $cont123) ?></span>
                                </center>

                            </span>
                        </div>

                    </div>
                </div>
                <!--team-1-->
            <?php   }    ?>

        </div>
    </div>







<?php
} //isset$_SESSION['zoool']



?>