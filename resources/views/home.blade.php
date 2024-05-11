<x-app-layout :title="'Home'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    @auth
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-4 flex-col sm:items-center sm:flex-row">
                        <h3>Hey, {{auth()->user()->name}}! Here's what you can do:</h3>
                        <div class="flex gap-4">
                            <a href="{{route('posts.create')}}">
                                <x-primary-button>{{ __('Create a post') }}</x-primary-button>
                            </a>
                            <a href="{{route('categories.create')}}">
                                <x-primary-button>{{ __('Add a category') }}</x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    @if (count($posts))
        @foreach($posts as $post)
            <x-post-card :post="$post" class="{{ !auth()->check() && $loop->first ? 'py-6' : 'pb-6' }}" />
        @endforeach
    @else
        <h3 class="text-sm text-gray-400">{{ __('There are no posts yet...') }}</h3>
    @endif
</x-app-layout>