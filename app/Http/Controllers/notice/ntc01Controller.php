<?php

namespace App\Http\Controllers\notice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ntc01Controller extends Controller
{
    //자유게시판 페이지 화면
    public function index(Request $request)
    {
        $sql = "
            select *
            from notice
        ";
        $notice = DB::select($sql);
        return view("/notice/ntc01");
    }

    public function json(Request $request)
    {
        $sql = "
            select *
            from notice
            ";
        $notice = DB::select($sql);
        
        $json = json_encode($notice, JSON_UNESCAPED_UNICODE);
    
        return $json ;
    }

    // 검색
    public function search(Request $request)
    {
        $rt = $request->input('rt');
        $title = $request->input('title');
        $writer = $request->input('writer');

        $where = "";

        if($writer != '') {
            $where .= "and rt like '%$rt%'";
            $where .= "and title like '%$title%'";
            $where .= "and writer like'%$writer%'";
        }
    
        $sql3 = "
            select * 
            from notice 
            where 1=1 $where order by idx asc
        ";
    
        $result = DB::select($sql3);
        $json2 = json_encode($result, JSON_UNESCAPED_UNICODE);
        $search = ['json2' => $json2];

        return view("/notice/ntc01", $search);
    }


    //등록페이지 화면
    public function register_view()
    {
        return view("/notice/register");
    }

    //등록페이지
    public function register(Request $request)
    {
        $r = $request->all();

        $writer = $request->input('writer');
        $title = $request->input('title');
        $content = $request->input('content');

        $sql = "
            insert into notice(idx, title, content, writer,rt)
            values(null,'$title', '$content', '$writer',now())
        ";
        
        $result = DB::insert($sql);

        return redirect("/");
    }

    //수정페이지 화면
    public function modify_view(Request $request)
    {
        $idx = $request->input('idx', '');
        $sql2 = "
            select *
            from notice
            where idx = $idx
        ";
        
        $result2 = DB::selectOne($sql2);
        $values = ['result' => $result2];
        return view("/notice/modify",$values);
    }


    //수정페이지
    public function modify(Request $request)
        {
            $r = $request->all();

            $writer = $request->input('writer');
            $title = $request->input('title');
            $content = $request->input('content');
            $idx = $request->input('idx');

            $sql = "
                update notice
                set writer='$writer', title='$title', content='$content', ut=now()
                where idx = $idx
            ";
            
            $result = DB::update($sql);

            return redirect("/");
        }


    //삭제페이지
    public function delete()
    {

    }
    
    
}