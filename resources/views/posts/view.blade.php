@extends('layouts.app')
@section('content')
  <post :post="{{ $post }}"></post>
  <sidebar></sidebar>
@endsection
