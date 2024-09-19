<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasklist;

class TodolistController extends Controller

{
    public function func(){
        $user = new User;
        $value = $user->find('');
        $arr = ['id','status','title','duedate','assighnee'];
        return view ('todolist.list',compact('values','arr'));
    }
    public function index()
    {
        $values = Tasklist::all();
        // dd($values);
        // return view('todolist.list',compact('values'));
        return view('todolist.list');
    }

    public function addList()
    {
        return view('todolist.addList');
    }
}
