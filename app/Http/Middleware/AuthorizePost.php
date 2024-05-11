<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizePost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $postId = $request->route('post');
        $post = Post::find($postId)->first();

        if (!$post || auth()->user()->id !== $post->user_id) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
