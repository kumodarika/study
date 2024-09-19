<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function list()
    {
        $data =[
            'msg'=>'お名前を入力してください。',
            ];
            return view('practice1-1',$data);
    }
    public function post(Request $request)
    {
        $msg=$request->msg;
        $data=[
            'msg'=>'こんにちは、'.$msg.'さん！',
            ];
            return view('practice1-1',$data);
    }
}