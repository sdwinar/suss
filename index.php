<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <center>
        <img src="media/img/main/logo.png" alt="LOGO" style="margin-top:7%;display: none;">
    </center>
    <script src="js/jquery-3.4.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
            url: "home",
            method: "POST",
            beforeSend: function() {
                $("img").slideDown();
            },
            success: function() {
                window.location = "home";
            }
        });
        });
    </script>
</body>

</html>