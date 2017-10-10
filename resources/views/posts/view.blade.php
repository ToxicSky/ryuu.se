@extends('layouts.app')
@section('content')
<h4>{{ $post->title }}</h4>
<p>{{ $post->body }}</p>
@endsection
