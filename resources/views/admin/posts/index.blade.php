@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.includes.navigation')
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Posts</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('admin.posts.create') }}">New</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @foreach($posts as $post)
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ $post->title }}</h3>
                            <div class="col-md-6">
                                <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('admin.posts.destroy', [$post->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-link">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
