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
            --neutral-900: #000000; /* Near Black for main text */
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

        <!-- Autopay Management Section -->
        <div class="bg-[--white] rounded-2xl shadow-sm p-6 border border-[--neutral-200] mb-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-[--neutral-900] text-lg font-bold">Autopay Management</h3>
                    <p class="text-[--neutral-600] text-sm">Total monthly autopay: 3,149 DH</p>
                </div>
                <button class="group px-6 py-2.5 bg-[--accent] text-[--white] rounded-xl hover:opacity-90 transition-all duration-200 flex items-center gap-2 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Autopay
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Rent Autopay Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[--accent] to-orange-600 opacity-50 blur-xl group-hover:opacity-70 transition-opacity rounded-xl"></div>
                    <div class="relative p-5 bg-[--white] rounded-xl border border-[--neutral-200] hover:border-[--accent] transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="text-[--neutral-900] font-semibold">Rent Payment</h4>
                                    <span class="px-2.5 py-0.5 bg-[--accent-light] text-[--accent] rounded-full text-xs font-medium">High Priority</span>
                                </div>
                                <p class="text-[--neutral-600] text-sm">Monthly rent for apartment</p>
                            </div>
                            <div class="flex gap-1">
                                <button class="p-2 hover:bg-[--accent-light] rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-[--accent]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-6">
                            <div>
                                <p class="text-[--neutral-600] text-xs mb-1">Amount</p>
                                <p class="text-[--neutral-900] text-xl font-bold">2,500 DH</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[--neutral-600] text-xs mb-1">Next Payment</p>
                                <p class="text-[--neutral-900] font-medium">March 1st</p>
                            </div>
                        </div>
                        <div class="mt-4 h-1 bg-[--neutral-200] rounded-full overflow-hidden">
                            <div class="h-full w-3/4 bg-gradient-to-r from-[--accent] to-orange-600 rounded-full"></div>
                        </div>
                        <p class="text-[--neutral-600] text-xs mt-2">23 days until next payment</p>
                    </div>
                </div>

                <!-- WiFi Subscription Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 opacity-50 blur-xl group-hover:opacity-70 transition-opacity rounded-xl"></div>
                    <div class="relative p-5 bg-[--white] rounded-xl border border-[--neutral-200] hover:border-blue-500 transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="text-[--neutral-900] font-semibold">WiFi Subscription</h4>
                                    <span class="px-2.5 py-0.5 bg-blue-50 text-blue-600 rounded-full text-xs font-medium">Active</span>
                                </div>
                                <p class="text-[--neutral-600] text-sm">Monthly internet service</p>
                            </div>
                            <div class="flex gap-1">
                                <button class="p-2 hover:bg-blue-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-6">
                            <div>
                                <p class="text-[--neutral-600] text-xs mb-1">Amount</p>
                                <p class="text-[--neutral-900] text-xl font-bold">299 DH</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[--neutral-600] text-xs mb-1">Next Payment</p>
                                <p class="text-[--neutral-900] font-medium">March 15th</p>
                            </div>
                        </div>
                        <div class="mt-4 h-1 bg-[--neutral-200] rounded-full overflow-hidden">
                            <div class="h-full w-1/2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"></div>
                        </div>
                        <p class="text-[--neutral-600] text-xs mt-2">38 days until next payment</p>
                    </div>
                </div>

                <!-- Electricity Bill Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 opacity-50 blur-xl group-hover:opacity-70 transition-opacity rounded-xl"></div>
                    <div class="relative p-5 bg-[--white] rounded-xl border border-[--neutral-200] hover:border-purple-500 transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="text-[--neutral-900] font-semibold">Electricity Bill</h4>
                                    <span class="px-2.5 py-0.5 bg-purple-50 text-purple-600 rounded-full text-xs font-medium">Variable</span>
                                </div>
                                <p class="text-[--neutral-600] text-sm">Monthly power consumption</p>
                            </div>
                            <div class="flex gap-1">
                                <button class="p-2 hover:bg-purple-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-purple-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-6">
                            <div>
                                <p class="text-[--neutral-600] text-xs mb-1">Amount</p>
                                <p class="text-[--neutral-900] text-xl font-bold">350 DH</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[--neutral-600] text-xs mb-1">Next Payment</p>
                                <p class="text-[--neutral-900] font-medium">March 20th</p>
                            </div>
                        </div>
                        <div class="mt-4 h-1 bg-[--neutral-200] rounded-full overflow-hidden">
                            <div class="h-full w-1/4 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full"></div>
                        </div>
                        <p class="text-[--neutral-600] text-xs mt-2">43 days until next payment</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expenses Table -->
        <div class="bg-[--white] rounded-2xl shadow-sm p-6 border border-[--neutral-200] mb-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-[--neutral-900] text-lg font-bold">Recent Expenses</h3>
                    <p class="text-[--neutral-600] text-sm">Track your spending patterns</p>
                </div>
                <button class="px-6 py-2.5 bg-[--accent] text-[--white] rounded-xl hover:opacity-90 transition-all duration-200 flex items-center gap-2 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Expense
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[--neutral-200]">
                            <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Date</th>
                            <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Description</th>
                            <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Category</th>
                            <th class="text-left py-4 px-4 text-[--neutral-600] text-sm font-medium">Amount</th>
                            <th class="text-right py-4 px-4 text-[--neutral-600] text-sm font-medium">Actions</th>
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Food
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-sm font-medium text-[--neutral-900]">250 DH</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 hover:bg-[--accent-light] rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[--accent]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Entertainment
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-sm font-medium text-[--neutral-900]">120 DH</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 hover:bg-[--accent-light] rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[--accent]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html> 