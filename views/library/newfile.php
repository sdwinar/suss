<?php
include "../../models/main/connect.php";
include "../../models/main/lang.php";
include "../../models/main/function.php";
?>
<style>
.in {
    width: 85%;
    margin: 3px -2px;
    padding: -1px !important;
    border: none;
    background: #343a4085;
    border-bottom: 1.5px solid red;
    border-radius: 15%;
    color: wheat;
    font-weight: bold;
}
</style>

<?php
if ($userinfo['_verified'] == 'yes') {
    if (isset($_GET['type']) && $_GET['type'] == 'file') {
?>

<button style="opacity: 0" class=" col-lg-1 col-md-1 col-sm-12">.</button>
<span style="margin-top: 5px"
    class="btn btn-success col-lg-10 col-md-10 col-sm-12"><?php echo ' ' . lang('إضافة ملف', 'Add file') ?></span>
<button style="opacity: 0" class=" col-lg-1 col-md-1 col-sm-12">.</button>

<form id="libfileaddform" action="models/library/02fileadd" method="post" enctype="multipart/form-data">
    <input autofocus class="col-sm-12 col-lg-4 col-md-4 in" type="text" name="file"
        placeholder="<?php echo lang("إسم الملف", "Name of the file") ?>">

    <input class="col-sm-12 col-lg-4 col-md-4 in" type="text" name="subject"
        placeholder="<?php echo lang("إسم المادة", "Name of the Subject") ?>">

    <input class="col-sm-12 col-lg-4 col-md-4 in" type="text" name="semester"
        placeholder="<?php echo lang("السمستر", "Semester") ?>">
    <?php
            $stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_choose` WHERE `_voited`=$_SESSION[zoool] LIMIT 1");
            $stmtremon_choose_ver->execute();
            $me_verinfo = $stmtremon_choose_ver->fetch();
            if ($me_verinfo['_ismonsig'] == 'yes') { ?>
    <select style="cursor: pointer" class="col-sm-12 col-lg-4 col-md-4 in" name="filetype" id="">
        <option value="lecfile"><?php echo lang("ملف محاضرة", "Lecture file") ?></option>
        <option value="perer"><?php echo lang("ورقة عمل", "Worksheet") ?></option>
    </select>
    <?php } else {
            ?>
    <input type="hidden" name="filetype" value="perer">
    <?php
            } ?>
    <label style="cursor: pointer" class="col-sm-12 col-lg-4 col-md-4 in" for="uplodfile"><i
            class="fa fa-upload"></i><?php echo ' ' . lang("تحديد الملف", "Select file") ?></label>
    <input type="file" style="display: none" name="uplodfile" id="uplodfile">
    <center>
        <div id="addfilelecrusalt"></div>
    </center>
    <center>
        <input name="sendlecfile" class="btn btn-info" type="submit"
            style="padding: 0px 36px;margin: 13px 0px; font-weight: 500;font-size: 12px;"
            value="<?php echo lang('حفظ', 'Save') ?>">
    </center>

</form>
<?php
    } elseif (isset($_GET['type']) && $_GET['type'] == 'film') {?>
<!-- // ******************************تضمين فديو******************************************************** -->
<button style="opacity: 0" class=" col-lg-1 col-md-1 col-sm-12">.</button>
<span style="margin-top: 5px"
    class="btn btn-success col-lg-10 col-md-10 col-sm-12"><?php echo ' ' . lang('تضمين فديو من يوتيوب', 'Embed a video from YouTube') ?></span>
<button style="opacity: 0" class=" col-lg-1 col-md-1 col-sm-12">.</button>

<form id="libvideoaddform" action="models/library/02fileadd" method="post" enctype="multipart/form-data">
    <input autofocus class="col-sm-12 col-lg-4 col-md-4 in" type="text" name="film"
        placeholder="<?php echo lang("إسم المقطع", "Name of the video") ?>">

    <input class="col-sm-12 col-lg-4 col-md-4 in" type="text" name="subject"
        placeholder="<?php echo lang("إسم المادة", "Name of the Subject") ?>">

    <input class="col-sm-12 col-lg-4 col-md-4 in" type="text" name="semester"
        placeholder="<?php echo lang("السمستر", "Semester") ?>">

        
    <input style="width: 100%" class="col-sm-12 col-lg-12 col-md-12 in" type="text" name="url"
        placeholder="<?php echo lang("عنوان URL", "URL") ?>">

    <center>
        <div id="addvideolecrusalt"></div>
    </center>
    <center>
        <input name="sendlecvideo" class="btn btn-info" type="submit"
            style="padding: 0px 36px;margin: 13px 0px; font-weight: 500;font-size: 12px;"
            value="<?php echo lang('تـضمين الفديو', 'Embed a video') ?>">
    </center>

</form>




<?php        }} else { ?>

<span style="margin-top: 5px"
    class="btn btn-success col-lg-12 col-md-12 col-sm-12"><?php echo ' ' . lang('قم بتوثيق حسابك لإضافة ملفات او فديو للمكتبة', 'Verify your account to add files or video to the library') ?></span>

<?php    }
?>

<script>
// ******************************غضافة ملف جديد****************************
$(function() {
    $("#libfileaddform").ajaxForm({
        beforeSend: function() {
            $("#addfilelecrusalt").html(
                "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
            );
        },
        success: function(data) {
            $("#addfilelecrusalt").html(data);
        },
        error: function() {
            var erorr = $("#conecterorr").text();
            alert(erorr)
        }
    });
});
// ******************************غضافة video جديد****************************
$(function() {
    $("#libvideoaddform").ajaxForm({
        beforeSend: function() {
            $("#addvideolecrusalt").html(
                "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
            );
        },
        success: function(data) {
            $("#addvideolecrusalt").html(data);
        },
        error: function() {
            var erorr = $("#conecterorr").text();
            alert(erorr)
        }
    });
});
</script>