<?php
if (isset($_SESSION['zoool']) && $_SESSION['zoool'] == $userinfo['_id']) { ?>


<hr>
<style>
.input_text{
    background: none;
    border: none;
    border-bottom: 1px solid blue;
    border-radius: 11%;
    color: antiquewhite;
    font-weight: bold;
}
</style>

<body dir="<?php echo lang('rtl','ltr') ?>" style="background-color: black">
<span id="successdone" style="display: none"><?php echo lang('تم التعديل بنجاح','Edite Done succsessfully')?></span>

    <div class="container divtheam">
        <div class="row">

            <div class="col-4 filtertheam">

                <img src="<?php
                      if ($myprofileinfo['_img'] != '') {
                        echo 'media/img/users/profile/'.$myprofileinfo['_img'];
                      } else {
                        if ($userinfo['_sex'] == 'male') {
                          echo 'media/img/users/profile/male.png';
                        } else {
                          echo 'media/img/users/profile/female.png';
                        }
                      }
                      ?>" alt="" width="100%" style="    max-height: 50vh;min-height: 50vh;">
            </div>
            <div class="col-8 ">
                <div class="page-header-image filtertheam" data-parallax="true" style="    max-height: 50vh;
    min-height: 50vh;background-image:url('<?php echo $myprofileinfo['_cover'] != '' ? 'media/img/users/profile/'.$myprofileinfo['_cover'] : 'media/img/users/profile/cover.jpg'   ?>');
                    background-size: cover;    width: 108% !important;    height: 100% !important;">.
                </div>
            </div>
        </div>
    </div>
    <div class="container divdark">
        <div class="row">
            <div class="col-12" id="avtarrusalt"></div>

            <div class="col-4 col-lg-1 col-md-2">
                <label for="editeprofileavatar" style="cursor: pointer">
                    <span class="badge badge-success"><i class="fa fa-edit"></i>
                        <?php echo lang('تعديل الصورة','Edit Avatar') ?></span>
                </label>
            </div>

            <form id="formrditavtar" action="models/users/01editprofile" method="post" enctype="multipart/form-data">
                <input type="file" name="profileavatar" id="editeprofileavatar" style="display: none">
                <div class="col-4 col-lg-1 col-md-2">
                    <input name="sendavatar" class="btn btn-info" type="submit"
                        style="padding: 0px 36px; font-weight: 500;font-size: 12px;"
                        value="<?php echo lang('حفظ','Save') ?>">
                </div>
                <div id="avtarrusalt"></div>
            </form>
            <div class="col-4 col-lg-1 col-md-2">
                <label for="editeprofilecover" style="cursor: pointer">
                    <span class="badge badge-success"><i class="fa fa-edit"></i>
                        <?php echo lang('تعديل الغلاف','Edit Cover') ?></span>
                </label>
            </div>
            <form id="formrditcover" action="models/users/01editprofile" method="post" enctype="multipart/form-data">
                <input type="file" name="profilecover" id="editeprofilecover" style="display: none">
                <div class="col-4 col-lg-1 col-md-2">
                    <input name="sendcover" class="btn btn-info" type="submit"
                        style="padding: 0px 36px;    font-weight: 500;font-size: 12px;"
                        value="<?php echo lang('حفظ','Save') ?>">
                                        </div>
                <div id="avtarrusalt"></div>
            </form>
            <div class="col-12 col-lg-12 col-md-12">
                <span class="badge badge-info" id="setuserimg"></span>
            </div>
        </div>
    </div>

    <div class="sty" style="margin-top: 20px;border-radius: 5%;border:2px solid blue;padding: 5px 0px;">
        <form id="formeditinfo" action="models/users/01editprofile" method="post">

            <div class="container">
                <div class="row">

    <div class="col-6 col-lg-3" >
    <label class="badge badge-success" for="name" style="width: 100%"><?php echo lang('الاســـم','Name') ?></label>
</div>
    <div class="col-6 col-lg-3" >
<input class="input_text"  type="text" name="name" id="name" style="width: 100%" value="<?php echo $userinfo['_name'] ?>">
</div>
<div class="col-6 col-lg-3" >
    <label class="badge badge-success" for="address" style="width: 100%"><?php echo lang('الـعـنـوان','Address') ?></label>
</div>
    <div class="col-6 col-lg-3">
<input class="input_text"  type="text" name="address" id="address" style="width: 100%"value="<?php echo $userinfo['_address'] ?>">
</div>
<div class="col-6 col-lg-3" >
    <label class="badge badge-success" for="about" style="width: 100%"><?php echo lang('نبذة عنك','About you') ?></label>
</div>
    <div class="col-6 col-lg-9">
<input class="input_text"  type="text" name="about" id="about" style="width: 100%"value="<?php
 echo $myprofileinfo['_About']==''? lang('لاتوجد نبذة عنك','There is no information about you'): $myprofileinfo['_About'] ?>">
</div>

<div class="col-6 col-lg-3" >
    <label class="badge badge-success" for="oldpass" style="width: 100%"><?php echo lang('كلمة المرورو الحالية','Current Password') ?></label>
</div>
    <div class="col-6 col-lg-3" >
<input class="input_text"  type="password" name="oldpass" id="oldpass" style="width: 100%" >
</div>
<div class="col-6 col-lg-3" >
    <label class="badge badge-success" for="newpass" style="width: 100%"><?php echo lang('كلمة المرورو الجديدة','New Password') ?></label>
</div>
    <div class="col-6 col-lg-3">
<input class="input_text"  type="password" name="newpass" id="newpass" style="width: 100%">
</div>

<div class="col-1 col-lg-3"></div>
<div class="col-10 col-lg-6" style="padding: 10px 0px;">
<button  name="info" class="btn btn-info"  type="submit" style="width: 100%;font-weight: bold;">
   <?php echo lang('حفظ','Save')  ?> <i class="fa fa-save" style="margin: 0px 5px;"></i></button>
<div class="col-1 col-lg-3"></div>
                </div>
                
            </div>
        </form>





















</body>

<?php
}
?>