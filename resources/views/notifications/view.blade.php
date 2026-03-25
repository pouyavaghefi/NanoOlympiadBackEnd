@extends('layouts.master')

@section('title','Main')

@section('wrapper')
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div id="example-basic">
            <h3>{{ $notif->title ?? '' }}</h3>
            <section>
                <p>{{ $notif->message ?? '' }}</p>
            </section>
        </div>
    </div>
</div>
@endsection