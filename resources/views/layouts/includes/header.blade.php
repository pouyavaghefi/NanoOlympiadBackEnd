<header class="header">
    <div class="logo-wrapper">
        <a target="_blank" href="{{ env('URL_FRONT') }}" class="logo">
            <img src="{{ env('APP_URL') }}/{{ $bases['panelLogo'] }}" alt="{{ config('mng.title') }}" />
        </a>
{{--        <a href="#" class="quick-links-btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick Links">--}}
{{--            <i class="icon-menu1"></i>--}}
{{--        </a>--}}
    </div>
    <div class="header-items">
        <!-- Custom search start -->
{{--        <div class="custom-search">--}}
{{--            <input type="text" class="search-query" placeholder="Search here ...">--}}
{{--            <i class="icon-search1"></i>--}}
{{--        </div>--}}
        <!-- Custom search end -->

        <!-- Header actions start -->
        <ul class="header-actions">
{{--            <li class="dropdown">--}}
{{--                <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">--}}
{{--                    <i class="icon-box"></i>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">--}}
{{--                    <div class="dropdown-menu-header">--}}
{{--                        Tasks (05)--}}
{{--                    </div>--}}
{{--                    <ul class="header-tasks">--}}
{{--                        <li>--}}
{{--                            <p>#48 - Dashboard UI<span>90%</span></p>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">--}}
{{--                                    <span class="sr-only">90% Complete (success)</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p>#95 - Alignment Fix<span>60%</span></p>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">--}}
{{--                                    <span class="sr-only">60% Complete (success)</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p>#7 - Broken Button<span>40%</span></p>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">--}}
{{--                                    <span class="sr-only">40% Complete (success)</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}
            <li class="dropdown">
                @if(count($adminNotifs) > 0)
                <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                    <i class="icon-bell"></i>
                    <span class="count-label">
                        {{ count($adminNotifs) > 0 ? '('.count($adminNotifs).')' : '' }}
                    </span>
                </a>
                @endif
                <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                    <div class="dropdown-menu-header">
                        Notifications ({{ count($adminNotifs) }})
                    </div>
                    <ul class="header-notifications">
                        @foreach($adminNotifs as $notif)
                        <li>
                            <a href="{{ route('adm.notifs.admin.view', $notif->id) }}">
                                <div class="user-img away">
                                    <img src="img/avatar.png" alt="User" />
                                </div>
                                <div class="details">
                                    <div class="user-title">{{ $notif->title ?? '' }}</div>
                                    <div class="noti-details">{{ $notif->message ?? '' }}</div>
                                    <div class="noti-date">{{ $notif->created_at }}</div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                    <span class="user-name">{{ auth()->user()->uname ?? '' }}</span>
                    <span class="avatar">{{ auth()->user()->summary() ?? '' }}<span class="status busy"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <div class="header-user-profile">
                            <div class="header-user">
                                <img src="/img/avatar.png" alt="Admin Template" />
                            </div>
                            <h5>{{ auth()->user()->fullName() ?? '' }}</h5>
                            <p>
                                @if(auth()->user()->super_user == 1)
                                    Super Admin
                                @else
                                    Admin
                                @endif
                            </p>
                        </div>
                        <a href="/admin-profile"><i class="icon-user1"></i> My Profile</a>
                        <a href="/account-settings"><i class="icon-settings1"></i> Account Settings</a>

                        <!-- Sign Out Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <!-- Trigger Sign Out via Form -->
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-log-out1"></i> Sign Out
                        </a>
                    </div>
                </div>
            </li>
{{--            <li>--}}
{{--                <a href="#" class="quick-settings-btn" data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick Settings">--}}
{{--                    <i class="icon-list"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <!-- Header actions end -->
    </div>
</header>
