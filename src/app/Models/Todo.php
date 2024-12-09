<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    //データの更新を可能にする
    protected $fillable = ['category_id', 'content'];

    //TodoとCategoryのリレーション
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
             $query->where('category_id', $category_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
    }
}
