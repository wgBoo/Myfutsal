<?php
if($member_id!=null) {
    echo "아이디 :".$member_id;
}else{?>
    <script>
    window.alert('아이디가 없습니다')
            history.go(-1)
            </script>

<?php }?>
<br/>
<button onclick="location.href='/home/index'">로그인 화면으로</button>
<button onclick="location.href='/member/findPw'">비밀번호 찾기</button>