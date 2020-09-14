@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2> {{ isset($post) ? 'Modifica' : 'Crea' }} il tuo post</h2>

        @if ($errors->any())
        	<div class="alert alert-danger">
        		<ul>
        		@foreach ($errors->all() as $error)
        			<li>Errore: {{ $error }}</li>
        		@endforeach
        		</ul>
        	</div>
        @endif

        <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="post">
        	@csrf
        	@if (isset($post))
        		@method('PUT')
        	@else
        		@method('POST')
        	@endif


        	<div>
        		<label>Titolo</label>
        		<input type="text" name="title" value="{{ old('title') ? old('title') : (isset($post) ? $post->title : '') }}">
        	</div>

        	<div>
        		<label>Content</label>
            <textarea name="content" rows="8" cols="80">{{ old('content') ? old('content') : (isset($post) ? $post->content : '') }}</textarea>
        	</div>

        	<div>
        		<input type="submit" value="{{ isset($post) ? 'Modifica' : 'Crea' }} post">
        	</div>
        </form>

      </div>
    </div>
  </div>
@endsection
