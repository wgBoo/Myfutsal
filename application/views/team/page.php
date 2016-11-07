

<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-9 main-chart">

            <div class="team_page">
                <table border="1" width="600">
                    <tr>
                        <td rowspan="4">
                            <img src="../../../public/img/team/<?php echo $team_page->team_pfimage ?>"></td>
                        <td><?php echo $team_page->team_name ?></td>
                        <?php if($_SESSION['loginID']==$team_page->team_leader){ ?>
                        <td rowspan="4">
                            <form action="/team/teammodifyv" method="post">
                                <input type="submit" value="팀 수정">
                                <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                            </form>
                        </td>
                        <?php } ?>
                    </tr>
                    <tr><td><?php echo $team_page->team_leader ?></td></tr>
                    <tr><td><?php echo $team_page->team_ability ?></td></tr>
                    <tr><td><?php echo $team_page->team_home ?></td></tr>
                </table>
                <form action="/team/page/" method="post">
                    <input type="submit"  value="소통">
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
                <form action="/team/memberlist/" method="post">
                    <input type="submit"  value="멤버">
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
                <hr>
            </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->

