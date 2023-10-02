<?php
$stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_choose` WHERE `_voited`=$_SESSION[zoool] LIMIT 1");
    $stmtremon_choose_ver->execute();
    $me_verinfo = $stmtremon_choose_ver->fetch();

    if($me_verinfo['_ismonsig']=='yes'){?>
<div class="container">
    <div class="row">
        <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
        <div class="col-12 col-lg-6 col-md-6">
            <form id="newmonapostform" action="models/monasig/03monapost" method="get">

                <textarea autofocus name="monapost" id="monaposttext" class="form-input cpinput" rows="3"
                    placeholder="<?php echo lang('منشور جديد', 'New Post') ?>" style="width:100%;">
            </textarea>
                <br />
                <div class="col-md-12">
                    <label class="btn btn-light" style="    background: #b55252;">
                        <input type="radio" class="form-switch radio_2set registration_type" name="post_type"
                            value="1" gl2="1" data-id="a"><?php echo lang("مهم", "Important") ?></label>
                    <label class="btn btn-light" style="    background: #f9ac80;">
                        <input type="radio" class="form-switch radio_2set registration_type" name="post_type"
                            value="2" gl2="2" data-id="b"><?php echo lang("عادي", "Normal") ?></label>
                    <label class="btn btn-light" style="    background: beige;">
                        <input type="radio" class="form-switch radio_2set registration_type" name="post_type"
                            value="3" gl2="3" data-id="b"><?php echo lang("للعلم", "For science") ?></label>
                </div>
                <input type="hidden" name="order" value="isadmin">
                <div id="monapostdiv"></div>
                <button id="sendmonapost" name="sendmonapost" style="width:100%;" class="btn btn-dark"
                    type="submit"><?php echo lang("نــشــــر", "Post") ?></button>
                    <hr>
           
            </form>

        </div>
        <div class="col-3 d-none d-sm-block" style="opacity: 0;">.</div>
     



    </div>
</div>

<?php }
?>