@extends('layouts.app')
@section('content')
{{-- @if (auth())
@include('layouts.includes.navigation')
@endif --}}
<div class="col-md-9">
  <div class="panel panel-default">
    <div class="panel-heading">{{ $post->title }} <small>({{ $post->category->title }})</small></div>
      <div class="panel-body">
        <p>{{ $post->body }}</p>
        <div>
          <ul>
          @foreach($post->tags as $tag)
            {{ $tag->title }}
          @endforeach
          </ul>
        </div>
    </div>
    <div class="panel-footer">
      <div class="row">
        <div class="col-md-6">Created: {{ $post->created_at->format('Y-m-d H:i') }}</div>
        <div class="col-md-6">Updated: {{ $post->updated_at->format('Y-m-d H:i') }}</div>
      </div>
     </div>
  </div>
</div>
<sidebar></sidebar>
@endsection
