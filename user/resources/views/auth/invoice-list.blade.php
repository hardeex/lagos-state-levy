@extends('dashboard.base')
@Section('title', 'Invoice List')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.invoice-list')
@endsection




