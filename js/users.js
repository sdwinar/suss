$(document).ready(function() {
    // ******************************اجاكس فورم تعديل بيانات البروفايل****************************
    $(function() {
        $("#formrditavtar").ajaxForm({
            beforeSend: function() {
                $("#avtarrusalt").html(
                    "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;' />");
            },
            success: function(data) {
                if (data === 'edit') {
                    var sucess = $("#successdone").text();
                    alert(sucess)
                    window.location = '';
                } else {
                    $("#avtarrusalt").html(data);

                }
                // window.location = '';
            },
            error: function(er) {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    });
    // ******************************اجاكس فورم تعديل بيانات الغلاف****************************
    $(function() {
        $("#formrditcover").ajaxForm({
            beforeSend: function() {
                $("#avtarrusalt").html(
                    "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;' />");
            },
            success: function(data) {
                if (data === 'edit') {
                    var sucess = $("#successdone").text();
                    alert(sucess)
                    window.location = '';
                } else {
                    $("#avtarrusalt").html(data);
                }
                // window.location = '';
            },
            error: function(er) {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    });
    // ******************************اجاكس فورم تعديل البيانات ****************************
    $(function() {
        $("#formeditinfo").ajaxForm({
            beforeSend: function() {
                $("#avtarrusalt").html(
                    "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;' />");
            },
            success: function(data) {
                if (data === 'edit') {
                    var sucess = $("#successdone").text();
                    alert(sucess)
                    $("#avtarrusalt").html(' ');
                } else {
                    $("#avtarrusalt").html(data);
                }
                // window.location = '';
            },
            error: function(er) {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    });
    $("#editeprofileavatar,#editeprofilecover").on("change", function() {
        var newavatar = $(this).val();
        $("#setuserimg").text(newavatar);

    })

    // ************************************************************البحث في صفحة المستخدمين***********************************************************************
    function importuserhomeshow(div, order, sql = '') { //دالة جلب اليوزر 
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
    } //دالة جلب اليوزر 

    $("#alusershowrowdiv").show(function() {
        importuserhomeshow("#allusershowdiv", "homeshow", " LIMIT 20");
    });

    $("#btnusersearch").click(function(e) { //جلب المستخدمين غعن طريق البحث
            e.preventDefault();

            var name = $("#usersbyname").val();
            var username = $("#usersbyusername").val();
            var address = $("#usersbyaddress").val();
            var un = $("#usersbyuniversity").val();
            var co = $("#usersbycollege").val();
            var sec = $("#usersbysection").val();
            var bach = $("#usersbybatch").val();
            var unnum = $("#usersbyunnum").val();

            var regtype = $("#usersbyregester").val();


            importuserhomeshow("#allusershowdiv", "homeshow",
                "WHERE `_name` LIKE '%" + name + "%' && `_username` LIKE '%" + username + "%' && `_address` LIKE '%" + address + "%' && (`_aruniversity` LIKE '%" + un + "%' || `_enuniversity` LIKE '%" + un + "%' )  && (`_arcollege` LIKE '%" + co + "%' || `_encollege` LIKE '%" + co + "%' ) && (`_arsection` LIKE '%" + sec + "%' || `_ensection` LIKE '%" + sec + "%' ) && `_adjective` LIKE '%" + regtype + "%' && `_batch` LIKE '%" + bach + "%' && `_unnum` LIKE '%" + unnum + "%'   ORDER BY `_id` DESC");

        })
        // **************************************************************************طلب توثيق الحساب من الصفحة الشخصية profile*************************************************
    $("#frontimg").change(function() {
        var imgval = $("#frontval").text();
        $("#frontspan").text(imgval);
    })
    $("#backimg").change(function() {
            var imgvalback = $("#backval").text();
            $("#backspan").text(imgvalback);
        })
        // ******************************اجاكس فورم طلب التحقق****************************
    $(function() {
        $("#reqverform").ajaxForm({
            beforeSend: function() {
                $("#reqverrusalt").html(
                    "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;' />");
            },
            success: function(data) {

                $("#reqverrusalt").html(data);
            },
            error: function(er) {
                var erorr = $("#conecterorr").text();
                alert(erorr)
            }
        });
    });
});