<style>
nav>.nav.nav-tabs {

    border: none;
    color: #fff;
    background: #272e38;
    border-radius: 0;

}

nav>div a.nav-item.nav-link,
nav>div a.nav-item.nav-link.active {
    border: none;
    padding: 18px 25px;
    color: #fff;
    background: #272e38;
    border-radius: 0;
}

nav>div a.nav-item.nav-link.active:after {
    content: "";
    position: relative;
    bottom: -60px;
    left: -10%;
    border: 15px solid transparent;
    border-top-color: #e74c3c;
}

.tab-content {
    background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top: 5px solid #e74c3c;
    border-bottom: 5px solid #e74c3c;
    padding: 30px 25px;
}

nav>div a.nav-item.nav-link:hover,
nav>div a.nav-item.nav-link:focus {
    border: none;
    background: #e74c3c;
    color: #fff;
    border-radius: 0;
    transition: background 0.20s linear;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-12" id="monaresultdiv"></div>
        <div class="col-12 ">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"><?php echo lang('مـنـشـورات الـمـنـسـق', 'Coordinator Post') ?></a>
                    <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false"><?php // echo lang('مـنـشـورات الدكاترة', "Doctors' Post") ?></a> -->
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact"
                        aria-selected="false"><?php echo lang('الـمـنـسـق', 'Coordinator') ?></a>
                    <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab"
                        aria-controls="nav-about"
                        aria-selected="false"><?php echo lang('اخـتـيـار الـمـنـسـق', 'Choose  Coordinator') ?></a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div style="    width: 100%;" class="tab-pane fade show active" id="nav-home" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    <?php include_once '01monapost.php' ?>
                    <!-- ******************************************************بحث منشورات المنسق******************************************************* -->

                    <div class="continer">
                        <div class="row">

                            <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
                            <div class="col-12 col-lg-6 col-md-6 ">
                                <nav aria-label="Page navigation example text-center">
                                    <ul class="pagination">
                                        <div class="container h-100" style="padding: 0px 0px 19px 0px;">
                                            <div class="d-flex justify-content-center h-100">
                                                <div class="searchbar">
                                                    <form id="monapostsershform" action="">
                                                    <input class="search_input text-center" type="text"
                                                        id="monapostsersh"
                                                        placeholder="<?php echo lang('بحث ', 'Search') ?>">
                                                        <!-- <input type="submit" value=""> -->
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
                        </div>
                    </div>
                    <div id="monapostreusalt"></div>

                    <!-- ******************************************************تعدد الصفحات******************************************************* -->
                    <?php
                    $stmtsmon410 = $con->prepare("SELECT * FROM `mon_posts`
                       WHERE `_un` = '$myun' && `_col` = '$mycol' && `_sec` = '$mysec' && `_bach` = '$mybach' && `_cer` = '$mycer'&& `stu_or_tech` = 1
                       ORDER BY `_id` DESC ");
                    $stmtsmon410->execute(array());
                    $postall = $stmtsmon410->fetchAll();
                    $postallnum = $stmtsmon410->rowCount();

                    $totalpage = ceil($postallnum / 10);

                    ?>
                    <div class="continer">
                        <div class="row">

                            <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
                            <div class="col-12 col-lg-6 col-md-6 ">
                                <nav aria-label="Page navigation example text-center">
                                    <ul class="pagination">
                                        <?php
                                        for ($i = 1; $i <= $totalpage; $i++) { ?>
                                        <li class="page-item123"><a class="page-link page123" href="#"><?php 
                                        echo $i;
                                        ?></a></li>
                                        <?php
                                        }
                                        ?>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
                        </div>
                    </div>
                    
                    <!-- ******************************************************تعدد الصفحات******************************************************* -->


                </div>

                <!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <?php //echo lang('مـنـشـورات الاسـاتـذة', "Doctors' Post") ?>
                </div> -->

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                </div>

                <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                </div>

            </div>


        </div>
 
