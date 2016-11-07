<html xmlns="http://www.w3.org/1999/html">
<head>
    <script type="text/javascript" src="../common/js/jquery-1.8.3.min.js" charset="euc-kr">
    </script>
    <script>
        var value1 = '<?= $team_home[0] ?>';
        var value2 = '<?= $team_home[1] ?>';
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#Uploadedimg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>
<body onload="init(this.form);">
<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-9 main-chart">

            <div class="team_page">
                <table border="1" width="600">
                    <form name="form" action="/team/teammodify" method="post"
                          enctype="multipart/form-data">
                        <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                        <input type="hidden" name="team_pfimage" value="<?php echo $team_page->team_pfimage ?>"
                        <tr>
                            <td rowspan="4">
                                <img id="Uploadedimg"
                                     src="../../../public/img/team/<?php echo $team_page->team_pfimage ?>">
                                <input type="file" name="pfimage" onchange="readURL(this);">
                            </td>
                            <td><?php echo $team_page->team_name ?></td>
                            <td rowspan="4">

                                <input type="submit" value="팀 수정">

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $team_page->team_leader ?></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="team_ability" value="<?php echo $team_page->team_ability ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                  <select name="home[]" id="first" style="width:70px;"
                                          onchange="itemChange(this.form);"></select>
                                  <select name="home[]" id="second" style="width:70px;"></select>
                            </td>
                        </tr>
                    </form>
                </table>
                <form action="/team/page/" method="post">
                    <input type="submit" value="소통">
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
                <form action="/team/memberlist/" method="post">
                    <input type="submit" value="멤버">
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
                <hr>
            </div>

        </div><!-- /col-lg-9 END SECTION MIDDLE -->
</body>
</html>

