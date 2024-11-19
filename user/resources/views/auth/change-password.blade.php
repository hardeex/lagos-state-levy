@extends('dashboard.base')
@Section('title', 'Change Password')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.change-password')
@endsection
