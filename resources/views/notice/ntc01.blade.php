<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자유게시판</title>
    <link rel="stylesheet" href="common/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="common/bootstrap/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body style="width:85%;margin:auto; margin-top:20px;">
    <header style="background-color:gray;width:auto;height:70px;">
        <img src="http://www.yangsungji.com/skin/images/main/sub_icon.png" alt="" width="auto" height="60px">
    </header>
    
    <h1>자유게시판</h1>
    <form action="" method="post">
        <div style="text-align:right;">
            <input type="button" class="btn btn-success" value="조회">
        </div>

            <fieldset style="text-align:center;border-bottom:1px solid #e5e5e5; padding-bottom:20px;">
                <legend class="w-auto">검색</legend>
                작성일시 : <input type="text" class="form-control" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
                제목 : <input type="text" class="form-control" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
                작성자 : <input type="text" class="form-control" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
            </fieldset>            
               
        <br><br><br>


        
    </form>

    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">번호</th>
            <th scope="col">제목</th>
            <th scope="col">작성자</th>
            <th scope="col">등록일시</th>
            <th scope="col">수정일시</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
            <td>@twitter</td>
            </tr>
        </tbody>
</table>

</body>
</html>