$(document).ready(function() {
    $('#bookmarkU').click(function(){

        // id값 가져옴
        var user_id = $('#userModalLabel').text();

        // 즐겨찾기 추가 된 경우
        if($('#check').attr('class') == "glyphicon glyphicon-star") {

            var check = "delete";

            $.ajax({

                // 회원가입 거쳐서 바로 삭제
                url: '../../../bookmark',
                type: 'POST',
                data: { "user_id" : user_id, "check" : check },
                success:function(data){

                    location.reload();     // 새로고침
                }
            });
        }

        // 즐겨찾기 추가 안 된 경우
        else if($('#check').attr('class') != "glyphicon glyphicon-star") {

            var check = "insert";

            $.ajax({

                // 회원가입 거쳐서 바로 삭제
                url: '../../../bookmark',
                type: 'POST',
                data: { "user_id" : user_id, "check" : check },
                success:function(data){
                    location.reload();     // 새로고침
                }
            });
        }
    });
});
