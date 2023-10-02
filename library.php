<?php
include "models/main/connect.php";
include "models/main/function.php";
include "models/main/lang.php";
$headname = lang('الـمـكـتـبـة - موقع طلاب جامعات السودان', 'Library - Sudan Un Students Site');
include "views/main/head.php";
?>

<body style="background: url('media/img/lecture/lib.jpg')">
    
    <?php
    $pagename = lang('الـمـكـتـبـة'.' ', 'Library');
    include "views/main/navbar.php";
    ?>

    <!-- <script src="js/jquery-3.4.0.min.js"></script>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/theme.default.css">
    <script src="js/carousel.js"></script> -->



    <?php
    if (isset($_SESSION['zoool'])) { ?>
            <div dir="<?php echo lang('rtl','ltr') ?>" class="maindiv filtertheam" style="    margin-top: 10px;">

    <?php
        include "views/library/index.php";
    } else { ?>
        </div>

        <div class="maindiv filtertheam">
            <?php
            // include "views/home/03Collapsing.php";
            ?>
        </div>
        <div class="maindiv filtertheam">
            <?php
            // include "views/home/04usersshow.php";
            ?>
        </div>
    <?php
    }
    ?>

    <!-- <link rel="stylesheet" href="css/home.css"> -->




    <?php
    include "views/main/fotter.php";
    ?>
</body>

</html>