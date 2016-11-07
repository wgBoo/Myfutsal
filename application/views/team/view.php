<div class="col-lg-9 main-chart">
    <div class="team_page_board">


        <h2>제목 : <?php echo $team_page->teampage_title; ?></h2>

        <p>글쓴이 : <?php echo $team_page->user_id; ?>
            작성일 : <?php echo $team_page->teampage_date; ?></p>

        <p>세부내용<br> <?php echo $team_page->teampage_content; ?></p>
        <a href="/team/delete/<?php echo $team_page->teampage_num ?>"> 삭제</a>
        <a href="/team/modifyV/<?php echo $team_page->teampage_num ?>"> 수정</a>
        <a href="/team/repage/<?php echo $team_page->teampage_num ?>"> 목록</a>
        <form action="/team/writev" method="post" >
            <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
            <input type="hidden" name="teampage_num" value="<?php echo $team_page->teampage_num ?>">
            <input type="submit" name="submit_teampage_response" value="답글">
        </form>
    </div>

</div><!-- /col-lg-9 END SECTION MIDDLE -->

