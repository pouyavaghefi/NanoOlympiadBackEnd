@extends('layouts.master')

@section('title','Admin Users')

@section('wrapper')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- Content wrapper start -->
            <div class="content-wrapper">

                <!-- Row start -->
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="user-details h-320">
                            <div class="user-thumb">
                                <img src="https://admin.nanolympiad.org/img/avatar.png" alt="Admin Template" />
                            </div>
                            <h4>{{ $user->fullName() }}</h4>
                            <h6>{{ $user->uname ?? '' }}</h6>
                            <p>{{ $user->email ?? '' }}</p>
                            <p>@if(!$user->created_at) Created via Seeder @else Admin since {{ $user->created_at }}@endif</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Quick Admin Tools</div>
                            </div>
                            <div class="card-body">
                                <div class="categories">
                                    <span class="badge badge-secondary">User Management</span>
                                    <span class="badge badge-secondary">System Logs</span>
                                    <span class="badge badge-secondary">Database Backup</span>
                                    <span class="badge badge-secondary">Access Control</span>
                                    <span class="badge badge-secondary">Audit Reports</span>
                                    <span class="badge badge-secondary">Maintenance Mode</span>
                                    <span class="badge badge-secondary">Send Notifications</span>
                                    <span class="badge badge-secondary">Manage Roles</span>
                                    <span class="badge badge-secondary">Settings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Tasks</div>
                            </div>
                            <div class="card-body">
                                <div id="basic-radial-graph2">
                                    <!-- Placeholder for task progress chart or dynamic task summary -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title" style="text-align:left">Pending Approvals</div>
                            </div>
                            <div class="card-body">
                                <ul class="bookmarks" style="text-align:left">
                                    <li><strong>Users</strong> </li>
                                    <li><strong>Comments</strong></li>
                                    <li><strong>Support Tickets</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Row end -->

                <!-- Row start -->
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Activities</div>
                            </div>
                            <!-- make this sample table specially for monitoring user admin activities in user admin management panel (showing whatever he has done) -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table projects-table">
                                        <thead>
                                        <tr>
                                            <th>Admin Name</th>
                                            <th>Action</th>
                                            <th>Target</th>
                                            <th>IP Address</th>
                                            <th>Date & Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($activities as $activity)
                                            <tr>
                                                <td>{{ $activity->user->name ?? 'Unknown' }}</td>
                                                <td>{{ $activity->action }}</td>
                                                <td>{{ $activity->target ?? '-' }}</td>
                                                <td>{{ $activity->ip_address }}</td>
                                                <td>{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No admin activities found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Todo's</div>
                            </div>
                            <div class="card-body">
                                <!-- Todo items -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Profile Summary</div>
                            </div>
                            <div class="card-body">
                                <!-- User details -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">System Notices</div>
                            </div>
                            <div class="card-body">
                                <!-- System alerts -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Recent Logins</div>
                            </div>
                            <div class="card-body">
                                <!-- Login history -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Pending Requests</div>
                            </div>
                            <div class="card-body">
                                <!-- Approvals or reviews -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">System Health</div>
                            </div>
                            <div class="card-body">
                                <!-- Status of services, uptime, etc. -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">Audit Trail</div>
                            </div>
                            <div class="card-body">
                                <!-- Admin actions -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card h-320">
                            <div class="card-header">
                                <div class="card-title">System Updates</div>
                            </div>
                            <div class="card-body">
                                <!-- Recent system patches or updates -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
            <!-- Content wrapper end -->
        </div>
    </div>
    <!-- Row end -->
@endsection
