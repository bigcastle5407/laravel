<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;

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

//메인 json
Route::get('/json', "notice\\ntc01Controller@json");

//검색
Route::get('/search', "notice\\ntc01Controller@search");

//등록페이지 이동
Route::get('/register','notice\\ntc01Controller@registerView');

//등록 데이터 전송
Route::post('/reg_data','notice\\ntc01Controller@register');

//수정 데이터 전송
Route::post('/mod_data','notice\\ntc01Controller@modify');

//수정 페이지 이동
Route::get('/modify','notice\\ntc01Controller@modifyView');

//삭제 데이터 전송
Route::post('/del_data','notice\\ntc01Controller@del');

//이미지 스토리지 저장
Route::post('/upload_img','notice\\ntc01Controller@uploadImage');