$(document).ready(function() {

    $(".monaedithispost").on("click", function() { //فتح تكست التعديل
        var postid = $(this).data("id");
        $(".editthisthpost" + postid).slideToggle();
    });

    function importfun(url, div, order = '', monaeditposttext = '', postid = '') { //دالة جلب ملفات الماين ديف
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                monaeditposttext: monaeditposttext,
                postid: postid
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

    $(".sendmonaeditpost").on("click", function(e) { //ارسال التعديل
        e.preventDefault();
        var postid = $(this).data("sendid"),
            monaeditposttext = $("#monaeditposttext" + postid).val();
        if (monaeditposttext != '') {
            importfun("models/monasig/03monapost", "#monaeditpostreusalt" + postid, "editpost", monaeditposttext, postid); //عرض المنشورات
        }
    });
    $(".sendmonaeditpost").on("click", function(e) { //ارسال التعديل
        e.preventDefault();
        var postid = $(this).data("sendid"),
            monaeditposttext = $("#monaeditposttext" + postid).val();
        if (monaeditposttext != '') {
            importfun("models/monasig/03monapost", "#monaeditpostreusalt" + postid, "editpost", monaeditposttext, postid); //عرض المنشورات
            var cont = 0,
                time = setInterval(function() {
                    cont++;
                    if (cont == 2) {
                        importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow", '', '');
                        $("#monaposttext").val("");
                    } else if (cont == 3) {
                        clearInterval(time);
                    }

                }, 1000)


        }
    });

    $(".monadeletehispost").on("click", function() { //فتح تكست الحذف
        var postid = $(this).data("id");
        $("#arushor" + postid).slideDown(
            function() {
                $("#yesamshor" + postid).slideDown(
                    function() {
                        $("#noamshor" + postid).slideDown()
                    }
                )
            }
        );
    });

    $(".noamshor").on("click", function() { //لا اريد الحذف 
        var postid = $(this).data("id");
        $("#arushor" + postid).slideUp(
            function() {
                $("#yesamshor" + postid).slideUp(
                    function() {
                        $("#noamshor" + postid).slideUp()
                    }
                )
            }
        );
    });

    $(".yesamshor").on("click", function() { //نعم اريد الحذف 
        var postid = $(this).data("id");
        importfun("models/monasig/03monapost", ".monaeditpostreusalt123" + postid, "deletpost", 'dswdswd', postid); //عرض المنشورات
        var cont = 0,
            time = setInterval(function() {
                cont++;
                if (cont == 2) {
                    importfun("models/monasig/03monapost", "#monapostreusalt", "postsshow", '', '');
                    $("#monaposttext").val("");
                } else if (cont == 3) {
                    clearInterval(time);
                }

            }, 1000)
    });
    // إظهار وإخفاء التعليقات
    $(".comspan478").on("click", function() {
        var coment = $(this).data("id");
        $("#" + coment).slideToggle();
        $("." + coment).slideToggle();
        $("." + coment).css("overflow-auto");
    });
    // ******************************اجاكس  تعليق جديد****************************
    $(".newmoncomentform").submit(function(e) {
        e.preventDefault();
        var comid = $(this).data('id');
        var newcom = $('#newcomment' + comid).val();
        $.ajax({
            method: "GET",
            url: 'models/monasig/04comment',
            data: {
                comid: comid,
                newcom: newcom,
                order: 'add'
            },
            beforeSend: function() {
                $("#comresult" + comid).html(
                    "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>")
            },
            success: function(data) {
                $("#comresult" + comid).html(data)
            },
            error: function() {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    })

    $(".newmoncomentform").show(function() {
            var comid = $(this).data('id');
            var newcom = $('#newcomment' + comid).val();
            $.ajax({
                method: "GET",
                url: 'models/monasig/04comment',
                data: {
                    comid: comid,
                    newcom: newcom,
                    order: 'show'
                },
                beforeSend: function() {
                    $("#comresult" + comid).html(
                        "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>")
                },
                success: function(data) {
                    $("#comresult" + comid).html(data)
                },
                error: function() {
                    var erorr = $("#conecterorr").text();
                    alert(erorr)
                }
            });
        })
        // ****************************************ارسال الاعجاب بالمنشور*************************
    $(".comspanlike").on("click", function() {

            var src = $(this).attr("src");
            if (src == 'media/img/main/like1.png') {
                $(this).attr("src", "media/img/main/like2.png");
            } else {
                $(this).attr("src", "media/img/main/like1.png");

            }
            var likeid = $(this).data('id');
            $.ajax({
                method: "GET",
                url: 'models/monasig/05like',
                data: {
                    likeid: likeid,
                    order: 'add'

                },
                success: function(data) {
                    // $("#comresult" + comid).html(data)
                    alert(data);
                },
                error: function() {
                    var erorr = $("#conecterorr").text();
                    alert(erorr)
                }
            });
        })
        // إظهار وإخفاء المعجبين
    $(".comspanlikers").on("click", function() {
        var coment = $(this).data("id");
        $("#like" + coment).slideToggle();
        var comid = $(this).data('id');

        $.ajax({
            method: "GET",
            url: 'models/monasig/05like',
            data: {
                comid: comid,
                order: 'show'
            },
            beforeSend: function() {
                $("#likere" + comid).html(
                    "<center><img src='media/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>")
            },
            success: function(data) {
                $("#likere" + comid).html(data)
            },
            error: function() {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    });










});