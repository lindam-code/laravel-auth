@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Lista dei post</h2>
        <ul>
          @foreach ($posts as $post)
            <li>{{ $post->user->name }} - {{ $post->title }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
