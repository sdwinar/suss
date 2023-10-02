<?php
include "connect.php";
if(isset($_SESSION['zoool']) && isset($_GET['ceked'])){  
    $newtheam = $_GET['ceked'];    $userid = $_SESSION['zoool'];
    $settheam = $con->prepare("UPDATE `users` SET `_theam` = ? WHERE `users`.`_id` =?");
    $settheam->execute(array($newtheam,$userid));
}
?>