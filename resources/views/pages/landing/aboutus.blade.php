@extends('layouts.master')

@section('title','Features')

@section('wrapper')
    @include('layouts.includes.forms.upload-file-same-directory')
    <hr>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a class="btn btn-primary btn-block" style="color:white" href="{{ route('adm.pgs.aboutus.trans') }}">Translations</a>
        </div>
    </div>
    <hr>
    <br>

    @include('layouts.includes.gadgets.about-us')
@endsection
