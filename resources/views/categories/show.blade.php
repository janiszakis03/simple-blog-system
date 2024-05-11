<x-app-layout :title="'Category - ' . $category->category">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts in category: "') . $category->category . '"' }}
        </h2>
    </x-slot>

    @if (count($posts))
        @foreach($posts as $post)
            <x-post-card :post="$post" class="{{ $loop->first ? 'py-6' : 'pb-6' }}" />
        @endforeach
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("There are no posts in this category...") }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
