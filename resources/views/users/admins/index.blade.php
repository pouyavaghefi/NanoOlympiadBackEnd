@extends('layouts.master')

@section('title','Admin Users')

@section('wrapper')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('adm.site.admins.create') }}" class="btn btn-outline-primary">
                    <i class="fa fa-plus"></i> Add New Admin User
                </a>
                <a href="{{ route('adm.site.users.create') }}" class="btn btn-primary">
                    <i class="fa fa-search"></i> Search
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($menuCounter=0)
                            @foreach($users as $user)
                            <tr>
                                <td>{{ ++$menuCounter }}</td>
                                <td>{{ $user->fullName() }}</td>
                                <td>{{ $user->uname }}</td>
                                <td>{!! $user->showStatus() !!}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="User Actions">
                                        <a href="{{ route('adm.site.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('adm.site.users.view', $user->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <form action="{{ route('adm.site.users.remove', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
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
