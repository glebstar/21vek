@extends('layout.empty')

@section('addtitle')
    {{ $title }}
@endsection

@section('content')
    {!! base64_decode($body) !!}
@endsection