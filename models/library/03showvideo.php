<?php

include "../main/connect.php";
include "../main/lang.php";
include "../main/function.php";
if (isset($_SESSION['zoool'])) {

    if (isset($_GET['table']) && $_GET['order'] == "show") {
        $videourl = $_GET['type'];
        $videourl = str_replace('watch','embed',$videourl);
        $videourl = str_replace('?v=','/',$videourl);
        $name = $_GET['titleen'];

                ?>

                        <span class="badge badge-primary btn-lg" 
                        style="font-size: 15px;font-weight: 500;padding: 8px;margin: 5px 0px; width: 100%;">
                        <?php echo ' '.$name ; ?></span>

<iframe style="width: 100%;padding:0.5% 0px" width="560" height="315" src="<?php echo $videourl ?>" frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen></iframe>

<?php
    }
}
?>