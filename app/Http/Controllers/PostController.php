<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_pic' => ['required', 'mimes:jpeg,png,jpg'],
            'title' => ['required', 'unique:posts,title'],
            'body' => ['required']
        ],[
            'post_pic.mimes' => 'Only Images can be uploaded!',
            'title.required' => "Please provide the title!",
            'post_pic.required' => "Please provide the post picture!"
        ]);

        $extension = $request->post_pic->extension();
        $imageName = "P-".time().'.'.$extension;

        $request->file('post_pic')->move(public_path('post_pics'), $imageName);

        $result = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'post_picture' => $imageName
        ]);

        if ($result) {
            return back()->with('success', 'Post has been added');
        } else {
            return back()->with('failed', 'Post has failed to add');
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
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'unique:posts,title,' . $post->id . 'id'],
            'body' => ['required']
        ],[
            'title.required' => "Please provide the title!"
        ]);

        $result = Post::find($post->id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if ($result) {
            return back()->with('success', 'Post has been updated');
        } else {
            return back()->with('failed', 'Post has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $image_path = 'post_pics/'. $post->post_picture;

        if (File::exists($image_path)){
            unlink($image_path);
        };

        $result = Post::find($post->id)->delete();

        if ($result) {
            return redirect()->route('show_posts')->with('success', 'Post has been deleted');
        } else {
            return redirect()->route('show_posts')->with('failed', 'Post has failed to delete');
        }
    }
}
