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
    <script src="/public/assets/js/join.js"></script>
    <script src="/public/assets/js/homeground.js"></script>


</head>
<body onload = "init(this.form);">
<div class="align_center">
<div class="container2">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form name="form" method="POST" action="/member/join/" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <h2>Create account</h2>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ID</label>
                        <input id="notHangul" type="text" name="id" maxlength="50" class="form-control" placeholder="only English and Number">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupPassword">Password</label>
                        <input id="signupPassword" name="pass" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupEmail">Email</label>
                        <input id="signupEmail" name="email" type="email" maxlength="50" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone</label>
                        <input type="tel" name="phone" maxlength="50" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ability</label>
                        <input type="text" name="ability" maxlength="50" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Home Ground</label><br>
                        <select name="home[]" id="first" class="form-control" style="width:110px;" onchange="itemChange(this.form);" ></select>
                        <select name="home[]" id="second" class="form-control" style="width:110px;" ></select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Select File</label>
                        <input name="pfimage" type="file" class="file">
                    </div>
                    <div class="form-group">
                        <button type="reset" class="btn btn-warning btn-block">Reset</button>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit_join" value="Create your account" class="btn btn-info btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
