$(document).ready(function() {

    function importuserhomeshow(div, order, sql = '') { //دالة جلب اليوزر الي الهوم
        $.ajax({
            method: "GET",
            url: "models/home/01usersshow",
            data: {
                // table: table,
                sql: sql,
                // titlear: titlear,
                // titleen: titleen,
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

    $("#homeusershowrowdiv").show(function() {
        importuserhomeshow("#homeusershowdiv", "homeshow", "WHERE `_id` != '$userinfo[_id]' LIMIT 8");
    });
    $('#homeusersserch').on("keyup", function() {
        var q = $(this).val();
        importuserhomeshow("#homeusershowdiv", "homeshow", "WHERE (`_username` LIKE '%" + q + "%'  OR `_name` LIKE '%" + q + "%') ORDER BY `_id` DESC LIMIT 8");
    });



});