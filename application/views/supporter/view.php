<?php $loginID = $_SESSION['loginID']; ?>

<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <div>

                <!-- 상세보기를 위한 div -->
                <div>
                    <!-- 유저 상세보기 -->
                    <?php

                    $check = true;
                    $pfRowSpan = 4;
                    for($i = 0 ; $i < count($supporter_request) ; $i++ ) {

                        if($_SESSION['loginID'] == ($supporter_request[$i] -> sptr_user)) {
                            $check = false;
                            $pfRowSpan = 3;
                        }
                    }
                    ?>
                    <table border="1" width="80%" align="center">
                        <tr>
                            <td rowspan="<?= $pfRowSpan ?>" width="15%" height="100"><?php echo $supporter_writer_and_board[0]->user_pfimage ?></td>
                            <td><?php

                                if(isset($supporter_team[0]->team_name)) {
                                    echo $supporter_team[0]->team_name;
                                } else {
                                    echo "대표팀이 없습니다.";
                                }
                                ?></td>
                        </tr>

                        <tr><td>
                                <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $supporter_writer_and_board[0] -> user_id?>">
                                    ID : <?php echo $supporter_writer_and_board[0]->user_id ?></div>
                            </td></tr>
                        <tr><td>홈그라운드 : <?php echo $supporter_writer_and_board[0]->user_home ?></td></tr>
                        <tr>
                            <?php

                            if(($_SESSION['loginID'] != $supporter_writer_and_board[0] -> spt_writer) && ($check == true) ) {?>
                                <td>
                                    <form action="../../supporter/request" method="post">
                                        <input type="number" name="request_num" min="1" max="<?php echo $supporter_writer_and_board[0]->spt_number?>" value="1">
                                        <input type="hidden" name="user_id" value="<?=$_SESSION['loginID']?>">
                                        <input type="hidden" name="spt_num" value="<?=$supporter_writer_and_board[0]->spt_num?>">
                                        <input type="submit" value="참가신청">
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
                <br>

                <!-- 용병신청 글 -->
                <table border="1" width="80%" align="center">
                    <tr><td colspan="2">상세위치 : <?php echo $supporter_writer_and_board[0]->spt_address ?></td></tr>
                    <tr>
                        <td>경기날짜 : <?php echo $supporter_writer_and_board[0]->spt_date ?></td>
                        <td>실력 : <?php echo $supporter_writer_and_board[0]->user_ability ?></td>
                    </tr>
                    <tr>
                        <td>경기 예정 시간 : <?php echo $supporter_writer_and_board[0]->spt_starttime ?> ~ <?php echo $supporter_writer_and_board[0]->spt_endtime ?></td>
                        <td>남은 모집인원 :<?php echo $supporter_writer_and_board[0]->spt_number ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea cols="100%" rows="6" readonly/><?php echo $supporter_writer_and_board[0]->spt_content ?></textarea>
                        </td>
                    </tr>
                </table>
                <!-- 용병신청 글 종료 -->
            </div>
            <br>
            <p align="right">
                <button onclick="location.href='/supporter/modifyV/<?php echo $supporter_writer_and_board[0]->spt_num?>'">수정</button>&nbsp;&nbsp;
                <button onclick="location.href='/supporter/del/<?php echo $supporter_writer_and_board[0]->spt_num?>'">삭제</button></p>
            <div>
                <h4 align="center">---------------------신청자 목록-------------------</h4>
                <br>
                <?php
                foreach($supporter_request as $row) {?>
                    <table width="80%" border="1" align="center">
                        <tr>
                            <td rowspan="3">사진<?php echo $row->user_psimage ?></td>
                            <td>
                                <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row->sptr_user?>">
                                    ID : <?php echo $row->sptr_user ?>
                                </div>
                            </td>
                            <?php
                            if($loginID != $supporter_writer_and_board[0]->user_id)
                                $colSpan = 3;
                            else
                                $colSpan = 2;
                            ?>
                            <?php if($loginID == $supporter_writer_and_board[0]->user_id) { ?>
                                <?php if(0 == $row->sptr_status) { ?>
                                    <td><button onclick="location.href='../../supporter/gameJoin/<?=$row->user_id?>/<?=$supporter_writer_and_board[0]->spt_num?>/<?=$row->sptr_number?>'">수락</button></td>
                                <?php } else if(1 == $row->sptr_status) { ?>
                                    <td rowspan="<?= $colSpan ?>">승인</td>
                                <?php } else { ?>
                                    <td rowspan="<?= $colSpan ?>">거절</td>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if(0 == $row->sptr_status) { ?>
                                    <td rowspan="3">
                                        <form action="../../supporter/gameCancel" method="post">
                                            <input type="hidden" name="sptr_num" value="<?=$row->sptr_num?>">
                                            <input type="hidden" name="spt_num" value="<?=$row->spt_num?>">
                                            <input type="hidden" name="sptr_number" value="<?=$row->sptr_number?>">
                                            <input type="submit" value="취소">
                                        </form>
                                    </td>
                                <?php } else if(1 == $row->sptr_status) { ?>
                                    <td rowspan="<?= $colSpan ?>">승인</td>
                                <?php } else { ?>
                                    <td rowspan="<?= $colSpan ?>">거절</td>
                                <?php } ?>
                            <?php }?>
                        </tr>
                        <tr>
                            <td>실력 : <?php echo $row->user_ability ?></td>
                            <?php if($loginID == $supporter_writer_and_board[0]->user_id) { ?>
                                <?php if(0 == $row->sptr_status) { ?>
                                    <td>
                                        <form action="../../supporter/gameRefusal" method="post">
                                            <input type="hidden" name="user_id" value="<?=$row->user_id?>">
                                            <input type="hidden" name="spt_num" value="<?=$row->spt_num?>">
                                            <input type="submit" value="거절">
                                        </form>
                                    </td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>참여 인원 : <?php echo $row->sptr_number ?></td>
                            <?php if($loginID == $supporter_writer_and_board[0]->user_id) { ?>
                                <td><button>쪽지</button></td>
                            <?php } ?>
                        </tr>
                    </table>
                    <br>
                <?php } ?>
            </div>
        </div>

