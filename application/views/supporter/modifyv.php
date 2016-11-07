<SCRIPT language=JavaScript>

    var f_selbox = new Array('한식', '중식', '일식' , '외국식');

    var s_selbox = new Array();
    s_selbox[0] = new Array('김치찌게', '된장찌게', '불고기', '설렁탕', '뼈해장국');
    s_selbox[1] = new Array('탕수육', '팔보채', '깐풍기');
    s_selbox[2] = new Array('초밥', '덮밥', '문어구이');
    s_selbox[3] = new Array('스테이크', '캐비어', '푸아그라', '파스타');

    function init(f){
        var f_sel = f.first;
        var s_sel = f.second;

        f_sel.options[0] = new Option("선택", "");
        s_sel.options[0] = new Option("선택", "");

        for(var i =0; i<f_selbox.length; i++){
            f_sel.options[i+1] = new Option(f_selbox[i], f_selbox[i]);
        }
    }

    function itemChange(f){
        var f_sel = f.first;
        var s_sel = f.second;

        var sel = f_sel.selectedIndex;
        for(var i=s_sel.length; i>=0; i--){
            s_sel.options[i] = null;
        }

        s_sel.options[0] = new Option("선택", "");

        if(sel != 0){
            for(var i=0; i<s_selbox[sel-1].length; i++){
                s_sel.options[i+1] = new Option(s_selbox[sel-1][i], s_selbox[sel-1][i]);
            }
        }
    }
</SCRIPT>
<body onload = "init(this.form);">
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-chart">

                <div class="supporter_write">
                    <form name="form" action="/supporter/modify/<?php echo $supporter_modify[0] -> spt_num?>" method="POST">
                        <select name="spt_number" id="spt_number" required>
                            <option selected disabled>모집 인원</option>
                            <?php
                            for($i = 1; $i <= 20; $i++)
                            {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>

                        <p><br><select id="first" style="width:70px;" onchange="itemChange(this.form);" ></select>
                            <select id="second" style="width:70px;" ></select></p>
                        <p><input type="text" name="spt_address" id="spt_address" value="<?php echo $supporter_modify[0] -> spt_address?>" placeholder="위치를 상세하게 적어주세요" required></p>
                        <p><input type="date" name="spt_date" id="spt_date" min="<?php echo $min=date("Y-m-d"); ?>" max="<?php echo $max=date("Y-m-d",strtotime("+365 day")); ?>"> </p>
                        <p>경기시간 :&nbsp;
                            <input type="time" name="spt_starttime" id="spt_starttime" min="00:00" max="24:00" > ~
                            <input type="time" name="spt_endtime" id="spt_endtime" min="00:00" max="24:00" >
                        </p>
                        <p><input type="text" name="spt_content" id="spt_content" placeholder="내용"> </p>
                        <p>
                            <button onclick="location.href='/supporter/index'">취소</button>
                            <input type="submit" name="submit_modify_supporter" value="작성">
                        </p>
                    </form>
                </div>
            </div><!-- /col-lg-9 END SECTION MIDDLE -->
        </div>
</body>