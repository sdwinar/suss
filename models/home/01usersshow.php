<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";

if (isset($_GET['order'])) {
    $sql = $_GET['sql'];

    $stmtusershomeshow = $con->prepare("SELECT * FROM `users` $sql ");
    $stmtusershomeshow->execute();
    $conts = $stmtusershomeshow->rowCount();
    $usersinfo = $stmtusershomeshow->fetchAll();
}
?>
<div class="container">
    <div class="row">
        <span class="badge badge-success col-12" style="margin-bottom: 10px;">(<?php echo $conts ?>)</span>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php foreach ($usersinfo as $row) {
            $stmtprofilehomeshow = $con->prepare("SELECT * FROM `profile` WHERE `_userid` = '$row[_id]' ");
            $stmtprofilehomeshow->execute();
            $contsprofile = $stmtprofilehomeshow->rowCount();
            $usersprofileinfo = $stmtprofilehomeshow->fetch();
        ?>
            <div class="col-md-4 col-lg-3">
                <div class="card profile-card-3">
                    <div class="background-block">
                        <img src="<?php
                                    if ($usersprofileinfo['_cover'] != '') {
                                        echo 'media/img/users/profile/'.$usersprofileinfo['_cover'];
                                    } else {
                                        echo 'media/img/users/profile/cover.jpg';
                                    }
                                    ?>" alt="profile-sample1" class="background" />
                    </div>
                    <div class="profile-thumb-block">
                        <img src="<?php
                                    if ($usersprofileinfo['_img'] != '') {
                                        echo 'media/img/users/profile/'.$usersprofileinfo['_img'];

                                    } else {
                                        if ($row['_sex'] == 'male') {
                                            echo 'media/img/users/profile/male.png';
                                        } else {
                                            echo 'media/img/users/profile/female.png';
                                        }
                                    }
                                    ?>" alt="profile-image" class="profile" />
                    </div>
                    <div class="card-content">
                        <a href="users?o=user&id=<?php echo $row['_id'] ?>">
                            <h2><?php echo $row['_name'] ?>
                        </a>
                        <small><?php
                                echo $row['_username'];
                                if ($row['_verified'] == 'yes') { ?>

                                <i class="fa fa-check" aria-hidden="true" style="color: #9a3bff" title="<?php echo lang('حـسـاب مـوثـق', 'Certified account') ?>"></i>
                            <?php                 }                 ?>
                        </small></h3>
                        <div class="icon-block"><?php echo lang($row['_aruniversity'], $row['_enuniversity']) . ' ' ?> -
                            <?php echo lang($row['_arcollege'], $row['_encollege']) . ' ' ?> -
                            <?php echo lang($row['_arsection'], $row['_ensection']) . ' ' ?> -
                            <?php echo $row['_batch'] ?>
                        </div>

                    </div>
                </div>
                <p class="mt-3 w-100 float-left text-center"><strong></strong></p>
            </div>
        <?php } ?>
    </div>
</div>