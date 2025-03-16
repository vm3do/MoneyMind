<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = auth()->user()->expenses->where('is_recurring', false);
        $autopays = auth()->user()->expenses->where('is_recurring', true);
        $alert = Alert::where('user_id', FacadesAuth::user()->id)->first();
        // dd($alert->toArray());
        $categories = Category::all();

        $salaryDay = FacadesAuth::user()->salary_date;
        $start_date = Carbon::now()->month()->day($salaryDay + 1);
        $end_date = Carbon::now()->month()->day($salaryDay - 1);

        $totalExpense = Expense::where('user_id', FacadesAuth::user()->id)->whereBetween('date', [$start_date, $end_date])->sum('amount');
        $salary = User::where('id', FacadesAuth::user()->id)->first()->salary;
        $fixedExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', true)->sum('amount');
        $variableExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', true)->whereBetween('date', [$start_date, $end_date])->sum('amount');

        // $expense =
        // dd($alert->percentage);
        return view('user.expenses', compact('alert', 'categories', 'totalExpense', 'salary', 'fixedExpense', 'variableExpense', 'expenses', 'autopays'));
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
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|min:3',
            'amount' => 'required|numeric',
            'category' => 'required|integer',
            'date' => 'required|date',
            'is_recurring' => 'required|boolean',
            'frequency' => 'nullable|string|in:monthly,yearly,daily',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['category_id'] = $validated['category'];
        unset($validated['category']);

        Expense::create($validated);
        return redirect()->back()->with('success', 'expense added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        Expense::findOrFail($expense);
        Expense::updated($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
