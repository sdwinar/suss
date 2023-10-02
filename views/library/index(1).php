<link rel="stylesheet" href="css/cpanel.css">
<div id="libcontiner" class="container-fluid">
    <div class="row">



        <div class="col-lg-2 col-md-3 col-sm-6">
            <div class="card card-body shadow cpdiv">
                <form class="text-center">
                    <div class="input-group mb-2" id="leclibershow">
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan"><i
                                    class="fas fa-book"></i>
                                <?php echo lang('ملفات السمستر', 'U S E R S') ?></span></a>
                    </div>
                    <div class="input-group mb-2" id="Workingpapers">
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan">
                        <i class="fa fa-file"></i><?php echo '  ' . lang('اوراق عــــمـــــــــل', 'Working papers') ?></span></a>
                    </div>
                    <div class="input-group mb-2" id="videoclip">
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan">
                        <i class="fa fa-film"></i><?php echo '  ' . lang('مـقـاطــع الـفديو', 'Video clips') ?></span></a>
                    </div>
                    <div class="input-group mb-2" id="yourfiles" data-myid="<?php echo $myid ?>" >
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan">
                        <i class="fa fa-list"></i><?php echo '  ' . lang('مــــلـــفـــــاتــــــــك', 'Your files') ?></span></a>
                    </div>
                    <div class="input-group mb-2" id="searchlib">
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan">
                        <i class="fa fa-search"></i><?php echo '  ' . lang('بـــــــــــحــــــــــــــث', 'Searsh') ?></span></a>
                    </div>
                    <div class="input-group mb-2" id="btnaddfile">
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan"><i
                                    class="fa fa-upload"></i><?php echo ' ' . lang('إضـافــــة مـلــــف', 'Add file') ?></span></a>
                    </div>
                    <div class="input-group mb-2" id="addfilm">
                        <a class=" homesidebara " href="#"><span style="font-size: 89%;" class=" homesidebarspan"><i
                                    class="fa fa-video"></i><?php echo ' ' . lang('تـضــمـين فـديــو', 'Include a video') ?></span></a>
                    </div>
                    <div class="deatalsrusalt">
                    </div>
                </form>
            </div>
        </div>

        <div id="libmaincpdiv" class="col-lg-8 col-md-7 col-sm-6 shadow cpdiv"></div>
        <div class="col-lg-2 col-md-2 col-sm-6">
            <div class="card card-body shadow cpdiv sideleftbar">
         
            </div>
        </div>
    </div>