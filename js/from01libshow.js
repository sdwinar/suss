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

    $(".getlec").on("click", function() {
        var sub = $(this).data('sub');
        var type = $(this).data('type');
        importfun("models/library/01libshow", "#libmaincpdiv", type, "Last REgestres", "show", "library", sub)
    });
    $(".showvideoclass").on("click", function() { //مشاهدة الفديو
        var videoid = $(this).data('id');
        var name = $(this).data('name');
        importfun("models/library/03showvideo", "#libmaincpdiv", videoid, name, "show", "library", "sub")
    });
    ////////////////////////////////////////////البحث//////////
    $("#btnlibserch").on("click", function() { // btnlibserch
        var name12 = $("#name12").val();
        var course12 = $("#course12").val();
        var semester12 = $("#semester12").val();
        var university12 = $("#university12").val();
        var section12 = $("#section12").val();
        var batch12 = $("#batch12").val();
        var type12 = $("#type12").val();
        importfun("models/library/01libshow", "#libmaincpdiv", "", "Last REgestres", "serch", "library", "",
            "WHERE `_name` LIKE '%" + name12 + "%' && `_subject` LIKE '%" + course12 + "%' && `_semester` LIKE '%" + semester12 + "%' && (`_arun` LIKE '%" + university12 + "%' || `_enun` LIKE '%" + university12 + "%' )  && (`_arsec` LIKE '%" + section12 + "%' || `_ensec` LIKE '%" + section12 + "%' )            && `_batch` LIKE '%" + batch12 + "%' && `_type` LIKE '%" + type12 + "%'   ORDER BY `_id` DESC LIMIT 50");

    });
    ////////////////////////////////////////////الحذف//////////
    $(".deleteicon").on("click", function() { // deleteicon
        var cinf = $("#deleteyesno212").text();
        var id = $(this).data("id");
        var delpro = confirm(cinf);
        if (delpro == true) {
            importfun("models/library/01libshow", "#libmaincpdiv", "", "Last REgestres", "delete", "library", id)
        } else {

        }

    });







});