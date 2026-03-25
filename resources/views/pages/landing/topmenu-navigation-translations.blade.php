@extends('layouts.master')

@section('title','Landing')

@section('wrapper')
    <div class="row">
        @include('layouts.partials.alerts')
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a class="btn btn-secondary btn-block" style="color:white" href="{{ route('adm.pgs.topmenu.info') }}">Menu Items</a>
        </div>
    </div>

    @include('layouts.includes.gadgets.top-menu-translations')

    <hr>

@endsection
