@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Benvenuto {{ $user->name }}, ecco la lista dei post</h2>
        <div>
          <a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>
        </div>
        <ul>
          @foreach ($posts as $post)
            <li>
              {{ $post->user->name }} - {{ $post->title }}
                <div>
                  <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">Visualizza</a>
                </div>
                <div>
                  <a class="btn btn-secondary" href="{{ route('admin.posts.edit', $post) }}">Modifica</a>
                </div>

                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="submit" onclick="return confirm('Sei sicuro di voler cancellare questo post?')" name="" value="Delete">
                </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
