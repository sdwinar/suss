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
    $(".nav-item").on("click", function() { //وضع يوم المحاضرة للتعديل
        var editename = $("#editename").text();
        var theday = $(this).text();
        var day = $(this).data("day");
        $("#editlec").text(editename + theday);
        $("#editlec").data("id", day);
    });

    $("#editlec").on("click", function() { // الذهاب لتعديل اليوم
        var iii = $(this).data("id");
        importfun("views/lectures/editlec", "#lecshow", iii);
    });


});
l