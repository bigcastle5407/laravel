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
   <style>
    .ag-header-cell-label { justify-content: center; }
   </style>
</head>
<body style="width:85%;margin:auto; margin-top:20px;">
    <header style="background-color:gray;width:auto;height:70px;">
        <img src="http://www.yangsungji.com/skin/images/main/sub_icon.png" alt="" width="auto" height="60px">
    </header>
    
    <h1>자유게시판</h1>
    <form action="" method="GET">
       <!-- @csrf -->
        <div style="text-align:right;">
            <input type="button" class="btn btn-success" name="reg_btn" onClick="location.href='/register'" value="등록">
            <input type="button" class="btn btn-warning" name="sel_btn" onclick="select_table();" value="조회">
        </div>
            <fieldset style="text-align:center;border-bottom:1px solid #e5e5e5; padding-bottom:20px;">
                <legend class="w-auto">검색</legend>
                작성일시 : <input type="text" class="form-control" id="datepicker" name="rt" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
                제목 : <input type="text" class="form-control" name="title" id="title" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
                작성자 : <input type="text" class="form-control" name="writer" id="writer" style="width:auto;display:inline-block;">&nbsp;&nbsp;&nbsp;
            </fieldset>            
        <br><br><br>
    </form>
    
    <!-- ag-grid -->
    <div id="myGrid" class="ag-theme-alpine" style="height: 500px; width:auto;text-align:center;"></div>
    <!-- ag-grid -->
    <script type="text/javascript">
        let gx;
        const gridOptions = {
            columnDefs: [
            { headerName:"번호", field: "idx", width:100},
            { headerName:"제목", field: "title", width:500,
                    cellRenderer: function(params) {
                        let modify = `<a href= /modify?idx=${params.data.idx}>${params.value}</a>`;
                        return modify;
                    }
                },
            { headerName:"작성자",field: "writer" },
            { headerName:"등록일시",field: "rt" },
            { headerName:"수정일시",field: "ut" },
            ],

            defaultColDef: {sortable: true, filter: true},

            rowSelection: 'multiple',
            animateRows: true,

            onCellClicked: params => {
                console.log(params.data.idx);
            },
            
            onGridReady: function (params) {
                params.api.sizeColumnsToFit();

            }
        };

        const eGridDiv = document.getElementById("myGrid");
        gx = new agGrid.Grid(eGridDiv, gridOptions);

        select_table();

        $("[name=sel_btn]").on("click", function(e) {
            select_table();
        });

        function select_table() {
            var rt = document.getElementById('datepicker').value;
            var title = document.getElementById('title').value;
            var writer = document.getElementById('writer').value;

            $.ajax({
                method: "get",
                url: "/search", 
                data: "sel_btn=조회&rt="+rt+"&title="+title+"&writer="+writer,
                success: function(res) {
                    console.log(res);
                    gx.gridOptions.api.setRowData(res.result);
                },
                error: function(err) {

                }
            })
        }
   </script>

<!-- jquery calendar -->
<script>
   $(function() {
       $("#datepicker").datepicker({
           dateFormat: 'yy-mm-dd'
           ,showOtherMonths: true 
           ,showMonthAfterYear:true 
           ,changeYear: true 
           ,changeMonth: true                 
           ,showOn: "both"   
           ,buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" 
           ,buttonImageOnly: true 
           ,buttonText: "선택"               
           ,yearSuffix: "년" 
           ,monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] 
           ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] 
           ,dayNamesMin: ['일','월','화','수','목','금','토'] 
           ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] 
           ,minDate: "-5Y" 
           ,maxDate: "+5y"  
       });                           
   });
</script>

<script>

</script>
</body>
</html>