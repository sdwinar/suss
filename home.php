<?php
include "models/main/connect.php";
include "models/main/function.php";
include "models/main/lang.php";
$headname = lang('موقع طلاب جامعات السودان', 'Sudan Un Students Site');
include "views/main/head.php";
?>

<body>
    <?php
    $pagename = lang('موقع طلاب جامعات السودان', 'Sudan Un Students Site');
    include "views/main/navbar.php";
    ?>

    <script src="js/jquery-3.4.0.min.js"></script>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/theme.default.css">
    <script src="js/carousel.js"></script>



    <?php
    if (!isset($_SESSION['zoool'])) { ?>
    <?php
        include "views/home/01welcome.php";
    } else { ?>

        <div class="maindiv filtertheam">
            <?php
            include "views/home/03Collapsing.php";
            ?>
        </div>
        <div class="maindiv filtertheam">
            <?php
            include "views/home/04usersshow.php";
            ?>
        </div>
    <?php
    }
    ?>

    <link rel="stylesheet" href="css/home.css">




    <?php
    include "views/main/fotter.php";
    ?>
</body>

</html>