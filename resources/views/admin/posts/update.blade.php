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
                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('admin.posts.update', [$post->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input class="form-control" placeholder="Title" name="title" value="{{ $post->title }}" />
                            </div>
                            <div class="col-md-6">
                                <select name="category" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body">{{ $post->body }}</textarea>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled">
                                @foreach($tags as $tag)
                                <li>
                                    <label class="form-check-label">
                                        <input name="tags[]" type="checkbox" value="{{ $tag->id }}" class="form-check-input" {{ $tag->isChecked($post->tags) }} /> {{ $tag->title }}
                                    </label>
                                </li>
                                @endforeach
                            </ul>
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
