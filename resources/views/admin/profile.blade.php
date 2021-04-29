@extends('admin.layouts.Main')

@section('content')
    <h1>{{auth()->user()->name}}</h1>
@endsection
