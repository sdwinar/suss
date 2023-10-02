<link rel="stylesheet" href="css/04usersshow.css">

<body style="background:url(media/img/home/bodyimgdark.jpg);background-size:cover">
    <section id="alusershowrowdiv" dir="<?php echo lang('rtl', 'ltr') ?>" style="    padding: 5px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 col-lg-3">
                    <div class="card card-body shadow cpdiv">

                        <form id="usersearchform" action="" method="post" >
                            <input autofocus id="usersbyname" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang(' بحث بواسطة الاسم', 'Search By Name') ?>">

                            <input id="usersbyusername" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang(' بحث بواسطة إسم المعرف', 'Search By username') ?>">

                            <input id="usersbyaddress" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang(' بحث بواسطة العنوان', 'Search By Address') ?>">

                            <input id="usersbyuniversity" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang('بحث بواسطة الجامعة', 'Search By University') ?>">
                           
                            <input id="usersbycollege" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang('بحث بواسطة الكلية', 'Search By college') ?>">
                          
                            <input id="usersbysection" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang('بحث بواسطة القسم', 'Search By Section') ?>">
                           
                         
                            <input id="usersbybatch" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang('بحث بواسطة الدفعة', 'Search By Section') ?>">

                            <input id="usersbyunnum" type="text" class="cpinput form-input my_input" placeholder="<?php echo lang(' بحث بواسطة الرقم الجامعي', 'Search By University ID') ?>">
                                  
                            <select name="regtype" id="usersbyregester" style="    width: 100%;    background: no-repeat;    font-weight: 700;    margin: 10px 0px;">
                                <option value=""><?php echo lang('نوع التسجيل','Regester Type') ?></option>
                                <option value="Student"><?php echo lang('طـألب','Student') ?></option>
                                <option value="professor"><?php echo lang('استاذ','Tatcher') ?></option>
                            </select>
                                    <button class="btn btn-success" id="btnusersearch" style="width: 100%"  type="submit">
                                     <?php echo lang('بـحـث','Search')  ?>   <i class="fa fa-search"></i>         </button>
                        </form>

                    </div>
                </div>
                <div class="col-8 col-lg-9">
                    <div class="card card-body shadow cpdiv">

                        <div id="allusershowdiv"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container h-100" style="padding: 0px 0px 19px 0px;">
        </div>
    </section>
</body>