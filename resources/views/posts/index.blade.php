@extends('layouts.app')
@section('content')
@foreach($posts as $post)
<div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">{{ $post->title }} <small>({{ $post->category->title }})</small></div>
      <div class="panel-body">
        <p>{{ $post->body }}</p>
        <div class="row">
          <div class="col-md-12">
            <ul class="list-unstyled">
            @foreach($post->tags as $tag)
              {{ $tag->title }}
            @endforeach
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">Created: {{ $post->created_at->format('Y-m-d H:i') }}</div>
          <div class="col-md-6">Updated: {{ $post->updated_at->format('Y-m-d H:i') }}</div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form method="post" action="{{ route('comment.store') }}">
              {{ csrf_field() }}
              <input type="hidden" name="post_id" value="{{ $post->id }}" />
              <div class="form-group">
                <input name="name" class="form-control" />
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" />
              </div>
              <div class="form-group">
                <textarea name="comment" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-default">Comment</button>
              </div>
            </form>
          </div>
        </div>
        @foreach ($post->comments as $comment)
        <div class="row">
          <div class="col-md-12">
            <p>{{ $comment->comment }}</p>
          </div>
        </div>
        @endforeach
    </div>
    <div class="panel-footer">

     </div>
  </div>
</div>
@endforeach
@endsection
