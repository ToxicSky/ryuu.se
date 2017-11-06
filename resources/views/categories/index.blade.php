@extends('layouts.master')
@section('content')
<ul>
@foreach($categories as $category)
<li>{{ $category->title }}</li>
@endforeach
</ul>
@endsection
