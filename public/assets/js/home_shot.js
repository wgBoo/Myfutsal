
$(document).ready(function() {
    $('#goShot').click(function(){
        var params = $('#userModalLabel').text();
        post_to_url("../../../mypage", params, "post");
    });
});

// 동적으로 form생성
function post_to_url(path, params, method) {
    method = method || "post";  //method 부분은 입력안하면 자동으로 post가 된다.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "user_id");
    hiddenField.setAttribute("value", params);
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}




