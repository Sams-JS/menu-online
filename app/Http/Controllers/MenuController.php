<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::orderBy('price')->get();
        $categories = Category::all();
        return view ('index', compact('menus', 'categories'));
    }
}
