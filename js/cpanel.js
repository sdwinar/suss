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

    $("#cpusers").on("click", function() { //users show
        importfun("models/cpanel/users/01usershow", ".maincpdiv", " اخر المسجلين", "Last REgestres", "show", "users", "WHERE `_admin` = 'no'  ORDER BY `_id` DESC LIMIT 10")
        importfun("models/cpanel/users/01usershow", ".deatalsrusalt", "", "", "detalse", "users", "")
        importfun("models/cpanel/users/01usershow", ".sidecpdiv", "", "", "searsh", "users", "")
    })
    $("#cpusers").show(function() {

            // if ($("#loadgettab").text() == "lastregster") {
            importfun("models/cpanel/users/01usershow", ".maincpdiv", " اخر المسجلين", "Last REgestres", "show", "users", "WHERE `_admin` = 'no'  ORDER BY `_id` DESC LIMIT 10")
            importfun("models/cpanel/users/01usershow", ".deatalsrusalt", "", "", "detalse", "users", "")
            importfun("models/cpanel/users/01usershow", ".sidecpdiv", "", "", "searsh", "users", "")
                // }
        }) //users show
    $("#cpnot").on("click", function() { //طلبات التحقق

            importfun("models/cpanel/users/03recusersreqver", ".maincpdiv", " اخر الطلبات", "Last requests", "show", "req_ver", " WHERE `_verified` = 'no' ORDER BY `_id` DESC LIMIT 20")
            importfun("models/cpanel/users/03recusersreqver", ".deatalsrusalt", "", "", "detalse", "req_ver", "")
            importfun("models/cpanel/users/03recusersreqver", ".sidecpdiv", "", "", "searsh", "req_ver", "")
        }) //users show

    //تغير كلاس اكتف سايدبار
    $(".input-group").on("click", function() {
        $(this).addClass("activecp").siblings().removeClass("activecp")

    })


});


// users show table in model cpanel users\