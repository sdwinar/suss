<link rel="stylesheet" href="css/cpanel.css">

<body style="background:url(media/img/home/bodyimgdark.jpg);background-size:cover">
    <div class="container" style="margin-top: 10px;">
        <div class="row" dir="<?php echo lang("rtl","ltr") ?>">
            <div class="col-lg-2 col-md-3 col-12 homesidebardiv" style="height: 88vh !important;">
                <div class="card card-body shadow cpdiv">
                    <form class="text-center">
                        <div class=" input-group mb-3  <?php echo !isset($_GET['tab'])?"activecp":"" ?>">
                            <a id="cpusers" class=" homesidebara " href="#"><span class=" homesidebarspan"><i
                                        class="fa fa-users"></i>
                                    <?php echo lang('المـســتـخـدمـيـن','U S E R S')?></span></a>
                        </div>
                        <div id="cpnot"
                            class="input-group mb-2 <?php echo isset($_GET['tab']) && $_GET['tab']=="notafigation"?"activecp":"" ?>">
                            <a class=" homesidebara " href="#"><span class=" homesidebarspan"><i class="fa fa-user"></i>
                                    <?php echo lang('طلبات التفعيل','Verification requests')?>
                                    <span class="badge badge-warning" id="notbill"
                                        style="padding: 5px;"></span></span></a>
                        </div>
                        <div class="input-group mb-2">
                            <a class=" homesidebara " href="#"><span class=" homesidebarspan"><i class="fa fa-user"></i>
                                    <?php echo lang('الــــطـــــــلابــــــــ','Prpfile')?></span></a>
                        </div>
                        <div class="deatalsrusalt">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-12" style="height: 88vh !important;">
                <div class="card card-body divtheam shadow maincpdiv cpdiv"></div>
            </div>
            <div class="col-lg-2 col-md-3 col-12" style="height: 88vh !important;">
                <div class="card card-body divtheam shadow sidecpdiv cpdiv"></div>
            </div>
        </div>
    </div>
</body>