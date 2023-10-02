$(document).ready(function() {


    function importfun(url, div, titlear, titleen, order, table, sql = '') { //دالة جلب ملفات الماين ديف
        $.ajax({
            method: "GET",
            url: url,
            data: {
                table: table,
                sql: sql,
                titlear: titlear,
                titleen: titleen,
                order: order
            },
            beforeSend: function() {
                $(div).html(
                    "<img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' />")
            },
            success: function(data) {
                $(div).html(data)
            },
            error: function(error) {
                alert(error)
            }
        });
    } //دالة جلب ملفات الماين ديف
    // $("#userunactive").on("click", function() {
    //         importfun("views/cpanel/users/usershow", "مستخدمين غير النشطين", "Un ACtive Users", ".maincpdiv", "users", "show", "WHERE `_admin` =  0 AND `_active` = 0 ORDER BY `_id` DESC")
    //         $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
    //     })
    //userun alladmain
    // $("#alladmain").on("click", function() {
    //         importfun("views/cpanel/users/usershow", "كل الادمــن", "All Admain", ".maincpdiv", "users", "show", "WHERE `_admin` = 1 AND `_active` = 1 ORDER BY `_id` DESC")
    //         $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
    //     })
    //userun Lastregstred
    // $("#Lastregstred").on("click", function() {
    //         importfun("views/cpanel/users/usershow", "اخر المسجلين", "Last Regstred ", ".maincpdiv", "users", "show", "WHERE `_admin` =  0  ORDER BY `_id` DESC LIMIT 10")
    //         $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
    //     })
    //userun alluserss
    $("#alluserss").on("click", function() {
            importfun("models/cpanel/users/01usershow", ".maincpdiv", "كل المستخدمين", "All Users", "show", "users", "WHERE `_admin` =  'no'  ORDER BY `_id` DESC")
            $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
        })
        //userun Allstudants
        // $("#Allstudants").on("click", function() {
        //         importfun("views/cpanel/users/usershow", "كل الطلاب", "All Studants", ".maincpdiv", "users", "show", "WHERE `_admin` =  0  AND `_usertype` = 'stu' ORDER BY `_id` DESC")
        //         $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
        //     })
        //userun AllMisster
        // $("#AllMisster").on("click", function() {
        //         importfun("views/cpanel/users/usershow", "كل الاسـاتــذة", "All Misster", ".maincpdiv", "users", "show", "WHERE `_admin` =  0 AND `_usertype` != 'stu' ORDER BY `_id` DESC")
        //         $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
        //     })

    $("#namesarshcp").click(function(e) { //star userun namesarshcp
            e.preventDefault()
            $(".badge-primary").removeClass("badge-primary").addClass("badge-danger")
            var sarsh = $("#inputnamesarshcp").val();

            if (sarsh != "") {
                importfun("models/cpanel/users/01usershow", ".maincpdiv", " بحث عن طريق إسم المعرف او الايميل", "Sersh By username Or Email", "show", "users", "WHERE `_username` LIKE '%" + sarsh + "%' AND `_admin` =  'no'  ORDER BY `_id` DESC")
                $("#inputnamesarshcp").val("")
            }
        }) //end userun namesarshcp
        //userun All sersh
        // $("#cpshsend").click(function(e) {
        //         e.preventDefault()
        //         $(".badge-primary").removeClass("badge-primary").addClass("badge-danger")
        //         var cpshun = $("#cpshun").val();
        //         var cpshfa = $("#cpshfa").val();
        //         var cpshyear = $("#cpshyear").val();
        //         var cpstty = $("#cpstty").val();
        //         var cpshactive = $("#cpshactive").val();
        //         var cpshmons = $("#cpshmons").val();
        //         var cpshse = $("#cpshse").val();
        //         if (cpshun != "" || cpshfa != "" || cpshyear != "" || cpstty != "" || cpshactive != "" || cpshmons != "" || cpshse != "") {
        //             importfun("views/cpanel/users/usershow", " بحث شـــامــــلـ", "Full Serrsh", ".maincpdiv", "users", "show", "WHERE `_university` LIKE '%" + cpshun + "%' AND `_factory` LIKE '%" + cpshfa + "%' AND `_year` LIKE '%" + cpshyear + "%' AND `_usertype` LIKE '%" + cpstty + "%' AND `_active` LIKE '%" + cpshactive + "%' AND `_monasig` LIKE '%" + cpshmons + "%' AND (`_Seiencear` LIKE '%" + cpshse + "%' OR `_Seienceen` LIKE '%" + cpshse + "%') AND `_admin` = 0   ORDER BY `_id` DESC")
        //             $("#cpshun").val("");
        //             $("#cpshfa").val("");
        //             $("#cpshyear").val("");
        //             $("#cpstty").val("");
        //             $("#cpshactive").val("");
        //             $("#cpshmons").val("");
        //             $("#cpshse").val("");
        //         }

    //     })
    //تغير تجاه الحقل بناءا على لغة الحرف الاول
    $(".form-input").on("keyup", function() {
        if ($(this).val().charCodeAt(0) < 200) {
            $(this).css("direction", "ltr");
        } else {
            $(this).css("direction", "rtl");
        }
    });
    // جلب بياناتالمستخدم داخل المود لتعديلها
    $(".userdetalsemodal").on("click", function() {
        var userid = $(this).data('id'),
            url = "models/cpanel/users/02editusers";
        $.ajax({
            method: "GET",
            url: url,
            data: {
                userid: userid

            },
            beforeSend: function() {
                $("#resultuserdata").html(
                    "<img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' />")
            },
            success: function(data) {
                $("#resultuserdata").html(data);
            },
            error: function(error) {
                alert('خطاء في النظام');
            }
        });
    });
    // تعديل بيانات المستخدم داخل المودل
    // ******************************اجاكس فورم  تعديل بيانات المستخدم داخل المودل****************************
    $(function() {
        $("#adminuseredit").ajaxForm({
            beforeSend: function() {
                $("#adminusereditresult").html(
                    "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;opacity: 0.3;' />");
            },
            success: function(data) {
                $("#adminusereditresult").html(data);
            },
            error: function(er) {
                alert(er)
            }
        });
    });


});