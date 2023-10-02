<?php
include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";


if ((isset($_SESSION['zoool']))) {
    $mybatch = $batch_of_me;
?>
<link rel="stylesheet" href="css/lecture.css">
<span id="editename" style="opacity: 0"><?php echo lang('تعديل يوم' . ' ', 'Edit').' '; ?></span>
<h6 class="section-title h1"><?php echo lang('جــدول الـمــحـاضـرات' . ' ', 'Lecture schedule'); ?></h6>
<center>
<h6 class="h6" style="color: aqua;"><?php echo lang($userinfo['_arsection'], $userinfo['_ensection'] ) . ' - '.$userinfo['_batch']; ?></h6>
</center>
<hr>
<div class="row">
    <div class="col-12 col-xs-12">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-home-lectures" role="tablist">
                <a data-day="Sat" class="nav-item nav-link <?php echo date("D")=='Sat'? 'active':'' ?>" id="nav-home-tab" data-toggle="tab" href="#nav-sat" role="tab"
                    aria-controls="nav-home" aria-selected="true"><?php echo lang('الـســبـت' . ' ', 'Saturday'); ?></a>
                <a data-day="Sun" class="nav-item nav-link <?php echo date("D")=='Sun'? 'active':'' ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-sun" role="tab"
                    aria-controls="nav-profile"
                    aria-selected="false"><?php echo lang('الاحـــد' . ' ', 'Sunday'); ?></a>
                <a data-day="Mon" class="nav-item nav-link <?php echo date("D")=='Mon'? 'active':'' ?>" id="nav-contact-tab" data-toggle="tab" href="#nav-mon" role="tab"
                    aria-controls="nav-contact"
                    aria-selected="false"><?php echo lang('الاثـنـيــن' . ' ', 'Monday'); ?></a>
                <a data-day="Tue" class="nav-item nav-link <?php echo date("D")=='Tue'? 'active':'' ?>" id="nav-about-tab" data-toggle="tab" href="#nav-tuth" role="tab"
                    aria-controls="nav-about"
                    aria-selected="false"><?php echo lang('الـثـلاثـاء' . ' ', 'Tuesday'); ?></a>
                <a data-day="Wed" class="nav-item nav-link <?php echo date("D")=='Wed'? 'active':'' ?>" id="nav-about-tab" data-toggle="tab" href="#nav-wen" role="tab"
                    aria-controls="nav-about"
                    aria-selected="false"><?php echo lang('الاربــعــاء' . ' ', 'Wednesday'); ?></a>
                <a data-day="Thu" class="nav-item nav-link <?php echo date("D")=='Thu'? 'active':'' ?>" id="nav-about-tab" data-toggle="tab" href="#nav-thr" role="tab"
                    aria-controls="nav-about"
                    aria-selected="false"><?php echo lang('الـخـمـيـس' . ' ', 'Thursday'); ?></a>
            </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane <?php echo date("D")=='Sat'? 'show active':'fade' ?>" id="nav-sat" role="tabpanel" aria-labelledby="nav-home-tab"
                style="width: 100%">
                <!-- *******************************************************satrday******************************************************************** -->
                <?php
					$stmtsat = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = 'sat' ");
					$stmtsat->execute(array());
					$satinfo = $stmtsat->fetch();
					?>
                <div class="container">
                    <div class="row">
                        <!--lec-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=1"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec1'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec1hall'] ?></h6>
                                    <p style="color: black">
                                        <?php echo $satinfo['_lec1star'].' -'.' '.$satinfo['_lec1end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-1-->
                        <!--lec-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=2"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec2'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec2hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec2star'].' -'.' '.$satinfo['_lec2end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-2-->
                        <!--lec-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=3"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec3'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec3hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec3star'].' -'.' '.$satinfo['_lec3end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-3-->
                        <!--lec-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=4"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec4'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec4hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec4star'].' -'.' '.$satinfo['_lec4end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-4-->

                    </div>
                </div>
            </div>
            <div class="tab-pane <?php echo date("D")=='Sun'? 'show active':'fade' ?>" id="nav-sun" role="tabpanel" aria-labelledby="nav-profile-tab"
                style="width: 100%">
                                <!-- *******************************************************sunrday******************************************************************** -->
                                <?php
					$stmtsat = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = 'sun' ");
					$stmtsat->execute(array());
					$satinfo = $stmtsat->fetch();
					?>
                <div class="container">
                    <div class="row">
                        <!--lec-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=1"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec1'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec1hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec1star'].' -'.' '.$satinfo['_lec1end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-1-->
                        <!--lec-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=2"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec2'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec2hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec2star'].' -'.' '.$satinfo['_lec2end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-2-->
                        <!--lec-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=3"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec3'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec3hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec3star'].' -'.' '.$satinfo['_lec3end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-3-->
                        <!--lec-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=4"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec4'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec4hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec4star'].' -'.' '.$satinfo['_lec4end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-4-->

                    </div>
                </div>
            </div>
            <div class="tab-pane <?php echo date("D")=='Mon'? 'show active':'fade' ?>" id="nav-mon" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <!-- *******************************************************monrday******************************************************************** -->
                                <?php
					$stmtsat = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = 'mon' ");
					$stmtsat->execute(array());
					$satinfo = $stmtsat->fetch();
					?>
                <div class="container">
                    <div class="row">
                        <!--lec-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=1"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec1'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec1hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec1star'].' -'.' '.$satinfo['_lec1end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-1-->
                        <!--lec-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=2"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec2'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec2hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec2star'].' -'.' '.$satinfo['_lec2end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-2-->
                        <!--lec-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=3"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec3'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec3hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec3star'].' -'.' '.$satinfo['_lec3end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-3-->
                        <!--lec-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=4"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec4'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec4hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec4star'].' -'.' '.$satinfo['_lec4end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-4-->

                    </div>
                </div>
            </div>
            <div class="tab-pane <?php echo date("D")=='Tue'? 'show active':'fade' ?>" id="nav-tuth" role="tabpanel" aria-labelledby="nav-about-tab">
                                <!-- *******************************************************tuerday******************************************************************** -->
                                <?php
					$stmtsat = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = 'tue' ");
					$stmtsat->execute(array());
					$satinfo = $stmtsat->fetch();
					?>
                <div class="container">
                    <div class="row">
                        <!--lec-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=1"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec1'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec1hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec1star'].' -'.' '.$satinfo['_lec1end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-1-->
                        <!--lec-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=2"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec2'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec2hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec2star'].' -'.' '.$satinfo['_lec2end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-2-->
                        <!--lec-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=3"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec3'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec3hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec3star'].' -'.' '.$satinfo['_lec3end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-3-->
                        <!--lec-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=4"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec4'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec4hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec4star'].' -'.' '.$satinfo['_lec4end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-4-->

                    </div>
                </div>
            </div>
            <div class="tab-pane <?php echo date("D")=='Wed'? 'show active':'fade' ?>" id="nav-wen" role="tabpanel" aria-labelledby="nav-about-tab">
                                <!-- *******************************************************wedrday******************************************************************** -->
                                <?php
					$stmtsat = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = 'wed' ");
					$stmtsat->execute(array());
					$satinfo = $stmtsat->fetch();
					?>
                <div class="container">
                    <div class="row">
                        <!--lec-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=1"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec1'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec1hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec1star'].' -'.' '.$satinfo['_lec1end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-1-->
                        <!--lec-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=2"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec2'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec2hall'] ?></h6>
                                    <p style="color: black">
                                        <?php echo $satinfo['_lec2star'].' -'.' '.$satinfo['_lec2end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-2-->
                        <!--lec-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=3"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec3'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec3hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec3star'].' -'.' '.$satinfo['_lec3end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-3-->
                        <!--lec-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=4"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec4'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec4hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec4star'].' -'.' '.$satinfo['_lec4end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-4-->

                    </div>
                </div>
            </div>
            <div class="tab-pane <?php echo date("D")=='Thu'? 'show active':'fade' ?>" id="nav-thr" role="tabpanel" aria-labelledby="nav-about-tab">
                                <!-- *******************************************************thurday******************************************************************** -->
                                <?php
					$stmtsat = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$mybatch' && `_day` = 'thu' ");
					$stmtsat->execute(array());
					$satinfo = $stmtsat->fetch();
					?>
                <div class="container">
                    <div class="row">
                        <!--lec-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=1"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec1'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec1hall'] ?></h6>
                                    <p style="color: black">
                                        <?php echo $satinfo['_lec1star'].' -'.' '.$satinfo['_lec1end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-1-->
                        <!--lec-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=2"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec2'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec2hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec2star'].' -'.' '.$satinfo['_lec2end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-2-->
                        <!--lec-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=3"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec3'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec3hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec3star'].' -'.' '.$satinfo['_lec3end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-3-->
                        <!--lec-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="our-team-main">

                                <div class="team-">
                                    <img style="margin-top: 5px" src="http://placehold.it/110x110/9c27b0/fff?text=4"
                                        class="img-fluid" />
                                    <h3 style="color: black"><?php echo $satinfo['_lec4'] ?></h3>
                                    <h6 style="color: black"><?php echo $satinfo['_lec4hall'] ?></h6>

                                    <p style="color: black">
                                        <?php echo $satinfo['_lec4star'].' -'.' '.$satinfo['_lec4end'] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--lec-4-->

                    </div>
                </div>
            </div>
        </div>
            </div>
</div>
<?php
$stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_choose` WHERE `_voited`=$_SESSION[zoool] LIMIT 1");
    $stmtremon_choose_ver->execute();
    $me_verinfo = $stmtremon_choose_ver->fetch();

    if($me_verinfo['_ismonsig']=='yes'){?>
    <center>
    <button id="editlec" data-id="<?php
    if(date('D')=='Sat'){
        echo 'sat';
    }elseif(date('D')=='Sun'){
        echo 'sun';
    }elseif(date('D')=='Mon'){
        echo 'Mon';
    }elseif(date('D')=='Thu'){
        echo 'Thu';
    }elseif(date('D')=='Wed'){
        echo 'Wed';
    }elseif(date('D')=='Tue'){
        echo 'Tue';
    }
    ?>" type="button" class="btn btn-primary"><i class="fa fa-edit"></i>
    <?php echo lang('تـعـديل الجدول' . ' ', 'Edit schedule'); ?></button>
    </center>


    <?php
    }
    ?>



<script src="js/fromlec.js"></script>





<?php
} //isset$_SESSION['zoool']



?>