<?php



// **********************************************mksave****************************************************************
function mksave($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}
// **********************************************chekviews****************************************************************
function chekviews($item, $froms, $id, $plus = "")
{
    global $con;
    $stmtchek = $con->prepare("SELECT $item FROM $froms WHERE	$item = ? $plus");
    $stmtchek->execute(array($id));
    $contsssss = $stmtchek->rowCount();
    return $contsssss;
}
// **********************************************userinfo****************************************************************
if (isset($_SESSION['zoool'])) {
    $userid = $_SESSION['zoool'];
    $stmtlang = $con->prepare("SELECT * FROM `users` WHERE `_id`=?");
    $stmtlang->execute(array($userid));
    $userinfo = $stmtlang->fetch();

    $myun = $userinfo['_enuniversity'];
$mycol = $userinfo['_encollege'];
$mysec = $userinfo['_ensection'];
$mybach = $userinfo['_batch'];
$mycer = $userinfo['Certificate_type'];
$myid = $userinfo['_id'];
}
// **********************************************profile info****************************************************************
if (isset($_SESSION['zoool'])) {
    $stmtprofile = $con->prepare("SELECT * FROM `profile` WHERE `_userid`=?");
    $stmtprofile->execute(array($userid));
    $profileinfo = $stmtprofile->fetch();
    $contprofile= $stmtprofile->rowCount();
}
// **********************************************req_ver info****************************************************************
if (isset($_SESSION['zoool'])) {
    $stmtreq_ver = $con->prepare("SELECT * FROM `req_ver` WHERE `_userid`=?");
    $stmtreq_ver->execute(array($userid));
    $req_verinfo = $stmtreq_ver->fetch();
    $contstmtreq_ver= $stmtreq_ver->rowCount();


    
}
    

