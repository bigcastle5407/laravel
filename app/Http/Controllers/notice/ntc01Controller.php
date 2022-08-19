<?php

namespace App\Http\Controllers\notice;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

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

    // public function json(Request $request)
    // {
    //     $sql = "
    //         select *
    //         from notice
    //         ";
    //     $notice = DB::select($sql);
        
    //     $json = json_encode($notice, JSON_UNESCAPED_UNICODE);
    
    //     return $json ;
    // }

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
        $content = $request->input('editordata');

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
            $r = $request->all();

            $writer = $request->input('writer');
            $title = $request->input('title');
            $content = $request->input('editordata');
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

    //이지미 업로드
    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'writer' => 'required',
    //         'title' => 'required',
    //         'editordata' => 'required',
    //     ]);

    //     $editordata = $request->editordata;
    //     $dom = new \DOMDocument();
    //     $dom ->loadHtml($editordata,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    //     $images = $dom->getElementsByTagName('img');
    //     foreach($images as $k => $img){

    //         $data = $img->getAttribute('src');
    //         list($type, $data) = explode(';', $data);
    //         list(, $data) = explode(',', $data);
    //         $data = base64_decode($data);
    //         $image_name= "/upload/" . time().$k.'.png';
    //         $path = public_path() . $image_name;
    //         file_put_contents($path, $data);
    //         $img->removeAttribute('src');
    //         $img->setAttribute('src', $image_name);
    //     }

    //     $editordata = $dom->saveHTML();
    //     $summernote = new Post();
    //     $summernote->writer = $request->writer;
    //     $summernote->title = $request->title;
    //     $summernote->editordata = $editordata;
    //     $summernote->save();

       
    // }


    
    
}