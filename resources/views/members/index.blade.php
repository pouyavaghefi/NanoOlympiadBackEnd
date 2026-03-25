@extends('layouts.master')

@section('title','Members Country')

@section('wrapper')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('adm.site.users.create') }}" class="btn btn-outline-primary">
                    <i class="fa fa-plus"></i> Add New Country
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($countriesNum > 0)
                        <div class="alert alert-info">
                            You have {{ $newUsersCount }} new users registered since your last visit.
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email / Account</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($menuCounter=0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ ++$menuCounter }}</td>
                                    <td>{{ $user->fullName() ?? '<i>Not Specified Yet</i>' }}</td>
                                    <td class="p-3 align-middle">
                                        <div class="fw-bold text-primary mb-1">
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </div>

                                        <hr class="my-2 border-primary opacity-50">

                                        <div class="text-muted small">
                                            <div class="mb-1">
                                                {!! $user->showEmail() !!} @if(!is_null($user->email_verified_at)) | Verified at: {{ $user->email_verified_at }} @endif
                                            </div>
                                            <div class="mb-2">
                                                {!! $user->showStatus() !!} @if($user->is_active == 1) | Passed the 2nd step @endif
                                            </div>

                                            @if($user->is_active == 0)
                                                <a href="{{ route('send.activation.link', $user->id) }}"
                                                   class="btn btn-outline-dark btn-sm">
                                                    Send Activation Link
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{ $user->last_login ?? '' }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="User Actions">
                                            <a href="{{ route('adm.site.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('adm.site.users.view', $user->id) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            @if ($user->hasMessages())
                                                <a href="{{ route('adm.site.users.conversations', $user->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-comments"></i> Conversations
                                                </a>
                                            @endif
                                            <a href="{{ route('adm.site.users.remove', $user->id) }}" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Remove
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Row end -->
@endsection
<!-- Pouya Vaghefi -->
@section('scripts')
    @if(Session::has('sw_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "Success!",
                    text: "{{ Session::get('sw_success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    @if($newUsersCount > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Select the table body
                const tbody = document.querySelector('table.table tbody');
                if (tbody) {
                    // Scroll to the last <tr> element in the tbody
                    const lastRow = tbody.querySelector('tr:last-child');
                    if (lastRow) {
                        // Scroll the last row into view smoothly
                        lastRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        </script>
    @endif
@endsection
