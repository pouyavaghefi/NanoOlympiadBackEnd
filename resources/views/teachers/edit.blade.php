@extends('layouts.master')

@section('title','Edit Teacher')

@section('styles')
    <style>
        .td-actions .btn {
            transition: all 0.3s ease;
        }

        /* Hover effect: Enlarge the icon slightly */
        .td-actions .btn:hover i {
            transform: scale(1.2);
        }

        /* Customize button sizes and icon alignment */
        .td-actions .btn i {
            font-size: 16px;
        }

        /* Tooltip styling */
        [data-toggle="tooltip"] {
            cursor: pointer;
        }
    </style>
@endsection

@section('wrapper')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('layouts.partials.errors')
                    @include('layouts.includes.gadgets.teachers-edit')
                </div>
            </div>
        </div>
    </div>
@endsection