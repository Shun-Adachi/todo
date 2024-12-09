<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    // インデックスページ表示
    public function index()
    {
        $categories = Category::Paginate(4);
        return view('category',compact('categories'));
    }

    // 保存処理
    public function store(CategoryRequest $request)
    {
        $create_name = $request->only(['create_name']);
        $category = [
            'name'=>$create_name['create_name'],
        ];
        Category::create($category);
         return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    // 更新処理
    public function update(CategoryRequest $request)
    {
        $update_name = $request->only(['update_name']);
        $name=[
            'name' => $update_name['update_name'],
        ];
        Category::find($request->id)->update($name);
        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }

    // 削除処理
    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}
