$(document).ready(function() {

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

    $("#lecshow").show(function() { // lecshow
        importfun("models/lectures/01lecshow", "#lecshow", "");
    });

    $("#edre").on("click", function() {
        importfun("views/lectures/editlec", "#lecshow", "");
    });




});
l