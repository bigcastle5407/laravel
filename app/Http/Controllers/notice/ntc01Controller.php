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
        return view("/notice/ntc01",['notice' => $notice] );
    }

    //검색
    public function search(Request $request)
    {
        // $r = $request->all();
        // $write_time = $request->input('write_time');
        // $title = $request->input('title');
        // $writer = $request->input('writer');

        // $where = "";

        // if($writer != '') {
        //     $where .= "and write_time = '$write_time'";
        //     $where .= " and  title = '$title'";
        //     $where .= " and writer = '$writer'";
        // }
        
        // $sql = "
        //     select *
        //     from notice
        //     where 1=1 $where
        // ";
        // $result = DB::select($sql);
        

        // return view("/notice/ntc01", $result);

        // return response()->json([
        //     'code' => 200,
        //     'head' => [
        //         'total' => 5,
        //         'page' => 1,
        //     ],
        //     'body' => $result,
        // ]);

        // return response()->json(['code' => 200, 'msg' => '저장이 완료되었습니다.']);
    }

    //등록페이지 화면
    public function register()
    {
        return view("/notice/register");
    }

    //수정페이지 화면
    public function modify(Request $request)
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
}