@extends('layouts.base')


@section('stylesheets')
	<link rel="stylesheet" href="/css/app.css">
@endsection


@section('pre-body')
	@include('app.layout.partials._navbar')
@endsection


@section('scripts')
	<script src="/js/app.js" type="text/javascript"></script>
@endsection