<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-type" charset=utf-8">
    <script src="/public/assets/js/homeground.js"></script>
    <script type="text/javascript" src="/public/assets/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">


            $('#bttHello').click(function () {
                var action = $("#all_joinus_form").attr("action");
                var ajData = {username : $('#username').val()
            };

                $.ajax({
                    type: "post",
                    url: action,
                    data: ajData,
                    dataType: "JSON",
                    success: function (response) {
                        if (response== "success") {
                            window.alert("fail");
                        }
                        else {
                            alert("success");
                        }
                    }
                });
                return false;
            });

    </script>
</head>
<body onload="init(this.form);">
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-chart">

                <div class="team_make">

                    <form action="/team/hello/" method="post">
                        <input type="text" id="username" name="username">
                        <input type="button" value="Hello" id="bttHello">
                        <input type="submit" value="전송">

                    </form>
                    <!--
                                            <form name="form" action="/team/make/" method="POST"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" name="main_team_check" id="main_team_check" value="1" required>

                                                <p><input type="text" name="team_name" id="team_name" placeholder="팀 이름" required></p>


                                                <select name="home[]" id="first" style="width:70px;"
                                                        onchange="itemChange(this.form);"></select>
                                                <select name="home[]" id="second" style="width:70px;"></select>

                                                <p><input type="text" name="team_ability" id="team_ability" placeholder="팀 실력" required></p>

                                                <P><textarea name="team_produce" id="team_produce" placeholder="팀 내용" required></textarea>
                                                </P>

                                                <p><input type="file" name="pfimage"></p>

                                                <p>
                                                    <input type="button" value="뒤로" onclick="history.back()">
                                                    <input type="submit" name="submit_make_team" value="생성">
                                                </p>
                                            </form>-->
                </div>

            </div><!-- /col-lg-9 END SECTION MIDDLE -->

</body>
</html>
