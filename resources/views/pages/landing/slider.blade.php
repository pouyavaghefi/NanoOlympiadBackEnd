@extends('layouts.master')

@section('title','Slider')

@section('wrapper')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a class="btn btn-primary btn-block" style="color:white" href="{{ route('adm.pgs.slider.trans') }}">Translations</a>
        </div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3 style="text-align:left">Add a new slider image</h3>
        </div>
    </div>
    <br>
    @include('layouts.includes.gadgets.slider-create')
    <hr>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3 style="text-align:left">Existing slider images</h3>
        </div>
    </div>
    <br>
    @include('layouts.includes.gadgets.slider-table')
@endsection
