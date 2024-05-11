@props(['post'])

<div {{ $attributes->merge() }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                        <h3 class="text-lg font-semibold pb-2">{{ $post->title }}</h3>
                    </a>
                    <p class="text-sm dark:text-gray-400 text-gray-600">{{ $post->getExcerpt(300) }}</p>
                    <div class="flex justify-between sm:items-center mt-2 flex-col sm:flex-row">
                        <p class="text-sm dark:text-gray-500 text-gray-400">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                            @if (count($post->categories))
                                in 
                                @foreach ($post->categories as $category)
                                    <a href="{{ route('categories.show', $category) }}"><span class="text-blue-600 hover:underline">{{ $category->category }}</span></a>
                                    @if (!$loop->last), @endif
                                @endforeach
                            @endif
                        </p>
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-sm text-blue-600 hover:underline mt-4 sm:mt-0">Read More</a>
                    </div>
                    @auth
                        @if(auth()->user()->id === $post->user_id)
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('posts.edit', $post->id) }}" class="mr-2 text-blue-600 hover:text-blue-800">Edit</a>
                                <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $post->id }}')" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>   
            </div>
        </div>
    </div>
</div>