<?php
include "models/main/connect.php";
include "models/main/function.php";
include "models/main/lang.php";
include "views/main/head.php";

?>

<body>
    <?php
    if (isset($_SESSION['zoool'])) {
    ?>
        <?php
        $this_is_user = 0;
        if (isset($_GET['o']) && $_GET['o'] == 'profile') {
            $headname = lang('موقع طلاب جامعات السودان - الصفحة الشخصية', 'Sudan Un Students Site');
            include "views/main/head.php";
            $pagename = lang('الـصـفـحـة الـشـخـصـيــة', 'Profile');
            $pageordertype = 'profile';
            $stmtmyprofile= $con->prepare("SELECT * FROM `profile` WHERE `_userid` = '$userinfo[_id]'");
            $stmtmyprofile->execute();
            $myprofileinfo = $stmtmyprofile->fetch();
            include "views/main/navbar.php";
            include "views/users/01profile.php";
        } elseif (isset($_GET['o']) && $_GET['o'] == 'usersshow') {
            $headname = lang('موقع طلاب جامعات السودان - الـمـسـتـخـدمـيـن', 'Sudan Un Students Site - USERS');
            include "views/main/head.php";
            $pagename = lang('الـمـسـتـخـدمـيـن', 'USERS');
            $pageordertype = 'usersshow';
            include "views/main/navbar.php";
            include "views/users/02usersshow.php";
        } elseif (isset($_GET['o']) && $_GET['o'] == 'user' && isset($_GET['id'])) {
            $useridshow = $_GET['id'];
            $stmtusershow= $con->prepare("SELECT * FROM `users` WHERE	`_id` = '$useridshow'");
            $stmtusershow->execute();
            $contuser = $stmtusershow->rowCount();
            $usershow = $stmtusershow->fetch();
            $stmtuserprofile= $con->prepare("SELECT * FROM `profile` WHERE `_userid` = '$useridshow'");
            $stmtuserprofile->execute();
            $userprofile = $stmtuserprofile->fetch();
            $headname = lang('موقع طلاب جامعات السودان - '.$usershow['_name'], 'Sudan Un Students Site - '.$usershow['_name']);
            include "views/main/head.php";
            $pagename = $usershow['_name'];
            $pageordertype = 'user';
            include "views/main/navbar.php";
            include "views/users/03userprorile.php";
        } elseif (isset($_GET['o']) && $_GET['o'] == 'editdata') {
     
            $headname = lang('موقع طلاب جامعات السودان - تـعـديـل الـبـيـانـات', 'Sudan Un Students Site - Edit data');
            include "views/main/head.php";
            $pagename = lang('تـعـديـل الـبـيـانـات', 'Edit data');
            $pageordertype = 'editdata';
            $stmtmyprofile= $con->prepare("SELECT * FROM `profile` WHERE `_userid` = '$userinfo[_id]'");
            $stmtmyprofile->execute();
            $myprofileinfo = $stmtmyprofile->fetch();
            include "views/main/navbar.php";
            include "views/users/04editdata.php";
        }
        ?>





        <?php
        include "views/main/fotter.php";
        ?>
</body>
<?php
    } else { //isset $_SESSION['id'] && $userinfo['_admin']==1
        die(lang('الرجاء تسجيل الدخول', 'plz sing in'));
    }
    // include "views/home/01welcome.php";
?>
<!-- <link rel="stylesheet" href="css/home.css"> -->





</body>

</html>