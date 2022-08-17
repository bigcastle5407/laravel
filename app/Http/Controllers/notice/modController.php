<?php

    namespace App\Http\Controllers\notice;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class modController extends Controller
    {
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
    }