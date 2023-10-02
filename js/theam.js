$(document).ready(function() {

    // changetheam*******************************************************************************************************

    function changetheam() {
        var cek = $(".checktheam").attr("checked"),
            url = "models/main/changetheam"
        if (cek == undefined) {
            cek = 'dark';
        } else {
            cek = 'light';

        }
        $.ajax({
            method: "GET",
            url: url,
            data: {
                ceked: cek
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function light() {
        $(".navbar,.cpdiv,.theambackground").addClass("light").removeClass("dark")
        $(".divtheam").addClass("divlight").removeClass("divdark")
        $(".nav-a,.dropdown-menu,.font_theam").addClass("font_light").removeClass("font_dark")
        $(".filtertheam").css({ "filter": "brightness(0.9)" })
        $(".homesidebara").addClass("homesidebaralight").removeClass("homesidebaradark") //لينكات السي بنل لوحة التحكم
        $(".cover").addClass("backlight").removeClass("backdark") //الخلفية المعتمة


    }

    function dark() {
        $(".navbar,.cpdiv,.theambackground").addClass("dark").removeClass("light")
        $(".divtheam").addClass("divdark").removeClass("divlight")
        $(".nav-a,.dropdown-menu,.font_theam").addClass("font_dark").removeClass("font_light")
        $(".filtertheam").css({ "filter": "brightness(0.3)" })
        $(".homesidebara").addClass("homesidebaradark").removeClass("homesidebaralight") //لينكات السي بنل لوحة التحكم
        $(".cover").addClass("backdark").removeClass("backlight") //الخلفية المعتمة


    }

    $("#checktheam").on("change", function() {
        changetheam()
        var transform = $(".checktheam").attr("checked")
        if (transform == "checked") {
            light()
        } else {
            dark()
        }
    })
    $("#checktheam").show(function() {
        changetheam()
        var transform = $(".checktheam").attr("checked")
        if (transform == "checked") {
            light()
        } else {
            dark()
        }
    })

});