<link rel="stylesheet" href="css/navbar.css">
<span id="conecterorr" style="display: none"><?php echo lang('حدث خطاء في الاتصال .. الرجاء التاكد من الاتصال وإعادة المحاولة','A connection error occurred. Please check your connection and try again')?></span>
<nav dir="<?php echo lang("rtl", "ltr") ?>" class="navbar navbar-expand-md navbar-light bg-light">
    <img src="media/img/main/logo.png" alt="logo" width="40px">
    <a class="navbar-brand nav-a" href="#">
        <?php
        echo isset($pagename) ? $pagename : 'SUSS';
        ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active">
                <a class="nav-link nav-a" href="home">
                    <i class="fa fa-home"></i>
                    <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-a" href="#">
                    <i class="fas fa-bell"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-a" href="#">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle nav-a" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu nav-a theambackground" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><?php echo $userinfo['_theam'] ?></a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <?php
                    if(isset($_SESSION['zoool']) && !isset($this_is_cpanel)){
                        if($userinfo['_admin']=='manager'|| $userinfo['_admin']=='admin'){?>
                    <a class="dropdown-item" href="cpanel"><?php echo lang('لوحة التحكم','cPanel') ?></a>
                    <?php   } }  ?>
                    <?php
        if(isset($_SESSION['zoool'])){?>
                    <?php 
                         if(!isset($_GET['o'])|| $_GET['o']!='profile'){?>
                    <a class="dropdown-item" href="users?o=profile"><i class="fa fa-user"></i>
                        <?php echo lang('الصفحة الشخصية','Profile') ?></a>
                    <?php
                       }
                        ?>

                    <a class="dropdown-item" href="models/main/logout"
                        title="<?php echo lang('تســــجيل الـخـروج', 'Logout') ?>"><i class="fa fa-power-off"
                            style='color:red'></i><?php echo lang('تســــجيل الـخـروج', 'Logout') ?></a>
                    <?php
        }
        ?>

                </div>
            </li>

        </ul>
        <!-- <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#sem-login">
    Open modal
</a>
<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#sem-reg">
  Open modal
</a> -->
        <?php
if(!isset($_SESSION['zoool'])){?>
        <span class="nav-a reg_log" data-toggle="modal"
            data-target="#sem-reg"><?php echo lang('تســــجيل', 'Regester') ?></span>

        <span class="nav-a reg_log" data-toggle="modal"
            data-target="#sem-login"><?php echo lang('دخــــول', 'login') ?></span>
        <?php
}
?>


        <a class="nav-link nav-a" href="?lang=<?php echo lang("en", "ar");
        if(isset($pageordertype)){
            echo '&o='.$pageordertype;
        }
        if(isset($useridshow)){
            echo '&id='.$useridshow;
        }
        ?>"><?php echo lang("English", "عربي") ?></a>


        <input type="checkbox" <?php
        if(isset($_SESSION['zoool'] )&& $userinfo['_theam']=='light'){
           echo 'checked';
        }
        ?> class="checktheam" id="checktheam">
        <label id="labeltheam" for="checktheam" class="labeltheam nav-light"
            style="color: red; cursor: pointer;margin-top: 6px;">
            <i class="fa fa-<?php echo lang('sun', 'moon') ?>" style="color: #3f429c; cursor: pointer;"></i>
            <i class="fa fa-<?php echo lang('moon', 'sun') ?>"
                style="color: #073cff; cursor: pointer;margin-top: 5.5px;"></i>
            <div id="theamball" class="ball"></div>
        </label>
    </div>
</nav>
<!-- **************log&reg***************************************** -->
<?php
error_reporting(0);
$num1 = rand(0, 10);$num2 = 10;
$opetors = array("+", "*");
$opetor = rand(0, count($opetors) - 1);
$opetor = $opetors[$opetor];
$answer = 0;
switch ($opetor) {
  case "+":
    $answer = $num1 + $num2;
    break;
  case "*":
    $answer = $num1 * $num2;
    break;
}
$_SESSION["answer123321"] = $answer;
?>


<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->


