<?php


// **********************************************switsh lang****************************************************************
if (isset($_SESSION['zoool']) && isset($_GET['lang'])) {
    $newlang = $_GET['lang']; $userid = $_SESSION['zoool'];
    $setlang = $con->prepare("UPDATE `users` SET `_lang` = ? WHERE `users`.`_id` = ?");
    $setlang->execute(array($newlang,$userid));
}
// **********************************************lang****************************************************************
function lang($ar, $en)
{
    global $con;
    if (isset($_SESSION['zoool'])) {
        $userid = $_SESSION['zoool'];
        $stmtlang = $con->prepare("SELECT `_lang` FROM `users` WHERE `_id`=?");
        $stmtlang->execute(array($userid));
        $userinfo = $stmtlang->fetch();
        $userlang = $userinfo['_lang'];
    } else {
        $userlang = "ar";
    }
    isset($_GET['lang']) ? $userlang = $_GET['lang'] : $userlang = $userlang;
    $_SESSION['lang'] = $userlang;
    if ($_SESSION['lang'] == "ar") {
        $ret = $ar;
    } else {
        $ret =  $en;
    }
    return $ret;
}
?>