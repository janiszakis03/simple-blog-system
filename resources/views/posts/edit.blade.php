<x-app-layout :title="'Edit Post - ' . $post->title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') . ' - ' . $post->title }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Edit Post') . ' - ' . $post->title }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Change the text or categories.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('posts.update', $post->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input name="title" id="title" title="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="body" :value="__('Body')" />
                            <x-textarea id="body" name="body" class="mt-1 block w-full" rows="5">{{ old('body', $post->body) }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('body')" />
                        </div>

                        <div>
                            <x-input-label :value="__('Categories:')" class="mb-4" />
                            @foreach($categories as $category)
                                <div class="flex items-center">
                                    <x-checkbox-input name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}" class="mr-2" :checked="$post->categories->contains($category->id) ? 'checked' : '' " />
                                    <x-input-label for="category{{ $category->id }}" :value="$category->category" />
                                </div>
                            @endforeach
                            <x-input-error class="mt-2" :messages="$errors->get('categories.*')" />
                        </div>

                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>