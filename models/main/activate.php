<?php
include "connect.php";
include "lang.php";
include "function.php";

if (isset($_GET['username']) && isset($_GET['key'])) {
    $username = mksave($_GET['username']);
    $key = mksave($_GET['key']);
    $stmtactive = $con->prepare("SELECT * FROM `users` WHERE `_username` =  '$username' && `_activation`= '$key' ");
    $stmtactive->execute();
    $conts = $stmtactive->rowCount();
    $userinfo = $stmtactive->fetch();

    if($conts>0){
        $settheam = $con->prepare("UPDATE `users` SET `_active` = 'yes' WHERE `users`.`_username` = '$username'");
        $settheam->execute();

        $_SESSION['zoool']=$userinfo['_id'];
        $_SESSION['_admin']=$userinfo['_admin'];
        echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
        <?php echo lang("<strong> تم!</strong> ... تم تفعيل حسابك بنجاح", "<strong> Done!</strong> ...Your account has been successfully activated"); ?>
        <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        ?>
                    <script>
            var t = 0;
            log = setInterval(function(){
                t++
                if(t==2){
                    window.location = "../../"
                }
            },500)

        </script>
        <?php
                    exit();
    }else{
        echo '<center>'. lang('عفوا بيانات غير صحيحة','Sorry, incorrect data').'</center>';

    }
    
}
?>