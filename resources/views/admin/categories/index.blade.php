@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Comandi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $category)
      <tr>
        <th scope="row">{{$category->id}}</th>
        <td>{{$category->name}}</td>
        <td>
          <a href="{{route('admin.categories.show', $category->id)}}" class="btn btn-outline-info"><i class="far fa-clipboard"></i></a>
          <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-outline-secondary"><i class="far fa-edit"></i></a>
          <a href="#" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>    
@endsection