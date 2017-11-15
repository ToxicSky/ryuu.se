@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('layouts.includes.navigation')
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>New post</h2>
                </div>

                <div class="panel-body">
                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('admin.posts.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input placeholder="Title" name="title" class="form-control" />
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
                            <textarea name="body" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input name="new_tags" placeholder="New tags, comma-seperated" class="form-control">
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled">
                                @foreach($tags as $tag)
                                <li>
                                    <label class="form-check-label">
                                        <input name="tags[]" type="checkbox" value="{{ $tag->id }}" class="form-check-input" /> {{ $tag->title }}
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <label>
                                <input class="form-check-input" type="checkbox" checked name="published"> Published
                            </label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
