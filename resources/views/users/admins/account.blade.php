@extends('layouts.master')

@section('title','Admin Users')

@section('wrapper')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="content-wrapper">

                <!-- Profile Header -->
                <div class="row gutters mb-4">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="user-details h-320">
                            <div class="user-thumb">
                                <img src="{{ asset('img/avatar.png') }}" alt="Admin Avatar" />
                            </div>
                            <h4>{{ $user->fullName() }}</h4>
                            <h6>{{ $user->uname ?? '' }}</h6>
                            <p>{{ $user->email ?? '' }}</p>
                            <p>
                                @if(!$user->created_at)
                                    Created via Seeder
                                @else
                                    Admin since {{ $user->created_at->format('F Y') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Account Quick Actions</div>
                            </div>
                            <div class="card-body">
                                <div class="categories">
                                    <span class="badge badge-primary">Edit Profile</span>
                                    <span class="badge badge-primary">Change Password</span>
                                    <span class="badge badge-primary">2FA Settings</span>
                                    <span class="badge badge-primary">Manage Sessions</span>
                                    <span class="badge badge-primary">Notification Preferences</span>
                                    <span class="badge badge-primary">Privacy Settings</span>
                                    <span class="badge badge-primary">Logout All Devices</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Settings Panels -->
                <div class="row gutters">

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Account Information</div>
                            </div>
                            <div class="card-body">
                                <!-- Form: name, username, email -->
                                <form method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="uname" value="{{ $user->uname }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Panel -->
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Change Password</div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-2">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Notification Settings</div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Receive system alerts via email</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Enable push notifications</label>
                                    </div>
                                    <button class="btn btn-success mt-2">Save Preferences</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Session Management -->
                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Session Management</div>
                            </div>
                            <div class="card-body">
                                <p>You are currently logged in on {{ count($user->sessions ?? []) }} device(s).</p>
                                <button class="btn btn-danger">Logout from All Devices</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Row end -->
@endsection
