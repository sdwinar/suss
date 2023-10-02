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

    $("#nav-about-tab").on("click", function() { //اختيار المنسق
        importfun("models/monasig/01choose", "#nav-about", "showbatch");
    });
    $("#nav-contact-tab").on("click", function() { // المنسق
        importfun("models/monasig/02show", "#nav-contact", "showbatch");
    });
    $("#nav-home-tab").on("click", function() { // منشورات المنسق
        // importfun("models/monasig/03monapost", "#monapostreusalt", "isadmin"); //كتابة
        importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow"); //عرض المنشورات
        $("#monaposttext").val("");

    });
    $("#nav-home-tab").show(function() { // منشورات المنسق
        // importfun("models/monasig/03monapost", "#monapostreusalt", "isadmin");
        importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow");
        $("#monaposttext").val("");

    });

    // ******************************اجاكس فورم منشور جديد****************************
    $(function() {
        $("#newmonapostform").ajaxForm({
            beforeSend: function() {
                $("#monapostdiv").html(
                    "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>")
            },
            success: function(data) {
                $("#monaposttext").val("");
                importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow");
                $("#monapostdiv").html(data);

            },
            error: function() {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    });
    //*****************************************************تعدد الصفحات************************************************ */
    $(".page123").on("click", function() {

        var pagenum = $(this).text();
        importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow", pagenum); //عرض المنشورات
    });
    //*****************************************************بحث منشورات المنسق************************************************* */
    $("#monapostsershform").submit(function(e) {
        e.preventDefault();
        var sersh = $("#monapostsersh").val();

        importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow", "", " && `_post` LIKE '%" + sersh + "%'"); //عرض المنشورات



    });








});