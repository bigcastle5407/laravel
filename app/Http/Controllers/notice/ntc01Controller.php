<?php

namespace App\Http\Controllers\notice;

use App\Http\Controllers\Controller;

class ntc01Controller extends Controller
{
    public function index()
    {
        $values = [
            'test' => "01",
            'array' => ["최유현", "양대성", "장건희"],
        ];
        return view("/notice/ntc01",$values);
    }
}