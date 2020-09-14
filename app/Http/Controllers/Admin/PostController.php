<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        return view('admin.posts.index', compact('posts','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate($this->getValidationRules());
      $data = $request->all();
      
      $post = new Post();
      $post->title = $data['title'];
      $post->content = $data['content'];
      $post->user_id = 1;
      $post->image_url = 'https://i.pinimg.com/originals/5f/b8/b2/5fb8b26dd5c47a8eb1a23b2ea28d77d3.png';
      // $post->fill($data);
      $saved = $post->save();

      if($saved) {
        return redirect()->route('admin.posts.show', $post);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $request->validate($this->getValidationRules());
      $data = $request->all();
      $updated = $post->update($data);

      if($updated) {
        return redirect()->route('admin.posts.show', $post);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getValidationRules() {
      return [
        'title' => 'required|max:255',
        'content' => 'required|max:700',
      ];
    }
}
