<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-9 main-chart">
            <h2>대표팀</h2>
            <button onclick="location.href='/team/makev/'">팀 생성</button>
            <?php
            if($teamList){
            foreach ($teamList as $row) {
                if ($row->main_team_check == 1) { ?>
                    <table border="1" width="600">
                        <tr>
                            <td rowspan="4">
                                <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>"></td>
                            <td><?php echo $row->team_name ?></td>
                            <td rowspan="4">
                                <form action="team/page/" method="post">
                                    <input type="submit" value="상세보기">
                                    <input type="hidden" name="team_name" value="<?php echo $row->team_name ?>">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $row->team_leader ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $row->team_ability ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $row->team_home ?></td>
                        </tr>
                    </table>
                    <hr>
                <?php }
            }
            foreach ($teamList as $row) {
                if ($row->main_team_check == 0) {
                    ?>
                    <table border="1" width="600">
                        <tr>
                            <td rowspan="4">
                                <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>"></td>
                            <td><?php echo $row->team_name ?></td>

                            <td rowspan="4">
                                <form action="team/page/" method="post">
                                    <input type="submit" value="상세보기">
                                    <input type="hidden" name="team_name" value="<?php echo $row->team_name ?>">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $row->team_leader ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $row->team_ability ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $row->team_home ?></td>
                        </tr>
                        <br/>
                    </table>
                <?php }
            }} ?>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->
