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
            --accent: #FF660E;
            /* Vibrant Orange for primary actions */
            --accent-light: #FFF1EC;
            /* Light Orange for backgrounds */
            --neutral-900: #000000;
            /* Near Black for main text */
            --neutral-600: #666666;
            /* Dark Gray for secondary text */
            --neutral-200: #EFEFEF;
            /* Light Gray for borders */
            --white: #FFFFFF;
            /* White for backgrounds */
            --success: #00C48C;
            /* Green for positive indicators */
            --warning: #FFB800;
            /* Yellow for warnings */
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

        <!-- Expense Alerts & Info Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Expense Information Card -->
            <div class="relative group h-full">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#4ECDC4]/30 via-[#45B7D1]/30 to-[#2C3E50]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-8 border border-slate-200/60 h-full">
                    <div class="flex items-start gap-3 mb-6">
                        <span
                            class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#4ECDC4] to-[#45B7D1] shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-slate-800 text-lg font-bold">Expense Overview</h3>
                            <p class="text-slate-500 text-sm">Current month statistics</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-slate-500 text-sm">Total Expenses</p>
                            <p class="text-2xl font-bold text-slate-800">4,250 DH</p>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                    <path d="M4 0l4 4H0z" />
                                </svg>
                                12% vs last month
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-slate-500 text-sm">Monthly Budget</p>
                            <p class="text-2xl font-bold text-slate-800">6,000 DH</p>
                            <span class="text-xs font-medium text-slate-500">
                                71% utilized
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-slate-500 text-sm">Fixed Expenses</p>
                            <p class="text-2xl font-bold text-slate-800">3,149 DH</p>
                            <span class="text-xs font-medium text-slate-500">
                                via Autopay
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-slate-500 text-sm">Variable Expenses</p>
                            <p class="text-2xl font-bold text-slate-800">1,101 DH</p>
                            <span class="text-xs font-medium text-slate-500">
                                this month
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expense Alert Settings -->
            <div class="relative group h-full">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-8 border border-slate-200/60 h-full flex flex-col">
                    <div class="flex items-start gap-3 mb-6">
                        <span
                            class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-slate-800 text-lg font-bold">Expense Alerts</h3>
                            <p class="text-slate-500 text-sm">Set spending thresholds</p>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col justify-center">
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-slate-700">Alert Threshold (% of
                                Salary)</label>
                            <div class="flex items-center gap-4">
                                <input type="range" id="rangeInput"
                                    class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-[#FF6B6B]"
                                    min="0" max="100" value="70">
                                <span id="rangeValue" class="text-sm font-medium text-slate-800 min-w-[3rem]">70%</span>
                            </div>
                        </div>

                        <button
                            class="w-full px-4 py-2.5 bg-gradient-to-r from-[#FF6B6B] to-[#FF8E53] text-white rounded-xl hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-200 font-medium mt-8">
                            Save Alert Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Autopay Management Section -->
        <div class="mb-8">
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-8 border border-slate-200/60">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-start gap-3">
                            <span
                                class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#FF6B6B] to-[#FF8E53] shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-slate-800 text-lg font-bold">Autopay Management</h3>
                                <p class="text-slate-500 text-sm">Total monthly autopay: 3,149 DH</p>
                            </div>
                        </div>
                        <button x-data @click="$dispatch('open-modal', 'add-autopay')"
                            class="group px-4 sm:px-6 py-2.5 bg-gradient-to-r from-[#FF6B6B] to-[#FF8E53] text-white rounded-xl hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-200 flex items-center gap-2 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5 transition-transform group-hover:rotate-90">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="hidden sm:inline">Add Autopay</span>
                        </button>
                    </div>

                    <!-- Autopay Cards Container -->
                    <div class="relative">
                        <!-- Scrollable container with fixed height -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-3 gap-5 max-h-[460px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent hover:scrollbar-thumb-slate-300">
                            <!-- Rent Autopay Card -->
                            <div class="relative">
                                <div
                                    class="p-6 bg-white rounded-2xl border border-slate-200/60 hover:border-[#FF6B6B]/30 transition-all duration-200">
                                    <!-- Card Header -->
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-[#FF6B6B]/10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 text-[#FF6B6B]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-slate-800 font-semibold">Rent Payment</h4>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FF6B6B]/10 text-[#FF6B6B] border border-[#FF6B6B]/20">
                                                    High Priority
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <button class="p-2 hover:bg-[#FF6B6B]/10 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4 text-[#FF6B6B]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Amount and Date -->
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-slate-500 text-xs">Amount</p>
                                                <p class="text-2xl font-bold text-slate-800">2,500 DH</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-slate-500 text-xs">Next Payment</p>
                                                <p class="text-slate-800 font-medium">March 1st</p>
                                            </div>
                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs font-medium text-slate-500">23 days until next
                                                    payment</span>
                                                <span class="text-xs font-medium text-[#FF6B6B]">75%</span>
                                            </div>
                                            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full w-[75%] bg-[#FF6B6B] rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- WiFi Subscription Card -->
                            <div class="relative">
                                <div
                                    class="p-6 bg-white rounded-2xl border border-slate-200/60 hover:border-[#4ECDC4]/30 transition-all duration-200">
                                    <!-- Card Header -->
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-[#4ECDC4]/10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 text-[#4ECDC4]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-slate-800 font-semibold">WiFi Subscription</h4>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#4ECDC4]/10 text-[#4ECDC4] border border-[#4ECDC4]/20">
                                                    High Priority
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <button class="p-2 hover:bg-[#4ECDC4]/10 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4 text-[#4ECDC4]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Amount and Date -->
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-slate-500 text-xs">Amount</p>
                                                <p class="text-2xl font-bold text-slate-800">299 DH</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-slate-500 text-xs">Next Payment</p>
                                                <p class="text-slate-800 font-medium">March 15th</p>
                                            </div>
                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs font-medium text-slate-500">38 days until next
                                                    payment</span>
                                                <span class="text-xs font-medium text-[#4ECDC4]">50%</span>
                                            </div>
                                            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full w-[50%] bg-[#4ECDC4] rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Electricity Bill Card -->
                            <div class="relative">
                                <div
                                    class="p-6 bg-white rounded-2xl border border-slate-200/60 hover:border-purple-500/30 transition-all duration-200">
                                    <!-- Card Header -->
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-[#FF6B6B]/10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 text-purple-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-slate-800 font-semibold">Electricity Bill</h4>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FF6B6B]/10 text-[#FF6B6B] border border-[#FF6B6B]/20">
                                                    High Priority
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <button class="p-2 hover:bg-purple-500/10 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4 text-purple-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Amount and Date -->
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-slate-500 text-xs">Amount</p>
                                                <p class="text-2xl font-bold text-slate-800">350 DH</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-slate-500 text-xs">Next Payment</p>
                                                <p class="text-slate-800 font-medium">March 20th</p>
                                            </div>
                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs font-medium text-slate-500">43 days until next
                                                    payment</span>
                                                <span class="text-xs font-medium text-purple-500">25%</span>
                                            </div>
                                            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                                <div
                                                    class="h-full w-[25%] bg-gradient-to-r from-purple-500 to-purple-400 rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Expenses Section -->
        <div class="mb-8">
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#4ECDC4]/30 via-[#45B7D1]/30 to-[#2C3E50]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-8 border border-slate-200/60">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-start gap-3">
                            <span
                                class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#4ECDC4] to-[#45B7D1] shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-slate-800 text-lg font-bold">Recent Expenses</h3>
                                <p class="text-slate-500 text-sm">Track your spending patterns</p>
                            </div>
                        </div>
                        <button x-data @click="$dispatch('open-modal', 'add-expense')"
                            class="group px-4 sm:px-6 py-2.5 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white rounded-xl hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-200 flex items-center gap-2 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor"
                                class="w-5 h-5 transition-transform group-hover:rotate-90">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="hidden sm:inline">Add Expense</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-[--neutral-200]">
                                    <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Date</th>
                                    <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">
                                        Description</th>
                                    <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Category
                                    </th>
                                    <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Amount
                                    </th>
                                    <th class="text-right py-4 px-4 text-[--neutral-600] text-sm font-medium">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--neutral-200]">
                                <tr class="hover:bg-[--accent-light]/30 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-medium text-[--neutral-900]">Feb 20, 2024</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="text-sm text-[--neutral-900]">Groceries Shopping</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Food
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="text-sm font-medium text-[--neutral-900]">250 DH</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-2 hover:bg-[--accent-light] rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-[--accent]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-[--accent-light]/30 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-medium text-[--neutral-900]">Feb 19, 2024</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="text-sm text-[--neutral-900]">Netflix Subscription</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Entertainment
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="text-sm font-medium text-[--neutral-900]">120 DH</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-2 hover:bg-[--accent-light] rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-[--accent]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Expense Modal -->
    <div x-data="{
        show: false,
        isAutopay: false
    }"
        @open-modal.window="show = ($event.detail === 'add-expense' || $event.detail === 'add-autopay'); isAutopay = ($event.detail === 'add-autopay')"
        @close-modal.window="show = false" @keydown.escape.window="show = false" x-show="show"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">

        <!-- Modal Backdrop -->
        <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="show"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                @click.away="show = false">

                <form action="/expenses" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-6">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                            <h3 class="text-lg font-semibold text-slate-800"
                                x-text="isAutopay ? 'Add Autopay Expense' : 'Add Expense'"></h3>
                            <button type="button" @click="show = false" class="text-slate-400 hover:text-slate-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-5">
                            <!-- Expense Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Expense
                                    Name</label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" required
                                        placeholder="Enter expense name"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                                </div>
                            </div>

                            <!-- Amount -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-slate-700 mb-1">Amount
                                    (DH)</label>
                                <div class="relative">
                                    <input type="number" name="amount" id="amount" required step="0.01"
                                        placeholder="0.00"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <span class="text-slate-400">DH</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category"
                                    class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                                <div class="relative">
                                    <select name="category" id="category" required
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20 appearance-none">
                                        <option value="" disabled selected>Select a category</option>
                                        <option value="housing">Housing</option>
                                        <option value="transportation">Transportation</option>
                                        <option value="food">Food</option>
                                        <option value="utilities">Utilities</option>
                                        <option value="entertainment">Entertainment</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="date"
                                    class="block text-sm font-medium text-slate-700 mb-1">Date</label>
                                <div class="relative">
                                    <input type="date" name="date" id="date" required
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                                </div>
                            </div>

                            <!-- Autopay Section -->
                            <div x-data="{
                                showFrequency: $data.isAutopay
                            }" x-init="$watch('isAutopay', value => showFrequency = value)" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Autopay</label>
                                    <div class="flex gap-4">
                                        <label class="relative flex items-center">
                                            <input type="radio" name="is_autopay" value="1"
                                                x-bind:checked="isAutopay"
                                                @change="showFrequency = $event.target.value === '1'"
                                                class="peer sr-only">
                                            <div
                                                class="w-14 h-8 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#4ECDC4]/20 rounded-full peer peer-checked:after:translate-x-[24px] peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#4ECDC4]">
                                            </div>
                                            <span class="ml-3 text-sm font-medium text-slate-600">Yes</span>
                                        </label>
                                        <label class="relative flex items-center">
                                            <input type="radio" name="is_autopay" value="0"
                                                x-bind:checked="!isAutopay" @change="showFrequency = false"
                                                class="peer sr-only">
                                            <div
                                                class="w-14 h-8 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#4ECDC4]/20 rounded-full peer peer-checked:after:translate-x-[24px] peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#4ECDC4]">
                                            </div>
                                            <span class="ml-3 text-sm font-medium text-slate-600">No</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Autopay Frequency -->
                                <div x-show="showFrequency" x-transition class="space-y-3 pt-2">
                                    <label class="block text-sm font-medium text-slate-700">Payment Frequency</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <label class="relative">
                                            <input type="radio" name="frequency" value="daily"
                                                class="peer sr-only">
                                            <div
                                                class="w-full p-2.5 bg-white border-2 border-slate-200 rounded-xl text-center text-sm font-medium text-slate-600 cursor-pointer transition-all peer-checked:border-[#4ECDC4] peer-checked:bg-[#4ECDC4]/5 hover:border-[#4ECDC4]/50">
                                                Daily
                                            </div>
                                        </label>
                                        <label class="relative">
                                            <input type="radio" name="frequency" value="monthly"
                                                class="peer sr-only" checked>
                                            <div
                                                class="w-full p-2.5 bg-white border-2 border-slate-200 rounded-xl text-center text-sm font-medium text-slate-600 cursor-pointer transition-all peer-checked:border-[#4ECDC4] peer-checked:bg-[#4ECDC4]/5 hover:border-[#4ECDC4]/50">
                                                Monthly
                                            </div>
                                        </label>
                                        <label class="relative">
                                            <input type="radio" name="frequency" value="yearly"
                                                class="peer sr-only">
                                            <div
                                                class="w-full p-2.5 bg-white border-2 border-slate-200 rounded-xl text-center text-sm font-medium text-slate-600 cursor-pointer transition-all peer-checked:border-[#4ECDC4] peer-checked:bg-[#4ECDC4]/5 hover:border-[#4ECDC4]/50">
                                                Yearly
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit"
                                class="w-full px-4 py-3 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white rounded-xl hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-200 font-medium">
                                Add Expense
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
