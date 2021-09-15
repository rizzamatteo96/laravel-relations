@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    {{$post->title}}
  </div>
  <div class="card-body">
    <p class="card-text">{{$post->description}}</p>
  </div>
</div>
<div class="my-4">
  <a href="{{url()->previous()}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Torna indietro</a>
  {{-- <a href="{{route('admin.posts.index')}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Torna indietro</a> --}}
  <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-outline-secondary"><i class="far fa-edit me-2"></i>Edit</a>
  <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="d-inline-block">
    {{-- Per ogni form bisogna inserire il token altrimenti il cambiamento non viene accettato dal sistema --}}
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Sei sicuro di voler cancellare l\'elemento?')"><i class="far fa-trash-alt me-2"></i>Delete</button>
  </form>
</div>
@endsection