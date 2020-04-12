@extends('template.layout2')
@section('title', 'Menu')
@section('content')
    {!! Menu::render() !!}
@endsection
@push('scripts')
    {!! Menu::scripts() !!}
@endpush