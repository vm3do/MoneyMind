<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name|min:3|max:50',
        ]);

        Category::create($request->all());
        
        return redirect()->back()->with('success', 'categorie created successfully');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->back()->with('sucess', 'category deleted');
    }
}
