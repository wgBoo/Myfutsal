<section id="main-content">
    <section class="wrapper">
        <div class="row">
                <div class="col-lg-9 main-chart">
                    <!-- 글쓰기 공간 -->
                    <?php if($_SESSION['loginID'] == $timeline_user) {?>
                    <div class="container">
                        <div class="span7 bottom15">
                            <div class="roundinside bottom15 center">
                                <label class="lightblue bold leftalign" for="textarea">Compose New Message</label>
                                <form action="../../mypage/mypageWrite" method="post">
                                    <textarea name="content" rows="5" cols="80" style="resize: none; font-size: 20px;"></textarea>
                                    <br/><br/>
                                    <input type="submit" value="Create">
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="reset" value="Reset">
                                    <!--<a class="btn btn-primary" id="writeBtn"> Write </a>&nbsp;
                                    <a class="btn btn-info between" id="reloadBtn"> Refresh </a>-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--<div class="thumb">

                        <img class="img-circle" src="../../../public/img/member_s/<?/*=$row -> user_psimage*/?>" align="left">

                    </div>-->
                    <!-- 타임라인 공간 -->
                    <div>
                        <div class="container">
                            <div id="haha">
                            <ul id ="scroll_mypage_01" class="timeline">

                                <?php $last_notice_num = 0;?>
                                <?php foreach($timelineList as $row){
                                    $last_notice_num = $row -> time_num;
                                ?>

                                <li><!---Time Line Element--->

                                    <div class="timeline-badge up"  ><i class="fa fa-thumbs-up"></i></div>
                                    <div class="timeline-panel" style="background-color:white; min-height: 30em;">

                                        <div class="timeline-heading" >
                                            <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row -> user_id?>">
                                                <div class="thumb">
                                                    <img class="img-circle" src="../../../public/img/member_s/<?=$row -> user_psimage?>" align="left">
                                                </div>
                                            </div>
                                            <h4 class="timeline-title"><?php echo $row -> user_id; ?></h4>
                                            <h5><?php echo $row -> time_date; ?></h5>
                                        </div>
                                        <div class="timeline-body"><!---Time Line Body&Content--->
                                            <br/>
                                            <p style="font-size: large"><?php echo $row -> time_content; ?></p>
                                        </div>
                                    </div>



                                    <div class="timeline-panel_reply" style="background-color:white; min-height: 5em;">

                                        <!-- 댓글 쓰는공간 -->
                                        <table>
                                            <tr>
                                                <td>
                                                    <img src="../../../public/img/member_s/<?=$myInfoList[0]->user_psimage?>">
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                                <td>
                                                    <?php echo $user_id ?>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                                <td>
                                                    <form action="/timeline_reply/write/<?php echo $row -> time_num ?>" method="post">
                                                        <input type="hidden" name="reply_user" value="<?php echo $user_id?>">
                                                        <input type="text" name="reply_content" placeholder="댓글을 입력하세요." style="min-height: 3em; min-width: 50em; border : 1px solid black">
                                                        <input type="submit" value="쓰기">
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>


                                        <!-- 댓글이 달리는 공간-->
                                        <?php

                                            for($cnt = 0 ; $cnt < count($timeline_reply) ; $cnt++ ) {
                                                if(($row -> time_num) == (@($timeline_reply[0][$cnt]->time_num))) {
                                                    ?>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <img src="../../../public/img/member_s/<?=$timeline_reply[0][$cnt] -> user_psimage?>">
                                                            </td>
                                                            <td>
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <?php echo $timeline_reply[0][$cnt] -> user_id; ?>
                                                            </td>
                                                            <td>
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <div style="min-height: 3em; min-width: 50em; border : 1px solid black">
                                                                    <?php echo $timeline_reply[0][$cnt] -> reply_content; ?>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <br>
                                                    <?php
                                                }
                                                else {

                                                }
                                            }
                                        ?>
                                        <!--------------------->



                                        <!----------------->
                                    </div>


                                <?php }?>
                                </li>

                            </ul>
                            </div>
                        </div>

                    </div>
                    <script type="text/javascript">var last_notice_num = <?php echo "$last_notice_num"; ?>;</script>
                    <p id="loader" style="text-align: center; display: none">
                        <img src="../../public/assets/img/loader.gif">
                    </p>

                </div><!-- /col-lg-9 END SECTION MIDDLE -->


