@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.includes.navigation')
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Dashboard</h2>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
