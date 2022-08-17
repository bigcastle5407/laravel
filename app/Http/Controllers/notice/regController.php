<?php

    namespace App\Http\Controllers\notice;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class regController extends Controller
    {
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


    }