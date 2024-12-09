<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    // インデックスページ表示
    public function index()
    {
        // Todosを取得し、カテゴリ情報を付加
        $todos = Todo::with('category')->paginate(4);
        $categories = Category::all();
        return view('index',compact('todos','categories'));
    }

    // 保存処理
    public function store(TodoRequest $request)
    {
        //カテゴリ名からカテゴリIDを取得
        $category_name = $request->only(['create_category_name']);
        $category = Category::where('name', $category_name['create_category_name'])->first();
        $category_id = $category->id;
        $content = $request->only(['create_content']);
        //連想配列のキーの変更
        $todo = [
            'category_id'=>$category_id,
            'content'=>$content['create_content'],
        ];
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを作成しました');
    }

    // 更新処理
    public function update(TodoRequest $request)
    {
        //カテゴリ名からカテゴリIDを取得
        $content = $request->only(['update_category_name','update_content']);
        $category = Category::where('name', $content['update_category_name'])->first();
        $category_id = $category->id;
        //連想配列のキーの変更
        $todo = [
            'category_id'=>$category_id,
            'content'=>$content['update_content'],
        ];
        Todo::find($request->id)->update($todo);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    // 削除処理
    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }

    // 検索処理
    public function search(Request $request)
    {
        //カテゴリ名からカテゴリIDを取得(空文字対応)
        $category_name_temp = $request->only(['search_category_name']);
        $category_name = $category_name_temp ? $category_name_temp : null;
        $category = Category::where('name', $category_name)->first();
        $category_id = $category ? $category->id : null;
        //検索処理
        //ページネート処理追加
        //ページネートリンクを使用した時に必要な、検索条件をクエリパラメータとして渡す処理追加
        $todos = Todo::with('category')
            ->CategorySearch($category_id)
            ->KeywordSearch($request->keyword)
            ->paginate(4)
            ->appends([
                'search_category_name' => $category_name,
                'keyword' => $request->keyword,
            ]);
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
