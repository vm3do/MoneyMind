<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique|min:3|max:50',
        ]);

        Category::create($request->all());
        
        return redirect()->route('admin.dashboard')->with('success', 'categorie created successfully');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admin.dashboard')->with('sucess', 'category deleted');
    }
}
