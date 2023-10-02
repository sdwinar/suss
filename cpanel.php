<?php
include "models/main/connect.php";
include "models/main/function.php";
include "models/main/lang.php";
$headname = lang('موقع طلاب جامعات السودان - لوحة التحكم','Sudan Un Students Site');
include "views/main/head.php";
?>

<body>
    
<?php
$pagename = lang('لوحة التحكم','cPanel');
if (isset($_SESSION['zoool']) && ($userinfo['_admin']=='manager'|| $userinfo['_admin']=='admin')) { ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <body>
    <?php
                    $this_is_cpanel=0;
                    include "views/main/navbar.php";
                    include "views/cpanel/index.php"; 
                    ?>
        <div class="container-fluid">
                


                    
        </div>
              
 

        <?php
    include "views/main/fotter.php";
    ?>
        </body>
<?php
} else { //isset $_SESSION['id'] && $userinfo['_admin']==1
    die(lang('صفحة للادمن فقط', 'jast for admin'));
}
// include "views/home/01welcome.php";
?>
<!-- <link rel="stylesheet" href="css/home.css"> -->





</body>
</html>