@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2> Crea il tuo post</h2>

        @if ($errors->any())
        	<div class="alert alert-danger">
        		<ul>
        		@foreach ($errors->all() as $error)
        			<li>Errore: {{ $error }}</li>
        		@endforeach
        		</ul>
        	</div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        	@csrf
        	@method('POST')

        	<div>
        		<label>Titolo</label>
        		<input type="text" name="title" value="{{ old('title') }}">
        	</div>

        	<div>
        		<label>Content</label>
            <textarea name="content" rows="8" cols="80">{{ old('content') }}</textarea>
        	</div>

          <div>
            <label>Inserisci immagina del post</label>
            <input type="file" name="image_url" accept="image/*">
          </div>

        	<div>
        		<input type="submit" value="Crea post">
        	</div>
        </form>

      </div>
    </div>
  </div>
@endsection
