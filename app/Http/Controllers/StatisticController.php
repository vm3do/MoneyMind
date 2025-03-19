<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();

        $salaryDay = Auth::user()->salary_date;
        $start_date = Carbon::now()->month()->day($salaryDay);
        $end_date = Carbon::now()->addMonth()->day($salaryDay - 1);

        $totalExpense = Expense::where('user_id', Auth::user()->id)->whereBetween('created_at', [$start_date, $end_date])->sum('amount');
        $salary = User::where('id', Auth::user()->id)->first()->salary;
        $fixedExpense = Expense::where('user_id', Auth::user()->id)->where('is_recurring', true)->sum('amount');
        $variableExpense = Expense::where('user_id', Auth::user()->id)->where('is_recurring', false)->whereBetween('date', [$start_date, $end_date])->sum('amount');
        $balance = auth()->user()->balance;

        $expense_categories = auth()->user()->expenses()
                                        ->join('categories', 'expenses.category_id', '=', 'categories.id')
                                        ->selectRaw('categories.name as category, SUM(expenses.amount) as total')
                                        ->groupBy('categories.name')->get();

        $categories = json_encode($expense_categories->pluck('category'));
        $categories_total = json_encode($expense_categories->pluck('total'));
        return view('user.dashboard', compact('totalExpense')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
