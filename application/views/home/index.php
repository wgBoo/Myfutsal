<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>풋살</title>

    <link href="/public/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/login.css" />

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="/public/assets/js/bootstrap.min.js"></script>
    <script src="/public/assets/js/login.js"></script>

</head>
<body>
<?php
if(isset($alertCode)) {
    if($alertCode == -1){ ?>
        <script>
            window.alert('비밀번호가 다릅니다.')
            history.go(-1)
        </script>

<?php exit; } else { ?>
        <script>
            window.alert('등록되지 않은 아이디입니다..')
            history.go(-1)
        </script>
<?php }} ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">my futsal</p>
                <form class="login" action="/member/loginCheck/" method="POST">
                    <input type="text" class="form-control" name="id" placeholder="Username" required="" autofocus="" />
                    <input type="password" class="form-control" name="pass" placeholder="Password" required=""/>
                    <input type="submit" name="submit_login" value="Sign In" class="btn btn-default btn-sm" />
                    <div class="remember-forgot">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="<?php echo BASEPATH; ?>member/findIdV">Forgot ID?</a>

                            </div>
                            <div class="col-xs-6">
                                <a href="<?php echo BASEPATH; ?>member/findPwV">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="form-group divider">
                            <hr class="left"><small><font color="white">New to site?</font></small><hr class="right">
                        </div>
                        <p class="form-group btn btn-info btn-block"><a href="/member/joinV/">Create an account</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="posted-by">Copyright By 정제국</div>
</div>
</body>
</html>
