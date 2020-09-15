<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\PostCreateMail;
use Illuminate\Support\Facades\Mail;

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
        return view('admin.posts.create');
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

      $new_post = new Post();
      $new_post->title = $data['title'];
      $new_post->content = $data['content'];
      $new_post->user_id = Auth::id();
      // Carico il file dell'iimagine nella cartella locale
      $path = $request->file('image_url')->store('images','public');
      // Salvo il path nel database
      $new_post->image_url = $path;

      $saved = $new_post->save();

      // Redirect alla show pubblica per vedere come vedono i post tutti
      // e mando un email all'utente che ha creato il post
      if($saved) {
        Mail::to($new_post->user->email)->send(new PostCreateMail());
        return redirect()->route('posts.show', $new_post);
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
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    protected function getValidationRules() {
      return [
        'title' => 'required|max:255',
        'content' => 'required|max:700',
        'image_url' => 'image',
      ];
    }
}
