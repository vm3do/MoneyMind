<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #FF660E;      /* Vibrant Orange for primary actions */
            --accent-light: #FFF1EC; /* Light Orange for backgrounds */
            --neutral-900: #1A1A1A; /* Near Black for main text */
            --neutral-600: #666666; /* Dark Gray for secondary text */
            --neutral-200: #EFEFEF; /* Light Gray for borders */
            --white: #FFFFFF;       /* White for backgrounds */
            --success: #00C48C;     /* Green for positive indicators */
            --warning: #FFB800;     /* Yellow for warnings */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--neutral-900);
        }
    </style>
</head>
<body class="bg-[#F8F9FD]" x-data="dashboard()">
    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Overview Cards -->
        <!-- Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Balance Card -->
    <div class="relative group">
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
        <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm font-medium">Available Balance</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{$balance}} DH</p>
                    <span class="flex items-center gap-1 text-[#FF6B6B] text-sm mt-2 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 px-2 py-0.5 rounded-full border border-[#FF6B6B]/20 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        +2.5%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Income Card -->
    <div class="relative group">
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
        <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm font-medium">Monthly Income</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{$salary}} DH</p>
                    <span class="flex items-center gap-1 text-[#FF6B6B] text-sm mt-2 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 px-2 py-0.5 rounded-full border border-[#FF6B6B]/20 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        +1.8%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Expenses Card -->
    <div class="relative group">
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
        <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm font-medium">Monthly Expenses</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{$fixedExpense}} DH</p>
                    <span class="flex items-center gap-1 text-[#FF6B6B] text-sm mt-2 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 px-2 py-0.5 rounded-full border border-[#FF6B6B]/20 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 4.5l-15 15m0 0h11.25m-11.25 0V8.25" />
                        </svg>
                        -0.8%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Savings Card -->
    <div class="relative group">
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
        <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm font-medium">Total Savings</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">0 DH</p>
                    <span class="flex items-center gap-1 text-[#FF6B6B] text-sm mt-2 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 px-2 py-0.5 rounded-full border border-[#FF6B6B]/20 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        +3.2%
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Spending by Category Chart -->
    <div class="relative group">
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
        <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-8 border border-slate-200/60">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-slate-800 text-lg font-bold">Spending Categories</h3>
                        <p class="text-slate-500 text-sm">Alltime breakdown</p>
                    </div>
                </div>
                
            </div>
            <canvas id="categoryChart" class="w-full h-[400px]"></canvas>
        </div>
    </div>

    

    <!-- Right Column with Salary Settings and Trend Chart -->
    <div class="flex flex-col gap-6">
        <!-- Salary Settings Card -->
        <div class="relative group">
            
            <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
            <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-slate-800 text-lg font-bold">Salary Settings</h3>
                            <p class="text-slate-500 text-sm">Monthly income details</p>
                        </div>
                    </div>
                    
                        <button x-data onclick="fillForm(this)"  @click="$dispatch('open-modal', 'edit-salary')" class="group/edit p-2 hover:bg-[#FF6B6B]/10 rounded-lg transition-colors"
                                data-amount = {{$salary}}
                                data-day = {{$salaryDay}}>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FF6B6B]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                </div>
                @if ($errors->any())
    <div class="text-red-500 bg-red-100 p-2 mb-2 rounded-md">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
                <div class="grid grid-cols-2 gap-6">
                    <div class="p-4 rounded-xl bg-gradient-to-br from-[#FF6B6B]/10 to-[#FF8E53]/10 border border-[#FF6B6B]/20">
                        <p class="text-slate-500 text-sm mb-2">Monthly Salary</p>
                        <p class="text-2xl font-bold text-slate-800">{{$salary}} DH</p>
                    </div>
                    <div class="p-4 rounded-xl bg-gradient-to-br from-[#FF6B6B]/10 to-[#FF8E53]/10 border border-[#FF6B6B]/20">
                        <p class="text-slate-500 text-sm mb-2">Payment Day</p>
                        <p class="text-2xl font-bold text-slate-800">{{$salaryDay}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Trends Chart -->
        <div class="relative group flex-1">
            <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
            <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60 h-full">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-slate-800 text-lg font-bold">Total Expenses</h3>
                            <p class="text-slate-500 text-sm">Per Month</p>
                        </div>
                    </div>
                    
                </div>
                <canvas id="trendChart" class="w-full"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div x-data="{ show: false }" @open-modal.window="show = ($event.detail === 'edit-salary')" @close-modal.window="show = false" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div x-show="show" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg" @click.away="show = false">
            <form id="edit-form" method="POST" class="p-6">
                @method('PUT')
                @csrf
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                        <h3 class="text-lg font-semibold text-slate-800">Edit Salary</h3>
                        <button type="button" @click="show = false" class="text-slate-400 hover:text-slate-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-slate-700 mb-1">Amount
                            (DH)</label>
                        <div class="relative">
                            <input type="number" name="amount" id="amount" required step="1"
                                placeholder="0.00"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                            
                        </div>
                    </div>

                    <div>
                        <label for="date"
                            class="block text-sm font-medium text-slate-700 mb-1">Date</label>
                        <div class="relative">
                            <input type="number" min="1" max="31" name="salary_date" id="date" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{auth()->id()}}">
                    <div class="pt-2">
                        <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white rounded-xl hover:shadow-lg transition-all duration-200 font-medium">
                            Edit Salary
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    </main>

    <script>

        function fillForm(button){
            document.getElementById('amount').value = button.getAttribute('data-amount')
            document.getElementById('date').value = button.getAttribute('data-day')
        }

        let form = document.getElementById('edit-form')
            let id = document.querySelector('[name="id"]').value

            form.action = `/statistics/update/${id}`

        let categories = {!! $categories !!}
        let total = {!! $categories_total !!}

        let month_year = {!! $month_year !!}
        let month_total = {!! $month_total !!}
        console.log(categories)
        function dashboard() {
            return {
                init() {
                    // Category Chart
                    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
                    new Chart(categoryCtx, {
                        type: 'doughnut',
                        data: {
                            labels: categories,
                            datasets: [{
                                data: total,
                                backgroundColor: $colors = ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF", "#FF9F40", "#C9CBCF", "#8DFF57", "#FF5FA2", "#00C49F"]
                            }]
                        }
                    });

                    // Trend Chart
                    const trendCtx = document.getElementById('trendChart').getContext('2d');
                    new Chart(trendCtx, {
                        type: 'line',
                        data: {
                            labels: month_year,
                            datasets: [{
                                label: 'Expenses per Month',
                                data: month_total,
                                borderColor: '#FF660E',
                                tension: 0.4,
                                backgroundColor: 'rgba(255, 102, 14, 0.1)',
                                fill: true
                            }]
                        },
                        // options: {
                        //     scales: {
                        //         y: {
                        //             beginAtZero: true
                        //         }
                        //     }
                        // }
                    });
                }
            }
        }
    </script>
</body>
</html> 