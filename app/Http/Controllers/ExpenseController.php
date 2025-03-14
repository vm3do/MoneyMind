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
        $alert = Alert::where('user_id', FacadesAuth::user()->id)->first();
        $categories = Category::all();
        
        $salaryDay = FacadesAuth::user()->salary_date;
        $start_date = Carbon::now()->month()->day($salaryDay+1);
        $end_date = Carbon::now()->month()->day($salaryDay-1);

        $totalExpense = Expense::where('user_id', FacadesAuth::user()->id)->whereBetween('date', [$start_date, $end_date])->sum('amount');
        $salary = User::where('id', FacadesAuth::user()->id)->first()->salary;
        $fixedExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', true)->sum('amount');
        $variableExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', true)->whereBetween('date', [$start_date, $end_date])->sum('amount');

        // $expense =
        // dd($alert->percentage);
        return view('user.expenses', compact('alert', 'categories', 'totalExpense', 'salary', 'fixedExpense', 'variableExpense'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
