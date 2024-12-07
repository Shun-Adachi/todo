<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    // インデックスページ表示
    public function index()
    {
        //$todos = Todo::where('content' ,'test')->get();
        //$todos = Todo::find(1);
        //echo "<pre>";
        $todos = Todo::Paginate(4);
        //var_dump($todos);
        //echo "</pre>";
        //dd($todos);
        return view('index',compact('todos'));
    }

    // 保存処理
    public function store(TodoRequest $request)
    {
        $content = $request->only(['content']);
        Todo::create($content);
         return redirect('/')->with('message', 'Todoを作成しました');
    }

    // 更新処理
    public function update(TodoRequest $request)
    {
        $content = $request->only(['content']);
        Todo::find($request->id)->update($content);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    // 削除処理
    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }

}
