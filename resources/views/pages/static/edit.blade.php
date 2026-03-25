@extends('layouts.master')

@section('title','Edit Static Web Page')

@section('wrapper')
    @include('layouts.partials.alerts')
    @include('layouts.includes.forms.upload-file-same-directory')
    <hr>
    @include('layouts.includes.gadgets.edit-static-page-members')
@endsection

