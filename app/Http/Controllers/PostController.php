<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    //

    public function getLatest($n) {
        return Post::orderBy('release_on', 'desc')->where("release_on", "<=", \DB::raw("curdate()"))->take($n)->get();
    }

    /**
     * Display all
     */
    public function index() {
        $posts = Post::orderBy('release_on', 'desc')->get();

        return view('posts_all')->with('posts', $posts);
    }

    /**
     * Show form for creating
     */
    public function create() {
        return view('posts_create');
    }

    /**
     * Store newly created resource
     */
    public function store(Request $request) {
        $request->validate([
            'content' => 'required',
            'release_on' => 'required'
        ]);

        $post = new Post([
            'content' => $request->get('content'),
            'release_on' => $request->get('release_on')
        ]);
        $post->save();
        return redirect('/posts')->with('success', 'Post saved!');
    }

    /**
     * Display resource
     */

    public function show($id) {
        
    }

    /**
     * Show edit form
     */
    public function edit($id) {
        $post = Post::find($id);
        return view('posts_edit')->with('post', $post);
    }

    /**
     * Update specified resource
     */
    public function update(Request $request, $id) {
        $request->validate([
            'content' => 'required',
            'release_on' => 'required'
        ]);

        $post = Post::find($id);
        $post->content = $request->get('content');
        $post->release_on = $request->get('release_on');
        $post->save();

        return redirect('/posts')->with('success', 'Post updated!');
    }

    /**
     * Delete resource
     */
    public function destroy($id) {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted!');
    }
}
