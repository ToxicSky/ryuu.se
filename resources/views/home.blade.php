@extends('layouts.app')

@section('content')
  {{ $archive }}
  <div class="row">
    <posts></posts>
    <sidebar></sidebar>
  </div>
@endsection
