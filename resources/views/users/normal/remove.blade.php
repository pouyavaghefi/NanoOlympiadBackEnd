@extends('layouts.master')

@section('title','Delete User')

@section('wrapper')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-danger text-white">
                    <strong>⚠️ Deletion Summary</strong>
                </div>
                <div class="card-body">

                    @php
                        $summary = $user->getDeletionSummary();
                    @endphp

                    <div class="alert alert-warning">
                        <ul class="mb-3">
                            <li><strong>Course registrations:</strong> {{ $summary['course_registrations'] }}</li>
                            <li><strong>Course comments:</strong> {{ $summary['course_comments'] }}</li>
                            <li><strong>Wallet data:</strong> <em>{{ $summary['wallet'] ?? 'not set up' }}</em></li>
                        </ul>
                    </div>

                    <form action="{{ route('adm.site.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this user?');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-danger">
                            🗑️ Delete User Permanently
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