<div class="container">


    <!-- The Modal -->
    <div dir="<?php echo lang('rtl', '') ?>" class="modal fade seminor-login-modal" data-backdrop="static" id="sem-reg">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body seminor-login-modal-body">
                    <h5 class="modal-title text-center"><?php echo lang("تسجيل حساب جديد", "CREATE AN ACCOUNT") ?></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span <?php echo lang("style='position: absolute;'", "") ?>><i class="fa fa-times-circle"
                                aria-hidden="true"></i></span>
                    </button>


                    <form id="regform" action="models/main/reg" method="POST" class="seminor-login-form">
                        <div class="form-group">
                            <input name="name" id="name" type="name" class="form-control" required autocomplete="off">
                            <label class="form-control-placeholder"
                                for="name"><?php echo lang("الاســمـ", "Name") ?></label>
                        </div>
                        <div class="form-group">
                            <input name="username" id="username" type="name" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="username"><?php echo lang("إسـم المـستخدم", "User Name") ?></label>
                        </div>
                        <div class="form-group">
                            <input name="email" id="email" type="email" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="email"><?php echo lang("الإيــميــل", "Email address") ?></label>
                        </div>
                        <div class="form-group">
                            <input name="address" id="address" type="name" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="address"><?php echo lang("الـعـنـوانـ", "Address") ?></label>
                        </div>
                        <div class="form-group">
                            <label class="select-form-control-placeholder" style="margin-bottom: 15px;"
                                for="seluniversity"><?php echo lang("الـجـنـس", "Gender") ?></label>
                            <div class="col-md-12">

                                <label class="btn btn-light">
                                    <input type="radio" class="form-switch radio_2set" name="gender" value="male"
                                        gl2="1" data-id="a"><?php echo lang("ذكــر", "Male") ?></label>
                                <label class="btn btn-light">
                                    <input type="radio" class="form-switch radio_2set" name="gender" value="female"
                                        gl2="2" data-id="b"><?php echo lang("انـثـى", "Female") ?></label>
                            </div>
                        </div>
                        <!-- ***************************************************************************************** -->
                        <input name="universityar" type="hidden" id="universityar">
                        <!-- <input name="universityen" type="hidden" id="universityen"> -->
                        <div class="form-group">
                            <label class="select-form-control-placeholder"
                                for="seluniversity"><?php echo lang("الـجــامـعـة", "University") ?></label>
                            <select name="university" class="form-control" id="seluniversity">
                                <option value="0"><?php echo lang("اختار الجامعة", "Choose the university") ?></option>
                                <option id="Sennar" value="Sennar" data-ar="سنار">
                                    <?php echo lang("جامعة سنار", "Sennar University") ?>
                                </option>
                                <option id="Khartoum" value="Khartoum" data-ar="الخرطوم">
                                    <?php echo lang("جامعة الخرطوم", "Khartoum University") ?></option>
                                <option id="aljazeera" value="aljazeera" data-ar="الجزيرة">
                                    <?php echo lang("جامعة الجزيرة", "al jazeera University") ?></option>
                            </select>
                        </div>
                        <!-- ***************************************************************************************** -->
                        <input name="collegear" type="hidden" id="collegear">
                        <div id="divCollege" class="form-group" style="display: none;">
                            <label class="select-form-control-placeholder"
                                for="selCollege"><?php echo lang("الـكـلــية", "College") ?></label>
                            <select name="Collegeen" class="form-control" id="selCollege">
                                <option value="0"><?php echo lang("اخـتـار الـكـلــية", "Choose college") ?></option>
                                <option id="optionEngineering" data-ar="الهندسة" value="Engineering">
                                    <?php echo lang("كلية الهندسة", "College of Engineering") ?>
                                </option>
                                <option id="optionMedicine" data-ar="الطب" value="Medicine">
                                    <?php echo lang("كلية الـطـبـ", "College of Medicine") ?>
                                </option>
                                <option id="optionPharmacy" data-ar="الصيدلة" value="Pharmacy">
                                    <?php echo lang("كلية الـصـيدلـة", "College of Pharmacy") ?>
                                </option>
                            </select>
                        </div>
                        <div>
                            <!-- ***************************************************************************************** -->
                            <input name="secen" type="hidden" id="secen">
                            <input name="secar" type="hidden" id="secar">
                            <div id="divEngineering" class="form-group College of Engineering" style="display: none;">
                                <label class="select-form-control-placeholder"
                                    for="selEngineering"><?php echo lang("الـقـســم", "Section") ?></label>
                                <select class="form-control optionsection" id="selEngineering" name="College">
                                    <option value="0"><?php echo lang("اخـتـار الـقـســم", "Choose Section") ?>
                                    </option>
                                    <option id="optionComputer" data-en="Computer" data-ar="حاسوب" name="optionComputer"
                                        value="Computer">
                                        <?php echo lang("هـندسة حـاسـوب", "Computer engineering") ?></option>
                                    <option id="optionElectricity" data-en="Electricity" data-ar="كهرباء"
                                        value="Electricity">
                                        <?php echo lang("هندسة كهرباء", "Electricity Engineering") ?></option>
                                    <option id="optionMechanical" data-en="Mechanical" data-ar="ميكانيكا"
                                        value="Mechanical">
                                        <?php echo lang("هندسة ميكانيكا", "Mechanical Engineering") ?></option>
                                </select>
                            </div>
                            <!-- ***************************************************************************************** -->
                            <div id="divMedicine" class="form-group College of Medicine" style="display: none;">
                                <label class="select-form-control-placeholder"
                                    for="selMedicine"><?php echo lang("الـقـســم", "Section") ?></label>
                                <select class="form-control optionsection" id="selMedicine" name="College">
                                    <option value="0"><?php echo lang("اخـتـار الـقـســم", "Choose Section") ?>
                                    </option>
                                    <option id="optionMedicine_and_Health_Sciences"
                                        data-en="Medicine and Health Sciences" data-ar="الطب والعلوم الصحية"
                                        value="Medicine_and_Health_Sciences">
                                        <?php echo lang("الطب والعلوم الصحية", "Medicine and Health Sciences") ?>
                                    </option>
                                    <option id="optionpharmacy" data-en="Computer" data-ar="الصيدلة" value="pharmacy">
                                        <?php echo lang("الصيدلة", "pharmacy") ?></option>
                                    <option id="optionMedical_Laboratory" data-en="Medical Laboratory"
                                        data-ar="المختبرات الطبية" value="Medical_Laboratory">
                                        <?php echo lang("المختبرات الطبية", "Medical Laboratory") ?></option>
                                </select>
                            </div>
                            <!-- ***************************************************************************************** -->
                        </div>
                        <div class="form-group">
                            <label class="select-form-control-placeholder" style="margin-bottom: 15px;"
                                for="seluniversity"><?php echo lang("نوع التسجيل", "Registration Type") ?></label>
                            <div class="col-md-12">

                                <label id="student" data-a="student" class="btn btn-light">
                                    <input type="radio" class="form-switch radio_2set registration_type"
                                        name="registration_type" value="student" gl2="1"
                                        data-id="a"><?php echo lang("تـسـجـيـلـ طـالـبـ", "Register as student") ?></label>
                                <label class="btn btn-light">
                                    <input type="radio" class="form-switch radio_2set registration_type"
                                        name="registration_type" value="professor" gl2="2"
                                        data-id="b"><?php echo lang("تـسـجـيـلـ اسـتـاذ", "Registration as professor") ?></label>
                           
                                    </div>
                        </div>
                        <!-- ***************************************************************************************** -->
                        <div id="divregistration" class="form-group" style="display: none;">
                            <label class="select-form-control-placeholder" style="margin-bottom: 15px;"
                                for="seluniversity"><?php echo lang("نوع الـشـهادة", "Certificate type") ?></label>
                            <div class="col-md-12">

                                <label id="Certificate" class="btn btn-light">
                                    <input type="radio" class="form-switch radio_2set Certificate_type"
                                        name="Certificate_type" value="Bachelor’s" gl2="1"
                                        data-id="a"><?php echo lang("بـكـلاريـوسـ", "Bachelor’s") ?></label>
                                <label class="btn btn-light">
                                    <input type="radio" class="form-switch radio_2set Certificate_type"
                                        name="Certificate_type" value="Diploma" gl2="2"
                                        data-id="b"><?php echo lang("دبـلـوم", "Diploma") ?></label>
                            </div>
                        </div>
                        <!-- ***************************************************************************************** -->
                        <div id="divbatch" class="form-group College of Medicine" style="display: none;">
                            <label class="select-form-control-placeholder"
                                for="batch"><?php echo lang("الـدفـعـة", "The Batch") ?></label>
                            <select class="form-control" id="batch" name="batch">
                                <?php $now = date('Y') ?>
                                <option value="0"><?php echo lang("اخـتـار الدفعة", "Choose college") ?></option>
                                <option value="<?php echo $now-7 ?>"><?php echo $now-7 ?></option>
                                <option value="<?php echo $now-6 ?>"><?php echo $now-6 ?></option>
                                <option value="<?php echo $now-5 ?>"><?php echo $now-5 ?></option>
                                <option value="<?php echo $now-4 ?>"><?php echo $now-4 ?></option>
                                <option value="<?php echo $now-3 ?>"><?php echo $now-3 ?></option>
                                <option value="<?php echo $now-2 ?>"><?php echo $now-2 ?></option>
                                <option value="<?php echo $now-1 ?>"><?php echo $now-1 ?></option>
                                <option value="<?php echo $now ?>"><?php echo $now ?></option>
                                <option value="<?php echo $now+1 ?>"><?php echo $now+1 ?></option>
                                <option value="<?php echo $now+2 ?>"><?php echo $now+2 ?></option>
                                <option value="<?php echo $now+3 ?>"><?php echo $now+3 ?></option>
                            </select>
                        </div>
                        <!-- ***************************************************************************************** -->

                        <div id="divunnum" class="form-group" style="display: none;">
                            <input placeholder="<?php echo lang("الرقم الجامعي", "Un. Number") ?>" name="unnum"
                                id="unnum" type="name" class="form-control" autocomplete="off">
                            <label class="form-control-placeholder"
                                for="unnum"><?php echo lang("الرقم الجامعي", "Un. Number") ?></label>
                        </div>
                        <!-- ***************************************************************************************** -->

                        <div class="form-group">
                            <input name="pass1" id="password" type="password" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="password"><?php echo lang("كلمة المرور", "Password") ?></label>
                        </div>
                        <div class="form-group">
                            <input name="pass2" id="repassword" type="password" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="repassword"><?php echo lang("تأكيد كلمة المرور", "Confirm Password") ?></label>
                        </div>
                        <div class="cptcadrop text-center">
                            <hr /> <span style="font-size:15px"
                                class="badge badge-pill badge-warning "><?php echo $num1 . " " . $opetor . " " . $num2; ?>

                                <span style="color:#383d41">=</span>

                            </span>

                            <input name="answer" style="width: 37px;height: 22px;" type="text">

                        </div>

                        <div id="regrusalt" class="form-group forgot-pass-fau text-center" style="margin-top: 18px;">

                        </div>

                        <div class="form-group forgot-pass-fau text-center ">
                            <a href="/terms-conditions/" class="text-secondary">
                                By Clicking "SIGN UP" you accept our<br>
                                <span class="text-primary-fau">Terms and Conditions</span>
                            </a>
                        </div>

                        <div class="btn-check-log">
                            <button type="submit" id="btnsendreg" name="btnsendreg" class="btn-check-login">SIGN
                                UP</button>
                        </div>
                        <div class="create-new-fau text-center pt-3">
                            <a href="#" class="text-primary-fau"><span data-toggle="modal" data-target="#sem-login"
                                    data-dismiss="modal">Already Have An Account</span></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




    <!-- The Modal -->
    <div dir="<?php echo lang('rtl', '') ?>" class="modal fade seminor-login-modal" data-backdrop="static"
        id="sem-login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body seminor-login-modal-body">
                    <h5 class="modal-title text-center">
                        <?php echo lang("تـسـجــيـلـ الـدخـولـ", "LOGIN TO MY ACCOUNT") ?></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                    </button>


                    <form id="logform" action="models/main/log" method="POST" class="seminor-login-form">
                        <div class="form-group">
                            <input id="usernamelog" name="usernamelog" type="text" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="usernamelog"><?php echo lang("إسـمـ الـمـسـتـخـدم", "User Name") ?></label>
                        </div>
                        <div class="form-group">
                            <input id="passlog" name="passlog" type="password" class="form-control" required
                                autocomplete="off">
                            <label class="form-control-placeholder"
                                for="passlog"><?php echo lang("كـلـمـة الـمـرور", "Password") ?></label>
                        </div>
                        <!-- <div class="form-group">
                            <label class="container-checkbox">
                                Remember Me On This Computer
                                <input type="checkbox" checked="checked" required>
                                <span class="checkmark-box"></span>
                            </label>
                        </div> -->
                        <div id="logrusalt" class="form-group forgot-pass-fau text-center" style="margin-top: 18px;">
                        </div>

                        <div class="btn-check-log">
                            <button name="btnlog" type="submit" class="btn-check-login">LOGIN</button>
                        </div>


                        <div class="forgot-pass-fau text-center pt-3">
                            <a href="/reset_pass"
                                class="text-secondary"><?php echo lang("نـسـيـت كـلـمـة المـرور ؟", "Forgot Your Password?") ?></a>
                        </div>
                        <!-- <div class="create-new-fau text-center pt-3">
                            <a href="#" class="text-primary-fau"><span data-toggle="modal" data-target="#sem-reg"
                                    data-dismiss="modal">Create A New Account</span></a>
                        </div> -->



                    </form>

                </div>
            </div>
        </div>
    </div>

</div>



<!-- **************log&reg***************************************** -->