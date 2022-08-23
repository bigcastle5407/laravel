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
    <h1>게시물 등록</h1>
    <form action="/reg_data" method="post" enctype="multipart/form-data">
        @csrf
        <div style="text-align:right;width:80%;margin:auto;">
            작성자 : <input type="text" class="form-control" name="writer" style="width:160px;display:inline-block;margin-right:70px;">
            <input type="submit" class="btn btn-success" value="등록">
            <button class="btn btn-dark" onclick="window.location.href='/'">취소</button>
        </div>
        <br><br>
        <div style="width:80%;margin:auto;">
            <input type="text" class="form-control" name="title"><br><br><br>
            <textarea id="summernote" name="content"></textarea>
        </div>
    </form>

    <!-- 서머노트 -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height:600,
                callbacks: {
                    onImageUpload: function(image, editor, welEditable) {
                        uploadImage(image[0]);
                    }
                }
            });

        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            data.append('_token', "{{ csrf_token() }}");

            
            $.ajax({
                type: "post",
                url: '/upload_img',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                header: {
                    "Content-Type": "multipart/form-data",
                },
                success: function(response) {
                    var image = $('<img>').attr('src',response.destination);
                    $('#summernote').summernote("insertNode", image[0]);
                    if (response.code == 200){
                        // alert(response.msg);

                    }else if(response.code == 500){
                        // alert(response.msg);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        });
    </script>

    <script>
        


    </script>
</body>
</html>