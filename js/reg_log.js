$(document).ready(function() {

    // سيلكت الجامعة في تسجيل جديد
    $("#seluniversity").on("change", function() {
        var seluniversity = $("#seluniversity").val();
        if (seluniversity != 0) {
            $("#divCollege").slideDown();
            var unen = $(this).val();
            var unar = $('#' + unen).data('ar');
            $("#universityar").val(unar);
        } else {
            $("#divCollege").slideUp(function() {
                $(".College").slideUp();
            });

        }
    });
    //

    // سيلكت الكلية في تسجيل جديد
    $("#selCollege").on("change", function() {
        var selCollege = $("#selCollege").val();
        var selCollege = "#div" + selCollege;
        $(selCollege).slideDown().siblings().fadeOut();
        //تحميل الاسم بالعربي
        var Collegear = $("#selCollege").val();
        Collegear = "#option" + Collegear;
        Collegearar = $(Collegear).data('ar');
        $("#collegear").val(Collegearar);
    });
    // سيلكت الاقسام في تسجيل جديد
    $(".optionsection").on("change", function() {
        var value = $(this).val();
        var valuen = $('#option' + value).data("en");
        $("#secen").val(valuen);
        var value = $('#option' + value).data("ar");
        $("#secar").val(value);

    });

    //التبديل بين طالب واستاذ
    $(".registration_type").on("click", function() {
        var registrationtype = $(this).val();
        if (registrationtype == "student") {
            $("#divregistration").slideDown(function() {
                $("#divbatch").slideDown(function() {
                    $("#divunnum").slideDown();
                });
            });
        } else {
            $("#divunnum").slideUp(function() {
                $("#divunnum").slideUp(function() {
                    $("#divbatch").slideUp(function() {
                        $("#divregistration").slideUp();
                    });
                });
            });
        }
    });

});
// ******************************اجاكس فورم تسجيل جديد****************************
$(function() {
    $("#regform").ajaxForm({
        beforeSend: function() {
            $("#regrusalt").html(
                "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;' />");
        },
        success: function(data) {
            $("#regrusalt").html(data);
        },
        error: function(er) {
            alert(er)
        }
    });
});
// ******************************اجاكس فورم تسجيل جديد****************************
// ******************************اجاكس فورم تسجيل  الدخول****************************
$(function() {
    $("#logform").ajaxForm({
        beforeSend: function() {
            $("#logrusalt").html(
                "<img src='media/img/main/lod.gif' width='140px' style='margin-top: 15px;width: 28%;height: 4vh;' />");
        },
        success: function(data) {
            $("#logrusalt").html(data);
        },
        error: function(er) {
            alert(er)
        }
    });
});
// ******************************اجاكس فورم تسجيل  الدخول****************************