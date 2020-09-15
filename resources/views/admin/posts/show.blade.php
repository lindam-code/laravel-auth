@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>{{ $post->title }}</h2>

        <div>
          <h3>Autore: {{ $post->user->name }}</h3>
          <p>Contact: {{ $post->user->email }}</p>
        </div>

        <div>
          <img src="{{ asset('storage') . '/' . $post->image_url }}" alt="image">
        </div>
        <div>
          <p>{{ $post->content }}</p>
        </div>

        <div>
          <a href="{{ route('admin.posts.index') }}">Torna alla lista dei post</a>
        </div>
      </div>
    </div>
  </div>
@endsection
