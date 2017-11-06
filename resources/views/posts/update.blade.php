@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Update {{ $post->title }}</h4>
                </div>

                <div class="panel-body">
                    <form action="{{ route('posts.update', [$post->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <input class="form-control" placeholder="Title" name="title" value="{{ $post->title }}" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body">{{ $post->body }}</textarea>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label"> Published
                                <input class="form-check-input" type="checkbox" checked name="published" disabled>
                            </label>
                        </div>
                        <button>Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
