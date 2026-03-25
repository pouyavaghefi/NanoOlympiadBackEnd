@extends('layouts.master')

@section('title','Static Web Pages')

@section('wrapper')
    @include('layouts.partials.alerts-secondary')

    @include('layouts.includes.gadgets.index-static-pages')
@endsection

