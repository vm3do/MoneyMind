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
            font-family: 'Urbanist', sans-serif;
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
        <!-- Financial Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Balance Card -->
            <div class="group bg-[--white] rounded-2xl p-6 transition-all duration-300 hover:shadow-lg border border-[--neutral-200] hover:border-[--accent]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[--accent-light] rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[--accent]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                    </div>
                    <span class="text-[--success] text-sm font-medium bg-[--success]/10 px-3 py-1 rounded-full">+12%</span>
                </div>
                <div>
                    <p class="text-[--neutral-600] text-sm font-medium mb-1">Available Balance</p>
                    <h3 class="text-[--neutral-900] text-2xl font-bold">3,500 DH</h3>
                </div>
            </div>

            <!-- Monthly Salary Card -->
            <div class="group bg-[--white] rounded-2xl p-6 transition-all duration-300 hover:shadow-lg border border-[--neutral-200] hover:border-[--accent]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[--accent-light] rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[--accent]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                    <span class="text-[--accent] text-sm font-medium bg-[--accent-light] px-3 py-1 rounded-full">10th</span>
                </div>
                <div>
                    <p class="text-[--neutral-600] text-sm font-medium mb-1">Monthly Salary</p>
                    <h3 class="text-[--neutral-900] text-2xl font-bold">5,000 DH</h3>
                </div>
            </div>

            <!-- Expenses Card -->
            <div class="group bg-[--white] rounded-2xl p-6 transition-all duration-300 hover:shadow-lg border border-[--neutral-200] hover:border-[--accent]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[--accent-light] rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[--accent]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                    </div>
                    <span class="text-[--warning] text-sm font-medium bg-[--warning]/10 px-3 py-1 rounded-full">45%</span>
                </div>
                <div>
                    <p class="text-[--neutral-600] text-sm font-medium mb-1">Monthly Expenses</p>
                    <h3 class="text-[--neutral-900] text-2xl font-bold">1,500 DH</h3>
                </div>
                <div class="mt-4 bg-[--neutral-200] rounded-full h-1.5">
                    <div class="bg-[--warning] h-1.5 rounded-full" style="width: 45%"></div>
                </div>
            </div>

            <!-- Savings Card -->
            <div class="group bg-[--white] rounded-2xl p-6 transition-all duration-300 hover:shadow-lg border border-[--neutral-200] hover:border-[--accent]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[--accent-light] rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[--accent]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                        </svg>
                    </div>
                    <span class="text-[--success] text-sm font-medium bg-[--success]/10 px-3 py-1 rounded-full">60%</span>
                </div>
                <div>
                    <p class="text-[--neutral-600] text-sm font-medium mb-1">Savings Goal</p>
                    <h3 class="text-[--neutral-900] text-2xl font-bold">300/500 DH</h3>
                </div>
                <div class="mt-4 bg-[--neutral-200] rounded-full h-1.5">
                    <div class="bg-[--success] h-1.5 rounded-full" style="width: 60%"></div>
                </div>
            </div>
        </div>

        <!-- AI suggestions section -->
        <div class="mb-8">
            <div class="bg-[--white] rounded-2xl shadow-sm p-6 border border-[--neutral-200]">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-[--neutral-900] text-lg font-bold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[--accent]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                            Smart Insights
                        </h3>
                        <p class="text-[--neutral-600] text-sm">Personalized financial recommendations</p>
                    </div>
                    <span class="px-3 py-1 bg-[--accent-light] text-[--accent] text-sm font-medium rounded-full">Updated daily</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Spending Pattern Card -->
                    <div class="p-4 bg-gradient-to-br from-orange-50 to-white rounded-xl border border-[--neutral-200]">
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-[--accent-light] rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[--accent]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[--neutral-900] font-semibold mb-2">Spending Pattern Detected</h4>
                                <p class="text-[--neutral-600] text-sm">Your restaurant expenses increased by 25% this month. Consider setting a dining budget of 800 DH.</p>
                                <button class="mt-3 text-[--accent] text-sm font-medium hover:underline">Set Budget →</button>
                            </div>
                        </div>
                    </div>

                    <!-- Savings Opportunity Card -->
                    <div class="p-4 bg-gradient-to-br from-green-50 to-white rounded-xl border border-[--neutral-200]">
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[--neutral-900] font-semibold mb-2">Savings Opportunity</h4>
                                <p class="text-[--neutral-600] text-sm">You can save 200 DH by optimizing your subscription services. We found 2 overlapping services.</p>
                                <button class="mt-3 text-green-600 text-sm font-medium hover:underline">Review Subscriptions →</button>
                            </div>
                        </div>
                    </div>

                    <!-- Bill Payment Reminder Card -->
                    <div class="p-4 bg-gradient-to-br from-blue-50 to-white rounded-xl border border-[--neutral-200]">
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[--neutral-900] font-semibold mb-2">Upcoming Bill Alert</h4>
                                <p class="text-[--neutral-600] text-sm">Your electricity bill (≈300 DH) is due in 3 days. Set up auto-pay to avoid late fees.</p>
                                <button class="mt-3 text-blue-600 text-sm font-medium hover:underline">Setup Auto-pay →</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-[#2D3142] mb-4">Spending by Category</h3>
                <canvas id="categoryChart" class="w-full h-64"></canvas>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-[#2D3142] mb-4">Monthly Trends</h3>
                <canvas id="trendChart" class="w-full h-64"></canvas>
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
                                borderColor: '#6366F1',
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }
        }
    </script>
</body>
</html> 