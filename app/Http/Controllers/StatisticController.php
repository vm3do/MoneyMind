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

        $monthly_expense = auth()->user()->expenses()
                            ->selectRaw('MONTH(date) as month, YEAR(date) as year, SUM(amount) as monthly_total')
                            ->groupBy('month', 'year')
                            ->orderBY('year')
                            ->get();

        $monthly_expense = $monthly_expense->map(function($expense){
            $expense->month_year = Carbon::createFromDate($expense->year, $expense->month, 1)->format('m-Y');
            return $expense;
        });

        $categories = json_encode($expense_categories->pluck('category'));
        $categories_total = json_encode($expense_categories->pluck('total'));

        $month_year = json_encode($monthly_expense->pluck('month_year'));
        $month_total = json_encode($monthly_expense->pluck('monthly_total'));

        return view('user.dashboard', compact('totalExpense','salary','salaryDay' , 'fixedExpense', 'balance' ,'categories', 'categories_total', 'month_year', 'month_total')); 
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if($id != auth()->id()){
            abort(403, 'test');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'salary_date' => 'numeric|min:1|max:31',
        ]);


        auth()->user()->salary = $validated['amount'];
        auth()->user()->salary_date = $validated['salary_date'];
        auth()->user()->save();

        return redirect()->back()->with('success', 'salary info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
