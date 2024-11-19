@extends('dashboard.base')
@Section('title', 'Declaration')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.official-returns')
@endsection
