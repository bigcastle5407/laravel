<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 수정</title>
    <link rel="stylesheet" href="common/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="common/bootstrap/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body style="width:85%;margin:auto; margin-top:20px;">
    <header style="background-color:gray;width:auto;height:70px;">
        <img src="http://www.yangsungji.com/skin/images/main/sub_icon.png" alt="" width="auto" height="60px">
    </header>
    <h1>게시물 수정</h1>
    <form action="/mod_data" method="post" enctype="multipart/form-data">
        @csrf
        <div style="text-align:right;width:80%;margin:auto;">
            <input type="hidden" name="idx" value="{{$result->idx}}">
            작성자 : <input type="text" class="form-control" name="writer" value="{{$result->writer}}" style="width:160px;display:inline-block;">
            <input type="submit" class="btn btn-success" value="수정">
            <button class="btn btn-dark" onclick="window.location.href='/'">취소</button>
        </div>
        <br><br>
        <div style="width:80%;margin:auto;">
            <input type="text" class="form-control" name="title" value="{{$result->title}}"><br><br><br>
            <textarea id="summernote" name="editordata">{{$result->content}}</textarea>
        </div>
    </form>
    <form action="" method="post">
        <div style="text-align:center;">
            <input type="hidden" name="del_idx" id="del_idx" value="{{$result->idx}}">
            <input type="button" class="btn btn-danger" name="del_btn" value="삭제">
        </div>
    </form>
            
    
    <!-- 서머노트 -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height:600,
            });
        });
    </script>

    <script>
       $("[name=del_btn]").on("click", function(e) {
            delete_table();
        });


        function delete_table() {
            var idx = document.getElementById('del_idx').value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            if (confirm("정말 삭제하시겠습니까?")) {
                console.log('Y');
                $.ajax({
                    method: "post",
                    url: "/del_data", 
                    data: {del_idx: idx}, 
                    success: function(response) {
                        // console.log(response);
                        if (response.code == "200") {
                            alert(response.msg);
                            location.href = "/";
                        } else if (response.code =="500") {
                            alert(response.msg);
                        }
                        
                 
                    },
                    error: function(err) {
    
                    }
                });
                
            } else {
                console.log('N');
            }
        }   
    </script>
</body>
</html>