@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Benvenuto {{ $user->name }}, ecco la lista dei post</h2>
        <ul>
          @foreach ($posts as $post)
            <li>{{ $post->user->name }} - {{ $post->title }}</li>
            <div>
              <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">Visualizza</a>
            </div>
            <div>
              <a class="btn btn-secondary" href="{{ route('admin.posts.edit', $post) }}">Modifica</a>
            </div>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
