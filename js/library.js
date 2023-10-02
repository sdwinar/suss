$(document).ready(function() {

    function importfun(url, div, type, titleen, order, table, sub = '', sql = '') { //دالة جلب ملفات الماين ديف
        $.ajax({
            method: "GET",
            url: url,
            data: {
                table: table,
                sub: sub,
                type: type,
                titleen: titleen,
                order: order,
                sql: sql
            },
            beforeSend: function() {
                $(div).html(
                    "<img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' />")
            },
            success: function(data) {
                $(div).html(data)
            },
            error: function() {
                var erorr = $("#conecterorr").text();
                alert(erorr);
            }
        });
    } //دالة جلب ملفات الماين ديف

    $("#libcontiner").show(function() { //ملفات السمستر

            importfun("models/library/01libshow", "#libmaincpdiv", "lecfile", "Last REgestres", "show", "library", "lastlec")
            importfun("models/library/01libshow", ".sideleftbar", "lecfile", "Last REgestres", "sideleft", "library", "")


        }) //users show


    $("#leclibershow").on("click", function() { //ملفات السمستر
        // $(this).hide();
        importfun("models/library/01libshow", "#libmaincpdiv", "lecfile", "Last REgestres", "show", "library", "lastlec")
        importfun("models/library/01libshow", ".sideleftbar", "lecfile", "Last REgestres", "sideleft", "library", "")
    });
    $("#Workingpapers").on("click", function() { //اوراق عمل
        // $(this).hide();
        importfun("models/library/01libshow", "#libmaincpdiv", "perer", "Last REgestres", "show", "library", "lastlec")
        importfun("models/library/01libshow", ".sideleftbar", "perer", "Last REgestres", "sideleft", "library", "")
    });
    $("#videoclip").on("click", function() { //videoclip 
        // $(this).hide();
        importfun("models/library/01libshow", "#libmaincpdiv", "video", "Last REgestres", "show", "library", "lastlec")
        importfun("models/library/01libshow", ".sideleftbar", "video", "Last REgestres", "sideleft", "library", "")
    });
    $("#yourfiles").on("click", function() { //yourfiles 
        var myid = $(this).data("myid");
        importfun("models/library/01libshow", "#libmaincpdiv", "", "myfile", "serch", "library", "", "WHERE `_monid` LIKE '%" + myid + "%'  ORDER BY `_id` DESC");
        $(".sideleftbar").html(' ');

    });
    $("#searchlib").on("click", function() { //searchlib 
        // $(this).hide();
        importfun("models/library/01libshow", ".sideleftbar", "video", "", "search", "library", "")
    });


    $("#btnaddfile").on("click", function() { //ملفات إضافة
        $(".sideleftbar").html(' ');
        importfun("views/library/newfile", "#libmaincpdiv", "file");
    });
    $("#addfilm").on("click", function() { //addfilm إضافة
        $(".sideleftbar").html(' ');
        importfun("views/library/newfile", "#libmaincpdiv", "film");
    });



});