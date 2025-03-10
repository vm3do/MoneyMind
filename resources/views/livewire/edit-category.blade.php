<div x-data="{ show: false }" @open-modal.window="show = ($event.detail === 'edit-category')" @close-modal.window="show = false" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div x-show="show" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg" @click.away="show = false">
            <form wire:submit.prevent="update" class="p-6">
                @csrf
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                        <h3 class="text-lg font-semibold text-slate-800">Edit Category</h3>
                        <button type="button" @click="show = false" class="text-slate-400 hover:text-slate-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <label for="category-name" class="block text-sm font-medium text-slate-700 mb-1">Category Name</label>
                        <input type="text" name="name" wire:model="name" id="category-name" required placeholder="Enter category name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-slate-600 text-sm transition-all focus:outline-none focus:border-[#4ECDC4] focus:ring-2 focus:ring-[#4ECDC4]/20">
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-[#4ECDC4] to-[#45B7D1] text-white rounded-xl hover:shadow-lg transition-all duration-200 font-medium">
                            Edit Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
