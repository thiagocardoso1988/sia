@extends('layouts.base')


@section('stylesheets')
	<link rel="stylesheet" href="/public/css/app.css">
@endsection


@section('pre-body')
	@include('app.layout.partials._navbar')
@endsection


@section('scripts')
	<script src="/public/js/app.js" type="text/javascript"></script>
@endsection