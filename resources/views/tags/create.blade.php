@extends('layouts.master')

@section('title', 'Create New Tag')

@section('wrapper')
<div class="row gutters">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add New Tag</h5>
                <a href="{{ route('adm.site.tags.index') }}" class="btn btn-sm btn-secondary">Back to Tags</a>
            </div>
            <div class="card-body">
                <form action="{{ route('adm.site.tags.submit') }}" method="POST">
                    @csrf
                    @include('layouts.partials.errors')

                    {{-- Tag Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Tag Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">Create Tag</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
