<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Unsplash;

class PostController extends Controller
{

    public function index() {
        $title = '';
        if ( request('category') ) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' In ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' By ' . $author->name;
        }

        return view('posts', [
            'title' => 'All Posts' . $title,
            'posts' => Post::latest()->filter( request(['search', 'category', 'author']) )->paginate(7)->withQueryString(),
        ]);
    }

    public function show(Post $post) {
        return view('post', [
            'post' => $post,
        ]);
    }
}























    // Assign posts array to an single post
    // $new_post = [];
    // foreach ($blog_posts as $post) {
    //     if ( $post['slug'] === $slug ) {
    //         $new_post = $post;
    //     }
    // }
