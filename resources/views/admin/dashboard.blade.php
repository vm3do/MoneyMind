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
            --neutral-900: #1A1A1A;
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
        <!-- Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#4ECDC4]/30 via-[#45B7D1]/30 to-[#45B7D1]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-xl bg-[#4ECDC4] shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-white">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.41 0-8 2.69-8 6v2h16v-2c0-3.31-3.59-6-8-6z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-slate-500 text-sm font-medium">Total Users</p>
                            <p class="text-2xl font-bold text-slate-800 mt-1">{{$totalUsers}} Users</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Average Salary Card -->
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/30 via-[#FF8E53]/30 to-[#FF8E53]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-6 border border-slate-200/60">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-xl bg-[#FF6B6B] shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-white">
                                <path d="M12 2c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-slate-500 text-sm font-medium">Average Salary</p>
                            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $average_salary }} DH</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="mb-8">
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#4ECDC4]/30 via-[#45B7D1]/30 to-[#2C3E50]/30 opacity-0 group-hover:opacity-100 transition-all duration-300 blur-xl rounded-2xl">
                </div>
                <div
                    class="relative bg-gradient-to-br from-white via-slate-50 to-white rounded-2xl shadow-lg p-8 border border-slate-200/60">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 text-lg font-bold">Recent Categories</h3>
                        <button x-data @click="$dispatch('open-modal', 'add-category')"
                            class="group px-4 sm:px-6 py-2.5 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white rounded-xl hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-200 flex items-center gap-2 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor"
                                class="w-5 h-5 transition-transform group-hover:rotate-90">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="hidden sm:inline">Add Category</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach ($categories as $category)

                            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="text-lg font-semibold text-slate-800">{{ $category->name }}</h4>
                                        <p class="text-sm text-slate-500">{{$category->created_at->format('F j, y')}}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('category.edit', $category) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="p-2 hover:bg-[#4ECDC4]/10 rounded-lg transition-colors" title="Edit Category">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-[#4ECDC4]">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('category.destroy', $category) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors" title="Delete Category">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach

                        <!-- Add more categories as needed -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category Modal -->
        <div x-data="{ show: false }" @open-modal.window="show = ($event.detail === 'add-category')" @close-modal.window="show = false" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="show" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg" @click.away="show = false">
                    <form action="/categories" method="POST" class="p-6">
                        @csrf
                        <div class="space-y-6">
                            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                                <h3 class="text-lg font-semibold text-slate-800">Add New Category</h3>
                                <button type="button" @click="show = false" class="text-slate-400 hover:text-slate-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <label for="category-name" class="block text-sm font-medium text-slate-700 mb-1">Category Name</label>
                                <input type="text" name="category-name" id="category-name" required placeholder="Enter category name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                            </div>
                            <div class="pt-2">
                                <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white rounded-xl hover:shadow-lg transition-all duration-200 font-medium">
                                    Add Category
                                </button>
                            </div>
                        </div>
                    </form>
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
