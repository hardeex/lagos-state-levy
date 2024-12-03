@extends('dashboard.base')
@Section('title', 'Returns')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.official-returns')
@endsection
