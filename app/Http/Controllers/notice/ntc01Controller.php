<?php

namespace App\Http\Controllers\notice;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Storage;

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

   
    // 검색
    public function search(Request $request)
    {
        $rt = $request->input('rt');
        $title = $request->input('title');
        $writer = $request->input('writer');

        $where = "";

        if($writer != '') {
            $where .= "and writer like'%$writer%'";
        }

        if($rt != ''){
            $where .= "and rt like '%$rt%'";
        }

        if($title != ''){
            $where .= "and title like '%$title%'";
        }
        
        $sql3 = "
            select * 
            from notice 
            where 1=1 $where order by idx asc
        ";
    
        $result = DB::select($sql3);
        return response()->json(["result" => $result]);
    }


    //등록페이지 화면
    public function registerView()
    {
        return view("/notice/register");
    }

    //등록페이지
    public function register(Request $request)
    {
        $writer = $request->input('writer');
        $title = $request->input('title');
        $content = $request->input('content');
        // $request->file('content')->store('images','public');

        $sql = "
            insert into 
            notice(idx, title, content, writer,rt)
            values(null,'$title', '$content', '$writer',now())
        ";
        
        $result = DB::insert($sql);

        return redirect("/");
    }

    //수정페이지 화면
    public function modifyView(Request $request)
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
    public function del(Request $request)
    {
        $idx = $request->input('del_idx');

            try {
                DB::beginTransaction();

                DB::table('notice')
                ->where('idx', '=', $idx)
                ->delete();
                
                DB::commit();
                $code = 200;
                $msg = "성공!";
            } catch (\Throwable $th) {

                // dd($th);

                DB::rollback();
                $code = 500;
                $msg = "실패!";
            }
           return response()->json([
                'code' => $code,
                'msg' => $msg
           ]);

    }

    //이미지 업로드
    public function uploadImage(Request $request)
    {
        try {

            // if(!Storage::exists('storage/images')) {
            //     Storage::makeDirectory('storage/images');
            // }

            
            // Storage::disk('local')->put('/images', base64_decode($request->file('image')));


            if ($_FILES['image']['name']) {
                if (!$_FILES['image']['error']) {

                    
                  $name = md5(rand(100, 200));
                  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                  $filename = $name. '.'.$ext;
                  $destination = 'storage/images/'.$filename;
                  $location = $_FILES["image"]["tmp_name"];
                  move_uploaded_file($location, $destination);
                }
              }
            $code = 200;
            $msg = "성공!";
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            $code = 500;
            $msg = "실패!";
        }
       return response()->json([
            'code' => $code,
            'msg' => $msg,
            'destination' => $destination

       ]);

        

    }


}