<?php
include "connect.php";
include "lang.php";
include "function.php";

if (isset($_POST['btnsendreg'])) {
    // التاكد من الكباتشا
    $theanser = $_SESSION["answer123321"];
    $user_anser = $_POST["answer"];
    if ($theanser != $user_anser) {
        echo '<br/><div class="alert alert-warning alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ... يجب حل المعادلة بشكل صحيح", "<strong> Sorri!</strong> ...fun faild"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
        exit();
    } else {

        $name = mksave($_POST['name']);
        $username = mksave($_POST['username']);
        $email = $_POST['email'];
        $address = mksave($_POST['address']);
        $gender = isset($_POST['gender']) ? $_POST['gender'] : 'empty';
        $registration_type  = isset($_POST['registration_type']) ? $_POST['registration_type'] : 'empty';
        $Certificate_type  = isset($_POST['Certificate_type']) ? $_POST['Certificate_type'] : 'empty';
        $universityar = $_POST['universityar'];
        $universityen = $_POST['university'];
        $collegear = $_POST['collegear'];
        $collegeen = $_POST['Collegeen'];
        $secen = $_POST['secen'];
        $secar = $_POST['secar'];
        $batch = $_POST['batch'];
        $unnum = mksave($_POST['unnum']);
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        $isusername = chekviews("_username", "users", $username);


        if ($registration_type == "student") {
            if ($unnum == '' || $batch == '0' || $Certificate_type == '') {
                echo '<br/><div class="alert alert-warning alert-dismissible fade show text-right" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
                <?php echo lang("<strong> معذراً!</strong> ...الرجاء تحديد نوع الشهادة والدفعة والرقم الجامعي", "<strong> Sorry!</strong> ...Please select a gender"); ?>
                <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
                exit();
            }
        } else {
            $unnum == '';
            $batch == '';
            $Certificate_type == '';
        }

        if (empty($name) || empty($username) || empty($address)) {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-right" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...بعض الحقول المطلوبة فارغة", "<strong> معذراً!</strong> ...بعض الحقول فارغة"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...  ادخل ايميل صحيح", "<strong> Sorri!</strong> ...enter right email"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }elseif (strlen($username) < 4) {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...  اسم المستخدم لايقل عن اربعة خانات", "<strong> Sorri!</strong> ...enter right email"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }elseif ($isusername>0) {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...  اسم المستخدم مستخدم من قبل", "<strong> Sorri!</strong> ...enter right email"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }
        elseif ($gender == 'empty') {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-right" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...الرجاء تحديد الجنس", "<strong> Sorry!</strong> ...Please select a gender"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } elseif ($universityen == '0' || $collegeen == '0' || $secen == '') {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-right" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...الرجاء تحديد الجامعة والكلية والقسم", "<strong> Sorry!</strong> ...Please select a gender"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }elseif (strlen($pass1) < 4) {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> معذراً!</strong> ...  كلمة المرور يجب ان لا تقل عن 4 خانات", "<strong> Sorri!</strong> ...enter right email"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        }elseif ($pass1 != $pass2) {
            echo '<br/><div class="alert alert-warning alert-dismissible fade show text-right" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
            <?php echo lang("<strong> معذراً!</strong> ...كلمتي المرور غير متطابفتين", "<strong> Sorry!</strong> ...Please select a gender"); ?>
            <?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
        } else {
            $activation = md5(uniqid(rand(), true));
            $newpass = sha1($pass2 . '@%00&#$%@@@@$*');
            $stmtinsert = $con->prepare("INSERT
             INTO `users` (`_id`, `_name`, `_username`, `_email`, `_sex`, `_address`, `_aruniversity`, `_enuniversity`, `_arcollege`, `_encollege`, `_arsection`, `_ensection`, `_adjective`,`Certificate_type`,`_batch`, `_unnum`, `_password`, `_admin`, `_monasig`, `_active`, `_activation`, `_lang`, `_theam`, `_regdate`) 
             VALUES        (NULL, '$name', '$username', '$email', '$gender', '$address', '$universityar', '$universityen', '$collegear', '$collegeen', '$secar', '$secen','$registration_type','$Certificate_type','$batch', '$unnum', '$newpass', 'no', 'no', 'no', '$activation', 'ar', 'dark', CURRENT_TIMESTAMP);");
            $stmtinsert->execute();
            $stmtinsert->CloseCursor();
                   //   عنوان الرسالة
                $subject ='Activation Code in SUSS website';
                // رأس الرسالة
                $header = "From: \"Admin\"<sdwinar2@gmail.com> \n";
                $header.= "Reply-to: \"$name\" <$email> \n";
                $header.= "MIME-Version: 1.0 \n";
              // محتوى الرسالة يتضمن رابط تفعيل العضوية
                $message = '<span style="font-size: 19px;color: blueviolet;" >'.
                lang('لتفعيل عضويتك المرجو النقر على الرابط أسفله أو نقله و نسخه على متصفحك:\n\n'
                ,'To activate your membership, please click on the link below or move it and copy it to your browser:\n\n').'</span>';

                $message .= '<span style="font-size: 19px;color: blueviolet;" >'.
                 lang('الرجاء تجاهل الرسالة اذا لم تكن انت المعني بها :\n\n'
                ,'Please ignore the message if it is not you :\n\n').'</span>';
                
                $message .='suss.000webhostapp.com/models/main/activate?username=' . urlencode($username) . "&key=$activation";
              // إرسال الرسالة إلى بريد العضو
                mail($email, $subject, $message, $header);
            echo '<br/><div class="alert alert-success alert-dismissible fade show text-center" role="alert"style="font-size: 1rem !important;font-weight: bold !important;">' ?>
<?php echo lang("<strong> تم!</strong> ...    تسجيلك بنجاح الرجاء مراجعة الايميل الخاص بك لتفعيل الحساب او التواصل مع إدارة الموقع", "<strong> Done!</strong> ...Your Rgested succsessful Plase chek your Email for Active your Acaaunt"); ?>
<?php echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="top: 115%;  position: absolute;right: 90px;" aria-hidden="true">&times;</span></button></div>';
            exit();
           
        }
    } //captcha right
} else {
}
                ?>