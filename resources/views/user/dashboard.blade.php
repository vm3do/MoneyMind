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
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-[#2D3142]">MyBudget</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe" alt="">
                            <span class="text-[#2D3142] font-medium">Moha</span>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-[#2D3142] hover:bg-[#F8F9FD]">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-[#2D3142] hover:bg-[#F8F9FD]">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-[#F8F9FD]">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Balance Card -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/20 via-teal-500/20 to-cyan-500/20 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
                <div class="relative overflow-hidden bg-gradient-to-br from-emerald-50 to-white rounded-2xl border border-emerald-100 group-hover:border-emerald-300 transition-all duration-300 p-6">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 rounded-bl-[100%] transition-all duration-300 group-hover:scale-150"></div>
                    <div class="flex flex-col gap-1">
                        <p class="text-emerald-600/80 text-sm font-medium">Available Balance</p>
                        <p class="text-2xl font-bold text-emerald-900">12,560 DH</p>
                        <span class="flex items-center gap-1 text-emerald-600 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                            +2.5%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Income Card -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-violet-500/20 via-purple-500/20 to-fuchsia-500/20 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
                <div class="relative overflow-hidden bg-gradient-to-br from-violet-50 to-white rounded-2xl border border-violet-100 group-hover:border-violet-300 transition-all duration-300 p-6">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-violet-500/10 to-purple-500/10 rounded-bl-[100%] transition-all duration-300 group-hover:scale-150"></div>
                    <div class="flex flex-col gap-1">
                        <p class="text-violet-600/80 text-sm font-medium">Monthly Income</p>
                        <p class="text-2xl font-bold text-violet-900">5,240 DH</p>
                        <span class="flex items-center gap-1 text-violet-600 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                            +1.8%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Expenses Card -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-rose-500/20 via-pink-500/20 to-[--accent]/20 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
                <div class="relative overflow-hidden bg-gradient-to-br from-rose-50 to-white rounded-2xl border border-rose-100 group-hover:border-rose-300 transition-all duration-300 p-6">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-rose-500/10 to-pink-500/10 rounded-bl-[100%] transition-all duration-300 group-hover:scale-150"></div>
                    <div class="flex flex-col gap-1">
                        <p class="text-rose-600/80 text-sm font-medium">Monthly Expenses</p>
                        <p class="text-2xl font-bold text-rose-900">3,890 DH</p>
                        <span class="flex items-center gap-1 text-rose-600 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 4.5l-15 15m0 0h11.25m-11.25 0V8.25" />
                            </svg>
                            -0.8%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Savings Card -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-indigo-500/20 to-violet-500/20 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-100 group-hover:border-blue-300 transition-all duration-300 p-6">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-blue-500/10 to-indigo-500/10 rounded-bl-[100%] transition-all duration-300 group-hover:scale-150"></div>
                    <div class="flex flex-col gap-1">
                        <p class="text-blue-600/80 text-sm font-medium">Total Savings</p>
                        <p class="text-2xl font-bold text-blue-900">8,670 DH</p>
                        <span class="flex items-center gap-1 text-blue-600 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                            +3.2%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Smart Insights Section -->
        <div class="mb-8">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#4ECDC4]/30 to-[#45B7D1]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl"></div>
                <div class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60 backdrop-blur-sm">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-slate-800 text-lg font-bold flex items-center gap-3">
                                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                    </svg>
                                </span>
                                Smart Insights
                            </h3>
                            <p class="text-slate-500 text-sm mt-1 ml-13">Personalized financial recommendations</p>
                        </div>
                        <span class="px-4 py-1.5 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 text-[#FF6B6B] text-sm font-medium rounded-full border border-[#FF6B6B]/20">Updated daily</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Spending Pattern Card -->
                        <div class="relative group/card">
                            <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/20 to-[#FF8E53]/20 opacity-0 group-hover/card:opacity-100 transition-all duration-300 blur-lg rounded-xl"></div>
                            <div class="relative p-5 bg-gradient-to-br from-white to-orange-50/50 rounded-xl border border-orange-100 shadow-sm shadow-orange-500/5 group-hover/card:border-[#FF6B6B]/40 group-hover/card:shadow-lg group-hover/card:shadow-orange-500/10 transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover/card:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-slate-800 font-semibold mb-2">Spending Pattern</h4>
                                        <p class="text-slate-500 text-sm">Restaurant expenses increased by 25%. Consider setting a dining budget.</p>
                                        <button class="mt-4 px-4 py-2 bg-gradient-to-r from-[#FF6B6B] to-[#FF8E53] text-white text-sm font-medium rounded-lg shadow-lg shadow-orange-500/30 hover:shadow-orange-500/40 hover:-translate-y-0.5 transition-all duration-300">Set Budget →</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Savings Card -->
                        <div class="relative group/card">
                            <div class="absolute inset-0 bg-gradient-to-br from-[#4ECDC4]/20 to-[#45B7D1]/20 opacity-0 group-hover/card:opacity-100 transition-all duration-300 blur-lg rounded-xl"></div>
                            <div class="relative p-5 bg-gradient-to-br from-white to-teal-50/50 rounded-xl border border-teal-100 shadow-sm shadow-teal-500/5 group-hover/card:border-[#4ECDC4]/40 group-hover/card:shadow-lg group-hover/card:shadow-teal-500/10 transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#4ECDC4] to-[#45B7D1] shadow-lg shadow-teal-500/30 group-hover/card:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-slate-800 font-semibold mb-2">Savings Opportunity</h4>
                                        <p class="text-slate-500 text-sm">Found 2 overlapping subscription services. Potential savings: 200 DH</p>
                                        <button class="mt-4 px-4 py-2 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white text-sm font-medium rounded-lg shadow-lg shadow-teal-500/30 hover:shadow-teal-500/40 hover:-translate-y-0.5 transition-all duration-300">Review Now →</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bill Payment Card -->
                        <div class="relative group/card">
                            <div class="absolute inset-0 bg-gradient-to-br from-[#556270]/20 to-[#4ECDC4]/20 opacity-0 group-hover/card:opacity-100 transition-all duration-300 blur-lg rounded-xl"></div>
                            <div class="relative p-5 bg-gradient-to-br from-white to-slate-50/50 rounded-xl border border-slate-200 shadow-sm shadow-slate-500/5 group-hover/card:border-[#556270]/40 group-hover/card:shadow-lg group-hover/card:shadow-slate-500/10 transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#556270] to-[#4ECDC4] shadow-lg shadow-slate-500/30 group-hover/card:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-slate-800 font-semibold mb-2">Upcoming Bill</h4>
                                        <p class="text-slate-500 text-sm">Electricity bill (≈300 DH) due in 3 days. Set up auto-pay to avoid fees.</p>
                                        <button class="mt-4 px-4 py-2 bg-gradient-to-r from-[#556270] to-[#4ECDC4] text-white text-sm font-medium rounded-lg shadow-lg shadow-slate-500/30 hover:shadow-slate-500/40 hover:-translate-y-0.5 transition-all duration-300">Setup Auto-pay →</button>
                                    </div>
                                </div>
                            </div>
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
                        <p class="text-slate-500 text-sm">Monthly breakdown</p>
                    </div>
                </div>
                <select class="px-3 py-1.5 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 text-[#FF6B6B] text-sm font-medium rounded-lg border border-[#FF6B6B]/20 focus:outline-none">
                    <option>This Month</option>
                    <option>Last Month</option>
                    <option>Last 3 Months</option>
                </select>
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
                    <button class="group/edit p-2 hover:bg-[#FF6B6B]/10 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FF6B6B] transition-transform group-hover/edit:rotate-45">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="p-4 rounded-xl bg-gradient-to-br from-[#FF6B6B]/10 to-[#FF8E53]/10 border border-[#FF6B6B]/20">
                        <p class="text-slate-500 text-sm mb-2">Monthly Salary</p>
                        <p class="text-2xl font-bold text-slate-800">5,000 DH</p>
                    </div>
                    <div class="p-4 rounded-xl bg-gradient-to-br from-[#FF6B6B]/10 to-[#FF8E53]/10 border border-[#FF6B6B]/20">
                        <p class="text-slate-500 text-sm mb-2">Payment Date</p>
                        <p class="text-2xl font-bold text-slate-800">10th</p>
                    </div>
                </div>
                <div class="mt-6 p-4 rounded-xl bg-gradient-to-r from-[#FF6B6B]/5 to-[#FF8E53]/5 border border-[#FF6B6B]/10">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-500">Next Payment</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 text-[#FF6B6B] border border-[#FF6B6B]/20">March 10, 2024</span>
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
                            <h3 class="text-slate-800 text-lg font-bold">Monthly Trends</h3>
                            <p class="text-slate-500 text-sm">Spending analysis</p>
                        </div>
                    </div>
                    <select class="px-3 py-1.5 bg-gradient-to-r from-[#FF6B6B]/10 to-[#FF8E53]/10 text-[#FF6B6B] text-sm font-medium rounded-lg border border-[#FF6B6B]/20 focus:outline-none">
                        <option>Last 6 months</option>
                        <option>Last year</option>
                        <option>All time</option>
                    </select>
                </div>
                <canvas id="trendChart" class="w-full"></canvas>
            </div>
        </div>
    </div>
</div>
    </main>

    <script>
        function dashboard() {
            return {
                init() {
                    // Category Chart
                    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
                    new Chart(categoryCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Food', 'Transport', 'Entertainment', 'Bills', 'Others'],
                            datasets: [{
                                data: [300, 200, 150, 400, 100],
                                backgroundColor: ['#6366F1', '#EF4444', '#10B981', '#F59E0B', '#4F5D75']
                            }]
                        }
                    });

                    // Trend Chart
                    const trendCtx = document.getElementById('trendChart').getContext('2d');
                    new Chart(trendCtx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Expenses',
                                data: [1500, 1800, 1600, 1700, 1400, 1500],
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