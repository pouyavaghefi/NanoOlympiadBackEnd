@extends('layouts.master')

@section('title','Departments')

@section('wrapper')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="{{ route('adm.pgs.departments.trans') }}" class="btn btn-primary btn-block" style="color:white">
                Translations
            </a>
        </div>
    </div>
    <hr>
    <br>
    @include('layouts.includes.gadgets.browse-departments')
@endsection
