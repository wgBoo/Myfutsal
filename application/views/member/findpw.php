<?php
if($member_pw!=null) {
    echo $member_pw;
}else{ ?>
    <script>
    window.alert('정보가 올바르지 않습니다')
            history.go(-1)
            </script>
<?php }?><br/>

<button onclick="location.href='/home/index'">로그인 화면으로</button>
