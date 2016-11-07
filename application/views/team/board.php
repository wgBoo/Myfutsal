<?php
if (!$teamMember) { ?>
    <script>
        window.alert('팀 멤버가 아닐 경우 게시글 읽기만 가능합니다')
    </script>
<?php }?>

<div class="col-lg-9 main-chart">

    <div class="team_page_board">
        <form action="../writev" method="post">
            <?php if ($teamMember) {
                echo '<input type="submit" value="글쓰기">';
            } ?>
            <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
        </form>
        <div class="team-board">

            <table border='2' width='500' align='CENTER'>
                <tr>
                    <th>카테고리</th>
                    <th>작성자</th>
                    <th>제목</th>
                    <th>작성일</th>
                </tr>
                <?php if ($team_board != null) {
                    foreach ($team_board as $row) {
                        $gap = "";
                        $key = "";
                        for ($cnt = 0; $cnt < $row->teampage_depth; $cnt++) {
                            $gap = "&nbsp&nbsp" . $gap;
                            $key = "└";
                        }
                        ?>

                        <tr>
                            <td width><?php echo $row->teampage_category; ?></td>
                            <td width><?php echo $row->user_id ?></td>
                            <td width><?php echo "$gap$key" ?><a
                                    href="/team/view/<?php echo $row->teampage_num ?>"><?php echo $row->teampage_title ?></a>
                            </td>
                            <td width><?php echo $row->teampage_date ?></td>
                        </tr>
                    <?php }
                } ?>
            </table>
            <br>

            <p align="center"><?php echo $links; ?></p>
        </div>

    </div>
</div><!-- /col-lg-9 END SECTION MIDDLE -->

