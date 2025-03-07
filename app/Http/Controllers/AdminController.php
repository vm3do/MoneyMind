<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = User::count();
        $average_salary = round(User::average('salary'), 2);
        $categories = Category::all();
        return view('admin.dashboard', compact('users', 'totalUsers', 'average_salary', 'categories'));
    }
}
