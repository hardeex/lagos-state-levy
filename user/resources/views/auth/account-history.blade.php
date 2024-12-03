@extends('dashboard.base')
@Section('title', 'Account History')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.account-history')
@endsection
