<x-app-layout :title="$post->title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-4">{{ $post->title }}</h2>
                    <p class="text-sm dark:text-gray-400 text-gray-600">{!! nl2br(e($post->body)) !!}</p>
                    <p class="mt-4 text-sm dark:text-gray-500 text-gray-400">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                        @if (count($post->categories))
                            in 
                            @foreach ($post->categories as $category)
                                <a href="{{ route('categories.show', $category) }}"><span class="text-blue-600 hover:underline">{{ $category->category }}</span></a>
                                @if (!$loop->last), @endif
                            @endforeach
                        @endif
                    </p>

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

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Add a Comment</h3>
                            <!-- Form for adding comments -->
                            <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea name="comment" rows="3" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                <button type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                            </form>
                        </div>
                    @else
                        <p class="mb-4">You need to <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">log in</a> to add a comment.</p>
                    @endauth

                    <div>
                        <h3 class="text-lg font-semibold mb-2">All Comments</h3>
                        @if (count($post->comments))
                            @foreach($post->comments as $comment)
                                <div class="mb-4">
                                    <p class="dark:text-gray-300 text-gray-700">{{ $comment->comment }}</p>
                                    <p class="text-sm dark:text-gray-500 text-gray-400">{{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}</p>
                                    @auth
                                        @if(auth()->user()->id === $comment->user_id)
                                            <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDeleteComment('{{ $comment->id }}')" class="text-red-600 hover:text-red-800">Delete</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-400">{{ __("There are no comments yet...") }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                document.getElementById('delete-post-form-' + postId).submit();
            }
        }

        function confirmDeleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                document.getElementById('delete-comment-form-' + commentId).submit();
            }
        }
    </script>
</x-app-layout>