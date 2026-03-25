@extends('layouts.master')

@section('title','Admin Users')

@section('wrapper')
<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Last Login</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Token</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($menuCounter = 0)
                        @foreach($users as $user)
                        <tr>
                            <td>{{ ++$menuCounter }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name ?? 'Not Specified Yet' }}</td>
                            <td>
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </td>
                            <td>{{ $user->ip_address ?? '-' }}</td>
                            <td>
                                <small class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($user->user_agent, 50) }}
                                </small>
                            </td>
                            <td>
                                {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->format('Y-m-d H:i') : '-' }}
                            </td>
                            <td>
                                @if($user->is_active)
                                <span class="badge bg-success" style="color:white">Active</span>
                                @else
                                <span class="badge bg-danger" style="color:white">Inactive</span>
                                <br>
                                <a href="{{ route('send.activation.link', $user->id) }}" class="btn btn-outline-dark btn-sm mt-1">
                                    Send Activation Link
                                </a>
                                @endif
                            </td>
                            <td>
                                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') : '-' }}
                            </td>
                            <td><code>{{ $user->showToken() }}</code></td>
                            <td>
                                <button class="btn btn-sm btn-dark regenerate-token" data-user-id="{{ $user->id }}">
                                    <i class="fa fa-refresh"></i> Regenerate
                                </button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.regenerate-token').click(function () {
            const button = $(this);
            const userId = button.data('user-id');

            $.ajax({
                url: '{{ route("adm.site.supers.regenerate-token") }}',
                type: 'POST',
                data: {
                    user_id: userId,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    button.prop('disabled', true).text('Working...');
                },
                success: function (response) {
                    if (response.success) {
                        button.closest('tr').find('code').text(response.new_token);
                        Swal.fire("Success!", "Token regenerated.", "success");
                    } else {
                        Swal.fire("Error!", response.message || "Something went wrong.", "error");
                    }
                },
                complete: function () {
                    button.prop('disabled', false).html('<i class="fa fa-refresh"></i> Regenerate');
                }
            });
        });
    });
</script>
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
@endsection