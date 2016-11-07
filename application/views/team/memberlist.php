<div class="col-lg-9 main-chart">
    <div class="teampage_memberlist">

        <table border="1" align="center">
            <?php foreach($team_memberlist as $member) {?>
                <tr><td width="80"><img src="../../../public/img/member/<?php echo $member->user_pfimage ?>"></td>
                    <td width="80"><?php echo $member->user_id ?> 님</td>
                    <td width="80"><?php echo $member->user_home ?></td>
                    <td width="80"><?php
                        if($member->main_team_check == 1){echo "팀 대표";}
                        else {echo "일반 회원";} ?></td></tr>

            <?php  } ?>
        </table>
    </div>

</div><!-- /col-lg-9 END SECTION MIDDLE -->

