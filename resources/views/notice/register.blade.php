<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 등록</title>
    <link rel="stylesheet" href="common/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="common/bootstrap/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body style="width:85%;margin:auto; margin-top:20px;">
    <header style="background-color:gray;width:auto;height:70px;">
        <img src="http://www.yangsungji.com/skin/images/main/sub_icon.png" alt="" width="auto" height="60px">
    </header>
    <h1>게시물 등록</h1>
    <form action="/reg_data" method="post">
        @csrf
        <div style="text-align:right;width:80%;margin:auto;">
            작성자 : <input type="text" class="form-control" name="writer" style="width:160px;display:inline-block;margin-right:70px;">
            <input type="submit" class="btn btn-success" value="등록">
            <button class="btn btn-dark" onclick="window.location.href='/'">취소</button>
        </div>
        <br><br>
        <div style="width:80%;margin:auto;">
            <input type="text" class="form-control" name="title"><br><br><br>
            <textarea class="form-control" name="content" id="content" cols="30" rows="30"></textarea>
        </div>
    </form>
</body>
</html>