@extends('layouts.master')

@section('title','Landing')

@section('wrapper')
    <div class="row">
        @include('layouts.partials.alerts')
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a class="btn btn-primary btn-block" style="color:white" href="{{ route('adm.pgs.topmenu.trans') }}">Translations</a>
        </div>
    </div>

    @include('layouts.includes.gadgets.top-menu')

    @include('layouts.includes.gadgets.cal-to-action')

    <hr>

@endsection
