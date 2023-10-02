<?php
include "connect.php";
include "function.php";
include "lang.php";

if (isset($_POST['btnlog'])) {
    $username =$_POST['usernamelog'];
    $pass =$_POST['passlog'];
    $newpass = sha1($pass . '@%00&#$%@@@@$*');

    $stmtlog = $con->prepare("SELECT * FROM `users` WHERE	`_username` = ? && `_password`= ?");
    $stmtlog->execute(array($username, $newpass));
    $conts = $stmtlog->rowCount();
    $userinfo = $stmtlog->fetch();

    if ($conts == 0) { ?>
        <div class="alert alert-warning alert-dismissible fade show <?php echo lang('text-right', 'text-left') ?>" role="alert" style="font-size: 11px !important;font-weight: bold !important;margin: 0px 3px 0px -36px;">
            <?php echo lang("<strong> معذراً!</strong> ... إسم المستخدم او الإيميل غير متطابق مع كلمة المرور", "<strong> Sorri!</strong> ...fun faild"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: -53px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }elseif($userinfo['_active']=='no'){?>
        <div class="alert alert-primary alert-dismissible fade show <?php echo lang('text-right', 'text-left') ?>" role="alert" style="font-size: 11px !important;font-weight: bold !important;margin: 0px 3px 0px -36px;">
            <?php echo lang("<strong> معذراً!</strong> ... الرجاء تفقد الايميل الخاص بك  لتفعيل حسابك", "<strong> Sorri!</strong> ...fun faild"); ?>
    <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: -53px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    }else{
        $_SESSION['zoool']=$userinfo['_id'];
        $_SESSION['_admin']=$userinfo['_admin'];
        ?>
                <div class="alert alert-success alert-dismissible fade show <?php echo lang('text-left', 'text-right') ?>" role="alert" style="font-size: 11px !important;font-weight: bold !important;margin: 0px 3px 0px -36px;">
            <?php echo lang("<strong> تم!</strong> ... جاري تسجيل الدخول", "<strong> Sorri!</strong> ...fun faild"); ?>
            <script>
            var t = 0;
            log = setInterval(function(){
                t++
                if(t==2){
                    window.location = ""
                }
            },500)

        </script>
        <?php
          exit();
    }

}
?>