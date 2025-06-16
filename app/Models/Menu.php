<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'menu_name',
        'price',
        'image',
        'category_id',
        'gofood_link',
        'shopeefood_link',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
