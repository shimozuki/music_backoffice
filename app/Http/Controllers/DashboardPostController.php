<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_alat' => 'required',
            'link' => 'required',
            'sejarah' => 'required',
            'perawatan' => 'required',
            'image' => 'required|file|image|mimes:png,jpg|max:9048',
            'tutorial' => 'required',
            'pembuatan' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();  // Get the original file extension
            $imageName = time() . '_' . uniqid() . '.' . $extension;  // Generate a unique file name with the original extension
            $image->move(public_path('post-images'), $imageName);
        
            $validatedData['image'] = 'post-images/' . $imageName;
        }


        $validatedData['status'] = 1;
        $validatedData['user_id'] = auth()->user()->id;

        $validatedData['sejarah'] = Str::limit(strip_tags($validatedData['sejarah']), 150, '...');
        $validatedData['tutorial'] = Str::limit(strip_tags($validatedData['tutorial']), 150, '...');
        $validatedData['perawatan'] = Str::limit(strip_tags($validatedData['perawatan']), 150, '...');
        $validatedData['pembuatan'] = Str::limit(strip_tags($validatedData['pembuatan']), 150, '...');

        $create = Post::create($validatedData);

        if ( $create ) {
            return redirect()->route('posts.index')->with('success', 'Congratulation! your post has been created');
        }else{
            return redirect()->back()->with('field', 'Congratulation! your post has been created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($id)
    {
        $data = Post::find($id);
        return view('dashboard.posts.edit', compact('data'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'nama_alat' => 'required',
            'link' => 'required',
            'sejarah' => 'required',
            'perawatan' => 'required',
            'image' => 'required|file|image|mimes:png,jpg|max:9048',
            'tutorial' => 'required',
            'pembuatan' => 'required'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($request->old_image) {
                Storage::delete(public_path($request->old_image));
            }
        
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
        
            $image->move(public_path('post-images'), $imageName);
        
            $validatedData['image'] = 'post-images/' . $imageName;
        }
        

        $validatedData['user_id'] = auth()->user()->id;

        $validatedData['sejarah'] = Str::limit(strip_tags($validatedData['sejarah']), 150, '...');
        $validatedData['tutorial'] = Str::limit(strip_tags($validatedData['tutorial']), 150, '...');
        $validatedData['perawatan'] = Str::limit(strip_tags($validatedData['perawatan']), 150, '...');
        $validatedData['pembuatan'] = Str::limit(strip_tags($validatedData['pembuatan']), 150, '...');

        $post->where('id', $post->id)->update($validatedData);

        return redirect()->route('posts.index')->with('success', 'Your post has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);

        return redirect()->route('posts.index')->with('success', 'Post has been deleted!');
    }

    // public function checkSlug(Request $request) {
    //     $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
    //     return response()->json(['slug' => $slug]);
    // }
}
