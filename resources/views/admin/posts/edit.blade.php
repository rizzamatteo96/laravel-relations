@extends('layouts.app')

@section('content')
  <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
    {{-- genero token --}}
    @csrf

    {{-- imposto il metodo per il form --}}
    @method('PUT')
    
    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control
      @error('title') 
        is-invalid 
      @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
      @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea type="password" class="form-control
      @error('description') 
        is-invalid 
      @enderror" id="description" name="description" rows="5">{{old('description', $post->description)}}</textarea>
      @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mt-4">
      <a href="{{route('admin.posts.index')}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Torna indietro</a>
      <button type="submit" class="btn btn-outline-primary"><i class="far fa-save me-2"></i> Salva le modifiche</button>
    </div>
  </form>
@endsection