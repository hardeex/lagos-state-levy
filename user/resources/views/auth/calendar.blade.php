@extends('dashboard.base')
@Section('title', 'Visitation')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.calendar')
@endsection




