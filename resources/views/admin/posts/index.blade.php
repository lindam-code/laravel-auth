@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Benvenuto {{ $user->name }}, ecco la lista dei post</h2>
        <ul>
          @foreach ($posts as $post)
            <li>{{ $post->user->name }} - {{ $post->title }}</li>
            <span>
              <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">Visualizza</a>
            </span>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
