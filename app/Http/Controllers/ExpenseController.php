<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = auth()->user()->expenses()->where('is_recurring', false)->paginate(5, ['*'], 'expenses');
        $autopays = auth()->user()->expenses()->where('is_recurring', true)->paginate(5, ['*'], 'autopays');
        $alert = Alert::where('user_id', FacadesAuth::user()->id)->first();
        // dd($alert->toArray());
        $categories = Category::all();

        $salaryDay = FacadesAuth::user()->salary_date;
        $start_date = Carbon::now()->month()->day($salaryDay);
        $end_date = Carbon::now()->addMonth()->day($salaryDay - 1);

        $totalExpense = Expense::where('user_id', FacadesAuth::user()->id)->whereBetween('created_at', [$start_date, $end_date])->sum('amount');
        $salary = User::where('id', FacadesAuth::user()->id)->first()->salary;
        $fixedExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', true)->sum('amount');
        $variableExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', false)->whereBetween('date', [$start_date, $end_date])->sum('amount');
        $balance = auth()->user()->balance;

        $expense_categories = auth()->user()->expenses()
                                        ->join('categories', 'expenses.category_id', '=', 'categories.id')
                                        ->selectRaw('categories.name, SUM(expenses.amount) as total')
                                        ->groupBy('categories.name')->get();
                                        // dd(implode(',', $expense_categories->pluck('total, name')->toArray()));
        $total_categories = $expense_categories->map(function($item){
            return  "{$item->name} : {$item->total}";
        })->implode(', ');

        // dd($total_categories);

        // dd(implode(',', $total_categories->toArray()));




        return view('user.expenses', compact('alert', 'categories', 'totalExpense', 'salary', 'fixedExpense', 'variableExpense', 'expenses', 'autopays', 'balance'));
    }

    public function callApi($array)
    {
        $client = new Client();
        $api_key = config('services.gemini.key');
        $uri = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$api_key";
        $informations = "";
        foreach($array as $key => $value){
            $informations .= "$key: $value, ";
        };

        $json = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $informations . ' based on these informations, give me an appropriate suggestion in a short message']
                    ]
                ]
            ]
        ];

        $response = $client->post($uri, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' =>$json
        ]);

        $message = json_decode($response->getBody(), true);
        return $message['candidates'][0]['content']['parts'][0]['text'];
        
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

        $salaryDay = FacadesAuth::user()->salary_date;
        $start_date = Carbon::now()->month()->day($salaryDay);
        $end_date = Carbon::now()->addMonth()->day($salaryDay - 1);

        $totalExpense = Expense::where('user_id', FacadesAuth::user()->id)->whereBetween('created_at', [$start_date, $end_date])->sum('amount');
        $salary = User::where('id', FacadesAuth::user()->id)->first()->salary;
        $fixedExpense = Expense::where('user_id', FacadesAuth::user()->id)->where('is_recurring', true)->sum('amount');

        $expense_categories = auth()->user()->expenses()
                                        ->join('categories', 'expenses.category_id', '=', 'categories.id')
                                        ->selectRaw('categories.name, SUM(expenses.amount) as total')
                                        ->groupBy('categories.name')->get();
                                        // dd(implode(',', $expense_categories->pluck('total, name')->toArray()));
        $total_categories = $expense_categories->map(function($item){
            return  "{$item->name} : {$item->total}";
        })->implode(', ');


        $array = [
            'Salary' => $salary,
            'Total Expenses of the current month' => $totalExpense,
            'Salary Day' => $salaryDay,
            'Categories Expenses' => $total_categories,
            'Auropayed Expenses' => $fixedExpense,
        ];

        $validated = $request->validate([
            'name' => 'required|min:2',
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
        $user = auth()->user();
        $user->balance -= $validated['amount'];
        $user->save();

        // dd($array);
        $ai_insight = $this->callApi($array);
        // dd($request->all());

        // dd($ai_insight);

        return redirect()->back()->with(['success' => 'Expense created successfully', 'ai_insight' => $ai_insight]);
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

        // dd([$request, $expense]);
        $validated = $request->validate([
            'name' => 'required|min:3',
            'amount' => 'required|numeric',
            'category' => 'required|integer',
            'date' => 'required|date',
            'is_recurring' => 'required|boolean',
            'edit-frequency' => 'nullable|string|in:monthly,yearly,daily',
        ]);

        $validated['category_id'] = $validated['category'];
        $validated['frequency'] = $validated['edit-frequency'];
        unset($validated['category']);
        unset($validated['edit-frequency']);
        $validated['user_id'] = auth()->id();

        $expense->update($validated);

        return redirect()->back()->with('success', 'Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back()->with('success', 'Expense deleted successfully');
    }
}
