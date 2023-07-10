@extends('adminlte::page')

@section('title', $title)
    
@section('content_header')
    <h3>{{ $title }}</h3>
@stop

@section('content')

<ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
    <li class="list-group-item">A fourth item</li>
    <li class="list-group-item">And a fifth one</li>
  </ul>
@stop

