      <?php
      include "../../models/main/connect.php";
      include "../../models/main/lang.php";
      include "../../models/main/function.php";



$stmtremon_choose_ver = $con->prepare("SELECT * FROM `mon_choose` WHERE `_voited`=$_SESSION[zoool] LIMIT 1");
    $stmtremon_choose_ver->execute();
    $me_verinfo = $stmtremon_choose_ver->fetch();

    if($me_verinfo['_ismonsig']=='yes'){
        if(isset($_GET['order'])){
            $order = $_GET['order'];
            if($order=='Sat'){
                $editeday = lang('السبت','Saturday');
            }elseif($order=='Sun'){
                $editeday =  lang('الاحـــد', 'Sunday');
            }elseif($order=='Mon'){
                $editeday =  lang('الاثـنـيــن', 'Monday');
            }elseif($order=='Tue'){
                $editeday =  lang('الـثـلاثـاء' , 'Tuesday');
            }elseif($order=='Wed'){
                $editeday =  lang('الاربــعــاء' , 'Wednesday');
            }elseif($order=='Thu'){
                $editeday =  lang('الـخـمـيـس' , 'Thursday');
            }else{
                $editeday = lang('لا محاضرات يوم الجمعة','No lectures on Friday');
            }
            //إحضار معلومات المحاضرة
            $stmtday = $con->prepare("SELECT * FROM `lectures` WHERE `_mybatch` = '$batch_of_me' && `_day` = '$order' ");
            $stmtday->execute(array());
            $daycont = $stmtday->rowCount();
            $dayinfo = $stmtday->fetch();
        }

        ?>
      <style>
body {
    background: #070c0b !important;
}

.lecdiv {
    /* border: 1px solid red;
    border-radius: 0.5%; */
    background: #09097dbf;
    padding: 8px 2px;
    margin: 0px 0px 10px 0px
}

input.col-sm-6.col-lg-3.col-md-6 {
    width: 85%;
    margin: 3px -2px;
    padding: -1px !important;
    border: none;
    background: #343a4085;
    border-bottom: 1.5px solid red;
    border-radius: 15%;
    color: wheat;
    font-weight: bold;
}
      </style>
      <div class="row">
          <div class="col-lg-1 col-md-1 col-sm-1 d-sm-none d-md-block" style="opacity: 0">.</div>
          <div class="col-lg-10 col-md-10 col-sm-10 d-sm-none d-md-block">
              <div id="edre" class="col-12 badge badge-warning">
                  <?php echo lang("تعديل محاضرات يوم ","Edit"). ' '.$editeday ?>
              </div>
              <form id="editlecform" action="models/lectures/02lecedit" method="post">
              <input type="hidden" name="day" value="<?php echo $order ?>">

                  <span class="col-12 badge badge-success"><?php echo lang("المحاضرة الاولى","First lecturer")?></span>
                  <div class="col-12 lecdiv  shadow">
                      <input autofocus class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec1name" id=""
                          placeholder="<?php echo lang("إسم المحاضرة","Name of the lecture")?>" 
                          value="<?php echo $dayinfo['_lec1'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec1hall" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec1hall'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec1star" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec1star'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec1end" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec1end'] ?>">
                  </div>

                  <span
                      class="col-12 badge badge-success"><?php echo lang("المحاضرة الثانية","second lecturer")?></span>
                  <div class="col-12 lecdiv  shadow">
                      <input autofocus class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec2name" id=""
                          placeholder="<?php echo lang("إسم المحاضرة","Name of the lecture")?>"
                          value="<?php echo $dayinfo['_lec2'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec2hall" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec2hall'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec2star" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec2star'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec2end" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec2end'] ?>">
                  </div>

                  <span class="col-12 badge badge-success"><?php echo lang("المحاضرة الثالثة","third lecture")?></span>
                  <div class="col-12 lecdiv  shadow">
                      <input autofocus class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec3name" id=""
                          placeholder="<?php echo lang("إسم المحاضرة","Name of the lecture")?>"
                          value="<?php echo $dayinfo['_lec3'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec3hall" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec3hall'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec3star" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec3star'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec3end" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec3end'] ?>">
                  </div>

                  <span class="col-12 badge badge-success"><?php echo lang("المحاضرة الرابعة","fourth lecture")?></span>
                  <div class="col-12 lecdiv  shadow">
                      <input autofocus class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec4name" id=""
                          placeholder="<?php echo lang("إسم المحاضرة","Name of the lecture")?>"
                          value="<?php echo $dayinfo['_lec4'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="text" name="lec4hall" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec4hall'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec4star" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec4star'] ?>">
                      <input class="col-sm-6 col-lg-3 col-md-6" type="time" name="lec4end" id=""
                          placeholder="<?php echo lang("إسم القاعة","Hall name")?>"
                          value="<?php echo $dayinfo['_lec4end'] ?>">
                  </div>
                  <center>
                      <div id="editlecreusalt"></div>
                  </center>

                  <center>
                      <button name="btnlecedit" class="btn btn-dark btn-block  col-sm-10 col-lg-4 col-md-4" type="submit"><i
                              class="fa fa-edit"></i><?php echo lang("تـعــديـل","Edit")?></button>
                              <button id="backfromlecedit" class="btn btn-dark btn-block col-sm-10 col-lg-4 col-md-4"><i class="fa fa-backward"></i> <?php echo lang("عــودة","Back")?></button>
                  </center>

              </form>


          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 d-sm-none d-md-block" style="opacity: 0">.</div>

          <script>
          // ******************************تعديل المحاضرات تسجيل جديد****************************
          $(function() {
              $("#editlecform").ajaxForm({
                  beforeSend: function() {
                      $("#editlecreusalt").html(
                          "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
                          );
                  },
                  success: function(data) {
                      $("#editlecreusalt").html(data);
                  },
                  error: function() {
                      var erorr = $("#conecterorr").text();
                      alert(erorr)
                  }
              });
          });

          //زر العودة
          function importfun(url, div, order = '', pagenumer = '', sersh = '') { //دالة جلب ملفات الماين ديف
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                pagenumer: pagenumer,
                sersh: sersh
            },
            beforeSend: function() {
                $(div).html(
                    "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>")
            },
            success: function(data) {
                $(div).html(data)
            },
            error: function() {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    } //دالة جلب ملفات الماين ديف
          $("#backfromlecedit").on("click", function() {
            importfun("models/lectures/01lecshow", "#lecshow", "");
    });


          
          </script>



          <?php

    }
    ?>