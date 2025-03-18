<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'category_id',
        'image',
        'title',
        'overview',
        'description',
        'meta_keywords',
        'meta_descriptions',
    ];  

    public function category()
    {
        return $this->belongsTo(CategoryBlog::class);
    }
}
