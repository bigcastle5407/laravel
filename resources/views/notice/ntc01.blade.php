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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
   <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/styles/ag-grid.css"/>
   <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/styles/ag-theme-alpine.css"/>
</head>
<body style="width:85%;margin:auto; margin-top:20px;">
    <header style="background-color:gray;width:auto;height:70px;">
        <img src="http://www.yangsungji.com/skin/images/main/sub_icon.png" alt="" width="auto" height="60px">
    </header>
    
    <h1>자유게시판</h1>
    <form action="/info" method="GET">
       @csrf
        <div style="text-align:right;">
            <input type="button" class="btn btn-success" name="reg_btn" onClick="location.href='/register'" value="등록">
            <input type="submit" class="btn btn-warning" name="sel_btn" value="조회">
        </div>

            <fieldset style="text-align:center;border-bottom:1px solid #e5e5e5; padding-bottom:20px;">
                <legend class="w-auto">검색</legend>
                작성일시 : <input type="text" class="form-control" id="datepicker" name="write_time" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
                제목 : <input type="text" class="form-control" name="title" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
                작성자 : <input type="text" class="form-control" name="writer" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
            </fieldset>            
               
        <br><br><br>


        
    </form>

    <!-- <table class="table">
        <thead class="thead-light">
            <tr>
                <th style="text-align:center;width:100px;">번호</th>
                <th style="text-align:center;width:700px;">제목</th>
                <th style="text-align:center;">작성자</th>
                <th style="text-align:center;">등록일시</th>
                <th style="text-align:center;">수정일시</th>
            </tr>
        </thead>
        <tbody>
           @foreach($notice as $result)
            <tr>
                <td style="text-align:center;">{{$result->idx}}</td>
                <td style="text-align:center;"><a href="/modify?idx='{{$result->idx}}'">{{$result->title}}</a></td>
                <td style="text-align:center;">{{$result->writer}}</td>
                <td style="text-align:center;">{{$result->rt}}</td>
                <td style="text-align:center;">{{$result->ut}}</td>
            </tr>
            @endforeach                

        </tbody>
    </table> -->


   
   <div id="myGrid" class="ag-theme-alpine" style="height: 500px; width:auto;"></div>
   <script type="text/javascript">
       const gridOptions = {

         columnDefs: [
           { field: "번호" },
           { field: "제목" },
           { field: "작성자" },
           { field: "등록일시" },
           { field: "수정일시" },
         ],

         defaultColDef: {sortable: true, filter: true},

         rowSelection: 'multiple',
         animateRows: true,

         onCellClicked: params => {
           console.log('cell was clicked', params)
         }
       };

       const eGridDiv = document.getElementById("myGrid");
       new agGrid.Grid(eGridDiv, gridOptions);

       fetch("https://www.ag-grid.com/example-assets/row-data.json")
       .then(response => response.json())
       .then(data => {
         gridOptions.api.setRowData(data);
       });
   </script>










<!-- jquery calendar -->
<script>
   $(function() {
       $("#datepicker").datepicker({
           dateFormat: 'yy-mm-dd' //달력 날짜 형태
           ,showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
           ,showMonthAfterYear:true // 월- 년 순서가아닌 년도 - 월 순서
           ,changeYear: true //option값 년 선택 가능
           ,changeMonth: true //option값  월 선택 가능                
           ,showOn: "both" //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시  
           ,buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" //버튼 이미지 경로
           ,buttonImageOnly: true //버튼 이미지만 깔끔하게 보이게함
           ,buttonText: "선택" //버튼 호버 텍스트              
           ,yearSuffix: "년" //달력의 년도 부분 뒤 텍스트
           ,monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 텍스트
           ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip
           ,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 텍스트
           ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 Tooltip
           ,minDate: "-5Y" //최소 선택일자(-1D:하루전, -1M:한달전, -1Y:일년전)
           ,maxDate: "+5y" //최대 선택일자(+1D:하루후, -1M:한달후, -1Y:일년후)  
       });                           
   });
</script>

<script>

</script>
</body>
</html>