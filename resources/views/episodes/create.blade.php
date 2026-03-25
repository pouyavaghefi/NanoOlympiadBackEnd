@extends('layouts.master')

@section('title','Create Episode')

@section('styles')
    <style>
        .td-actions .btn {
            transition: all 0.3s ease;
        }

        .td-actions .btn:hover i {
            transform: scale(1.2);
        }

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
    @include('layouts.partials.alerts')
    @include('layouts.includes.gadgets.new-episode')
@endsection

