<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->

            <div class="flex items-center flex-shrink-0">
                <a href="#" class="flex items-center">
                    <div class="w-10 h-10 rounded-l-lg bg-gradient-to-br from-[#FF6B6B] to-[#fe945c] flex items-center justify-center">
                        <span class="text-xl font-bold text-white">M</span>
                    </div>
                    <div class="w-10 h-10 rounded-r-lg bg-gradient-to-br from-[#000000] to-[#664938] flex items-center justify-center">
                        <span class="text-xl font-bold text-white">M</span>
                    </div>
                </a>
            </div>

            <!-- Center Navigation - Hidden on Mobile -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{route('statistics.index')}}" class="text-slate-600 hover:text-[#FF6B6B] font-medium transition-colors">
                    Statistics
                </a>
                <a href="/expenses" class="text-slate-600 hover:text-[#FF6B6B] font-medium transition-colors">
                    Expenses
                </a>
            </nav>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 rounded-lg hover:bg-slate-100" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Desktop Profile Button -->
                <button class="hidden md:flex items-center gap-2 p-2 rounded-lg hover:bg-slate-100" @click="open = !open">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Profile" class="w-8 h-8 rounded-full">
                    <span class="text-sm font-medium text-slate-600">{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 origin-top-right bg-white rounded-xl shadow-lg border border-slate-200/60 focus:outline-none">
                    <!-- Mobile Navigation Links -->
                    <div class="md:hidden px-2 py-2 border-b border-slate-200/60">
                        <a href="{{route('statistics.index')}}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg">Statistics</a>
                        <a href="/expenses" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg">Expenses</a>
                    </div>
                    <!-- Profile Options -->
                    <div class="px-2 py-2">
                        <a href={{route('profile.edit')}} class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                Logout
                            </a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>