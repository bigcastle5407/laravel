<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 메인
Route::get('/', "notice\\ntc01Controller@index");

//api
Route::get('/json',function(){
    
    $sql = "
        select *
        from notice
        ";
    $notice = DB::select($sql);
    
    // $arr = response()->json($notice);
    $json = json_encode($notice, JSON_UNESCAPED_UNICODE);

    return $json ;

});

// 검색
Route::get('/info','notice\\ntc01Controller@search');

// 등록페이지 이동
Route::get('/register','notice\\ntc01Controller@register_view');

//등록 데이터 전송
Route::post('/reg_data','notice\\ntc01Controller@register');

//수정 데이터 전송
Route::post('/mod_data','notice\\ntc01Controller@modify');

//수정 페이지 이동
Route::get('/modify','notice\\ntc01Controller@modify_view');

