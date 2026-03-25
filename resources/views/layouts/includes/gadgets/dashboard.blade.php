<!-- Row starts -->
<div class="row gutters">
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Row start -->
        <div class="row gutters">
            <!-- Total Users -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-users" style="font-size: 30px; color: #4caf50;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $users->count() }}</h3>
                        <p>Total Users</p>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-user-check" style="font-size: 30px; color: #ff9800;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $users->where('is_active', 1)->count() }}</h3>
                        <p>Active Users</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-eye" style="font-size: 30px; color: #03a9f4;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $todayVisitors }}</h3>
                        <p>Visitors Today</p>
                    </div>
                </div>
            </div>

            <!-- Visitors Yesterday -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-eye-slash" style="font-size: 30px; color: #03a9f4;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $yesterdayVisitors }}</h3>
                        <p>Visitors Yesterday</p>
                    </div>
                </div>
            </div>

            <!-- Signups This Week -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon secondary">
                        <i class="fas fa-user-plus" style="font-size: 30px; color: #8bc34a;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $signupsThisWeek }}</h3>
                        <p>Signups This Week</p>
                    </div>
                </div>
            </div>

            <!-- Signups This Month -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon secondary">
                        <i class="fas fa-user-plus" style="font-size: 30px; color: #8bc34a;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $signupsThisMonth }}</h3>
                        <p>Signups This Month</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row ends -->
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Row start -->
        <div class="row gutters">
            <!-- Normal Users -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-users" style="font-size: 30px; color: #4caf50;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $users->where('super_user', 0)->count() }}</h3>
                        <p>Normal Users</p>
                    </div>
                </div>
            </div>

            <!-- Admin Users -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-user-shield" style="font-size: 30px; color: #ff9800;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $users->where('super_user', 1)->count() }}</h3>
                        <p>Admin Users</p>
                    </div>
                </div>
            </div>

            <!-- Logins This Week -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-sign-in-alt" style="font-size: 30px; color: #4caf50;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $loginsThisWeek }}</h3>
                        <p>Logins This Week</p>
                    </div>
                </div>
            </div>

            <!-- Logins This Month -->
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="info-tiles">
                    <div class="info-icon">
                        <i class="fas fa-calendar-day" style="font-size: 30px; color: #ff9800;"></i>
                    </div>
                    <div class="stats-detail">
                        <h3>{{ $loginsThisMonth }}</h3>
                        <p>Logins This Month</p>
                    </div>
                </div>
            </div>
        </div>

        {{--                <!-- Wallets -->--}}
{{--                <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                    <div class="info-tiles">--}}
{{--                        <div class="info-icon secondary">--}}
{{--                            <i class="icon-check_circle" style="font-size: 40px; color: #8bc34a;"></i>--}}
{{--                        </div>--}}
{{--                        <div class="stats-detail">--}}
{{--                            <h3>250</h3>--}}
{{--                            <p>Signups</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Wallets -->--}}
{{--                <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                    <div class="info-tiles">--}}
{{--                        <div class="info-icon secondary">--}}
{{--                            <i class="icon-archive" style="font-size: 40px; color: #9c27b0;"></i>--}}
{{--                        </div>--}}
{{--                        <div class="stats-detail">--}}
{{--                            <h3>2500</h3>--}}
{{--                            <p>Orders</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--        </div>--}}
{{--        <!-- Row ends -->--}}
{{--    </div>--}}
{{--    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">--}}
        <!-- Row start -->
{{--        <div class="row gutters">--}}
{{--            <!-- Total Users -->--}}
{{--            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                <div class="info-tiles">--}}
{{--                    <div class="info-icon">--}}
{{--                        <i class="icon-account_circle" style="font-size: 40px; color: #4caf50;"></i>--}}
{{--                    </div>--}}
{{--                    <div class="stats-detail">--}}
{{--                        <h3>{{ $users->where('super_user',0)->count() }}</h3>--}}
{{--                        <p>Normal Users</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Active Users -->--}}
{{--            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                <div class="info-tiles">--}}
{{--                    <div class="info-icon">--}}
{{--                        <i class="fas fa-clock" style="font-size: 40px; color: #ff9800;"></i>--}}
{{--                    </div>--}}
{{--                    <div class="stats-detail">--}}
{{--                        <h3>{{ $users->where('super_user',1)->count() }}</h3>--}}
{{--                        <p>Admin Users</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Visitors -->--}}
{{--            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                <div class="info-tiles">--}}
{{--                    <div class="info-icon">--}}
{{--                        <i class="icon-visibility" style="font-size: 40px; color: #03a9f4;"></i>--}}
{{--                    </div>--}}
{{--                    <div class="stats-detail">--}}
{{--                        <h3>7500</h3>--}}
{{--                        <p>Visitors</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Courses -->--}}
{{--            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                <div class="info-tiles">--}}
{{--                    <div class="info-icon">--}}
{{--                        <i class="icon-shopping_basket" style="font-size: 40px; color: #e91e63;"></i>--}}
{{--                    </div>--}}
{{--                    <div class="stats-detail">--}}
{{--                        <h3>$300k</h3>--}}
{{--                        <p>Courses</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Signups -->--}}
{{--            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                <div class="info-tiles">--}}
{{--                    <div class="info-icon secondary">--}}
{{--                        <i class="icon-check_circle" style="font-size: 40px; color: #8bc34a;"></i>--}}
{{--                    </div>--}}
{{--                    <div class="stats-detail">--}}
{{--                        <h3>250</h3>--}}
{{--                        <p>Signups</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Orders -->--}}
{{--            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4 col-12">--}}
{{--                <div class="info-tiles">--}}
{{--                    <div class="info-icon secondary">--}}
{{--                        <i class="icon-archive" style="font-size: 40px; color: #9c27b0;"></i>--}}
{{--                    </div>--}}
{{--                    <div class="stats-detail">--}}
{{--                        <h3>2500</h3>--}}
{{--                        <p>Orders</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- Row ends -->
    </div>
</div>

{{--<div class="row">--}}
{{--    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
{{--        <div class="card h-420">--}}
{{--            <div class="card-header">--}}
{{--                <div class="card-title">Visitors</div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row justify-content-center">--}}
{{--                    <div class="col-xl-10">--}}
{{--                        <div id="world-map-markers2" class="chart-height-md1"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row gutters justify-content-center">--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">--}}
{{--                        <div class="info-stats">--}}
{{--                            <span class="info-label"></span>--}}
{{--                            <p class="info-title">Visitors</p>--}}
{{--                            <h3 class="info-total">9000</h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">--}}
{{--                        <div class="info-stats">--}}
{{--                            <span class="info-label"></span>--}}
{{--                            <p class="info-title">Bookings</p>--}}
{{--                            <h3 class="info-total">8000</h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">--}}
{{--                        <div class="info-stats">--}}
{{--                            <span class="info-label secondary"></span>--}}
{{--                            <p class="info-title">Cancellations</p>--}}
{{--                            <h3 class="info-total">75</h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Row end -->


