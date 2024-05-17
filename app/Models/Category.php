<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $guarded = [];
    protected $fillable = ['article_id', 'category'];

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
