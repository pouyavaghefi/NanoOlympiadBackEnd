<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar" aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i></i>
						<i></i>
						<i></i>
					</span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link {{ Request::is('/') ? 'active-page' : '' }}" href="{{ route('adm.dash.index') }}" id="dashboardsDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-devices_other nav-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('settings*') ? 'active-page' : '' }}" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-devices_other nav-icon"></i>
                    Settings
                </a>
                <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                    <li>
                        <a class="dropdown-item {{ Request::is('settings/site-settings') ? 'active-page' : '' }}" href="{{ route('adm.set.site') }}">Main Site Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('settings/seo-settings') ? 'active-page' : '' }}" href="{{ route('adm.set.seo') }}">General Seo Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('settings/admin-settings') ? 'active-page' : '' }}" href="{{ route('adm.set.adm') }}">Admin Panel Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('settings/user-settings') ? 'active-page' : '' }}" href="{{ route('adm.set.usr') }}">User Panel Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('settings/coming-settings') ? 'active-page' : '' }}" href="{{ route('adm.set.soon') }}">Coming Soon Settings</a>
                    </li>
                    @php
                        $availableLangs = \App\Models\Language::where('is_active', 1)->get();

                        $langLabels = [];
                        foreach ($availableLangs as $lang) {
                            $langLabels[$lang->code] = $lang->name;
                        }
                    @endphp
                    @if (count($availableLangs) > 1)
                        <li>
                            <a class="dropdown-toggle sub-nav-link" href="#" id="customGallery" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-globe"></i> &nbsp; Other Languages
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="customGallery">
                                @foreach ($availableLangs as $lang)
                                    @if ($lang->code !== 'en')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('adm.set.langs.' . $lang->code) }}">
                                                {{ $langLabels[$lang->code] ?? strtoupper($lang->code) }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                <hr>
                                <li>
                                    <a class="dropdown-item" href="/settings/languages/configurations">
                                        Settings & Configuration
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('landing*') ? 'active-page' : '' }}" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-alt nav-icon"></i>
                    Landing
                </a>
                <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/quick-contact-info') ? 'active-page' : '' }}" href="{{ route('adm.pgs.quick.contact.info') }}">Quick Contact Info</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/topmenu-navigation') ? 'active-page' : '' }}" href="{{ route('adm.pgs.topmenu.info') }}">Top Menu Navigation</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/slider') ? 'active-page' : '' }}" href="{{ route('adm.pgs.slider.info') }}">Slider</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/features') ? 'active-page' : '' }}" href="{{ route('adm.pgs.features.info') }}">Features</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/aboutus') ? 'active-page' : '' }}" href="{{ route('adm.pgs.aboutus.info') }}">Aboutus</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/counter') ? 'active-page' : '' }}" href="{{ route('adm.pgs.counter.info') }}">Counter</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/gallery') ? 'active-page' : '' }}" href="{{ route('adm.pgs.gallery.info') }}">Gallery</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/cta') ? 'active-page' : '' }}" href="{{ route('adm.pgs.cta.info') }}">CTA</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/departments') ? 'active-page' : '' }}" href="{{ route('adm.pgs.departments.info') }}">Departments</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/partners') ? 'active-page' : '' }}" href="{{ route('adm.pgs.partners.info') }}">Partners</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/footer') ? 'active-page' : '' }}" href="{{ route('adm.pgs.footer') }}">Footer</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/subscribers') ? 'active-page' : '' }}" href="{{ route('adm.pgs.subscribers') }}">Subscribers</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('landing/priority') ? 'active-page' : '' }}" href="{{ route('adm.pgs.prior') }}">Priority</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('system*') ? 'active-page' : '' }}" href="#" id="systemDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs nav-icon"></i>
                    System
                </a>
                <ul class="dropdown-menu" aria-labelledby="systemDropdown">

                    <li>
                        <a class="dropdown-item {{ Request::is('system/base-info') ? 'active-page' : '' }}" href="{{ url('system/base-info') }}">
                           Base Info
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('system/country-list') ? 'active-page' : '' }}" href="{{ url('system/country-list') }}">
                            Country List
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('system/admin-optic') ? 'active-page' : '' }}" href="{{ url('system/admin-optic') }}">
                            Admin Optic
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('system/form-handler') ? 'active-page' : '' }}" href="{{ url('system/form-handler') }}">
                            Form Handler
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('system/auth-prefer') ? 'active-page' : '' }}" href="{{ url('system/auth-prefer') }}">
                            Auth Preferences
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('system/error-logs') ? 'active-page' : '' }}" href="{{ url('system/error-log') }}">
                            Error Logs
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item {{ Request::is('system/logs') ? 'active-page' : '' }}" href="{{ url('system/logs') }}">
                            System Logs
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('system/settings') ? 'active-page' : '' }}" href="{{ url('system/settings') }}">
                            System Settings
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-users nav-icon"></i>
                    Users
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('adm.site.users.index') }}">Site Users</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('adm.site.admins.index') }}">Admin Users</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('adm.site.supers.index') }}">Super Users</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="customGallery" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add New <i class="icon-plus-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="customGallery">
                            <li>
                                <a class="dropdown-item" href="{{ route('adm.site.admins.create') }}">Admin</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('adm.site.users.create') }}">Normal</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('courses*') ? 'active-page' : '' }}" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-book nav-icon"></i>
                    Courses
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-item {{ Request::is('courses/all') ? 'active-page' : '' }}" href="{{ route('adm.crs.index') }}">All Courses</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('courses/create') ? 'active-page' : '' }}" href="{{ route('adm.crs.create') }}">Add New</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('academy*') ? 'active-page' : '' }}" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-graduation-cap nav-icon"></i>
                    Academy
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/representatives/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.mem.index') }}">Members Country</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/representatives/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.rep.index') }}">Representatives</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/teachers/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.index') }}">Teachers</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/students/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.index') }}">Students</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/roadmaps/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.index') }}">Roadmaps</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/resources/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.index') }}">Resources</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/certifications/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.create') }}">Certifications</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/assignments/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.index') }}">Assignments</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/schedules/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.create') }}">Schedules</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/performance_reports/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.index') }}">Performance Reports</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/student_achievements/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.create') }}">Student Achievements</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('academy/events_competitions/all') ? 'active-page' : '' }}" href="{{ route('adm.aca.tea.create') }}">Events & Competitions</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-users nav-icon"></i>
                    Pages
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="staticPagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Static Pages <i class="fa fa-file-alt"></i> <!-- changed from fa-plus -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="staticPagesDropdown">
                            <li><a class="dropdown-item" href="{{ route('adm.pgs.statics.create') }}">Add New</a></li>
                            <li><a class="dropdown-item" href="{{ route('adm.pgs.statics.index') }}">All Static Pages</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="dynamicPagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dynamic Pages <i class="fa fa-sync-alt"></i> <!-- changed from fa-plus -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dynamicPagesDropdown">
                            <li><a class="dropdown-item" href="{{ route('adm.pgs.dynamics.new') }}">Add New</a></li>
                            <li><a class="dropdown-item" href="{{ route('adm.pgs.dynamics.index') }}">All Dynamic Pages</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('adm.pgs.statics.index') }}">Course Related Page</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('contact*') ? 'active-page' : '' }}" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-phone nav-icon"></i>
                    Contact
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-item {{ Request::is('contact/info') ? 'active-page' : '' }}" href="{{ route('adm.pgs.contact.info') }}">Information</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Request::is('contact/messages') ? 'active-page' : '' }}" href="{{ route('adm.pgs.contact.messenger') }}">Messages</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
