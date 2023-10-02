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

    // جلب بياناتالمستخدم داخل المود لتعديلها
    $(".userdetalsemodalrev").on("click", function() {
        var userid = $(this).data('id'),
            url = "models/cpanel/users/02editusers";
        $.ajax({
            method: "GET",
            url: url,
            data: {
                userid: userid,
                type: 'rev'

            },
            beforeSend: function() {
                $("#resultuserdatarev").html(
                    "<img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' />")
            },
            success: function(data) {
                $("#resultuserdatarev").html(data);
            },
            error: function(error) {
                alert('خطاء في النظام');
            }
        });
    });
    $("#allreqrev").on("click", function() { //كل طلبات التفعيل في صفحة الادمن
        importfun("models/cpanel/users/03recusersreqver", ".maincpdiv", "كل الطلبات", "All ", "show", "req_ver", "ORDER BY `_id` DESC")
        $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
    })
    $("#reqnoverified").on("click", function() { //غير موثق طلبات التفعيل في صفحة الادمن
        importfun("models/cpanel/users/03recusersreqver", ".maincpdiv", "غير موثق", "NO verified", "show", "req_ver", "WHERE `_verified` = 'no' ORDER BY `_id` DESC")
        $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
    })
    $("#reqverified").on("click", function() { // موثق طلبات التفعيل في صفحة الادمن
        importfun("models/cpanel/users/03recusersreqver", ".maincpdiv", " موثق", " verified", "show", "req_ver", "WHERE `_verified` = 'yes' ORDER BY `_id` DESC")
        $(this).removeClass("badge-danger").addClass("badge-primary").siblings().removeClass("badge-primary").addClass("badge-danger")
    })

    $("#btn_req_revsearch").click(function(e) { // بحث بواسطة المعرف في طلبات التحقق
            e.preventDefault()
            $(".badge-primary").removeClass("badge-primary").addClass("badge-danger")
            var sarsh = $("#req_rev_byusername").val();

            if (sarsh != "") {
                importfun("models/cpanel/users/03recusersreqver", ".maincpdiv", " بحث عن طريق إسم المعرف ", "Sersh By username", "req_searsh", "users", "WHERE `_username` LIKE '%" + sarsh + "%' AND `_admin` =  'no'  ORDER BY `_id` DESC")

                $("#inputnamesarshcp").val("")
            }
        }) // بحث بواسطة المعرف في طلبات التحقق



});