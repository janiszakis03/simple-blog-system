<x-app-layout :title="'Add a new category'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add a new category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Add a new category') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Write a name for the brand new category.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('categories.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input name="category" id="category" category="category" type="text" class="mt-1 block w-full" :value="old('category')" required autofocus autocomplete="category" />
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>