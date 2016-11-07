
<div class="col-lg-9 main-chart">
    <div class="team_page_board">
        <p> 글쓰기 페이지</p>

        <form action="/team/write/" method="post">
            <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
            <input type="hidden" name="teampage_num" value="<?php echo $teampage_num ?>">
            <p><select name="teampage_category" id="teampage_category" required>
                    <option selected disabled value="">카테고리</option>
                    <option value="가입인사">[가입인사]</option>;
                    <option value="공유">[공유]</option>;

                </select>
            </p>
            <p><input type="text" name="teampage_title" placeholder="제목" required></p>

            <P><textarea name="teampage_content" placeholder="내용" required></textarea></P>

            <p>
                <input type="submit" name="submit_teampage_write" value="작성">
            </p>
        </form>
        <form action="/team/repagewrite/" method="post">
            <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
            <input type="submit"  value="뒤로">
        </form>
    </div>
</div><!-- /col-lg-9 END SECTION MIDDLE -->

