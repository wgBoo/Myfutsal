<div class="col-lg-9 main-chart">
    <div class="team_page_board_modify">
        <form action="../modify/" method="post">
            <input type="hidden" name="teampage_num" value="<?php echo $team_page->teampage_num ?>">
            <h2>제목 : <input type="text" name="teampage_title" value="<?php echo $team_page->teampage_title; ?>"></h2>

            <p>글쓴이 : <?php echo $team_page->user_id; ?>
                작성일 : <?php echo $team_page->teampage_date; ?></p>

            <p>세부내용<br>
            <textarea name="teampage_content"><?php echo $team_page->teampage_content; ?>
            </textarea></p>
            <a href="../view/<?php echo $team_page->teampage_num ?>"> 취소</a>
            <input type="submit" name="submit_teampage_modify" value="저장">
        </form>
    </div>
</div><!-- /col-lg-9 END SECTION MIDDLE -->

