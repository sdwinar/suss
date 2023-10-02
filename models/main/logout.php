<?php

session_start();
session_unset();//حذف البيانات
session_destroy();//تحطيم الجلسة
header('location:../../');
exit();
?>