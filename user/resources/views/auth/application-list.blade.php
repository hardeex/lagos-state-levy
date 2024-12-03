@extends('dashboard.base')
@Section('title', 'My Application')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.application-list')
@endsection
