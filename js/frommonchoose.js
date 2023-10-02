$(document).ready(function() {

    function importfun(url, div, order = '', votedid = '') { //دالة جلب ملفات الماين ديف
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                votedid: votedid
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


    $(".userchoosemon").on("click", function() { //ارسال رقم المرشح الي الجدول
        var votedid = $(this).data('id');
        importfun("models/monasig/01choose", "#monaresultdiv", "addmonseg", votedid);
    });










});